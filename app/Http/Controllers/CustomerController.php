<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\EmailToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{

    public function index(){
        $customers = Customer::latest()->get();

        return view('user.customer.index', compact('customers'));
    }

    public function create(Request $request){
        // dd($request->all());
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
        $customer->save();

        $token = Str::random(64);
        Log::info('Email Token: '.$token);

        $emailToken = new EmailToken();
        $emailToken->email = $customer->email;
        $emailToken->token = $token;
        $emailToken->save();

        // $url = env('FRONTEND_URL').'/auth/confirm-email/' . $customer->email . '/' . $emailToken->token;

        // $body  = '<br/>
        //             <h2>Hello '.$customer->first_name. ' '. $customer->last_name.', </h2>';
        // $body .= 'Thank you for registering with AEDC MAP Application.
        //           Please click the button below to confirm your email address';
        // $body .= '<br/><br/> If you did not register on AEDC MAP Application, you can ignore this email.';
        // $body .= '<br/><br/>Thanks. <br/>';

        // $button = [
        //     'button_url' => $url,
        //     'button_text' => 'Confirm Email',
        //     'button_color' => 'default'
        // ];

        // $to = $customer->email;
        // $subject = 'Email Confirmation';

        // $email = new EmailNotificationService();
        // $email->sendMessage($body,$to,$subject,$button);

        Auth::guard('customer')->login($customer);
        return redirect()->intended('customer-dashboard');
    }
}
