@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center position-relative">
        <div class="col-lg-6">
            <div class="steps d-flex justify-content-center mb-3">
                <div class="steps-content d-flex justify-content-between">
                    <div class="text-center">
                        <a href="/discharge-of-waste">
                            <div class="number active">1</div>
                            <div>Basic Info</div>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="#">
                            <div class="number">2</div>
                            <div>Application Details</div>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="#">
                            <div class="number">3</div>
                            <div>Documents</div>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="#">
                            <div class="number">4</div>
                            <div>Payment</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="title-div">
                        <h4 class="text-center mb-0" style="color: #5a5a5a">Application for Water Licence</h4>
                    </div>
                </div>
            </div>
            <div class="modal-content cs_modal shadow-sm">
                <div class="modal-header">
                    <h5 class="modal-title">Basic Info</h5>
                </div>
                <div class="modal-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                    @endif
                    <form action="/application-form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" name="first_name" value="{{session('wmc-customer')['first_name'] ?? ''}}" class="form-control" placeholder="John" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" name="last_name" value="{{session('wmc-customer')['last_name'] ?? ''}}" class="form-control" placeholder="Doe" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="other_names">Other Names:</label>
                                    <input type="text" name="other_names" value="{{session('wmc-customer')['other_names'] ?? ''}}" class="form-control" placeholder="Others" >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" name="address" value="{{session('wmc-customer')['address'] ?? ''}}" class="form-control" placeholder="No. 1 dummy street, Dummy country" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number:</label>
                                    <input type="text" name="phone" value="{{session('wmc-customer')['phone'] ?? ''}}" class="form-control" placeholder="090XXXXXXXX" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="{{session('wmc-customer')['email'] ?? ''}}" class="form-control" placeholder="johndoe@mail.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" class="form-control" placeholder="XXXXXXX" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password:</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="XXXXXXX" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="cust_id" value="{{session('wmc-customer')['id'] ?? ''}}">
                        <button type="submit" href="#" class="btn_1 text-center" style="background-color: #55a51c; border:none; color: #fff;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
