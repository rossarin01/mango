<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\employees;
use App\Models\checkin_checkout;
use App\Models\RosterDetail;

class TransferBioTime
{
    function getEmployee()
    {
        $emp_biotime = DB::connection('mysql_biotime')->table('personnel_employee')->get();

        foreach($emp_biotime as $emp){
            $data = [
                'name' => $emp->first_name.' '.$emp->last_name,
                'branch' => $emp->department_id,
            ];
            employees::updateOrCreate(['emp_code_biotime' => $emp->emp_code], $data);
        }
        return true;
    }

    public function getTransaction($today=null)
    {
        /**
         * == ฟังก์ชั่น ดึงเวลา เงื่อนไขการตรวจสอบ ดังนี้
         * == Checkin morning_shift บันทึกได้เลย โดยใช้เวลาสแกนครั้งแรก
         * == Checkout morning_end ตรวจสอบว่ามีการ morning_shift หรือไม่
         * == -- ถ้ามี ให้ตรวจสอบมี roster ตอนบ่ายหรือไม่
         * == -- ถ้ามีงานบ่าย ให้บันทึกล่วงเวลา OT ไม่เกิน 45 นาที
         * == -- ถ้าไม่มีงานบ่าย ให้ใช้เวลาล่าสุด
         *
         * == Checkin evening_shift ตรวจสอบมีงานเช้า morning_shift หรือไม่
         * == -- ถ้าไม่มีงานเช้า ให้บันทึกได้เลย ใช้เวลาครั้งแรก (ล่วงหน้าไม่เกิน 1 ชม.)
         * == -- ถ้ามีงานเช้า ให้ตรวจสอบมีเวลาบันทึกออกงานตอนเช้าหรือไม่ (ล่วงหน้าไม่เกิน 15 นาที)
         * == -- ถ้ามีบันทึกออกงานตอนเช้า morning_end ให้สแกนนิ้วล่วงหน้าไม่เกิน 15 นาทีก่อนเข้างาน
         * == Checkout evening_end ให้ตรวจสอบว่ามีการเข้างานบ่ายหรือไม่
         * == -- ถ้ามีให้ทำการบันทึกโดยใช้เวลาล่าสุด
         */


        if(!is_null($today)){
            $today = $today;
        }else{
            $today = date('Y-m-d');
        }

        $iclock_transaction = DB::connection('mysql_biotime')->table('iclock_transaction')
            ->whereDate('punch_time', $today)->orderby('punch_time')->get();

        $roster_details = RosterDetail::where([
                ['is_active', 'Y'],
                ['workdate', $today]
            ])->get();

        foreach($iclock_transaction as $transction){
            foreach($roster_details as $roster_detail){

                $employees = employees::where('emp_code_biotime', $transction->emp_code)->first();
                $checkin_checkout = checkin_checkout::where([
                        ['workdate', $today],
                        ['employee_id', $employees->id]
                    ])->first();

                $punch_time = date('H:i', strtotime($transction->punch_time));

                $checkin_checkout_id = $checkin_checkout->id ?? null;
                $morning_shift = null;
                $morning_end = null;
                $evening_shift = null;
                $evening_end = null;

                $data = [];
                $data = [
                    'employee_id' => $employees->id,
                    'branch_id' => $employees->branch,
                    'department_id' => $employees->department,
                    'workdate' => $today,
                ];

                // ช่วงเช้า
                if(!is_null($roster_detail->morning_shift)){ // มีตารางงานใน roster
                    if(is_null($checkin_checkout) || is_null($checkin_checkout->morning_shift)){

                        if(is_null($morning_shift)){ // ใช้เวลาสแกนครั้งแรก
                            $morning_shift = $punch_time;
                            $data['morning_shift'] = $morning_shift;
                            $data['morning_shift_punch_time'] = $morning_shift;
                        }

                    }elseif(!is_null($checkin_checkout->morning_shift) && is_null($checkin_checkout->evening_shift)){

                        /**
                         * == ป้องกันการสแกนนิ้วซ้ำ Checkin โดยมีเงื่อนไข
                         * == โดยจะ Checkout ออกได้ต้องห่างจาก Checkin 30 นาที
                         */
                        $time1 = strtotime($punch_time);
                        $time2 = strtotime($checkin_checkout->morning_shift);
                        $diff_in_minutes = abs($time2 - $time1) / 60;

                        if($diff_in_minutes > 30){ // ถ้าเช็คห่างจากเดิม 30 นาที ให้บันทึกค่าใหม่เป็น checkout

                            if(!is_null($checkin_checkout->morning_end) && !is_null($roster_detail->evening_shift)){ // ถ้ามีงานบ่าย
                                $time_m1 = strtotime($punch_time);
                                $time_m2 = strtotime($roster_detail->evening_shift);
                                $diff_in_minutes = ($time_m2 - $time_m1) / 60;

                                if($diff_in_minutes > 15){
                                    $morning_end = $punch_time;
                                    $data['morning_end'] = $morning_end;
                                    $data['morning_end_punch_time'] = $morning_end;
                                }
                            }else{
                                $morning_end = $punch_time;
                                $data['morning_end'] = $morning_end;
                                $data['morning_end_punch_time'] = $morning_end;
                            }

                        }
                    }
                }
                // End ช่วงเช้า
                // ช่วงบ่าย
                if(!is_null($roster_detail->evening_shift)){ // มีตารางงานใน roster

                    if(is_null($roster_detail->morning_shift) || is_null($checkin_checkout)){

                        if(is_null($checkin_checkout) || is_null($checkin_checkout->evening_shift)){ // ไม่มีงานเช้า

                            $check_time = strtotime($punch_time);
                            $roste_evening_shift = strtotime($roster_detail->evening_shift);
                            $diff_in_minutes = ($roste_evening_shift - $check_time) / 60;

                            if($diff_in_minutes < 60){ // เช็คอินล่วงหน้าไม่เกิน 1 ชม.
                                if(is_null($evening_shift)){ // ใช้เวลาสแกนครั้งแรก
                                    $evening_shift = $punch_time;
                                    $data['evening_shift'] = $evening_shift;
                                    $data['evening_shift_punch_time'] = $evening_shift;
                                }
                            }

                        }

                    }elseif(!is_null($checkin_checkout->morning_end) && is_null($checkin_checkout->evening_shift)){ // ถ้ามีงานช่วงเช้า

                        $check_time = strtotime($punch_time);
                        $check_morning_end = strtotime($checkin_checkout->morning_end);
                        $diff_in_minutes_morning = ($check_time - $check_morning_end) / 60;

                        if($diff_in_minutes_morning > 0){ //ตรวจสอบ เวลาเข้างานบ่าย ต้องมากกว่า เวลาออกตอนเช้า
                            $roste_evening_shift = strtotime($roster_detail->evening_shift);
                            $diff_in_minutes = ($roste_evening_shift - $check_time) / 60;

                            if($diff_in_minutes <= 15){ // เช็คอินล่วงหน้าไม่เกิน 15 นาที
                                if(is_null($evening_shift)){ // ใช้เวลาสแกนครั้งแรก
                                    $evening_shift = $punch_time;
                                    $data['evening_shift'] = $evening_shift;
                                    $data['evening_shift_punch_time'] = $evening_shift;
                                }
                            }
                        }

                    }elseif(!is_null($checkin_checkout->evening_shift)){
                        // dd('evening_shift');
                        /**
                         * == ป้องกันการสแกนนิ้วซ้ำ Checkin โดยมีเงื่อนไข
                         * == โดยจะ Checkout ออกได้ต้องห่างจาก Checkin 30 นาที
                         */
                        $time1 = strtotime($punch_time);
                        $time2 = strtotime($checkin_checkout->evening_shift);
                        $diff_in_minutes = abs($time2 - $time1) / 60;

                        if($diff_in_minutes > 30){ // ถ้าเช็คห่างจากเดิม 30 นาที ให้บันทึกค่าใหม่เป็น checkout
                            $evening_end = $punch_time;
                            $data['evening_end'] = $evening_end;
                            $data['evening_end_punch_time'] = $evening_end;
                        }

                    }

                }
                // End ช่วงบ่าย

                checkin_checkout::updateOrCreate(['id' => $checkin_checkout_id], $data);

            }
        }

    }

    public function compareTime($workdate_time, $checktime, $type)
    {
        /**
         * == เงื่อนไขการแสดงเวลา มาสายแสดงสีแดง , มาไม่ตรง roster ให้แสดงสีเหลือง
         * == -- ถ้ามาสายเกิน 30 นาที ให้เป็นไม่ตรง roster
         * == -- มาเร็วกว่า 35 นาที่ ให้เป็นไม่ตรง roster
         */

        $class_bg = '';
        $class_font_color = '';

        if(!empty($checktime)){
            if($workdate_time == '-' && $checktime != ''){ // ไม่มีในตารางาน

                $class_bg = '#f9d347';
                $class_font_color = '#000';

            }else{ // มาสาย - กลับก่อน

                $check_workdate = strtotime($workdate_time);
                $check_time = strtotime($checktime);
                $diff_in_minutes = ($check_time - $check_workdate) / 60;

                // Check มาสาย - กลับก่อน
                if($type == 'checkin'){
                    if($diff_in_minutes > 0){
                        $class_bg = '#f1322f';
                        $class_font_color = '#FFFFFF';
                    }
                }elseif($type == 'checkout'){
                    if($diff_in_minutes < 0){
                        $class_bg = '#f1322f';
                        $class_font_color = '#FFFFFF';
                    }
                }
                // End Check มาสาย - กลับก่อน

                // Check ไม่ตรง Roster
                if($type == 'checkin'){
                    if($diff_in_minutes < -35){ // มาเร็วมากกว่า 35 นาที
                        // dd($diff_in_minutes);
                        $class_bg = '#f9d347';
                        $class_font_color = '#000';
                    }elseif($diff_in_minutes > 30){ // มาสายมากกว่า 30 นาที
                        $class_bg = '#f9d347';
                        $class_font_color = '#000';
                    }
                }
                // End Check ไม่ตรง Roster
            }
        }

        $data = [
            'class_bg' => $class_bg,
            'class_font_color' => $class_font_color
        ];

        return $data;
    }
}
