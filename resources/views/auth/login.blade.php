@extends('layouts.guest')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-lg-6">
        <div class="modal-content cs_modal shadow-sm">
            <form action="" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Log in</h5>
                    <div>
                        <span class="mb-2">Staff:</span>
                        <label class="switch">
                            <input type="checkbox" name="type" value="in">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="modal-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                    @endif
                        <div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" class="form-control" placeholder="johndoe@mail.com" required>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" class="form-control" placeholder="XXXXXXX" required>
                            </div>
                        </div>
                        {{-- <input type="hidden" name="type"> --}}
                        <button type="submit" href="#" class="btn_1 text-center" style="background-color: #55a51c; border:none; color: #fff;">Log in</button>
                        <p>Don't have an account? <a href="/register" style="color: #55a51c;"> Sign Up</a></p>
                        <div class="text-center">
                            <a class="pass_forget_btn mt-1" href="#" style="color: #55a51c; font-size: 14px;">Forgot Password?</a>
                        </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
