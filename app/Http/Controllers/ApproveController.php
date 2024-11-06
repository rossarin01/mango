<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\approve;

class ApproveController extends Controller
{
    // method สำหรับ mango coco: front: checkin
    /**
     * Display a listing of the resource.
     */
    public function frontcheckinindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.front.checkin.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function frontcheckincreate()
    {
        return view('approves.mangococo.front.checkin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function frontcheckinstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.front.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function frontcheckinshow(approve $approve)
    {
        return view('approves.mangococo.front.checkin.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function frontcheckinedit(approve $approve)
    {
        return view('approves.mangococo.front.checkin.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function frontcheckinupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.front.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function frontcheckindestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.front.checkin.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: front: checkout
    /**
     * Display a listing of the resource.
     */
    public function frontcheckoutindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.front.checkout.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function frontcheckoutincreate()
    {
        return view('approves.mangococo.front.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function frontcheckoutstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.front.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function frontcheckoutshow(approve $approve)
    {
        return view('approves.mangococo.front.checkout.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function frontcheckoutedit(approve $approve)
    {
        return view('approves.mangococo.front.checkout.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function frontcheckoutupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.front.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function frontcheckoutdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.front.checkout.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: front: breakstart
    /**
     * Display a listing of the resource.
     */
    public function frontbreakstartindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.front.breakstart.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function frontbreakstartcreate()
    {
        return view('approves.mangococo.front.breakstart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function frontbreakstartstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.front.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function frontbreakstartshow(approve $approve)
    {
        return view('approves.mangococo.front.breakstart.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function frontbreakstartedit(approve $approve)
    {
        return view('approves.mangococo.front.breakstart.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function frontbreakstartupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.front.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function frontbreakstartdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.front.breakstart.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: front: breakend
    /**
     * Display a listing of the resource.
     */
    public function frontbreakendindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.front.breakend.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function frontbreakendcreate()
    {
        return view('approves.mangococo.front.breakend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function frontbreakendstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.front.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function frontbreakendshow(approve $approve)
    {
        return view('approves.mangococo.front.breakend.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function frontbreakendedit(approve $approve)
    {
        return view('approves.mangococo.front.breakend.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function frontbreakendupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.front.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function frontbreakenddestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.front.breakend.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: dessert: checkin
    /**
     * Display a listing of the resource.
     */
    public function dessertcheckinindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.dessert.checkin.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dessertcheckincreate()
    {
        return view('approves.mangococo.dessert.checkin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dessertcheckinstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.dessert.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function dessertcheckinshow(approve $approve)
    {
        return view('approves.mangococo.dessert.checkin.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function dessertcheckinedit(approve $approve)
    {
        return view('approves.mangococo.dessert.checkin.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function dessertcheckinupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.dessert.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function dessertcheckindestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.dessert.checkin.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: dessert: checkout
    /**
     * Display a listing of the resource.
     */
    public function dessertcheckoutindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.dessert.checkout.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dessertcheckoutincreate()
    {
        return view('approves.mangococo.dessert.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dessertcheckoutstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.dessert.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function dessertcheckoutshow(approve $approve)
    {
        return view('approves.mangococo.dessert.checkout.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function dessertcheckoutedit(approve $approve)
    {
        return view('approves.mangococo.dessert.checkout.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function dessertcheckoutupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.dessert.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function dessertcheckoutdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.dessert.checkout.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: dessert: breakstart
    /**
     * Display a listing of the resource.
     */
    public function dessertbreakstartindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.dessert.breakstart.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dessertbreakstartcreate()
    {
        return view('approves.mangococo.dessert.breakstart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dessertbreakstartstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.dessert.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function dessertbreakstartshow(approve $approve)
    {
        return view('approves.mangococo.front.dessert.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function dessertbreakstartedit(approve $approve)
    {
        return view('approves.mangococo.dessert.breakstart.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function dessertbreakstartupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.dessert.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function dessertbreakstartdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.dessert.breakstart.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: dessert: breakend
    /**
     * Display a listing of the resource.
     */
    public function dessertbreakendindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.dessert.breakend.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dessertbreakendcreate()
    {
        return view('approves.mangococo.dessert.breakend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dessertbreakendstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.dessert.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function dessertbreakendshow(approve $approve)
    {
        return view('approves.mangococo.dessert.breakend.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function dessertbreakendedit(approve $approve)
    {
        return view('approves.mangococo.dessert.breakend.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function dessertbreakendupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.dessert.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function dessertbreakenddestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.dessert.breakend.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: kitchen: checkin
    /**
     * Display a listing of the resource.
     */
    public function kitchencheckinindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.kitchen.checkin.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function kitchencheckincreate()
    {
        return view('approves.mangococo.kitchen.checkin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function kitchencheckinstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.kitchen.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function kitchencheckinshow(approve $approve)
    {
        return view('approves.mangococo.kitchen.checkin.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function kitchencheckinedit(approve $approve)
    {
        return view('approves.mangococo.kitchen.checkin.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function kitchencheckinupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.kitchen.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function kitchencheckindestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.kitchen.checkin.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: kitchen: checkout
    /**
     * Display a listing of the resource.
     */
    public function kitchencheckoutindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.kitchen.checkout.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function kitchencheckoutincreate()
    {
        return view('approves.mangococo.kitchen.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function kitchencheckoutstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.kitchen.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function kitchencheckoutshow(approve $approve)
    {
        return view('approves.mangococo.kitchen.checkout.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function kitchencheckoutedit(approve $approve)
    {
        return view('approves.mangococo.kitchen.checkout.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function kitchencheckoutupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.kitchen.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function kitchencheckoutdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.kitchen.checkout.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: kitchen: breakstart
    /**
     * Display a listing of the resource.
     */
    public function kitchenbreakstartindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.kitchen.breakstart.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function kitchenbreakstartcreate()
    {
        return view('approves.mangococo.kitchen.breakstart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function kitchenbreakstartstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.kitchen.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function kitchenbreakstartshow(approve $approve)
    {
        return view('approves.mangococo.kitchen.breakstart.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function kitchenbreakstartedit(approve $approve)
    {
        return view('approves.mangococo.kitchen.breakstart.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function kitchenbreakstartupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.kitchen.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function kitchenbreakstartdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.kitchen.breakstart.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: kitchen: breakend
    /**
     * Display a listing of the resource.
     */
    public function kitchenbreakendindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.kitchen.breakend.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function kitchenbreakendcreate()
    {
        return view('approves.mangococo.kitchen.breakend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function kitchenbreakendstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.kitchen.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function kitchenbreakendshow(approve $approve)
    {
        return view('approves.mangococo.kitchen.breakend.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function kitchenbreakendedit(approve $approve)
    {
        return view('approves.mangococo.kitchen.breakend.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function kitchenbreakendupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.kitchen.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function kitchenbreakenddestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.kitchen.breakend.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: bakery: checkin
    /**
     * Display a listing of the resource.
     */
    public function bakerycheckinindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.bakery.checkin.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bakerycheckincreate()
    {
        return view('approves.mangococo.bakery.checkin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bakerycheckinstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.bakery.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function bakerycheckinshow(approve $approve)
    {
        return view('approves.mangococo.bakery.checkin.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function bakerycheckinedit(approve $approve)
    {
        return view('approves.mangococo.bakery.checkin.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function bakerycheckinupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.bakery.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function bakerycheckindestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.bakery.checkin.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: bakery: checkout
    /**
     * Display a listing of the resource.
     */
    public function bakerycheckoutindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.bakery.checkout.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bakerycheckoutincreate()
    {
        return view('approves.mangococo.bakery.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bakerycheckoutstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.bakery.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function bakerycheckoutshow(approve $approve)
    {
        return view('approves.mangococo.bakery.checkout.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function bakerycheckoutedit(approve $approve)
    {
        return view('approves.mangococo.bakery.checkout.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function bakerycheckoutupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.bakery.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function bakerycheckoutdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.bakery.checkout.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: bakery: breakstart
    /**
     * Display a listing of the resource.
     */
    public function bakerybreakstartindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.bakery.breakstart.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bakerybreakstartcreate()
    {
        return view('approves.mangococo.bakery.breakstart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bakerybreakstartstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.bakery.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function bakerybreakstartshow(approve $approve)
    {
        return view('approves.mangococo.bakery.breakstart.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function bakerybreakstartedit(approve $approve)
    {
        return view('approves.mangococo.bakery.breakstart.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function bakerybreakstartupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.bakery.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function bakerybreakstartdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.bakery.breakstart.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: bakery: breakend
    /**
     * Display a listing of the resource.
     */
    public function bakerybreakendindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.bakery.breakend.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bakerybreakendcreate()
    {
        return view('approves.mangococo.bakery.breakend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bakerybreakendstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.bakery.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function bakerybreakendshow(approve $approve)
    {
        return view('approves.mangococo.bakery.breakend.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function bakerybreakendedit(approve $approve)
    {
        return view('approves.mangococo.bakery.breakend.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function bakerybreakendupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.bakery.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function bakerybreakenddestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.bakery.breakend.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: office: checkin
    /**
     * Display a listing of the resource.
     */
    public function officecheckinindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.office.checkin.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function officecheckincreate()
    {
        return view('approves.mangococo.office.checkin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function officecheckinstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.office.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function officecheckinshow(approve $approve)
    {
        return view('approves.mangococo.office.checkin.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function officecheckinedit(approve $approve)
    {
        return view('approves.mangococo.office.checkin.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function officecheckinupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.office.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function officecheckindestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.office.checkin.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: office: checkout
    /**
     * Display a listing of the resource.
     */
    public function officecheckoutindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.office.checkout.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function officecheckoutincreate()
    {
        return view('approves.mangococo.office.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function officecheckoutstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.office.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function officecheckoutshow(approve $approve)
    {
        return view('approves.mangococo.office.checkout.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function officecheckoutedit(approve $approve)
    {
        return view('approves.mangococo.office.checkout.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function officecheckoutupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.office.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function officecheckoutdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.office.checkout.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: office: breakstart
    /**
     * Display a listing of the resource.
     */
    public function officebreakstartindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.office.breakstart.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function officebreakstartcreate()
    {
        return view('approves.mangococo.office.breakstart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function officebreakstartstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.office.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function officebreakstartshow(approve $approve)
    {
        return view('approves.mangococo.office.breakstart.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function officebreakstartedit(approve $approve)
    {
        return view('approves.mangococo.office.breakstart.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function officebreakstartupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.office.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function officebreakstartdestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.office.breakstart.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ mango coco: office: breakend
    /**
     * Display a listing of the resource.
     */
    public function officebreakendindex()
    {
        $approve = approve::all();
        return view('approves.mangococo.office.breakend.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function officebreakendcreate()
    {
        return view('approves.mangococo.office.breakend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function officebreakendstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.office.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function officebreakendshow(approve $approve)
    {
        return view('approves.mangococo.office.breakend.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function officebreakendedit(approve $approve)
    {
        return view('approves.mangococo.office.breakend.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function officebreakendupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.mangococo.office.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function officebreakenddestroy(approve $approve)
    {
        return redirect()->route('approves.mangococo.office.breakend.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ flyingtigress: checkin
    /**
     * Display a listing of the resource.
     */
    public function flyingtigresscheckinindex()
    {
        $approve = approve::all();
        return view('approves.flyingtigress.checkin.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function flyingtigresscheckincreate()
    {
        return view('approves.flyingtigress.checkin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function flyingtigresscheckinstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.flyingtigress.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function flyingtigresscheckinshow(approve $approve)
    {
        return view('approves.flyingtigress.checkin.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function flyingtigresscheckinedit(approve $approve)
    {
        return view('approves.flyingtigress.checkin.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function flyingtigresscheckinupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.flyingtigress.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function flyingtigresscheckindestroy(approve $approve)
    {
        return redirect()->route('approves.flyingtigress.checkin.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ flyingtigress: checkout
    /**
     * Display a listing of the resource.
     */
    public function flyingtigresscheckoutindex()
    {
        $approve = approve::all();
        return view('approves.flyingtigress.checkout.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function flyingtigresscheckoutincreate()
    {
        return view('approves.flyingtigress.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function flyingtigresscheckoutstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.flyingtigress.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function flyingtigresscheckoutshow(approve $approve)
    {
        return view('approves.flyingtigress.checkout.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function flyingtigresscheckoutedit(approve $approve)
    {
        return view('approves.flyingtigress.checkout.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function flyingtigresscheckoutupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.flyingtigress.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function flyingtigresscheckoutdestroy(approve $approve)
    {
        return redirect()->route('approves.flyingtigress.checkout.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ flyingtigress: breakstart
    /**
     * Display a listing of the resource.
     */
    public function flyingtigressbreakstartindex()
    {
        $approve = approve::all();
        return view('approves.flyingtigress.breakstart.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function flyingtigressbreakstartcreate()
    {
        return view('approves.flyingtigress.breakstart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function flyingtigressbreakstartstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.flyingtigress.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function flyingtigressbreakstartshow(approve $approve)
    {
        return view('approves.flyingtigress.breakstart.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function flyingtigressbreakstartedit(approve $approve)
    {
        return view('approves.flyingtigress.breakstart.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function flyingtigressbreakstartupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.flyingtigress.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function flyingtigressbreakstartdestroy(approve $approve)
    {
        return redirect()->route('approves.flyingtigress.breakstart.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ flyingtigress: breakend
    /**
     * Display a listing of the resource.
     */
    public function flyingtigressbreakendindex()
    {
        $approve = approve::all();
        return view('approves.flyingtigress.breakend.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function flyingtigressbreakendcreate()
    {
        return view('approves.flyingtigress.breakend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function flyingtigressbreakendstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.flyingtigress.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function flyingtigressbreakendshow(approve $approve)
    {
        return view('approves.flyingtigress.breakend.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function flyingtigressbreakendedit(approve $approve)
    {
        return view('approves.flyingtigress.breakend.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function flyingtigressbreakendupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.flyingtigress.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function flyingtigressbreakenddestroy(approve $approve)
    {
        return redirect()->route('approves.flyingtigress.breakend.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ red work: myer: checkin
    /**
     * Display a listing of the resource.
     */
    public function myercheckinindex()
    {
        $approve = approve::all();
        return view('approves.redwork.myer.checkin.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function myercheckincreate()
    {
        return view('approves.redwork.myer.checkin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function myercheckinstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.myer.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function myercheckinshow(approve $approve)
    {
        return view('approves.redwork.myer.checkin.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function myercheckinedit(approve $approve)
    {
        return view('approves.redwork.myer.checkin.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function myercheckinupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.myer.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function myercheckindestroy(approve $approve)
    {
        return redirect()->route('approves.redwork.myer.checkin.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ red work: myer: checkout
    /**
     * Display a listing of the resource.
     */
    public function myercheckoutindex()
    {
        $approve = approve::all();
        return view('approves.redwork.myer.checkout.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function myercheckoutincreate()
    {
        return view('approves.redwork.myer.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function myercheckoutstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.myer.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function myercheckoutshow(approve $approve)
    {
        return view('approves.redwork.myer.checkout.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function myercheckoutedit(approve $approve)
    {
        return view('approves.redwork.myer.checkout.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function myercheckoutupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.myer.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function myercheckoutdestroy(approve $approve)
    {
        return redirect()->route('approves.redwork.myer.checkout.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ red work: myer: breakstart
    /**
     * Display a listing of the resource.
     */
    public function myerbreakstartindex()
    {
        $approve = approve::all();
        return view('approves.redwork.myer.breakstart.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function myerbreakstartcreate()
    {
        return view('approves.redwork.myer.breakstart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function myerbreakstartstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.myer.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function myerbreakstartshow(approve $approve)
    {
        return view('approves.redwork.myer.breakstart.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function myerbreakstartedit(approve $approve)
    {
        return view('approves.redwork.myer.breakstart.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function myerbreakstartupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.myer.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function myerbreakstartdestroy(approve $approve)
    {
        return redirect()->route('approves.redwork.myer.breakstart.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ red work: myer: breakend
    /**
     * Display a listing of the resource.
     */
    public function myerbreakendindex()
    {
        $approve = approve::all();
        return view('approves.redwork.myer.breakend.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function myerbreakendcreate()
    {
        return view('approves.redwork.myer.breakend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function myerbreakendstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.myer.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function myerbreakendshow(approve $approve)
    {
        return view('approves.redwork.myer.breakend.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function myerbreakendedit(approve $approve)
    {
        return view('approves.redwork.myer.breakend.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function myerbreakendupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.myer.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function myerbreakenddestroy(approve $approve)
    {
        return redirect()->route('approves.redwork.myer.breakend.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ red work: macquarie: checkin
    /**
     * Display a listing of the resource.
     */
    public function macquariecheckinindex()
    {
        $approve = approve::all();
        return view('approves.redwork.macquarie.checkin.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function macquariecheckincreate()
    {
        return view('approves.redwork.macquarie.checkin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function macquariecheckinstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.macquarie.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function macquariecheckinshow(approve $approve)
    {
        return view('approves.redwork.macquarie.checkin.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function macquariecheckinedit(approve $approve)
    {
        return view('approves.redwork.macquarie.checkin.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function macquariecheckinupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.macquarie.checkin.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function macquariecheckindestroy(approve $approve)
    {
        return redirect()->route('approves.redwork.macquarie.checkin.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ red work: macquarie: checkout
    /**
     * Display a listing of the resource.
     */
    public function macquariecheckoutindex()
    {
        $approve = approve::all();
        return view('approves.redwork.macquarie.checkout.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function macquariecheckoutincreate()
    {
        return view('approves.redwork.macquarie.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function macquariecheckoutstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.macquarie.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function macquariecheckoutshow(approve $approve)
    {
        return view('approves.redwork.macquarie.checkout.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function macquariecheckoutedit(approve $approve)
    {
        return view('approves.redwork.macquarie.checkout.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function macquariecheckoutupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.macquarie.checkout.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function macquariecheckoutdestroy(approve $approve)
    {
        return redirect()->route('approves.redwork.macquarie.checkout.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ red work: macquarie: breakstart
    /**
     * Display a listing of the resource.
     */
    public function macquariebreakstartindex()
    {
        $approve = approve::all();
        return view('approves.redwork.macquarie.breakstart.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function macquariebreakstartcreate()
    {
        return view('approves.redwork.macquarie.breakstart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function macquariebreakstartstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.macquarie.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function macquariebreakstartshow(approve $approve)
    {
        return view('approves.redwork.macquarie.breakstart.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function macquariebreakstartedit(approve $approve)
    {
        return view('approves.redwork.macquarie.breakstart.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function macquariebreakstartupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.macquarie.breakstart.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function macquariebreakstartdestroy(approve $approve)
    {
        return redirect()->route('approves.redwork.macquarie.breakstart.index')->with('success', 'approve deleted successfully.');
    }





    // method สำหรับ red work: macquarie: breakend
    /**
     * Display a listing of the resource.
     */
    public function macquariebreakendindex()
    {
        $approve = approve::all();
        return view('approves.redwork.macquarie.breakend.index', compact('approve'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function macquarierbreakendcreate()
    {
        return view('approves.redwork.macquarie.breakend.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function macquariebreakendstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.macquarie.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function macquariebreakendshow(approve $approve)
    {
        return view('approves.redwork.macquarie.breakend.show', compact('approve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function macquariebreakendedit(approve $approve)
    {
        return view('approves.redwork.macquarie.breakend.edit', compact('approve'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function macquariebreakendupdate(Request $request, approve $approve)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => 'required|date',
            'fingerprint_check_in' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_in(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_in',
            'fingerprint_check_out' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_check_out(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_check_out',
            'fingerprint_break_start_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_start_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_start_time',
            'fingerprint_break_end_time' => 'required|date_format:Y-m-d h:i:A',
            'fingerprint_break_end_time(edit)' => 'nullable|date_format:Y-m-d h:i:A|after_or_equal:fingerprint_break_end_time',
            'action' => 'required|string|max:500',
        ]);

        approve::create($request->all());

        return redirect()->route('approves.redwork.macquarie.breakend.index')->with('success', 'approve created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function macquariebreakenddestroy(approve $approve)
    {
        return redirect()->route('approves.redwork.macquarie.breakend.index')->with('success', 'approve deleted successfully.');
    }
}
