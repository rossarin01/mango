<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Helpers\FileImage;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Helpers\TransferBioTime;
use App\Models\employees;
use App\Models\branch;
use App\Models\Department;


class EmployeesController extends Controller
{
    public function index()
    {
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', '1')->get();

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
        ];

        return view('employees.index', $data);
    }

    public function datatable()
    {
        $search_branch = request('search_branch');
        $search_department = request('search_department');

        $data = employees::select(['*', DB::raw('ROW_NUMBER() OVER (ORDER BY id DESC) AS rownum')])
            ->WhereNotNull('id')
            ->where('is_active', 'Y');

        if($search_branch != ''){
            $data->where('branch', $search_branch);
        }

        if($search_department != ''){
            $data->where('department', $search_department);
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
                <button class="btn btn-sm btn-icon btn-warning me-2 btn_edit" data-employee_id="'.$data->id.'" title ="แก้ไข">
                    <i class="ti ti-pencil text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-info me-2 btn_show" data-employee_id="'.$data->id.'" title ="ดูรายละเอียด">
                    <i class="ti ti-eye text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-danger me-2 btn_delete" data-employee_id="'.$data->id.'" title ="ลบ">
                    <i class="ti ti-trash text-white ti-sm"></i>
                </button>
            ';
		});

		return $sQuery->escapeColumns([])->make(true);
    }

    public function create()
    {
        DB::beginTransaction();
        try {

            $branch = request('branch');
            $department = request('department');

            (new TransferBioTime)->getEmployee();

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

            $employee_id = request('employee_id');
            employees::where('id', $employee_id)->update(['is_active' => 'N']);

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
        $branchs = branch::where('is_active', 'Y')->get();
        $employees = employees::where('id', $id)->first();
        $departments = Department::where('is_active', 'Y')->where('branch_id', $employees->branch)->get();

        $data = [
            'branchs' => $branchs,
            'departments' => $departments,
            'employees' => $employees,
            'is_branch' => $employees->branch,
            'is_department' => $employees->department,
        ];

        return view('employees.create', $data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if(!is_null($request->employeesid)){
                $request->validate([
                    'employees_id' => 'required',
                    'name' => 'required|string|max:255',
                    'department' => 'required|string|max:255',
                    'branch' => 'required|string|max:255',
                    'position' => 'required',
                ]);
            }else{
                $request->validate([
                    'employees_id' => 'required|unique:employees',
                    'name' => 'required|string|max:255',
                    'department' => 'required|string|max:255',
                    'branch' => 'required|string|max:255',
                    'position' => 'required',
                ]);
            }

            // เพิ่มรูปภาพ
            $path = null;
            if($request->hasFile('image')){
                $files = $request->file('image');
                $path = (new FileImage)->uploadFile('profileimage', $files);

                $this->removeImage($request->employeesid); // ลบรูปเดิม
            }

            $data = [
                'employees_id' => $request->employees_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'department' => $request->department,
                'branch' => $request->branch,
                'TFN' => $request->TFN,
                'super_name' => $request->super_name,
                'super_number' => $request->super_number,
                'BSB' => $request->BSB,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'position' => $request->position,
            ];

            if(!is_null($path)){
                $data['image'] = $path;
            }

            if(!is_null($request->employeesid)){
                employees::where('id', $request->employeesid)->update($data);
            }else{
                employees::create($data);
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

    public function removeImage($employeesid=null)
    {
        if($employeesid){
            $employee = employees::where('id', $employeesid)->first();
            if(!is_null($employee->image)){
                $getRawOriginal = $employee->getRawOriginal('image'); // ดึง Path เดิม
                (new FileImage)->deleteFile($getRawOriginal);
                employees::where('id', $employeesid)->update(['image' => null]);
            }
        }
        return response()->json([
            'status' => 200,
            'message' => "Success",
        ]);
    }



    public function show($id)
    {
        $employee = employees::where('id', $id)->first();

        $data = [
            'employee' => $employee
        ];

        return view('employees.show', $data);

    }

}
