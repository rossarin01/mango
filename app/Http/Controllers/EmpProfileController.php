<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\EmployeesController;
use App\Models\employees;
use App\Models\branch;
use App\Models\Department;
use App\Models\RosterDetail;
use App\Models\checkin_checkout;

class EmpProfileController extends Controller
{
    public function calendar()
    {
        return view('empprofile.calendar');
    }

    // == Profile ===
    public function profile()
    {
        $employees = Auth::user();
        $branchs = branch::where('is_active', 'Y')->get();
        $departments = Department::where('is_active', 'Y')->where('branch_id', $employees->branch)->get();

        $data= [
            'branchs' => $branchs,
            'departments' => $departments,
            'employees' => $employees,
        ];

        return view('empprofile.profile', $data);
    }

    public function profileStore(Request $request)
    {
        return (new EmployeesController)->store($request);
    }
    // == End Profile ===


    // == Roster Calendar ===
    public function getRoster()
    {
        $rosters = RosterDetail::where('employee_id', Auth::user()->id)->get();
        $formattedEvents = null;
        foreach($rosters as $roster){
            if(!is_null($roster->morning_shift)){
                $start = $roster->workdate." ".$roster->morning_shift;
            }elseif(!is_null($roster->evening_shift)){
                $start = $roster->workdate." ".$roster->evening_shift;
            }

            if(!is_null($roster->evening_end)){
                $end = $roster->workdate." ".$roster->evening_end;
            }elseif(!is_null($roster->morning_end)){
                $end = $roster->workdate." ".$roster->morning_end;
            }

            $formattedEvents[] = [
                'className' => 'event-roster',
                'id' => $roster->id,
                'title' => '',
                'start' => $start,
                'end' => $end,
            ];

        }
        return response()->json($formattedEvents);
    }

    public function getRosterShow()
    {
        $roster_id = request('roster_id');
        $roster = RosterDetail::where('id', $roster_id)->first();

        return response()->json([
            'status' => 200,
            'roster' => $roster,
        ]);
    }
    // == End Roster Calendar ===


    // == CheckinCheckout ===
    public function checkinCheckout()
    {
        $checkin_checkouts = checkin_checkout::where([
                ['is_active', 'Y'],
                ['employee_id', Auth::user()->id]
            ])
            ->orderby('workdate', 'desc')
            ->get();

        $data = [
            'checkin_checkouts' => $checkin_checkouts
        ];

        return view('empprofile/checkin_checkout', $data);
    }

    // == End CheckinCheckout ===

}
