<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except(['logoutCustomer','logoutUser']);
    }

    public function logoutCustomer()
    {
        Session::flush();
        Auth::guard('customer')->logout();
        return redirect()->route('login');
    }

    public function logoutUser()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }

    public function attemptLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|max:50',
            'password' => 'required|string',
        ]);

        // dd($request->all());

        try {
            if ($request->type == 'in') {
                $user = User::where('email', $request->email)->first();
                if ($user && $user->email_verified_at) {
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        Log::info('User Login Success: ' . $user->email . ' logged in successfully');
                        return redirect()->intended('user-dashboard');
                    }else{
                        Log::error('User Login Error: Invalid Password');
                        return redirect()->back()->with('error', 'Invalid Password');
                    }
                } else {
                    Log::error('User Login Error: Invalid Email or Unverified Email');
                    return redirect()->back()->with('error', 'Invalid Email or Unverified Email');
                }
            } else {
                $customer = Customer::where('email', $request->email)->first();
                if ($customer && $customer->email_verified_at) {
                    if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
                        session(['wmc-customer' => $customer]);
                        Log::info('Customer Login Success: ' . $customer->email . ' logged in successfully');
                        return redirect()->intended('customer-dashboard');
                    }else{
                        Log::error('Customer Login Error: Invalid Password');
                        return redirect()->back()->with('error', 'Invalid Password');
                    }
                } else {
                    Log::error('Customer Login Error: Invalid Email or Unverified Email');
                    return redirect()->back()->with('error', 'Invalid Email or Unverified Email');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Login Error: " . $th->getMessage());
        }
    }
}
