<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Exports\RosterExport;
use App\Models\employees;
use App\Models\branch;
use App\Models\Department;
use App\Models\Roster;
use App\Models\RosterDetail;
use App\Models\RosterTemplate;
use App\Models\RosterTemplateDetail;
use Excel;

class RosterController extends Controller
{
    public function index()
    {
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', '1')->get();

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
        ];

        return view('roster.index', $data);
    }

    public function datatable()
    {
        $search_branch = request('search_branch');
        $search_department = request('search_department');

        $data = Roster::select(['*', DB::raw('ROW_NUMBER() OVER (ORDER BY id DESC) AS rownum')])
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
                <button class="btn btn-sm btn-icon btn-warning me-2 btn_edit" data-roster_id="'.$data->id.'" title ="แก้ไข">
                    <i class="ti ti-pencil text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-primary  me-2 btn_copy" data-roster_id="'.$data->id.'" title ="Copy">
                    <i class="ti ti-wallet text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-info me-2 btn_export" data-roster_id="'.$data->id.'" title ="ดูรายละเอียด">
                    <i class="ti ti-share text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-danger me-2 btn_delete" data-roster_id="'.$data->id.'" title ="ลบ">
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
        $roster_templates = RosterTemplate::where('is_active', 'Y')->where([
                ['branch_id', '1'],
                ['department_id', '1']
            ])->get();

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
            'roster_templates' => $roster_templates,
            'roster' => null,
        ];

        return view('roster.create', $data);
    }


    public function rosterDetailCreate()
    {
        $branch_id = request('branch_id');
        $department_id = request('department_id');
        $roster_template_id = request('roster_template_id');

        $employees = employees::where([
                ['is_active', 'Y'],
                ['branch', $branch_id],
                ['department', $department_id]
            ])->get();

        $roster_template_details = RosterTemplateDetail::where([
                ['is_active', 'Y'],
                ['roster_template_id', $roster_template_id]
            ])
            ->orderBy('workdate')
            ->get();

        $data= [
            'employees' => $employees,
            'roster_template_details' => $roster_template_details,
        ];

        return view('roster.box_roster_card', $data)->render();
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data_roster = [
                'branch_id' => $request->branch,
                'department_id' => $request->department,
                'roster_template_id' => $request->roster_template,
                'name' => $request->roster_name,
            ];

            $roster = Roster::create($data_roster);

            $employees = $request->emp_id;
            $days = $request->days;
            $workdate = $request->workdate;
            $morning_shift = $request->morning_shift;
            $morning_end = $request->morning_end;
            $evening_shift = $request->evening_shift;
            $evening_end = $request->evening_end;

            foreach($employees as $emp_id){
                foreach($days as $day){
                    $roster_detail = [
                        'roster_id' => $roster->id,
                        'employee_id' => $emp_id,
                        'day' => $day,
                        'workdate' => $workdate[$day],
                        'morning_shift' => $morning_shift[$emp_id][$day],
                        'morning_end' => $morning_end[$emp_id][$day],
                        'evening_shift' => $evening_shift[$emp_id][$day],
                        'evening_end' => $evening_end[$emp_id][$day],
                    ];

                    RosterDetail::create($roster_detail);
                }
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
        $roster = Roster::where('id', $id)->first();
        $roster_details = RosterDetail::where('roster_id', $id)->orderBY('day')->get();
        $roster_group_date = RosterDetail::select('day', 'workdate')
            ->where('roster_id', $id)
            ->orderBY('day')
            ->groupBy('day', 'workdate')
            ->get()
            ->pluck('workdate', 'day');

        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', $roster->branch_id)->get();
        $roster_templates = RosterTemplate::where([
                ['branch_id', $roster->branch_id],
                ['department_id', $roster->department_id]
            ])->get();

        $roster_template_details = RosterTemplateDetail::where([
                ['is_active', 'Y'],
                ['roster_template_id', $roster->roster_template_id]
            ])
            ->orderBy('workdate')
            ->get();

        $employees = employees::where([
                ['is_active', 'Y'],
                ['branch', $roster->branch_id],
                ['department', $roster->department_id]
            ])->get();



        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
            'roster' => $roster,
            'roster_details' => $roster_details,
            'roster_templates' => $roster_templates,
            'roster_template_details' => $roster_template_details,
            'employees' => $employees,
            'roster_group_date' => $roster_group_date,
        ];

        return view('roster.edit', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $data_roster = [
                'branch_id' => $request->branch,
                'department_id' => $request->department,
                'roster_template_id' => $request->roster_template,
                'name' => $request->roster_name,
            ];

            $roster = Roster::updateOrCreate(['id' => $request->roster_id], $data_roster);

            $roster_detail_id = $request->roster_detail_id;
            $morning_shift = $request->morning_shift;
            $morning_end = $request->morning_end;
            $evening_shift = $request->evening_shift;
            $evening_end = $request->evening_end;

            foreach($roster_detail_id as $detail_id){
                $roster_detail = [
                    'roster_id' => $roster->id,
                    'morning_shift' => $morning_shift[$detail_id],
                    'morning_end' => $morning_end[$detail_id],
                    'evening_shift' => $evening_shift[$detail_id],
                    'evening_end' => $evening_end[$detail_id],
                ];

                RosterDetail::updateOrCreate(['id' => $detail_id], $roster_detail);
            }

            // บันทึกส่วนของวันที่
            $days = $request->days;
            $workdate = $request->workdate;
            foreach($days as $day){
                $update = RosterDetail::whereIn('id', $roster_detail_id)->where('day', $day)
                    ->update([
                        'workdate' => $workdate[$day]
                    ]);
            }
            // End บันทึกส่วนของวันที่

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

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $rostert_id = $request->rostert_id;

            Roster::where('id', $rostert_id)->delete();
            RosterDetail::where('roster_id', $rostert_id)->delete();

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

    public function rosterCopy(Request $request)
    {
        DB::beginTransaction();
        try {
            $rostert_id = $request->rostert_id;

            $roster = Roster::where('id', $rostert_id)->first();

            $data_roster_copy = [
                'branch_id' => $roster->branch_id,
                'department_id' => $roster->department_id,
                'roster_template_id' => $roster->roster_template_id,
                'name' => $roster->name." (Copy)",
            ];

            $roster_copy = Roster::create($data_roster_copy);

            $roster_details = RosterDetail::where([
                    ['roster_id', $rostert_id],
                    ['is_active', 'Y']
                ])->get();

            foreach($roster_details as $roster_detail){
                $data_roster_detail_copy = [
                    'roster_id' => $roster_copy->id,
                    'employee_id' => $roster_detail->employee_id,
                    'day' => $roster_detail->day,
                    'workdate' => null,
                    'morning_shift' => $roster_detail->morning_shift,
                    'morning_end' => $roster_detail->morning_end,
                    'evening_shift' => $roster_detail->evening_shift,
                    'evening_end' => $roster_detail->evening_end,
                ];

                RosterDetail::create($data_roster_detail_copy);
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

    public function rosterExport($id)
    {
        $roster = Roster::where('id', $id)->first();
        $roster_details = RosterDetail::where([
                ['roster_id', $roster->id],
                ['is_active', 'Y']
            ])->get();

        $roster_group_date = RosterDetail::select('day', 'workdate')
            ->where('roster_id', $id)
            ->orderBY('day')
            ->groupBy('day', 'workdate')
            ->get()
            ->pluck('workdate', 'day');


        $roster_detail_employees = RosterDetail::where([
                ['roster_id', $roster->id],
                ['is_active', 'Y']
            ])
            ->groupBy('employee_id')
            ->pluck('employee_id');

        $employees = employees::whereIn('id', $roster_detail_employees)->get();

        $roster_template_details = RosterTemplateDetail::where([
                ['is_active', 'Y'],
                ['roster_template_id', $roster->roster_template_id]
            ])
            ->orderBy('workdate')
            ->get();

        $data = [
            'roster' => $roster,
            'roster_details' => $roster_details,
            'roster_template_details' => $roster_template_details,
            'employees' => $employees,
            'roster_group_date' => $roster_group_date,
        ];

        $today = date('Y-m-d');
        $export_name = $roster->branch->branch_name.'-'.$roster->department->department_name;

        return Excel::download(new RosterExport($data), $export_name.'-'.$today.'.xlsx');
    }

}
