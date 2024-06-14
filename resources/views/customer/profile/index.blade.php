@extends('layouts.app', [$pageTitle = 'NIWRMC | Profile Setting'])

@push('css')
    <style>
        label{
            color: #000000;
        }
    </style>
@endpush
@section('content')
    <div class="main_content_iner ">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-4">
                <div class="modal-content cs_modal shadow-sm">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit your details</h5>
                    </div>
                    <form action="{{auth()->guard('customer')->check() ? route('profile.update') : route('user.profile.update')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="{{$user->first_name?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{$user->last_name?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number">Phone</label>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number" value="{{$user->phone ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{$user->email ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="address" class="form-control" name="address" placeholder="Enter Address" value="{{$user->address ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-sm px-4" style="font-size: 12px">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-10">
                <div class="modal-content cs_modal shadow-sm">
                    <div class="modal-header">
                        <h5 class="modal-title">Change your password</h5>
                    </div>
                    <form action="{{auth()->guard('customer')->check() ? route('profile.password') : route('user.profile.password') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Enter Current Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success btn-sm px-4" style="font-size: 12px">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
