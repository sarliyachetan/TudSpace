<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
class SuperAdminLoginController extends Controller
{
    public function login() {
        return view('superadmin.login.index');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $credentials = request(['email', 'password']);

        if (Auth::guard('superadmin')->attempt($credentials)) {
            return response()->json(['success' => true, 'message' => 'Logged in successfully']);

        } else {
            return response()->json(['success' => false, 'error' => 'invalid_credentials']);
        }
    }
    public function logout()
    {
        Auth::guard('superadmin')->logout();
        return redirect()->route('superadmin.login');
    }
}
