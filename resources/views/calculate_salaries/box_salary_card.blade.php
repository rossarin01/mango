<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th class="fixed-column" rowspan="3" style="vertical-align: middle; background-color:#049d20; color:#FFF;">พนักงาน</th>
                @foreach ($roster_workdates as $workdate )
                    <input type="hidden" name="days[]" value="{{ $workdate }}">
                    <th colspan="5" style="text-align: center">
                        {{ date('D, j M Y', strtotime($workdate)) }}
                        <input type="hidden" name="workdate[{{ $workdate }}]" value="{{ $workdate ?? null }}" class="form-control" readonly>
                    </th>
                @endforeach
                <th rowspan="3" style="background-color:#fa8336; color:#FFF; vertical-align: middle; text-align:center">Total Hours</th>
                <th rowspan="2" colspan="13" style="vertical-align: middle; text-align:center">Weekly Summary</th>
            </tr>
            <tr style="background-color:#049d20;">
                @foreach ($roster_workdates as $workdate )
                    <th colspan="2" style="text-align: center; color:#FFF;">เช้า</th>
                    <th colspan="2" style="text-align: center; color:#FFF;">บ่าย</th>
                    <th></th>
                @endforeach
            </tr>
            <tr style="background-color:#049d20; text-align: center">
                @foreach ($roster_template_details as $roster_template )
                    <th style="color:#FFF; text-align: center">เข้า {{ date('H:i', strtoTime($roster_template->morning_shift)) }}</th>
                    <th style="color:#FFF; text-align: center">ออก {{ date('H:i', strtoTime($roster_template->morning_end)) }}</th>
                    <th style="color:#FFF; text-align: center">เข้า {{ date('H:i', strtoTime($roster_template->evening_shift)) }}</th>
                    <th style="color:#FFF; text-align: center">ออก {{ date('H:i', strtoTime($roster_template->evening_end)) }}</th>
                    <th style="color:#FFF; text-align: center">HR</th>
                @endforeach
                <th style="color:#FFF;">Weekday Hours</th>
                <th style="color:#FFF;">Weekend Hours</th>
                <th style="color:#FFF;">Weekday Rate</th>
                <th style="color:#FFF;">Weekend Rate</th>
                <th style="background-color:#fa8336; color:#FFF;">Pay</th>
                <th style="color:#FFF;">Diff</th>
                <th style="color:#FFF;">Surcharge</th>
                <th style="background-color:#fa8336; color:#FFF;">Total</th>
                <th style="background-color:#f9d347; color:#000;">Cash Pay</th>
                <th style="color:#FFF;">Transfer Pay</th>
                <th style="color:#FFF;">Payroll transfer</th>
                <th style="color:#FFF;">TAX</th>
                <th style="color:#FFF;">SUPPER</th>
            </tr>
        </thead>
        <tbody>
            @php
                use App\Helpers\TransferBioTime;
            @endphp
            @foreach ($employees as $employee )
            <tr>
                @php
                    $weekly_total_hours = 0;
                    $weekday_total_hours = 0;
                    $weekend_total_hours = 0;
                @endphp
                <td>
                    {{ $employee->name }}
                    <input type="hidden" name="emp_id[{{ $employee->id }}]" value="{{ $employee->id }}">
                </td>
                @foreach ($roster_workdates as $key => $workdate )
                    @php

                        if(isset($roster_tempalte_times[$employee->id][$workdate]['morning_shift'])){
                            $workdate_morning_shift = date('H:i', strtotime($roster_tempalte_times[$employee->id][$workdate]['morning_shift']));
                        }else{
                            $workdate_morning_shift = '-';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['morning_shift'])){
                            $checkin_morning_shift = $checkin_checkouts[$employee->id][$workdate]['morning_shift'];
                            $checkin_checkout_id = $checkin_checkouts[$employee->id][$workdate]['id'];
                        }else{
                            $checkin_morning_shift = '';
                            $checkin_checkout_id = '';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['id'])){
                            $checkin_checkout_id = $checkin_checkouts[$employee->id][$workdate]['id'];
                        }else{
                            $checkin_checkout_id = '';
                        }

                        $class_compare = (new TransferBioTime)->compareTime($workdate_morning_shift, $checkin_morning_shift, 'checkin');

                    @endphp
                    <td style="background-color: {{ $class_compare['class_bg'] }}; color:{{ $class_compare['class_font_color'] }}">
                        <input type="hidden" name="checkin_checkout_id[{{ $employee->id }}][{{ $workdate }}]" value="{{ $checkin_checkout_id }}">
                        {{ $workdate_morning_shift }}
                        @if(!empty($checkin_morning_shift))
                            <input type="time"  id="morning_shift_{{$employee->id}}_{{$key}}" name="morning_shift[{{ $employee->id }}][{{ $workdate }}]" value="{{ $checkin_morning_shift }}">
                            <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="morning_shift_{{$employee->id}}_{{$key}}" title ="ลบ">
                                <i class="ti ti-trash text-white ti-sm"></i>
                            </button>
                        @endif
                    </td>

                    @php
                        if(isset($roster_tempalte_times[$employee->id][$workdate]['morning_end'])){
                            $workdate_morning_end = date('H:i', strtotime($roster_tempalte_times[$employee->id][$workdate]['morning_end']));
                        }else{
                            $workdate_morning_end = '-';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['morning_end'])){
                            $checkin_morning_end = $checkin_checkouts[$employee->id][$workdate]['morning_end'];
                        }else{
                            $checkin_morning_end = '';
                        }

                        $class_compare = (new TransferBioTime)->compareTime($workdate_morning_end, $checkin_morning_end, 'checkout');
                    @endphp
                    <td style="background-color: {{ $class_compare['class_bg'] }}; color:{{ $class_compare['class_font_color'] }}">
                        {{ $workdate_morning_end }}
                        @if(!empty($checkin_morning_end))
                            <input type="time" id="morning_end_{{$employee->id}}_{{$key}}" name="morning_end[{{ $employee->id }}][{{ $workdate }}]" value="{{ $checkin_morning_end }}" >
                            <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="morning_end_{{$employee->id}}_{{$key}}" title ="ลบ">
                                <i class="ti ti-trash text-white ti-sm"></i>
                            </button>
                        @endif
                    </td>

                    @php
                        if(isset($roster_tempalte_times[$employee->id][$workdate]['evening_shift'])){
                            $workdate_evening_shift = date('H:i', strtotime($roster_tempalte_times[$employee->id][$workdate]['evening_shift']));
                        }else{
                            $workdate_evening_shift = '-';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['evening_shift'])){
                            $checkin_evening_shift = $checkin_checkouts[$employee->id][$workdate]['evening_shift'];
                        }else{
                            $checkin_evening_shift = '';
                        }

                        $class_compare = (new TransferBioTime)->compareTime($workdate_evening_shift, $checkin_evening_shift, 'checkin');
                    @endphp
                    <td style="background-color: {{ $class_compare['class_bg'] }}; color:{{ $class_compare['class_font_color'] }}">
                        {{ $workdate_evening_shift }}
                        @if(!empty($checkin_evening_shift))
                            <input type="time" id="evening_shift_{{$employee->id}}_{{$key}}" name="evening_shift[{{ $employee->id }}][{{ $workdate }}]" value="{{ $checkin_evening_shift }}">
                            <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="evening_shift_{{$employee->id}}_{{$key}}" title ="ลบ">
                                <i class="ti ti-trash text-white ti-sm"></i>
                            </button>
                        @endif
                    </td>

                    @php
                        if(isset($roster_tempalte_times[$employee->id][$workdate]['evening_end'])){
                            $workdate_evening_end = date('H:i', strtotime($roster_tempalte_times[$employee->id][$workdate]['evening_end']));
                        }else{
                            $workdate_evening_end = '-';
                        }

                        if(isset($checkin_checkouts[$employee->id][$workdate]['evening_end'])){
                            $checkin_evening_end = $checkin_checkouts[$employee->id][$workdate]['evening_end'];
                        }else{
                            $checkin_evening_end = '';
                        }

                        $class_compare = (new TransferBioTime)->compareTime($workdate_evening_end, $checkin_evening_end, 'checkout');
                    @endphp
                    <td style="background-color: {{ $class_compare['class_bg'] }}; color:{{ $class_compare['class_font_color'] }}">
                        {{ $workdate_evening_end }}
                        @if(!empty($checkin_evening_end))
                            <input type="time" id="evening_end_{{$employee->id}}_{{$key}}" name="evening_end[{{ $employee->id }}][{{ $workdate }}]" value="{{ $checkin_evening_end }}">
                            <button type="button" class="mt-1 btn btn-sm btn-icon btn-danger me-2 btndel_detail" data-column_id="evening_end_{{$employee->id}}_{{$key}}" title ="ลบ">
                                <i class="ti ti-trash text-white ti-sm"></i>
                            </button>
                        @endif
                    </td>

                    <td>
                        @php
                            $morning_shift = strtotime($checkin_morning_shift);
                            $morning_end = strtotime($checkin_morning_end);
                            $hr_morning = round( abs($morning_shift - $morning_end) / 3600, 2 );

                            $evening_shift = strtotime($checkin_evening_shift);
                            $evening_end = strtotime($checkin_evening_end);
                            $hr_evening = round( abs($evening_shift - $evening_end) / 3600, 2 );

                            $hr = round($hr_morning + $hr_evening , 2);
                            $hours = floor($hr); // ชั่วโมงเต็ม
                            $minutes = round(($hr - $hours) * 60); // เศษชั่วโมงแปลงเป็นนาที

                            if($hours == 0 && $minutes == 0){
                                $total_day_hours = 0;
                            }else{
                                $total_day_hours = $hours.".".$minutes;
                            }
                        @endphp

                        {{ $total_day_hours }}

                    </td>

                    @php
                        $dayname = date('D', strtotime($workdate));
                        $dayname = strtoupper($dayname);
                        if($dayname == 'SAT' || $dayname == 'SUN'){
                            $weekend_total_hours += $total_day_hours;
                        }else{
                            $weekday_total_hours += $total_day_hours;
                        }

                        $weekly_total_hours += $total_day_hours;
                    @endphp
                @endforeach

                <td style="background-color:#fa8336; color:#FFF;">
                    @php
                        if(isset($calculate_salary_weeklies[$employee->id]['id']) && !is_null($calculate_salary_weeklies[$employee->id]['id'])){
                            $weekly_id = $calculate_salary_weeklies[$employee->id]['id'];
                        }
                    @endphp
                    <input type="hidden" id="weekly_id_{{$employee->id}}" name="weekly_id[{{ $employee->id }}]" value="{{ $weekly_id ?? '' }}">

                    @php
                        if(isset($calculate_salary_weeklies[$employee->id]['total_hours']) && !is_null($calculate_salary_weeklies[$employee->id]['total_hours'])){
                            $weekly_total_hours = $calculate_salary_weeklies[$employee->id]['total_hours'];
                        }
                    @endphp
                    {{ $weekly_total_hours }}
                    <input type="hidden" id="weekly_total_hours_{{$employee->id}}" name="weekly_total_hours[{{ $employee->id }}]" value="{{ $weekly_total_hours }}">
                </td>
                <td>
                    @php
                        if(isset($calculate_salary_weeklies[$employee->id]['weekday_hours']) && !is_null($calculate_salary_weeklies[$employee->id]['weekday_hours'])){
                            $weekday_total_hours = $calculate_salary_weeklies[$employee->id]['weekday_hours'];
                        }
                    @endphp
                    {{ $weekday_total_hours }}
                    <input type="hidden" id="weekday_total_hours_{{$employee->id}}" name="weekday_total_hours[{{ $employee->id }}]"
                    value="{{ $weekday_total_hours }}" class="weekday_total_hours" data-column_id="{{ $employee->id }}">
                </td>
                <td>
                    @php
                        if(isset($calculate_salary_weeklies[$employee->id]['weekend_hours']) && !is_null($calculate_salary_weeklies[$employee->id]['weekend_hours'])){
                            $weekend_total_hours = $calculate_salary_weeklies[$employee->id]['weekend_hours'];
                        }
                    @endphp
                    {{ $weekend_total_hours }}
                    <input type="hidden" id="weekend_total_hours_{{$employee->id}}" name="weekend_total_hours[{{ $employee->id }}]"
                    value="{{ $weekend_total_hours }}" class="weekend_total_hours" data-column_id="{{ $employee->id }}">
                </td>
                <td>
                    <input type="number" id="weekday_rate_{{ $employee->id }}" name="weekday_rate[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['weekday_rate'] ?? '' }}" class="weekday_rate" data-column_id="{{ $employee->id }}" step="0.01">
                </td>
                <td>
                    <input type="number" id="weekend_rate_{{$employee->id}}" name="weekend_rate[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['weekend_rate'] ?? '' }}" class="weekend_rate" data-column_id="{{ $employee->id }}" step="0.01">
                </td>
                <td style="background-color:#fa8336; color:#FFF;">
                    <input type="number" id="weekend_payment_{{$employee->id}}" name="weekend_payment[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['payment'] ?? '' }}" class="weekend_payment" data-column_id="{{ $employee->id }}" readonly>
                </td>
                <td>
                    <input type="number" id="weekend_diff_{{$employee->id}}" name="weekend_diff[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['diff'] ?? '' }}" class="weekend_diff" data-column_id="{{ $employee->id }}" step="0.01">
                </td>
                <td>
                    <input type="number" id="weekend_surcharge_{{$employee->id}}" name="weekend_surcharge[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['surcharge'] ?? '' }}" class="weekend_surcharge" data-column_id="{{ $employee->id }}" step="0.01">
                </td>
                <td style="background-color:#fa8336; color:#FFF;">
                    <input type="number" id="weekend_total_{{$employee->id}}" name="weekend_total[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['total'] ?? '' }}" class="weekend_total" data-column_id="{{ $employee->id }}" readonly>
                </td>
                <td style="background-color:#f9d347; color:#000;">
                    <input type="number" id="weekend_cash_payment_{{$employee->id}}" name="weekend_cash_payment[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['cash_payment'] ?? '' }}" step="0.01">
                </td>
                <td>
                    <input type="number" id="weekend_transfer_payment_{{$employee->id}}" name="weekend_transfer_payment[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['transfer_payment'] ?? '' }}" step="0.01">
                </td>
                <td>
                    <input type="number" id="weekend_payroll_transfer_{{$employee->id}}" name="weekend_payroll_transfer[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['payroll_transfer'] ?? '' }}"  step="0.01">
                </td>
                <td>
                    <input type="number" id="weekend_tax_{{$employee->id}}" name="weekend_tax[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['tax'] ?? '' }}"  step="0.01">
                </td>
                <td>
                    <input type="number" id="weekend_super_{{$employee->id}}" name="weekend_super[{{ $employee->id }}]"
                    value="{{ $calculate_salary_weeklies[$employee->id]['super'] ?? '' }}" step="0.01">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<style>
    .table th {
        white-space: nowrap; /* ป้องกันข้อความยาวเกิน */
    }

    .table td:first-child {
        position: sticky;
        left: 0;
        z-index: 10; /* เพิ่มระดับความสูงเพื่อไม่ให้ถูกซ้อน */
        background-color: #FFF
    }

    .fixed-column {
        position: sticky;
        left: 0;
        background-color: #049d20; /* พื้นหลังของคอลัมน์แรก */
        color: #FFF;
        z-index: 10; /* เพิ่มค่า z-index เพื่อไม่ให้ถูกทับ */
        vertical-align: middle;
    }
</style>
