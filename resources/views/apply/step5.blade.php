@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center position-relative">
        <div class="col-md-8 mb-4">
            <div class="steps d-flex justify-content-center mb-3">
                <div class="steps-content d-flex justify-content-between">
                    <div class="text-center">
                        <a href="#">
                            <div class="number">1</div>
                            <div>Basic Info</div>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="/application-form-step1">
                            <div class="number">2</div>
                            <div>Application Details</div>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="/application-form-step2">
                            <div class="number">3</div>
                            <div>Documents</div>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="/application-form-step3">
                            <div class="number">4</div>
                            <div>Payment</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="title-div">
                        <h4 class="text-center mb-0" style="color: #5a5a5a">Application for {{session('wmc-application') ? ucwords(str_replace('-', ' ', session('wmc-application')['application_slug'])) : 'Water License'}}</h4>
                    </div>
                </div>
            </div>
            <div class="modal-content cs_modal shadow-sm">
                <div class="modal-header">
                    <h5 class="modal-title">Continue your Application, {{session('wmc-customer')['first_name'] ?? ''}}</h5>
                </div>
                <div class="modal-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                    @elseif(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <h4>Once your License is Approved, you will get a notification.</h4>
                            <small>Login to your Dashboard to view license when it's ready</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('customer.invoice.view')

