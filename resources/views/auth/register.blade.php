@extends('layouts.guest')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-lg-6">
        <div class="modal-content cs_modal shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title">Create an Account</h5>
            </div>
            <div class="modal-body">
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{session('error')}}
                    </div>
                @endif
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" name="first_name" value="" class="form-control" placeholder="John" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Doe" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="other_names">Other Names:</label>
                                <input type="text" name="other_names" class="form-control" placeholder="Others" >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" class="form-control" placeholder="No. 1 dummy street, Dummy country" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" name="phone" class="form-control" placeholder="090XXXXXXXX" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="johndoe@mail.com" required>
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
                    <input type="hidden" name="type" value="out">
                    <button type="submit" href="#" class="btn_1 text-center" style="background-color: #55a51c; border:none; color: #fff;">Register</button>
                    <p>Already have an account? <a href="/login" style="color: #55a51c;"> Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
