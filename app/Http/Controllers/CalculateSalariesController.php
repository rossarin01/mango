<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Exports\CalculateSalaryExport;
use App\Models\employees;
use App\Models\branch;
use App\Models\Department;
use App\Models\CalculateSalary;
use App\Models\CalculateSalaryDetail;
use App\Models\CalculateSalaryWeekly;
use App\Models\Roster;
use App\Models\RosterDetail;
use App\Models\checkin_checkout;
use App\Models\RosterTemplate;
use App\Models\RosterTemplateDetail;
use Excel;

class CalculateSalariesController extends Controller
{
    public function index()
    {
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', '1')->get();

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
        ];

        return view('calculate_salaries.index', $data);
    }

    public function datatable()
    {
        $search_branch = request('search_branch');
        $search_department = request('search_department');

        $data = CalculateSalary::select(['*', DB::raw('ROW_NUMBER() OVER (ORDER BY id DESC) AS rownum')])
            ->WhereNotNull('id')
            ->where('is_active', 'Y')
            ->orderBy('id', 'desc');

        if($search_branch != ''){
            $data->where('branch_id', $search_branch);
        }

        if($search_department != ''){
            $data->where('department_id',$search_department);
        }

        $sQuery	= Datatables::of($data)
        ->addColumn('rownum',function($data){
			return $data->rownum;
		})
        ->editColumn('department',function($data){
            return $data->department?->department_name ?? '';
		})
        ->editColumn('branch',function($data){
            return $data->branch?->branch_name ?? '';
		})
        ->addColumn('btnedit',function($data){
            return '
                <button class="btn btn-sm btn-icon btn-warning me-2 btn_edit" data-calculate_salary_id="'.$data->id.'" title ="แก้ไข">
                    <i class="ti ti-pencil text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-info me-2 btn_export" data-calculate_salary_id="'.$data->id.'" title ="ดูรายละเอียด">
                    <i class="ti ti-share text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-danger me-2 btn_delete" data-calculate_salary_id="'.$data->id.'" title ="ลบ">
                    <i class="ti ti-trash text-white ti-sm"></i>
                </button>
            ';
		});

		return $sQuery->escapeColumns([])->make(true);
    }

    public function create()
    {
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', '1')->get();
        $calculate_salary_roster = CalculateSalary::where('is_active', 'Y')->groupBy('roster_id')->pluck('roster_id');

        $rosters = Roster::where([
                ['is_active', 'Y'],
                ['branch_id', '1'],
                ['department_id', '1']
            ])
            ->whereNotIn('id', $calculate_salary_roster)
            ->get();

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
            'rosters' => $rosters,
        ];

        return view('calculate_salaries.create', $data);
    }

    public function salaryDetailCreate()
    {
        $branch_id = request('branch_id');
        $department_id = request('department_id');
        $roster_id = request('roster_id');

        // หา Employee
        $employee_roster = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->groupBy('employee_id')
            ->pluck('employee_id');

        $employees = employees::where('is_active', 'Y')
            ->whereIn('id', $employee_roster)
            ->get();
        // End หา Employee

        // หาเวลา ของ Template แสดงส่วน header
        $roster = Roster::where('id', $roster_id)->first();

        $roster_template_details = RosterTemplateDetail::where([
                ['is_active', 'Y'],
                ['roster_template_id', $roster->roster_template_id]
            ])
            ->orderBy('day')
            ->get();
        // End หาเวลา ของ Template แสดงส่วน header

        // หาเวลา ของ roster แต่ละ user
        $roster_workdates = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->orderBy('workdate')
            ->groupBy('workdate')
            ->pluck('workdate');

        $roster_details = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->orderBy('workdate')
            ->get()
            ->groupBy('workdate');

        $roster_tempalte_times = null;
        foreach($roster_details as $roster_detail){
            foreach($roster_detail as $detail){
                $roster_tempalte_times[$detail->employee_id][$detail->workdate] = $detail->toArray();
            }
        }
        // End หาเวลา ของ roster แต่ละ user

        // ดึงข้อมูล Checkin จากเครื่องสแกน
        $checkincheckouts = checkin_checkout::where('is_active', 'Y')
            ->whereIn('workdate', $roster_workdates)
            ->whereIn('employee_id', $employee_roster)
            ->get();

        $checkin_checkouts = null;
        foreach($checkincheckouts as $checkin){
            $checkin_checkouts[$checkin->employee_id][$checkin->workdate] = $checkin->toArray();
        }
        // End ดึงข้อมูล Checkin จากเครื่องสแกน

        $data= [
            'employees' => $employees,
            'roster_workdates' => $roster_workdates,
            'roster_template_details' => $roster_template_details,
            'roster_tempalte_times' => $roster_tempalte_times,
            'checkin_checkouts'=> $checkin_checkouts,
        ];

        return view('calculate_salaries.box_salary_card', $data)->render();
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $calculate_salary_id = $request->calculate_salary_id;
            $data_salary = [
                'roster_id' => $request->roster,
                'branch_id' => $request->branch,
                'department_id' => $request->department,
                'name' => $request->salary_name,
            ];

            $salary = CalculateSalary::updateOrCreate(['id' => $calculate_salary_id], $data_salary);

            $employees = $request->emp_id;
            $days = $request->days;
            $workdate = $request->workdate;
            $morning_shift = $request->morning_shift;
            $morning_end = $request->morning_end;
            $evening_shift = $request->evening_shift;
            $evening_end = $request->evening_end;
            $hours_day = $request->hours_day;
            $checkin_checkout_id = $request->checkin_checkout_id;

            foreach($employees as $emp_id){
                foreach($days as $day){

                    // คำนวน ชั่วโมง/วัน
                    $m_shift = strtotime($morning_shift[$emp_id][$day] ?? null);
                    $m_end = strtotime($morning_end[$emp_id][$day] ?? null);
                    $hr_morning = round( abs($m_shift - $m_end) / 3600, 2 );

                    $e_shift = strtotime($evening_shift[$emp_id][$day] ?? null);
                    $e_end = strtotime($evening_end[$emp_id][$day] ?? null);
                    $hr_evening = round( abs($e_shift - $e_end) / 3600, 2 );

                    $hr = round($hr_morning + $hr_evening , 2);
                    $hours = floor($hr); // ชั่วโมงเต็ม
                    $minutes = round(($hr - $hours) * 60); // เศษชั่วโมงแปลงเป็นนาที

                    if($hours == 0 && $minutes == 0){
                        $total_day_hours = 0;
                    }else{
                        $total_day_hours = $hours.".".$minutes;
                    }

                    $total_day_hours_numeric = floatval($total_day_hours);
                    // End คำนวน ชั่วโมง/วัน

                    // ตาราง CalculateSalaryDetail อาจจะไม่ใช้ เพราะจะใช้ตาราง checkin_checkout ตารางเดียว
                    $salary_detail = [
                        // 'calculate_salary_id' => $salary->id,
                        // 'employee_id' => $emp_id,
                        // 'workdate' => $day,
                        'morning_shift' => $morning_shift[$emp_id][$day] ?? null,
                        'morning_end' => $morning_end[$emp_id][$day] ?? null,
                        'evening_shift' => $evening_shift[$emp_id][$day] ?? null,
                        'evening_end' => $evening_end[$emp_id][$day] ?? null,
                        'working_hours' => $total_day_hours_numeric,
                    ];

                    CalculateSalaryDetail::updateOrCreate([
                        'calculate_salary_id' => $salary->id,
                        'employee_id' => $emp_id,
                        'workdate' => $day,
                    ], $salary_detail);
                    // End ตาราง CalculateSalaryDetail อาจจะไม่ใช้ เพราะจะใช้ตาราง checkin_checkout ตารางเดียว

                    $checkin_data = [
                        'calculate_salary_id' => $salary->id,
                        'employee_id' => $emp_id,
                        'branch_id' => $request->branch,
                        'department_id' => $request->department,
                        'workdate' => $day,
                        'morning_shift' => $morning_shift[$emp_id][$day] ?? null,
                        'morning_end' => $morning_end[$emp_id][$day] ?? null,
                        'evening_shift' => $evening_shift[$emp_id][$day] ?? null,
                        'evening_end' => $evening_end[$emp_id][$day] ?? null,
                        'working_hours' => $total_day_hours_numeric,
                    ];

                    checkin_checkout::where('id' ,$checkin_checkout_id[$emp_id][$day])->update($checkin_data);
                }

                // Weekly Summary
                $data_weekly = [
                    'calculate_salary_id' => $salary->id,
                    'employee_id' => $emp_id,
                    'total_hours' => $request->weekly_total_hours[$emp_id],
                    'weekday_hours' => $request->weekday_total_hours[$emp_id],
                    'weekend_hours' => $request->weekend_total_hours[$emp_id],
                    'weekday_rate' => $request->weekday_rate[$emp_id],
                    'weekend_rate' => $request->weekend_rate[$emp_id],
                    'payment' => $request->weekend_payment[$emp_id],
                    'diff' => $request->weekend_diff[$emp_id],
                    'surcharge' => $request->weekend_surcharge[$emp_id],
                    'total' => $request->weekend_total[$emp_id],
                    'cash_payment' => $request->weekend_cash_payment[$emp_id],
                    'transfer_payment' => $request->weekend_transfer_payment[$emp_id],
                    'payroll_transfer' => $request->weekend_payroll_transfer[$emp_id],
                    'tax' => $request->weekend_tax[$emp_id],
                    'super' => $request->weekend_tax[$emp_id],
                ];

                CalculateSalaryWeekly::updateOrCreate(['id' => $request->weekly_id[$emp_id]], $data_weekly);

                // End Weekly Summary
            }

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => "Success",
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        $calculate_salary = CalculateSalary::where('id', $id)->first();

        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', '1')->get();
        // $calculate_salary_roster = CalculateSalary::where('is_active', 'Y')->groupBy('roster_id')->pluck('roster_id');

        $rosters = Roster::where([
                ['is_active', 'Y'],
                ['branch_id', '1'],
                ['department_id', '1']
            ])
            // ->whereNotIn('id', $calculate_salary_roster)
            ->get();

        $branch_id = $calculate_salary->branch_id;
        $department_id = $calculate_salary->department_id;
        $roster_id = $calculate_salary->roster_id;

        // หา Employee
        $employee_roster = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->groupBy('employee_id')
            ->pluck('employee_id');

        $employees = employees::where('is_active', 'Y')
            ->whereIn('id', $employee_roster)
            ->get();
        // End หา Employee

        // หาเวลา ของ Template แสดงส่วน header
        $roster = Roster::where('id', $roster_id)->first();

        $roster_template_details = RosterTemplateDetail::where([
                ['is_active', 'Y'],
                ['roster_template_id', $roster->roster_template_id]
            ])
            ->orderBy('day')
            ->get();
        // End หาเวลา ของ Template แสดงส่วน header

        // หาเวลา ของ roster แต่ละ user
        $roster_workdates = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->orderBy('workdate')
            ->groupBy('workdate')
            ->pluck('workdate');

        $roster_details = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->orderBy('workdate')
            ->get()
            ->groupBy('workdate');

        $roster_tempalte_times = null;
        foreach($roster_details as $roster_detail){
            foreach($roster_detail as $detail){
                $roster_tempalte_times[$detail->employee_id][$detail->workdate] = $detail->toArray();
            }
        }
        // End หาเวลา ของ roster แต่ละ user

        // ดึงข้อมูล Checkin จากเครื่องสแกน
        $checkincheckouts = checkin_checkout::where('is_active', 'Y')
            ->whereIn('workdate', $roster_workdates)
            ->whereIn('employee_id', $employee_roster)
            ->get();

        $checkin_checkouts = null;
        foreach($checkincheckouts as $checkin){
            $checkin_checkouts[$checkin->employee_id][$checkin->workdate] = $checkin->toArray();
        }
        // End ดึงข้อมูล Checkin จากเครื่องสแกน


        $calculate_salary_weekly = CalculateSalaryWeekly::where([
                ['is_active', 'Y'],
                ['calculate_salary_id', $calculate_salary->id]
            ])->get();

        $calculate_salary_weeklies = null;
        foreach($calculate_salary_weekly as $weely){
            $calculate_salary_weeklies[$weely->employee_id] = $weely->toArray();
        }

        $data= [
            'calculate_salary' => $calculate_salary,
            'branchs' => $branchs,
            'departments' => $departments,
            'rosters' => $rosters,
            'employees' => $employees,
            'roster_workdates' => $roster_workdates,
            'roster_template_details' => $roster_template_details,
            'roster_tempalte_times' => $roster_tempalte_times,
            'checkin_checkouts'=> $checkin_checkouts,
            'calculate_salary_weeklies' => $calculate_salary_weeklies
        ];

        return view('calculate_salaries.edit', $data);
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {

            $calculate_salary_id = $request->calculate_salary_id;

            CalculateSalary::where('id', $calculate_salary_id)->delete();
            CalculateSalaryDetail::where('calculate_salary_id', $calculate_salary_id)->delete();
            CalculateSalaryWeekly::where('calculate_salary_id', $calculate_salary_id)->delete();

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => "Success",
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function calculateSalaryExport($id)
    {
        $calculate_salary = CalculateSalary::where('id', $id)->first();
        $branch_id = $calculate_salary->branch_id;
        $department_id = $calculate_salary->department_id;
        $roster_id = $calculate_salary->roster_id;

        // หา Employee
        $employee_roster = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->groupBy('employee_id')
            ->pluck('employee_id');

        $employees = employees::where('is_active', 'Y')
            ->whereIn('id', $employee_roster)
            ->get();
        // End หา Employee

        // หาเวลา ของ Template แสดงส่วน header
        $roster = Roster::where('id', $roster_id)->first();

        $roster_template_details = RosterTemplateDetail::where([
                ['is_active', 'Y'],
                ['roster_template_id', $roster->roster_template_id]
            ])
            ->orderBy('day')
            ->get();
        // End หาเวลา ของ Template แสดงส่วน header

        // หาเวลา ของ roster แต่ละ user
        $roster_workdates = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->orderBy('workdate')
            ->groupBy('workdate')
            ->pluck('workdate');

        $roster_details = RosterDetail::where([
                ['is_active', 'Y'],
                ['roster_id', $roster_id]
            ])
            ->orderBy('workdate')
            ->get()
            ->groupBy('workdate');

        $roster_tempalte_times = null;
        foreach($roster_details as $roster_detail){
            foreach($roster_detail as $detail){
                $roster_tempalte_times[$detail->employee_id][$detail->workdate] = $detail->toArray();
            }
        }
        // End หาเวลา ของ roster แต่ละ user

        // ดึงข้อมูล Checkin จากเครื่องสแกน
        $checkincheckouts = checkin_checkout::where('is_active', 'Y')
            ->whereIn('workdate', $roster_workdates)
            ->whereIn('employee_id', $employee_roster)
            ->get();

        $checkin_checkouts = null;
        foreach($checkincheckouts as $checkin){
            $checkin_checkouts[$checkin->employee_id][$checkin->workdate] = $checkin->toArray();
        }
        // End ดึงข้อมูล Checkin จากเครื่องสแกน


        $calculate_salary_weekly = CalculateSalaryWeekly::where([
                ['is_active', 'Y'],
                ['calculate_salary_id', $calculate_salary->id]
            ])->get();

        $calculate_salary_weeklies = null;
        foreach($calculate_salary_weekly as $weely){
            $calculate_salary_weeklies[$weely->employee_id] = $weely->toArray();
        }

        $data= [
            'calculate_salary' => $calculate_salary,
            'employees' => $employees,
            'roster_workdates' => $roster_workdates,
            'roster_template_details' => $roster_template_details,
            'roster_tempalte_times' => $roster_tempalte_times,
            'checkin_checkouts'=> $checkin_checkouts,
            'calculate_salary_weeklies' => $calculate_salary_weeklies
        ];
        // dd($checkin_checkouts);
        $today = date('Y-m-d');
        $export_name = 'SaralyReport '.$calculate_salary->branch->branch_name." ".$calculate_salary->department->department_name;

        return Excel::download(new CalculateSalaryExport($data), $export_name.'-'.$today.'.xlsx');
    }

}
