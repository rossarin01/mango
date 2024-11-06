<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
{
    $user = auth()->user();

    return view('user.profile', compact('user'));
}

public function update(Request $request)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        'department' => 'required|string|max:255',
        'branch' => 'required|string|max:255',
    ]);

    // ดึงข้อมูลผู้ใช้ปัจจุบัน
    $user = auth()->user();

    // อัปเดตข้อมูลโปรไฟล์
    $user->first_name = $validatedData['first_name'];
    $user->last_name = $validatedData['last_name'];
    $user->email = $validatedData['email'];
    $user->department = $validatedData['department'];
    $user->branch = $validatedData['branch'];

    // บันทึกการเปลี่ยนแปลง
    $user->save();

    // ส่ง response กลับ
    return response()->json([
        'status' => 200,
        'message' => 'Profile updated successfully!',
    ]);
}

}
