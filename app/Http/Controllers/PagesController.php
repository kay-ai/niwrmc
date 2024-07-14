<?php

namespace App\Http\Controllers;

use App\Models\ApplicationDocument;
use App\Models\ApplicationForm;
use App\Models\BoreHoleContractorLicenseForm;
use App\Models\Customer;
use App\Models\DischargeWaterWasteForm;
use App\Models\DrillersLicenseForm;
use App\Models\License;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function applyLicense(Request $request){
        return view('customer.apply.index');
    }

    public function payWithRemita(){
        return view('pay.index');
    }

    public function profile(){
        $user = auth()->user();
        return view('customer.profile.index', compact('user'));
    }

    public function profileUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'phone' => ['string', 'max:50'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            Log::channel('api')->error('Create User Validation Error: ' . $validator->errors());
            return redirect()->back()->with('error', $validator->errors());
        }

        if(auth()->guard('customer')->check()){
            $user = Customer::where('id', auth()->id())->first();
        }else{
            $user = User::where('id', auth()->id())->first();
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone_number');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back()->with('success', 'Profile Update Successfully');
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'current_password' => ['required','string'],
            'password' => ['required','string','min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            Log::channel('api')->error('Create User Validation Error: '. $validator->errors());
            return redirect()->back()->with('error', $validator->errors());
        }

        if(auth()->guard('customer')->check()){
            $user = Customer::where('id', auth()->id())->first();
        }else{
            $user = User::where('id', auth()->id())->first();
        }

        if (Hash::check($request->input('current_password'), $user->password)) {
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->back()->with('success', 'Password Changed Successfully');
        }else{
            return redirect()->back()->with('error', 'Current Password is Incorrect');
        }
    }

    public function dashboard(){
        $processing_fees = Payment::where(['purpose'=>'processing_fee', 'status'=>'verified'])->get();
        $licensing_fees = Payment::where(['purpose'=>'licensing_fee', 'status'=>'verified'])->get();
        $licenses = License::latest()->get();
        $revalidate = License::where('revalidate', true)->get();

        $process_amount = [];
        foreach($processing_fees as $payment){
            array_push($process_amount, $payment->amount_paid);
        }

        $license_amount = [];
        foreach($licensing_fees as $payment){
            array_push($license_amount, $payment->amount_paid);
        }

        $applications = ApplicationForm::latest()->get();

        $applications = $applications->take(200);

        return view('user.dashboard', compact('applications','process_amount','license_amount','licenses', 'revalidate'));
    }

    public function customerDashboard(){
        $customer_id = auth()->user()->id;
        $licenses = License::where('customer_id', $customer_id)->whereNotNull('generated_at')->latest()->get();

        $applications = ApplicationForm::where('customer_id', $customer_id)->where('stage', '!=', 'step7')->get();

        return view('customer.dashboard', compact('licenses','applications'));
    }

    public function viewDocument(Request $request)
    {
        $id = $request->id;

        $document = ApplicationDocument::where(['application_id' => $id])->get();

        if(!$document){
            return response()->json(['status'=>'error', 'msg' => 'There is no Document Uploaded for this Application']);
        }

        return response()->json(['status'=>'success', 'msg' => $document]);
    }
}
