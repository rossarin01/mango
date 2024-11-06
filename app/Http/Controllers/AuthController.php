<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            $auth = Auth::user();
            switch($auth->position){
                case "SUPERADMIN" : return redirect(route('dashboard'));
                    break;
                case "ADMIN" : return redirect(route('dashboard'));
                    break;
                case "SUPERUSER" : return redirect(route('empprofile.roster'));
                    break;
                case "USER" : return redirect(route('empprofile.roster'));
                    break;
                default : return redirect(route('login'));
            }
        }else{
            return view('login');
        }
    }

    public function authLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return response()->json([
                'status' => 200,
                'message' => "Success",
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => "Error",
            ]);
        }
    }

    public function showLoginForm()
    {
        return view('login');
    }


    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // สร้างผู้ใช้ใหม่
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'department' => $request->department,
            'branch' => $request->branch,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('login');
    }

    public function authLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
