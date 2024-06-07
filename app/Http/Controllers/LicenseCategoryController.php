<?php

namespace App\Http\Controllers;

use App\Models\LicenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LicenseCategoryController extends Controller
{
    public function index(){
        $categories = LicenseCategory::latest()->get();
        return view('user.categories.index', compact('categories'));
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:50'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        $category = new LicenseCategory();
        $category->name = $request->input('name');
        $category->save();

        return redirect()->back()->with('success', 'License Category created successfully');
    }
}
