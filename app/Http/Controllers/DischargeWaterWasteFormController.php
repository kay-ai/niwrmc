<?php

namespace App\Http\Controllers;

use App\Models\ApplicationDocument;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DischargeWaterWasteForm;
use App\Models\EmailToken;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class DischargeWaterWasteFormController extends Controller
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
        return redirect('/discharge-of-waste-step1')->with('success', 'Application Progress Saved Successfully');
    }

    public function getFormStep1(){
        if(Auth::guard('customer')->check()){
            $application = DischargeWaterWasteForm::where('customer_id', Auth::guard('customer')->user()->id)->first();

            session(['wmc-application' => $application]);

            return view('forms.discharge-of-waste.step1');
        }else{
            return view('forms.discharge-of-waste.step1');
        }
    }

    public function saveFormStep1(Request $request){
        $application_id = $request->input('application_id');
        $application = DischargeWaterWasteForm::where('id', $application_id)->first();

        if($application_id && $application){
            $dischargeForm = $application;
        }else{
            $dischargeForm = new DischargeWaterWasteForm();
        }

        $dischargeForm->full_name = $request->input('full_name');
        $dischargeForm->contact_address = $request->input('contact_address');
        $dischargeForm->occupation = $request->input('occupation');
        $dischargeForm->license_purpose = $request->input('license_purpose');
        $dischargeForm->quantity_of_waste = $request->input('quantity_of_waste');
        $dischargeForm->quantity_of_waste_discharged_per_day = $request->input('quantity_of_waste_discharged_per_day');
        $dischargeForm->point_of_discharge = $request->input('point_of_discharge');
        $dischargeForm->location_point_of_discharge = $request->input('location_point_of_discharge');
        $dischargeForm->uses_nearest_to_discharge_point = $request->input('uses_nearest_to_discharge_point');
        $dischargeForm->are_other_agencies_discharging = $request->input('are_other_agencies_discharging');
        $dischargeForm->other_agencies_discharging = $request->input('other_agencies_discharging');
        $dischargeForm->negative_impact_control_measures = $request->input('negative_impact_control_measures');
        $dischargeForm->are_you_pretreating_effluent = $request->input('are_you_pretreating_effluent');
        $dischargeForm->effluent_pretreatment = $request->input('effluent_pretreatment');
        $dischargeForm->have_you_conducted_studies = $request->input('have_you_conducted_studies');
        $dischargeForm->method_of_discharge = $request->input('method_of_discharge');
        $dischargeForm->vehicle_type = $request->input('vehicle_type');
        $dischargeForm->other_methods_of_discharge = $request->input('other_methods_of_discharge');
        $dischargeForm->are_you_recycling_waste = $request->input('are_you_recycling_waste');
        $dischargeForm->type_of_waste_recycle = $request->input('type_of_waste_recycle');
        $dischargeForm->customer_id = $request->input('cust_id');

        $dischargeForm->save();
        session(['wmc-application' => $dischargeForm]);

        return redirect('/discharge-of-waste-step2')->with('success', 'Application Progress Saved Successfully');
    }

    public function getFormStep2(){
        if(Auth::guard('customer')->check()){
            $application = DischargeWaterWasteForm::where('customer_id', Auth::guard('customer')->user()->id)->first();

            session(['wmc-application' => $application]);

            $documents = ApplicationDocument::where(['application_id' => $application->id, 'application_name'=> 'discharge_of_waste'])->get();

            session(['wmc-application-documents' => $documents]);

            return view('forms.discharge-of-waste.step2');
        }else{
            return view('forms.discharge-of-waste.step2');
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
            $document->application_name = "discharge-of-waste";
            $document->save();
        }

        $application = DischargeWaterWasteForm::where('id', $request->input('application_id'))->first();

        $application->stage = 'step2';
        $application->save();

        $documents = ApplicationDocument::where(['application_id' => $application->id, 'application_name'=> 'discharge-of-waste'])->get();

        session(['wmc-application-documents' => $documents]);

        return redirect()->back()->with('success', 'Application documents saved successfully');
    }

    public function getFormStep3(){
        $customer_id = session('wmc-customer')['id'];
        $invoice = Invoice::where(['customer_id'=>$customer_id, 'application_name'=>'discharge-of-waste', 'category'=>'processing_fee'])->first();

        return view('forms.discharge-of-waste.step3', compact('invoice'));
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
