<?php

namespace App\Http\Controllers;

use App\Models\ApplicationForm;
use App\Models\BoreHoleContractorLicenseForm;
use App\Models\DischargeWaterWasteForm;
use App\Models\DrillersLicenseForm;
use App\Models\Invoice;
use App\Models\License;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LicenseController extends Controller
{
    public function customerLicense(){
        $customer_id = auth()->guard('customer')->user()->id;

        $licenses = License::where('customer_id', $customer_id)->get();
        return view('customer.license.index', compact('licenses'));
    }

    public function index(){
        $licenses = License::latest()->get();

        return view('user.license.index', compact('licenses'));
    }

    public function approveLicense(Request $request){
        $application_id = $request->id;
        $slug = $request->slug;

        $application = ApplicationForm::where('id', $application_id)->first();
        $license_name = $application->license_sub_category->name;

        $prefix = '';
        $words = explode('-', $slug);
        foreach ($words as $word) {
            $prefix .= substr($word, 0, 1);
        }

        $reg_no = $prefix . '-' . rand(1000, 9999) . $application->id;

        $invoice = Invoice::where(['customer_id' => $application->customer_id, 'category' => 'licensing_fee'])->first();
        $payment = $invoice->payment;

        if($payment->status == 'verified'){
            $application->stage = 'step6';
            $application->save();

            $license = new License();
            $license->customer_id = $application->customer_id;
            $license->name = $license_name;
            $license->application_id = $application->id;
            $license->application_slug = $application->application_slug;
            $license->payment_id = $payment->id;
            $license->reg_no = $reg_no;
            $license->license_type = $invoice->category;
            $license->license_holder = $application->business_name;
            $license->assigned_by_id = auth()->user()->id;
            $license->valid_period = 10;
            $license->revalidate = false;
            $license->save();

        }else{
            return redirect()->back()->with('error', 'No payment has been verified for this license');
        }

        return redirect()->back()->with('success', 'License was approved successfully');
    }

    public function generateLicense(Request $request){
        $license = License::where('id', $request->id)->first();

        $application = ApplicationForm::where('id', $license->application_id)->first();
        $reg_no = $license->reg_no;

        try{
            $license->licensed_as = $request->input('licensed_as');
            $license->company_address = $request->input('company_address');
            $license->hydrological_area = $request->input('hydrological_area');
            $license->state = $request->input('state');
            $license->lga = $request->input('lga');
            $license->generated_at = Date::now();
            $license->save();

            $templatePath = ('/img/licenses/blank_license.png');
            $template = Image::make(public_path($templatePath));

            $fontPath = public_path('/fonts/Roboto_Slab/static/RobotoSlab-Bold.ttf');
            $fontSize = 37;
            $fontColor = '#191814';

            //License Name
            $template->text($license->name, 530, 320, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file($fontPath);
                $font->size(33);
                $font->color($fontColor);
            });

            //License Number
            $template->text($reg_no, 1350, 390, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file($fontPath);
                $font->size(24);
                $font->color($fontColor);
            });

            //License Applicant
            $template->text($license->license_holder, 580, 500, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file($fontPath);
                $font->size($fontSize);
                $font->color($fontColor);
            });

            //Licensed As
            $template->text($license->licensed_as, 629, 540, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file(public_path('/fonts/Roboto_Slab/static/RobotoSlab-Regular.ttf'));
                $font->size(23);
                $font->color($fontColor);
            });

            //Company Address
            $template->text($license->company_address, 642, 608, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file(public_path('/fonts/Roboto_Slab/static/RobotoSlab-Regular.ttf'));
                $font->size(23);
                $font->color($fontColor);
            });

            //Hydrological Area
            $template->text($license->hydrological_area, 575, 646, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file(public_path('/fonts/Roboto_Slab/static/RobotoSlab-Regular.ttf'));
                $font->size(23);
                $font->color($fontColor);
            });

            //State
            $template->text($license->state, 500, 675, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file(public_path('/fonts/Roboto_Slab/static/RobotoSlab-Regular.ttf'));
                $font->size(23);
                $font->color($fontColor);
            });

            //LGA
            $template->text($license->lga, 568, 700, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file(public_path('/fonts/Roboto_Slab/static/RobotoSlab-Regular.ttf'));
                $font->size(23);
                $font->color($fontColor);
            });

            //Effective Date
            $template->text(($license->created_at)->format('jS F Y'), 450, 890, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file($fontPath);
                $font->size(30);
                $font->color($fontColor);
            });

            $expiryDate = Carbon::parse($license->created_at)->addYears(10);

            // Expiry Date
            $template->text($expiryDate->format('jS F Y'), 1000, 890, function($font) use ($fontPath, $fontSize, $fontColor) {
                $font->file($fontPath);
                $font->size(30);
                $font->color($fontColor);
            });

            if ($request->hasFile('signature')) {
                $signatureImage = $request->file('signature');
                $signatureFileName = 'license_signature.' . $signatureImage->getClientOriginalExtension();
                $signatureImage->move(public_path('/signatures/'), $signatureFileName);
                $signatureImagePath = 'signatures/' . $signatureFileName;

                // Resize the signature image to a specific width and height
                $signatureImage = Image::make(public_path($signatureImagePath))->resize(180, 100);

                // Add the resized signature to the template
                $template->insert($signatureImage, 'bottom-center', 100, 140);
            }

            //  $qrCodeText = "Genuine License issued to " . $license->license_holder;
            // $qrCodePath = "/qrcodes/{$license->license_holder}_qrcode.png";

            // // Generate the QR code and save it to the storage disk
            // Storage::disk('public')->put($qrCodePath, QrCode::size(200)->format('png')->generate($qrCodeText));

            // // Get the local path of the saved QR code
            // $localQrCodePath = Storage::disk('public')->path($qrCodePath);

            // // Add the QR code to the template
            // $qrCodeImage = Image::make($localQrCodePath);
            // $template->insert($qrCodeImage, 'bottom-right', 100, 140);

            //Store Template
            $outputPath = "licenses/{$license->license_holder}.jpg";
            Storage::disk('public')->put($outputPath, $template->stream());

            $application->stage = 'step7';
            $application->save();
        }catch(\Throwable $th){
            return redirect()->back()->with('error', $th->getMessage());
        }

        return redirect()->back()->with('success', 'License was generated successfully');
    }

    public function destroy($id)
    {
        $license = License::find($id);

        switch ($license->application_slug) {
            case 'discharge-of-waste':
                $application = DischargeWaterWasteForm::where('id', $license->application_id)->first();
                break;
        }

        $application->stage = 'step5';
        $application->save();

        $license->delete();

        return redirect()->back()->with('success', 'License deleted successfully');
    }
}
