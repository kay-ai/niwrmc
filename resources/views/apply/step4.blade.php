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
                            <div class="number active">4</div>
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
                    <form action="/generate-invoice" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <h4>You are to pay a Licensing fee of <strong>&#8358;{{number_format($application->license_sub_category->licensing_fee, 2) ?? 'No Fee Added For this License'}}</strong></h4>

                                <input type="hidden" name="application_name" value="{{$application->license_sub_category->name}}">
                                <input type="hidden" name="price_category" value="licensing_fee">
                                <input type="hidden" name="application_id" value="{{$application->id ?? ''}}">

                                @if ($invoice)
                                    <a href="javascript:void(0);" onclick="viewInvoice({{session('wmc-customer')['id'] ?? ''}}, 'licensing_fee')" class="btn_1 my-3">View Invoice</a>
                                    <small>Login to your Dashboard to upload your evidence of payment and view application progress</small>
                                @else
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="checkbox" class="form-checkbox" name="" id="" value="checkedValue" required>
                                        I accept the <a href="{{asset('/tor/new_terms_and_condition.doc')}}">terms of reference</a> for this License
                                        </label>
                                    </div>
                                    <button type="submit" class="btn_1">Generate Invoice to continue</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('customer.invoice.view')

