<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Roster;
use App\Models\RosterTemplate;
use App\Models\CalculateSalary;

class GeneralController extends Controller
{
    public function getDepartment()
    {
        $branch_id = request('branch_id');
        $departments = Department::where([
                ['is_active', 'Y'],
                ['branch_id', $branch_id]
            ])->get();

        return response()->json($departments, 200);
    }

    public function getRosterTemplate()
    {
        $branch_id = request('branch_id');
        $department_id = request('department_id');

        $roster_template = RosterTemplate::where([
                ['is_active', 'Y'],
                ['branch_id', $branch_id],
                ['department_id', $department_id]
            ])->get();

        return response()->json($roster_template, 200);

    }

    public function getRoster()
    {
        $branch_id = request('branch_id');
        $department_id = request('department_id');
        $calculate_salary_roster = CalculateSalary::where('is_active', 'Y')->groupBy('roster_id')->pluck('roster_id');

        $roster = Roster::where([
                ['is_active', 'Y'],
                ['branch_id', $branch_id],
                ['department_id', $department_id]
            ])
            ->whereNotIn('id', $calculate_salary_roster)
            ->get();

        return response()->json($roster, 200);

    }
}
