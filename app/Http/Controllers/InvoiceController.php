<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceGenerated;
use App\Models\ApplicationForm;
use App\Models\DischargeWaterWasteForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pricing;
use App\Models\Invoice;
use App\Repositories\RemitaRepository;
use Illuminate\Support\Facades\Mail;

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

        $customer = auth()->guard('customer')->user();


        $rand = rand(1000, 9999);
        $randomNumber = "OR$rand$customer->id";

        $payload = [
            "amount" => $price,
            "orderId" => $randomNumber,
            "payerName" => $customer->first_name.' '.$customer->last_name,
            "payerEmail" => $customer->email,
            "payerPhone" => $customer->phone,
            "description" => "Payment for ".$request->input('application_name') . " License"
        ];

        if($application){
            $remitaRepo = new RemitaRepository();
            $generateRRR = $remitaRepo->generateRRR($payload, $category);

            $generateRRR = json_decode($generateRRR->getContent(), true);
            if($generateRRR['status'] == 'success'){
                $RRR = $generateRRR['data']['RRR'];
                // dd($RRR);

                $invoice = new Invoice();
                $invoice->remita_rrr = $RRR;
                $invoice->order_id = $randomNumber;
                $invoice->customer_id = $customer->id;
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

                // Send email to customer
                Mail::to($customer->email)->send(new InvoiceGenerated($invoice, $customer, $invoice->item, $invoice->category));

                return redirect()->back()->with('success', 'Invoice generated Successfully');
            }

            return redirect()->back()->with('error', 'Unable to generate invoice. RRR error!');
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
