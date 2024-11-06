<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\salaries;

class SalariesController extends Controller
{
    // method สำหรับ mango coco: front
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.front.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salaries.employees.mangococo.front.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
        ]);

        salaries::create($request->all());

        return redirect()->route('salaries.employees.mangococo.front.index')->with('success', 'Salaries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(salaries $salaries)
    {
        return view('salaries.employees.mangococo.front.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(salaries $salaries)
    {
        return view('salaries.employees.mangococo.front.edit', compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, salaries $salaries)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
        ]);

        $salaries->update($request->all());

        return redirect()->route('salaries.employees.mangococo.front.index')->with('success', 'Salaries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salaries $salaries)
    {
        return redirect()->route('salaries.employees.mangococo.front.index')->with('success', 'Salaries deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        if ($request->has('employee_ids')) {
            salaries::whereIn('id', $request->employee_ids)->delete();
            return redirect()->route('salaries.employees.mangococo.front.index')->with('success', 'Salaries deleted successfully.');
        }

        return redirect()->route('salaries.employees.mangococo.front.index')->with('error', 'Please select Salaries to delete.');
    }





    // method สำหรับ mango coco: dessert
    /**
     * Display a listing of the resource.
     */
    public function dessertindex()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.dessert.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dessertcreate()
    {
        return view('salaries.employees.mangococo.dessert.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function dessertstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        salaries::create($request->all());

        return redirect()->route('salaries.employees.mangococo.dessert.index')->with('success', 'Salaries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function dessertshow(salaries $salaries)
    {
        return view('salaries.employees.mangococo.dessert.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function dessertedit(salaries $salaries)
    {
        return view('salaries.employees.mangococo.dessert.edit', compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function dessertupdate(Request $request, salaries $salaries)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        $salaries->update($request->all());

        return redirect()->route('salaries.employees.mangococo.dessert.index')->with('success', 'Salaries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function dessertdestroy(salaries $salaries)
    {
        return redirect()->route('salaries.employees.mangococo.dessert.index')->with('success', 'Salaries deleted successfully.');
    }





    // method สำหรับ mango coco: kitchen
    /**
     * Display a listing of the resource.
     */
    public function kitchenindex()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.kitchen.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function kitchencreate()
    {
        return view('salaries.employees.mangococo.kitchen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function kitchenstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        salaries::create($request->all());

        return redirect()->route('salaries.employees.mangococo.kitchen.index')->with('success', 'Salaries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function kitchenshow(salaries $salaries)
    {
        return view('salaries.employees.mangococo.kitchen.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function kitchenedit(salaries $salaries)
    {
        return view('salaries.employees.mangococo.kitchen.edit', compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function kitchenupdate(Request $request, salaries $salaries)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        $salaries->update($request->all());

        return redirect()->route('salaries.employees.mangococo.kitchen.index')->with('success', 'Salaries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function kitchendestroy(salaries $salaries)
    {
        return redirect()->route('salaries.employees.mangococo.kitchen.index')->with('success', 'Salaries deleted successfully.');
    }





    // method สำหรับ mango coco: bakery
    /**
     * Display a listing of the resource.
     */
    public function bakeryindex()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.bakery.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bakerycreate()
    {
        return view('salaries.employees.mangococo.bakery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bakerystore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        salaries::create($request->all());

        return redirect()->route('salaries.employees.mangococo.bakery.index')->with('success', 'Salaries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function bakeryshow(salaries $salaries)
    {
        return view('salaries.employees.mangococo.bakery.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function bakeryedit(salaries $salaries)
    {
        return view('salaries.employees.mangococo.bakery.edit', compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function bakeryupdate(Request $request, salaries $salaries)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        $salaries->update($request->all());

        return redirect()->route('salaries.employees.mangococo.bakery.index')->with('success', 'Salaries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function bakerydestroy(salaries $salaries)
    {
        return redirect()->route('salaries.employees.mangococo.bakery.index')->with('success', 'Salaries deleted successfully.');
    }





    // method สำหรับ mango coco: office
    /**
     * Display a listing of the resource.
     */
    public function officeindex()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.office.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function officecreate()
    {
        return view('salaries.employees.mangococo.office.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function officestore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        salaries::create($request->all());

        return redirect()->route('salaries.employees.mangococo.office.index')->with('success', 'Salaries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function officeshow(salaries $salaries)
    {
        return view('salaries.employees.mangococo.office.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function officeedit(salaries $salaries)
    {
        return view('salaries.employees.mangococo.office.edit', compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function officeupdate(Request $request, salaries $salaries)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        $salaries->update($request->all());

        return redirect()->route('salaries.employees.mangococo.office.index')->with('success', 'Salaries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function officedestroy(salaries $salaries)
    {
        return redirect()->route('salaries.employees.mangococo.office.index')->with('success', 'Salaries deleted successfully.');
    }





    // method สำหรับ flyingtigress
    /**
     * Display a listing of the resource.
     */
    public function flyingtigressindex()
    {
        $salaries = salaries::all();
        return view('salaries.employees.flyingtigress.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function flyingtigresscreate()
    {
        return view('salaries.employees.flyingtigress.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function flyingtigressstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        salaries::create($request->all());

        return redirect()->route('salaries.employees.flyingtigress.index')->with('success', 'Salaries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function flyingtigressshow(salaries $salaries)
    {
        return view('salaries.employees.flyingtigress.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function flyingtigressedit(salaries $salaries)
    {
        return view('salaries.employees.flyingtigress.edit', compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function flyingtigressupdate(Request $request, salaries $salaries)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        $salaries->update($request->all());

        return redirect()->route('salaries.employees.flyingtigress.index')->with('success', 'Salaries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function flyingtigressdestroy(salaries $salaries)
    {
        return redirect()->route('salaries.employees.flyingtigress.index')->with('success', 'Salaries deleted successfully.');
    }





    // method สำหรับ red work: myer
    /**
     * Display a listing of the resource.
     */
    public function myerindex()
    {
        $salaries = salaries::all();
        return view('salaries.employees.redwork.myer.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function myercreate()
    {
        return view('salaries.employees.redwork.myer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function myerstore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        salaries::create($request->all());

        return redirect()->route('salaries.employees.redwork.myer.index')->with('success', 'Salaries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function myershow(salaries $salaries)
    {
        return view('salaries.employees.redwork.myer.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function myeredit(salaries $salaries)
    {
        return view('salaries.employees.redwork.myer.edit', compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function myerupdate(Request $request, salaries $salaries)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        $salaries->update($request->all());

        return redirect()->route('salaries.employees.redwork.myer.index')->with('success', 'Salaries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function myerdestroy(salaries $salaries)
    {
        return redirect()->route('salaries.employees.redwork.myer.index')->with('success', 'Salaries deleted successfully.');
    }





    // method สำหรับ red work: macquarie
    /**
     * Display a listing of the resource.
     */
    public function macquarieindex()
    {
        $salaries = salaries::all();
        return view('salaries.employees.redwork.macquarie.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function macquariecreate()
    {
        return view('salaries.employees.redwork.macquarie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function macquariestore(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        salaries::create($request->all());

        return redirect()->route('salaries.employees.redwork.macquarie.index')->with('success', 'Salaries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function macquarieshow(salaries $salaries)
    {
        return view('salaries.employees.redwork.macquarie.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function macquarieedit(salaries $salaries)
    {
        return view('salaries.employees.redwork.macquarie.edit', compact('salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function macquarieupdate(Request $request, salaries $salaries)
    {
        $request->validate([
            'employee_id' => 'required|integer|exists:employees,id',
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'payment_type' => 'required|string|max:255',
            'bank' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'action' => 'required|max:255',
        ]);

        $salaries->update($request->all());

        return redirect()->route('salaries.employees.redwork.macquarie.index')->with('success', 'Salaries updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function macquariedestroy(salaries $salaries)
    {
        return redirect()->route('salaries.employees.redwork.macquarie.index')->with('success', 'Salaries deleted successfully.');
    }
}
