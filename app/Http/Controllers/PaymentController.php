<?php

namespace App\Http\Controllers;

use App\Mail\PaymentConfirmed;
use App\Mail\PaymentNotification;
use App\Models\ApplicationForm;
use App\Models\Customer;
use App\Models\DischargeWaterWasteForm;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentReceipt;
use App\Models\User;
use App\Repositories\RemitaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PaymentController extends Controller
{
    public function index(){
        $payments = Payment::latest()->get();

        return view('user.payment.index', compact('payments'));
    }

    public function customerPayments(){
        $customer = auth()->guard('customer')->user();
        $payments = Payment::where('customer_id', $customer->id)->latest()->get();

        return view('customer.payment.index', compact('payments'));
    }

    public function uploadReceipt(Request $request){
        $validator = Validator::make($request->all(), [
            'receipts' => ['required', 'array', 'min:1'],
            'receipts.*' => ['image', 'mimes:jpeg,png,gif'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors())->withInput();
        }

        $invoice = Invoice::where('id', $request->id)->first();

        $payment_exists = Payment::where('invoice_id', $invoice->id)->first();

        if($payment_exists){
            return redirect()->back()->with('error', 'A Payment has already been registered for this invoice already!');
        }

        $customer = auth()->guard('customer')->user();

        $randomNumber = mt_rand(100000, 999999);
        $tx_id = 'BK-'. $invoice->id . $randomNumber;

        $payment = new Payment();
        $payment->invoice_id = $invoice->id;
        $payment->transaction_id = $tx_id;
        $payment->amount_paid = $invoice->amount;
        $payment->purpose = $invoice->category;
        $payment->application_id = $invoice->application_id;
        $payment->license_type = $invoice->application_name;
        $payment->customer_id = $customer->id;
        $payment->status = 'unverified';
        $payment->save();

        $receiptFiles = $request->file('receipts');

        foreach ($receiptFiles as $image) {
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $filePath = 'uploads/payment_receipts/' . $filename;

            Storage::disk('public')->put($filePath, file_get_contents($image));

            $evidence = new PaymentReceipt();
            $evidence->url = $filePath;
            $evidence->payment_id = $payment->id;
            $evidence->save();
        }

        return redirect()->back()->with('success', 'Receipt Uploaded Successfully');
    }

    public function viewReceipt(Request $request)
    {
        $id = $request->id;

        $images = PaymentReceipt::where('payment_id', $id)->get();
        if(!$images){
            return response()->json(['status'=>'error', 'msg' => 'There is no Payment Receipt for this Payment']);
        }

        return response()->json(['status'=>'success', 'msg' => $images]);
    }

    public function verify($id)
    {
        $payment = Payment::find($id);
        $payment->status = 'verified';
        $payment->save();

        $invoice = $payment->invoice;
        $invoice->status = 'paid';
        $invoice->save();

        $application = ApplicationForm::where('id', $invoice->application_id)->first();

        $application->stage = $payment->purpose == 'processing_fee' ?  'step4' : ($payment->purpose == 'licensing_fee' ? 'step5' :'');
        $application->save();

        // Send email to customer
        $customer = Customer::where('id', $invoice->customer_id)->first();
        Mail::to($customer->email)->send(new PaymentConfirmed($invoice));

        return redirect()->back()->with('success', 'Payment Verified Successfully');
    }

    public function verifyRemitaPayment($rrr, $tx_id){
        $invoice = Invoice::where('remita_rrr', $rrr)->first();
        if(!$invoice){
            return response()->json(['status'=>'error', 'error'=>'Invalid RRR'], 404);
        }

        $orderId = $invoice->order_id;
        $amount = $invoice->amount;
        $rrr = $invoice->remita_rrr;

        $remitaRepo = new RemitaRepository();
        $verifyRRRStatus = $remitaRepo->verifyTransactionStatus($orderId, $amount, $rrr);

        $verifyRRRStatus = json_decode($verifyRRRStatus->getContent(), true);
        // dd($verifyRRRStatus);
        $status = $verifyRRRStatus['status'];

        if($status == 'Successful'){
            $payment = new Payment();
            $payment->invoice_id = $invoice->id;
            $payment->transaction_id = $tx_id;
            $payment->amount_paid = $invoice->amount;
            $payment->purpose = $invoice->category;
            $payment->application_id = $invoice->application_id;
            $payment->license_type = $invoice->application_name;
            $payment->customer_id = $invoice->customer_id;
            $payment->status = 'verified';
            $payment->save();

            $invoice->status = 'paid';
            $invoice->save();

            $application = ApplicationForm::where('id', $invoice->application_id)->first();

            $application->stage = $payment->purpose == 'processing_fee'?  'step4' : ($payment->purpose == 'licensing_fee'? 'step5' :'');
            $application->save();

            // Send email to customer
            $customer = Customer::where('id', $invoice->customer_id)->first();
            Mail::to($customer->email)->send(new PaymentConfirmed($invoice));

            // Send email to users with "receive payment-email" permission
            $usersWithPermission = User::permission('receive payment-emails')->get();
            foreach ($usersWithPermission as $user) {
                Mail::to($user->email)->send(new PaymentNotification($invoice, $customer));
            }

            return response()->json(['status'=>'success', 'message'=>'Payment Verified Successfully'], 200);
        }else{
            return response()->json(['status'=>'error', 'message'=>$verifyRRRStatus['data']['message']], 400);
        }
    }
}
