<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salaries;

class SalaryController extends Controller
{
    // เมนูย่อย mangococo: front
    public function front()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.front.index', compact('salaries'));
    }

    // เมนูย่อย mangococo: dessert
    public function dessert()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.dessert.index', compact('salaries'));
    }

    // เมนูย่อย mangococo: kitchen
    public function kitchen()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.kitchen.index', compact('salaries'));
    }

    // เมนูย่อย mangococo: bakery
    public function bakery()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.bakery.index', compact('salaries'));
    }

    // เมนูย่อย mangococo: office
    public function office()
    {
        $salaries = salaries::all();
        return view('salaries.employees.mangococo.office.index', compact('salaries'));
    }

    // แสดงหน้า index ของเมนูหลัก flyingtigress
    public function flyingtigress()
    {
        $salaries = salaries::all();
        return view('salaries.employees.flyingtigress.index', compact('salaries'));
    }

    // เมนูย่อย redwork: myer
    public function myer()
    {
        $salaries = salaries::all();
        return view('salaries.employees.redwork.myer.index', compact('salaries'));
    }

    // เมนูย่อย redwork: macquarie
    public function macquarie()
    {
        $salaries = salaries::all();
        return view('salaries.employees.redwork.macquarie.index', compact('salaries'));
    }
}
