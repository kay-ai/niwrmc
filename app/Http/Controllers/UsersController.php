<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(){
        $user = Auth::user();

        if ($user->hasRole('Super Admin')) {
            $users = User::latest()->get();
            $roles = Role::all();
        } else {
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Super Admin');
            })
            ->get();
            $roles = Role::where('name', '!=', 'Super Admin')->get();
        }
        $users = User::latest()->get();

        return view('user.users.index', compact('users','roles'));
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'phone' => ['string', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['string', 'max:255'],
        ]);

        if ($validator->fails()) {
            Log::channel('api')->error('Create User Validation Error: ' . $validator->errors());
            return redirect()->back()->with('error', $validator->errors());
        }

        $user = new User();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone_number');
        $user->password = Hash::make($request->input('password'));
        $user->address = $request->input('address');
        $user->email_verified_at = Date::now();
        $user->save();

        return redirect()->back()->with('success', 'User Created Successfully');
    }
}
