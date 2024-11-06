<?php

namespace App\Http\Controllers\Masterfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\branch;

class BranchesController extends Controller
{

    public function index()
    {
        $branch = branch::all();
        return view('branch.index', compact('branch'));
    }

    public function datatable()
    {
        $data = branch::select(['*', DB::raw('ROW_NUMBER() OVER (ORDER BY id ASC) AS rownum')])
            ->WhereNotNull('id')
            ->where('is_active', 'Y');

        $sQuery	= Datatables::of($data)
        ->addColumn('rownum',function($data){
			return $data->rownum;
		})
        ->addColumn('btnedit',function($data){
            return '
                <button class="btn btn-sm btn-icon btn-warning me-2 btn_edit" data-branch_id="'.$data->id.'" title ="แก้ไข">
                    <i class="ti ti-pencil text-white ti-sm"></i>
                </button>
                <button class="btn btn-sm btn-icon btn-danger me-2 btn_delete" data-branch_id="'.$data->id.'" title ="ลบ">
                    <i class="ti ti-trash text-white ti-sm"></i>
                </button>
            ';
		});

		return $sQuery->escapeColumns([])->make(true);
    }

    public function create()
    {
        return view('branch.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'branch_name' => 'required|string|max:255',
            ]);

            $data = [
                'branch_name' => $request->branch_name
            ];

            branch::updateOrCreate(['id' => $request->branch_id], $data);

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
        $branch = branch::where('id', $id)->first();
        return view('branch.create', compact('branch'));
    }

    public function delete()
    {
        DB::beginTransaction();
        try {
            $branch_id = request('branch_id');

            branch::where('id', $branch_id)->update(['is_active' => 'N']);

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
