<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index(){
        $pricings = Pricing::latest()->get();

        return view('user.pricing.index', compact('pricings'));
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'license_name' => ['required'],
            'category' => ['required'],
            'price' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors())->withInput();
        }

        $pricing = new Pricing();
        $pricing->item = $request->input('license_name');
        $pricing->category = $request->input('category');
        $pricing->price = $request->input('price');
        $pricing->save();

        return redirect()->back()->with('success', 'Pricing saved successfully');
    }

    public function destroy(Request $request){
        $pricing = Pricing::find($request->id);

        $pricing->delete();

        return redirect()->back()->with('success', 'Pricing deleted successfully');
    }
}
