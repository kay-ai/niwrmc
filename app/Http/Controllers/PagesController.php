<?php

namespace App\Http\Controllers;

use App\Models\ApplicationDocument;
use App\Models\ApplicationForm;
use App\Models\BoreHoleContractorLicenseForm;
use App\Models\DischargeWaterWasteForm;
use App\Models\DrillersLicenseForm;
use App\Models\License;
use App\Models\Payment;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function applyLicense(Request $request){
        return view('customer.apply.index');
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
