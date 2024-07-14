@extends('layouts.app', [$pageTitle = 'NIWRMC | Dashboard'])

@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_box mb_30 min_400">
                        @if (count(auth()->guard('customer')->user()->invoices->where('status','unpaid'))>0)
                            <div class="alert alert-warning alert-dismissible fade show pe-3" role="alert">
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <a class="btn btn-outline-dark btn-sm float-end me-4" href="/customer-invoices" role="button" style="margin-top: -4px;">View</a>

                                <strong>You have {{count(auth()->guard('customer')->user()->invoices->where('status','unpaid'))}} Unpaid Invoice(s)</strong>
                            </div>
                        @endif

                        <div class="box_header ">
                            <div class="main-title">
                                <h3 class="mb-0">My Applications</h3>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                @if(count($applications)>0)
                                    @foreach ($applications as $application)
                                        @php
                                            switch ($application->stage) {
                                                case 'step1':
                                                    $progress = 25;
                                                    $stage = 'Document Upload';
                                                    $url = '/application-form-'.$application->stage;
                                                    break;
                                                case 'step2':
                                                    $progress = 50;
                                                    $stage = 'Generate Invoice';
                                                    $url = '/application-form-'.$application->stage;
                                                    break;
                                                case 'step3':
                                                    $progress = 75;
                                                    $stage = 'Pay Processing Fee';
                                                    $url = '/application-form-'.$application->stage.'/'.$application->id;
                                                    break;
                                                case 'step4':
                                                    $progress = 80;
                                                    $stage = 'Pay License Fee';
                                                    $url = '/application-form-'.$application->stage.'/'.$application->id;
                                                    break;
                                                case 'step5':
                                                    $progress = 90;
                                                    $stage = 'License Payment Verified';
                                                    $url = '/application-form-'.$application->stage;
                                                    break;
                                                case 'step6':
                                                    $progress = 100;
                                                    $stage = 'License Approved';
                                                    $url = '/application-form-'.$application->stage;
                                                    break;
                                                default:
                                                    $progress = 0;
                                                    $stage = 'Create Application';
                                                    $url = '/application-form-'.$application->stage;
                                                    break;
                                            }
                                        @endphp
                                        <div class="col-md-6">
                                            <a class="d-flex justify-content-between card p-3 shadow-sm" href="{{$url}}">
                                                <p class="text-center mt-2" style="font-size: 12px;">{{$application->license_sub_category->name}} - {{$application->business_name}}</p>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%;">{{$progress}}%</div>
                                                </div>
                                                <span class="badge rounded-pill bg-success" style="position: absolute; right: 15px; top: 8px; font-size: 9px;">{{$stage}}</span>
                                                <span class="text-success" style="position: absolute; left: 15px; top: 7px; font-size: 9px;">Click to Continue >>></span>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-center">
                                            <h5 class="text-center">You don't have any active applications</h5>
                                            <a href="{{route('apply.getFormStep1')}}" class="btn_1 btn my-3">Apply For a License</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="white_box mb_30 min_400">
                        <div class="box_header ">
                            <div class="main-title">
                                <h3 class="mb-0">My Licenses</h3>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                @if (count($licenses)>0)
                                    @foreach ($licenses as $license)
                                        <div class="col-md-4">
                                            <a href="/storage/licenses/{{$license->license_holder}}.jpg" target="_blank" class="position-relative">
                                                <div class="d-flex justify-content-between position-absolute p-2" style="width: 100%">
                                                    <span class="badge rounded-pill bg-success">Valid: <span id="years_remaining">{{$license->valid_period}}</span> yrs</span>
                                                    @if ($license->revalidate == true)
                                                        <span class="badge rounded-pill bg-warning">Revalidate</span>
                                                    @endif
                                                    {{-- <span class="badge rounded-pill bg-danger">Renew</span> --}}
                                                </div>
                                                <img src="/storage/licenses/{{$license->license_holder}}.jpg" style="width: 100%;">
                                                <div class="card bg-success text-white p-3">{{$license->name}}</div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <h5 class="text-center">You don't have any licenses yet</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
