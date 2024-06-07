<?php

namespace App\Http\Controllers;

use App\Models\LicenseCategory;
use App\Models\LicenseSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LicenseSubCategoryController extends Controller
{
    public function index(){
        $subcategories = LicenseSubCategory::latest()->get();
        $categories = LicenseCategory::latest()->get();
        return view('user.subcategories.index', compact('subcategories', 'categories'));
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
            'license_category_id' => ['required', 'integer', 'max:50'],
            'processing_fee' => ['required', 'string', 'max:50'],
            'licensing_fee' => ['required', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        $subcategory = new LicenseSubCategory();
        $subcategory->name = $request->input('name');
        $subcategory->license_category_id = $request->input('license_category_id');
        $subcategory->processing_fee = $request->input('processing_fee');
        $subcategory->licensing_fee = $request->input('licensing_fee');
        $subcategory->save();

        return redirect()->back()->with('success', 'License Category created successfully');
    }
}
