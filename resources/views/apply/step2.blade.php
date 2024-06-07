@extends('layouts.guest')

@section('content')
    <div class="row justify-content-center position-relative">
        <div class="col-md-8 mb-4">
            <div class="steps d-flex justify-content-center mb-3">
                <div class="steps-content d-flex justify-content-between">
                    <div class="text-center">
                        <a href="/application-form">
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
                            <div class="number active">3</div>
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
                    <form action="/application-form-step2" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Requirements</h5>
                                <ol>
                                    <li>1. Certificate of Incorporation</li>
                                    <li>2. NSITF/ITF</li>
                                    <li>3. Form CA7 of CAC</li>
                                    <li>4. EIA Certification</li>
                                    <li>5. Tax Clearance</li>
                                    <li>6. PENCOM Certification</li>
                                    <li>7. Passport Photograph (Max size: 2mb)</li>
                                    <li>8. Business Development plan</li>
                                    <li>9. Feasibility Studies</li>
                                    <li>10. Company Profile</li>
                                </ol>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <div class="img-div shadow-sm">
                                            <img id="preview-image" src="{{session('wmc-customer') ? (session('wmc-customer')['passport'] ? ('/storage/'.session('wmc-customer')['passport']) : '/img/no-img.jpg') : '/img/no-img.jpg'}}" alt="Uploaded Image" style="width: 100%; height:100%; object-fit:cover;">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-lg-5">
                                        <div class="form-group">
                                            <label for="avatar">Upload Passport Photograph</label>
                                            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*" {{session('wmc-customer') ? (session('wmc-customer')['passport'] ? '' : 'required') : 'required'}}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- {{dd(session('wmc-application-documents'))}} --}}
                            @if (session('wmc-application-documents'))
                                <div class="col-md-12">
                                    <h4 class="mt-3">Uploaded Documents</h4>
                                    <ul>
                                        @foreach (session('wmc-application-documents') as $document)
                                            <li>{{$document->name}}</li>
                                        @endforeach
                                    </ul>
                                    {{-- <a href="{{route('apply.clear.documents')}}" role="button" class="btn btn-sm btn-warning">Clear</a> --}}
                                </div>
                            @endif
                            <h4 class="mt-3">Upload Documents</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document_name">Document name:</label>
                                        {{-- <input type="text" name="" > --}}
                                        <select name="document_name[]" id="" class="form-control form-select select2" required>
                                            <option value="">- Select an Option -</option>
                                            <option value="Certificate of Incorporation">Certificate of Incorporation</option>
                                            <option value="NSITF/ITF">NSITF/ITF</option>
                                            <option value="Form CA7 of CAC">Form CA7 of CAC</option>
                                            <option value="EIA Certification">EIA Certification</option>
                                            <option value="Tax Clearance">Tax Clearance</option>
                                            <option value="PENCOM Certification">PENCOM Certification</option>
                                            <option value="Passport Photograph (Max size: 2mb)">Passport Photograph (Max size: 2mb)</option>
                                            <option value="Business Development plan">Business Development plan</option>
                                            <option value="Feasibility Studies">Feasibility Studies</option>
                                            <option value="Company Profile">Company Profile</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document_file">File:</label>
                                        <input type="file" name="document_file[]" class="form-control" required>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-success document-clone-button">+</button>
                                <button class="btn btn-sm btn-danger document-remove-button">-</button>
                            </div>
                        </div>
                        <input type="hidden" name="cust_id" value="{{Auth::guard('customer')->check() ? Auth::guard('customer')->user()->id : session('wmc-customer')['id']}}">
                        <input type="hidden" name="application_id" value="{{session('wmc-application')['id'] ?? ''}}">
                        <div class="d-flex justify-content-between mt-3" style="width: 100%">
                            <button type="submit" href="#" class="btn btn-success" style="background-color: #55a51c; border:none; color: #fff;">Save</button>
                            <a class="btn btn-primary" href="/application-form-step3" role="button">Next</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        // Listen for changes in the file input
        $('#avatar').change(function () {
            var fileInput = this;

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-image').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });

        $(".document-clone-button").click(function () {
            // Clone the entire row
            var clonedRow = $(this).parent().prev().clone();

            clonedRow.find('input').val('');

            $(this).parent().before(clonedRow);

            $(".document-remove-button").prop("disabled", false);
        });

        $(".document-remove-button").click(function () {
            var rows = $(this).parent().prevAll(".row");
            if (rows.length > 1) {
                rows.first().remove();

                rows.find('.contract-number').each(function (index) {
                    $(this).text(index + 1);
                });
            }

            if (rows.length <= 2) {
                $(this).prop("disabled", true);
            }
        });
    });
    </script>

@endpush
