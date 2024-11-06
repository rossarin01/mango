<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\branch;
use App\Models\Department;
use App\Models\RosterTemplate;
use App\Models\RosterTemplateDetail;

class RosterTemplateController extends Controller
{
    public function index()
    {
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', '1')->get();

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
        ];

        return view('roster_template.index', $data);
    }

    public function datatable()
    {
        $search_branch = request('search_branch');
        $search_department = request('search_department');

        $data = RosterTemplate::select(['*', DB::raw('ROW_NUMBER() OVER (ORDER BY id DESC) AS rownum')])
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
            return $data->getdepartment?->department_name ?? '';
		})
        ->editColumn('branch',function($data){
            return $data->getbranch?->branch_name ?? '';
		})
        ->addColumn('btnedit',function($data){
            return '
                <button class="btn btn-sm btn-icon btn-warning me-2 btn_edit" data-rostertemp_id="'.$data->id.'" title ="แก้ไข">
                    <i class="ti ti-pencil text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-danger me-2 btn_delete" data-rostertemp_id="'.$data->id.'" title ="ลบ">
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

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
            'roster_template' => null,
        ];

        return view('roster_template.create', $data);
    }

    public function edit($id)
    {
        $roster_template = RosterTemplate::where('is_active', 'Y')->where('id', $id)->first();
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = null;
        if(!is_null($roster_template)){
            $departments = Department::where('is_active', 'Y')->where('branch_id', $roster_template->branch_id)->get();
        }

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
            'roster_template' => $roster_template,
        ];

        return view('roster_template.create', $data);
    }


    public function boxRosterDetail()
    {
        $numItems = request('numItems');

        $data = [
            'numItems' => $numItems,
        ];
        return view('roster_template.box_roster_card', $data)->render();
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $roster_template = [
                'branch_id' => $request->branch,
                'department_id' => $request->department,
                'name' => $request->name,
            ];

            $roster_template = RosterTemplate::updateOrCreate(['id' => $request->rostertemp_id], $roster_template);
            // $roster_template = RosterTemplate::create($roster_template);

            $rostertemp_detail_id = $request->rostertemp_detail_id;
            // $workdate = $request->workdate;
            $morning_shift = $request->morning_shift;
            $morning_end = $request->morning_end;
            $evening_shift = $request->evening_shift;
            $evening_end = $request->evening_end;

            foreach($request->day as $key => $value){
                if(!is_null($value)){
                    $roster_template_detail = [
                        'roster_template_id' => $roster_template->id,
                        'day' => $value,
                        // 'workdate' => $workdate[$key],
                        'morning_shift' => $morning_shift[$key],
                        'morning_end' => $morning_end[$key],
                        'evening_shift' => $evening_shift[$key],
                        'evening_end' => $evening_end[$key],
                    ];

                    RosterTemplateDetail::updateOrCreate(['id' => $rostertemp_detail_id[$key]], $roster_template_detail);
                    // RosterTemplateDetail::create($roster_template_detail);
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

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $rostertemp_id = $request->rostertemp_id;

            RosterTemplate::where('id', $rostertemp_id)->update(['is_active' => 'N']);
            RosterTemplateDetail::where('roster_template_id', $rostertemp_id)->update(['is_active' => 'N']);

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
}
