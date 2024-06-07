<?php

namespace App\Http\Controllers;

use App\Models\ApplicationForm;
use App\Models\DischargeWaterWasteForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pricing;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function Invoices(){
        $invoices = Invoice:: latest()->get();

        return view('user.invoice.index', compact('invoices'));
    }

    public function customerInvoices(){
        $invoices = Invoice:: where('customer_id', auth()->guard('customer')->user()->id)->latest()->get();

        return view('customer.invoice.index', compact('invoices'));
    }

    public function generateInvoice(Request $request){
        $application = ApplicationForm::find($request->application_id);
        $category = $request->input('price_category');
        $price = $application->license_sub_category->$category;

        $customer_id = auth()->guard('customer')->user()->id;

        if($application){
            $part1 = rand(1000, 9999);
            $part2 = rand(1000, 9999);
            $part3 = rand(1000, 9999);

            $randomNumber = "$part1-$part2-$part3-$customer_id";

            $invoice = new Invoice();
            $invoice->remita_rrr = $randomNumber;
            $invoice->customer_id = $customer_id;
            $invoice->application_id = $request->input('application_id');
            $invoice->application_name = $application->application_slug;
            $invoice->item = $request->input('application_name');
            $invoice->category = $request->input('price_category');
            $invoice->amount = $price;
            $invoice->currency = 'NGN';
            $invoice->status = 'unpaid';
            $invoice->save();

            if($application->stage == 'step2'){
                $application->stage = 'step3';
                $application->save();
            }

            return redirect()->back()->with('success', 'Invoice generated Successfully');
        }else{
            return redirect()->back()->with('error', 'Invalid Application');
        }
    }

    public function viewInvoice(Request $request)
    {
        $type = $request->type;
        $invoice = Invoice::where(['customer_id'=> $request->id, 'category'=>$type])->orderBy('created_at', 'desc')->first();
        $customer = $invoice->customer;

        if($invoice){
            return response()->json(['status'=>'success','invoice'=>$invoice, 'customer' => $customer]);
        }else{
            return response()->json(['status'=>'error','msg'=>'Invalid Invoice']);
        }
    }
}
