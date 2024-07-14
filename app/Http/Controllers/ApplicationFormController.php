<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationNotification;
use App\Mail\ApplicationReceived;
use App\Mail\DocumentReceived;
use App\Mail\DocumentUploadedNotification;
use App\Models\ApplicationDocument;
use App\Models\ApplicationForm;
use App\Models\Customer;
use App\Models\EmailToken;
use App\Models\Invoice;
use App\Models\LicenseSubCategory;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ApplicationFormController extends Controller
{
    public function index(){
        return view('apply.index');
    }

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
        return redirect('/application-form-step1')->with('success', 'Application Progress Saved Successfully');
    }

    public function getFormStep1(){
        $subCat = LicenseSubCategory::orderBy('name', 'desc')->get();
        // dd(env('APP_URL').'/customer-dashboard');

        if(url()->previous() == env('APP_URL').'/customer-dashboard'){
            session(['wmc-application' => '']);
            session(['wmc-application-documents' => '']);

            return view('apply.step1', compact('subCat'));
        }
        if(Auth::guard('customer')->check()){
            $application = ApplicationForm::where('customer_id', Auth::guard('customer')->user()->id)->first();

            session(['wmc-application' => $application]);

            return view('apply.step1', compact('subCat'));
        }else{
            return view('apply.step1', compact('subCat'));
        }
    }

    public function saveFormStep1(Request $request){
        $validator = Validator::make($request->all(), [
            'business_name' => ['required', 'string', 'max:50'],
            'license_sub_category_id' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        $application_id = $request->input('application_id');
        $application = ApplicationForm::where('id', $application_id)->first();


        if($application && $application->license_sub_category_id == $request->input('license_sub_category_id')){
            $applicationForm = $application;
        }else{
            $applicationForm = new ApplicationForm();
        }

        $subCat = LicenseSubCategory::find($request->input('license_sub_category_id'));

        $applicationForm->customer_id = $request->input('cust_id');
        $applicationForm->business_name = $request->input('business_name');
        $applicationForm->business_location = $request->input('business_location');
        $applicationForm->business_postal_address = $request->input('business_postal_address');
        $applicationForm->business_phone_number = $request->input('business_phone_number');
        $applicationForm->business_mobile_number = $request->input('business_mobile_number');
        $applicationForm->business_email = $request->input('business_email');
        $applicationForm->business_website = $request->input('business_website');
        $applicationForm->legal_status = $request->input('legal_status');
        $applicationForm->shareholders_criminal_status = $request->input('shareholders_criminal_status');
        $applicationForm->shareholders_criminal_status_details = $request->input('shareholders_criminal_status_details');
        $applicationForm->directors_criminal_status = $request->input('directors_criminal_status');
        $applicationForm->directors_criminal_status_details = $request->input('directors_criminal_status_details');
        $applicationForm->license_sub_category_id = $request->input('license_sub_category_id');
        $applicationForm->existing_license = $request->input('existing_license');
        $applicationForm->existing_license_details = $request->input('existing_license_details');
        $applicationForm->own_10_share_of_another_licensed_entity = $request->input('own_10_share_of_another_licensed_entity');
        $applicationForm->share_licensed_entity_details = $request->input('share_licensed_entity_details');
        $applicationForm->has_applicant_been_denied_suspended_cancelled = $request->input('has_applicant_been_denied_suspended_cancelled');
        $applicationForm->denied_suspended_cancelled_details = $request->input('denied_suspended_cancelled_details');
        $applicationForm->share_capital_of_applicant_authorized = $request->input('share_capital_of_applicant_authorized');
        $applicationForm->share_capital_of_applicant_fully_paid = $request->input('share_capital_of_applicant_fully_paid');
        $applicationForm->certified_financial_statements_url = $request->input('certified_financial_statements_url');
        $applicationForm->source_of_funding_share_capital = $request->input('source_of_funding_share_capital');
        $applicationForm->source_of_funding_loan_capital = $request->input('source_of_funding_loan_capital');
        $applicationForm->source_of_funding_others = $request->input('source_of_funding_others');
        $applicationForm->main_business_activity_of_applicant = $request->input('main_business_activity_of_applicant');
        $applicationForm->technical_capacity_of_applicant = $request->input('technical_capacity_of_applicant');
        $applicationForm->managerial_competence_of_applicant = $request->input('managerial_competence_of_applicant');
        $applicationForm->technical_support_from_foreign_sources = $request->input('technical_support_from_foreign_sources');
        $applicationForm->technical_support_from_domestic_sources = $request->input('technical_support_from_domestic_sources');
        $applicationForm->description_of_proposed_project = $request->input('description_of_proposed_project');
        $applicationForm->initial_capacity_of_project = $request->input('initial_capacity_of_project');
        $applicationForm->proposed_future_capacity_of_project = $request->input('proposed_future_capacity_of_project');
        $applicationForm->implementation_schedule_of_project = $request->input('implementation_schedule_of_project');
        $applicationForm->present_land_use_at_project_site = $request->input('present_land_use_at_project_site');
        $applicationForm->is_there_access_to_public_private_land = $request->input('is_there_access_to_public_private_land');
        $applicationForm->does_area_of_business_operation_cover_defense_ministry = $request->input('does_area_of_business_operation_cover_defense_ministry');
        $applicationForm->does_area_of_business_operation_cover_river_basin_DA_land = $request->input('does_area_of_business_operation_cover_river_basin_DA_land');
        $applicationForm->environmental_impact_of_project = $request->input('environmental_impact_of_project');
        $applicationForm->geographic_area_license_is_required = $request->input('geographic_area_license_is_required');
        $applicationForm->declaration_by_applicant_that_info_is_true = $request->input('declaration_by_applicant_that_info_is_true');
        $applicationForm->application_slug = Str::slug($subCat->name);

        $applicationForm->save();

        session(['wmc-application' => $applicationForm]);

        // Generate PDF
        $pdf = Pdf::loadView('pdf.application', ['applicationForm' => $applicationForm]);
        $business_name = Str::slug($applicationForm->business_name);
        $pdfName = "application_$applicationForm->id$business_name";
        $pdfPath = "app/public/applications/$pdfName.pdf";

        // dd($pdfPath);

        $pdfDirectory = storage_path('app/public/applications/'.$pdfName.'.pdf');
        $pdf->save($pdfDirectory);

        // Send email to customer
        Mail::to($applicationForm->customer->email)->send(new ApplicationReceived($applicationForm, $pdfDirectory));

        // Send email to users with "receive application-emails" permission
        $usersWithPermission = User::permission('receive application-emails')->get();
        foreach ($usersWithPermission as $user) {
            Mail::to($user->email)->send(new ApplicationNotification($applicationForm, $pdfDirectory));
        }

        return redirect('/application-form-step2')->with('success', 'Application Progress Saved Successfully');
    }

    public function getFormStep2(){
        if(Auth::guard('customer')->check()){
            $application = ApplicationForm::where('customer_id', Auth::guard('customer')->user()->id)->latest()->first();

            session(['wmc-application' => $application]);

            $documents = ApplicationDocument::where('application_id', $application->id)->get();

            session(['wmc-application-documents' => $documents]);

            return view('apply.step2');
        }else{
            return view('apply.step2');
        }
    }

    public function clearDocuments(){
        session(['wmc-application-documents' => '']);
        return redirect()->back()->with('success', 'Documents cleared successfully');
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

        $application = ApplicationForm::where('id', $request->input('application_id'))->first();

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
            $document->application_name = $application->license_sub_category->name;
            $document->save();
        }


        $application->stage = 'step2';
        $application->save();

        $documents = ApplicationDocument::where('application_id', $application->id)->get();

        session(['wmc-application-documents' => $documents]);

        // Send email to customer
        Mail::to($customer->email)->send(new DocumentReceived($application, $documents));

        $usersWithPermission = User::permission('receive document-emails')->get();
        foreach ($usersWithPermission as $user) {
            Mail::to($user->email)->send(new DocumentUploadedNotification($application, $documents));
        }


        return redirect()->back()->with('success', 'Application documents saved successfully');
    }

    public function getFormStep3(Request $request){
        $customer_id = session('wmc-customer')['id'];
        $application_id = $request->application_id;

        if(!$application_id){
            $application_id = session('wmc-application')['id'];
        }

        $application = ApplicationForm::where('id', $application_id)->first();

        if(!$application){
            return redirect()->back()->with('error', 'Invalid application');
        }

        $invoice = Invoice::where(['customer_id'=>$customer_id, 'application_id'=>$application_id, 'category'=>'processing_fee'])->first();

        return view('apply.step3', compact('invoice', 'application'));
    }

    public function getFormStep4(Request $request){
        $customer_id = session('wmc-customer')['id'];
        $application_id = $request->application_id;

        $application = ApplicationForm::where('id', $application_id)->first();

        $invoice = Invoice::where(['customer_id'=>$customer_id, 'application_id'=>$application_id, 'category'=>'licensing_fee'])->first();


        return view('apply.step4', compact('invoice','application'));
    }

    public function getFormStep5(){
        return view('apply.step5');
    }

}
