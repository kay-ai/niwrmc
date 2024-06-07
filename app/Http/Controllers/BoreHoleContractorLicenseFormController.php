<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\EmailToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BoreHoleContractorLicenseFormController extends Controller
{
    public function saveCustomer(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:customers'],
            'phone' => ['string', 'max:50', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            Log::channel('api')->error('Registration Validation Error: ' . $validator->errors());
            return redirect()->back()->with('error', $validator->errors());
        }

        $customer = new Customer();
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->other_names = $request->input('other_names');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->password = Hash::make($request->input('password'));
        $customer->address = $request->input('address');
        $customer->email_verified_at = Date::now();
        $customer->save();

        $token = Str::random(64);
        Log::info('Email Token: '.$token);

        $emailToken = new EmailToken();
        $emailToken->email = $customer->email;
        $emailToken->token = $token;
        $emailToken->save();

        session(['wmc-customer' => $customer]);
        return redirect('/borehole-contractors-license-step1');
    }
}
