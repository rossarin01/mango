<?php

namespace App\Http\Controllers\Masterfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\branch;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $branchs = branch::where('is_active', 'Y')->get();

        return view('department.index', compact('branchs'));
    }

    public function datatable()
    {
        $search_branch = request('search_branch');

        $data = Department::select(['*', DB::raw('ROW_NUMBER() OVER (ORDER BY id DESC) AS rownum')])
            ->WhereNotNull('id')
            ->where('is_active', 'Y');

        if($search_branch != ''){
            $data->where('branch_id', $search_branch);
        }

        $sQuery	= Datatables::of($data)
        ->addColumn('rownum',function($data){
			return $data->rownum;
		})
        ->editColumn('branch',function($data){
            return $data->branch?->branch_name ?? '';
		})
        ->addColumn('btnedit',function($data){
            return '
                <button class="btn btn-sm btn-icon btn-warning me-2 btn_edit" data-department_id="'.$data->id.'" title ="แก้ไข">
                    <i class="ti ti-pencil text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-danger me-2 btn_delete" data-department_id="'.$data->id.'" title ="ลบ">
                    <i class="ti ti-trash text-white ti-sm"></i>
                </button>
            ';
		});

		return $sQuery->escapeColumns([])->make(true);
    }

    public function create()
    {
        $branchs = branch::where('is_active', 'Y')->get();

        return view('department.create', compact('branchs'));
    }

    public function edit($id)
    {
        $branchs = branch::where('is_active', 'Y')->get();
        $department = Department::where('id', $id)->first();

        $data = [
            'branchs' => $branchs,
            'department' => $department
        ];

        return view('department.create', $data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'department_name' => 'required|string|max:255',
            ]);

            $data = [
                'branch_id' => $request->branch,
                'department_name' => $request->department_name,
            ];

            Department::updateOrCreate(['id' => $request->department_id], $data);

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

            $department_id = request('department_id');

            Department::where('id', $department_id)->update(['is_active' => 'N']);

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
