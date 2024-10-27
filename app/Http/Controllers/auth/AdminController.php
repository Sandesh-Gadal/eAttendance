<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\auth\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(Request $request)
    {
   
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve the admin by username
        $admin = Admin::where('admin_username', $request->username)->first();

        // Check if admin exists and password is correct
        if ($admin && Hash::check($request->password, $admin->admin_password)) {
            // Log in the admin manually
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        return back()->withErrors(['login_error' => 'Invalid username or password']);
    }

    public function logout()
    {
        
        Auth::guard('admin')->logout();
        Session::flush();

        return redirect()->route('login');
    }
}
