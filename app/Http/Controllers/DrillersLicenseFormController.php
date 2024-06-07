<?php

namespace App\Http\Controllers;

use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DrillersLicenseForm;
use App\Models\EmailToken;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class DrillersLicenseFormController extends Controller
{
    public function saveCustomer(Request $request){
        $customer_id = $request->input('cust_id');
        $cust = Customer::where('id', $customer_id)->first();

        if($customer_id && $cust){
            $customer = $cust;
            $validator = Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:50'],
                'last_name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email', 'max:50'],
                'phone' => ['string', 'max:50'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'address' => ['string', 'max:255'],
            ]);

            if ($validator->fails()) {
                Log::channel('api')->error('Registration Validation Error: ' . $validator->errors());
                return redirect()->back()->with('error', $validator->errors());
            }
        }else{
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
        return redirect('/drillers-license-step1');
    }

    public function getFormStep1(){
        if(Auth::guard('customer')->check()){
            $application = DrillersLicenseForm::where('customer_id', Auth::guard('customer')->user()->id)->first();

            session(['wmc-application' => $application]);

            return view('forms.drillers-license.step1');
        }else{
            return view('forms.drillers-license.step1');
        }
    }

    public function saveFormStep1(Request $request){
        $application_id = $request->input('application_id');
        $application = DrillersLicenseForm::where('id', $application_id)->first();

        if($application_id && $application){
            $drillers_license = $application;
        }else{
            $drillers_license = new DrillersLicenseForm();
        }

        $drillers_license->full_name = $request->input('full_name');
        $drillers_license->contact_address = $request->input('contact_address');
        $drillers_license->occupation = $request->input('occupation');
        $drillers_license->date_of_birth = $request->input('date_of_birth');
        $drillers_license->educational_training = $request->input('educational_training');
        $drillers_license->professional_training = $request->input('professional_training');
        $drillers_license->relevant_drilling_experience = $request->input('relevant_drilling_experience');
        $drillers_license->professional_associations = $request->input('professional_associations');
        $drillers_license->other_relevant_info = $request->input('other_relevant_info');
        $drillers_license->customer_id = $request->input('cust_id');


        $drillers_license->save();
        session(['wmc-application' => $drillers_license]);

        return redirect('/drillers-license-step2')->with('success', 'Application Progress Saved Successfully');
    }

    public function getFormStep2(){
        if(Auth::guard('customer')->check()){
            $application = DrillersLicenseForm::where('customer_id', Auth::guard('customer')->user()->id)->first();

            session(['wmc-application' => $application]);

            $documents = ApplicationDocument::where(['application_id' => $application->id, 'application_name'=> 'drillers-license'])->get();

            session(['wmc-application-documents' => $documents]);

            return view('forms.drillers-license.step2');
        }else{
            return view('forms.drillers-license.step2');
        }
    }

    public function saveFormStep2(Request $request){
        $customer = Customer::find($request->input('cust_id'));

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $avatarFileName = 'passport_' . time() . '.' . $avatar->getClientOriginalExtension();

            $avatarUrl = $avatar->storeAs('passports', $avatarFileName, 'public');

            $customer->passport = $avatarUrl;
        }

        $customer->save();
        session(['wmc-customer' => $customer]);

        $documentNames = $request->input('document_name');
        $documentFiles = $request->file('document_file');

        foreach ($documentNames as $key => $documentName) {
            $document = new ApplicationDocument();

            // Rename the document
            $fileName = $documentFiles[$key]->getClientOriginalName();
            $documentNameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);
            $fileExtension = $documentFiles[$key]->getClientOriginalExtension();
            $newFileName = $documentNameWithoutExtension . '_' . time() . '.' . $fileExtension;

            // Store the document file with the new name and get its URL
            $document->url = $documentFiles[$key]->storeAs('documents', $newFileName, 'public');

            $document->name = $documentName;
            $document->customer_id = $request->input('cust_id');
            $document->application_id = $request->input('application_id');
            $document->application_name = "drillers-license";
            $document->save();
        }

        $application = DrillersLicenseForm::where('id', $request->input('application_id'))->first();

        $application->stage = 'step2';
        $application->save();

        $documents = ApplicationDocument::where(['application_id' => $application->id, 'application_name'=> 'drillers-license'])->get();

        session(['wmc-application-documents' => $documents]);

        return redirect()->back()->with('success', 'Application documents saved successfully');
    }

    public function getFormStep3(){
        $customer_id = session('wmc-customer')['id'];
        $invoice = Invoice::where(['customer_id'=>$customer_id, 'application_name'=>'drillers-license', 'category'=>'processing_fee'])->first();

        return view('forms.drillers-license.step3', compact('invoice'));
    }

    public function getFormStep4(Request $request){
        $customer_id = session('wmc-customer')['id'];
        $invoice = Invoice::where(['customer_id'=>$customer_id, 'application_name'=>'discharge-of-waste', 'category'=>'licensing_fee'])->first();

        $application_id = $request->application_id;

        return view('forms.discharge-of-waste.step4', compact('invoice','application_id'));
    }

    public function getFormStep5(){
        return view('forms.discharge-of-waste.step5');
    }
}
