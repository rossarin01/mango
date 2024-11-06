<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\TransferBioTime;
use App\Models\checkin_checkout;
use App\Models\branch;
use App\Models\Department;
use App\Models\employees;
use App\Models\RosterDetail;

class CheckinCheckoutController extends Controller
{
    public function index()
    {
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', '1')->get();

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
        ];

        return view('checkin_checkouts.index', $data);
    }

    public function datatable()
    {
        $search_branch = request('search_branch');
        $search_department = request('search_department');
        $search_workdate = request('search_workdate');

        $data = checkin_checkout::select(['*', DB::raw('ROW_NUMBER() OVER (ORDER BY id DESC) AS rownum')])
            ->WhereNotNull('id')
            // ->where('emp_code_biotime','>','0')
            ->where('is_active', 'Y');

        if($search_branch != ''){
            $data->where('branch_id', $search_branch);
        }

        if($search_department != ''){
            $data->where('department_id', $search_department);
        }

        if($search_workdate != ''){
            $data->whereDate('workdate', $search_workdate);
        }

        $sQuery	= Datatables::of($data)
        ->addColumn('rownum',function($data){
			return $data->rownum;
		})
        ->editColumn('employee_id',function($data){
			return $data->employee->name ?? '';
		})
        ->editColumn('morning_shift',function($data){
			$morning_shift = !is_null($data->morning_shift) ? strtotime($data->morning_shift) : null;
            if(!is_null($morning_shift)){
                $morning_shift = date('H:i', $morning_shift);
            }
			return $morning_shift;
		})
        ->editColumn('morning_end',function($data){
			$morning_end = !is_null($data->morning_end) ? strtotime($data->morning_end) : null;
            if(!is_null($morning_end)){
                $morning_end = date('H:i', $morning_end);
            }
			return $morning_end;
		})
        ->editColumn('evening_shift',function($data){
            $evening_shift = !is_null($data->evening_shift) ? strtotime($data->evening_shift) : null;
            if(!is_null($evening_shift)){
                $evening_shift = date('H:i', $evening_shift);
            }
			return $evening_shift;
		})
        ->editColumn('evening_end',function($data){
			$evening_end = !is_null($data->evening_end) ? strtotime($data->evening_end) : null;
            if(!is_null($evening_end)){
                $evening_end = date('H:i', $evening_end);
            }
			return $evening_end;
		})
        ->editColumn('department',function($data){
            return $data->department?->department_name ?? '';
		})
        ->editColumn('branch',function($data){
            return $data->branch?->branch_name ?? '';
		})
        ->addColumn('btnedit',function($data){
            return '
                <button class="btn btn-sm btn-icon btn-warning me-2 btn_edit" data-checkin_id="'.$data->id.'" title ="แก้ไข">
                    <i class="ti ti-pencil text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-danger me-2 btn_delete" data-checkin_id="'.$data->id.'" title ="ลบ">
                    <i class="ti ti-trash text-white ti-sm"></i>
                </button>
            ';
		});

		return $sQuery->escapeColumns([])->make(true);
    }


    public function getTransaction()
    {
        DB::beginTransaction();
        try {
            $today = date('Y-m-d');
            $today = '2024-08-08';
            // $today = '2024-10-15';

            (new TransferBioTime)->getTransaction($today);

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
        $checkin_id = $id;
        $checkin_checkout = checkin_checkout::where('id', $checkin_id)->first();
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', '1')->get();

        $data = [
            'checkin_checkout' => $checkin_checkout,
            'branchs' => $branchs,
            'departments' => $departments
        ];

        return view('checkin_checkouts.edit', $data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $data = [
                'morning_shift' => $request->morning_shift,
                'morning_end' => $request->morning_end,
                'evening_shift' => $request->evening_shift,
                'evening_end' => $request->evening_end,
            ];

            checkin_checkout::updateOrCreate(['id' => $request->checkin_id], $data);

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

    public function delete()
    {
        DB::beginTransaction();
        try {
            $checkin_id = request('checkin_id');

            checkin_checkout::where('id', $checkin_id)->update(['is_active' => 'N']);

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
