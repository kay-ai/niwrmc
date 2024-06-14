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
                            <div class="number active">2</div>
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
                        <a href="#">
                            <div class="number">4</div>
                            <div>Payment</div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- {{dd(session('wmc-application'))}} --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="title-div">
                        <h4 class="text-center mb-0" style="color: #5a5a5a">Application for {{session('wmc-application') ? ucwords(str_replace('-', ' ', session('wmc-application')['application_slug'])) : 'Water License'}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
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
                    <form action="/application-form-step1" method="POST">
                        @csrf
                        <div class="row">
                            <h3>1. Business Information</h3>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="full_name">Business Name: <small class="text-danger">* This name will appear on the License issued</small></label>
                                    <input type="text" name="business_name" class="form-control" placeholder="John Doe" value="{{old('business_name')}}{{session('wmc-application')['business_name'] ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact-address">Business Location: <small class="text-danger">*</small></label>
                                    <input type="text" name="business_location" value="{{old('business_location')}}{{session('wmc-application')['business_location'] ?? ''}}" class="form-control" placeholder="Okiki Investments Limited" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact-address">Business Postal Address: </label>
                                    <input type="text" name="business_postal_address" value="{{old('business_postal_address')}}{{session('wmc-application')['business_postal_address'] ?? ''}}" class="form-control" placeholder="P.O Box 123, Gwagwalada, Abuja">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact-address">Business Phone Number: <small class="text-danger">*</small></label>
                                    <input type="text" name="business_phone_number" value="{{old('business_phone_number')}}{{session('wmc-application')['business_phone_number'] ?? ''}}" class="form-control" placeholder="080XXXXXXXX" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="contact-address">Business Mobile Number:</label>
                                    <input type="text" name="business_mobile_number" value="{{old('business_mobile_number')}}{{session('wmc-application')['business_mobile_number'] ?? ''}}" class="form-control" placeholder="080XXXXXXXX">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact-address">Business Email: <small class="text-danger">*</small></label>
                                    <input type="text" name="business_email" value="{{old('business_email')}}{{session('wmc-application')['business_email'] ?? ''}}" class="form-control" placeholder="Johndoe@mail.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact-address">Business Website:</label>
                                    <input type="text" name="business_website" value="{{old('business_website')}}{{session('wmc-application')['business_website'] ?? ''}}" class="form-control" placeholder="www.okikyinvestment.com" required>
                                </div>
                            </div>
                            <h3 class="mt-3">2. LEGAL STATUS OF APPLICANT</h3>
                            <hr>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">2.1 Indicate Legal Status of Applicant</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="legal_status" id="" value="Sole Proprietorship" {{session('wmc-application') ? (session('wmc-application')['legal_status'] == 'Sole Proprietorship'? 'checked' : '') : ''}}>
                                        Sole Proprietorship
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="legal_status" id="" value="Partnership" {{session('wmc-application') ? (session('wmc-application')['legal_status'] == 'Partnership'? 'checked' : '') : ''}}>
                                        Partnership
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="legal_status" id="" value="Public Limited Liability Company" {{session('wmc-application') ? (session('wmc-application')['legal_status'] == 'Public Limited Liability Company'? 'checked' : '') : ''}}>
                                        Public Limited Liability Company
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="legal_status" id="" value="Private Limited Liability Company" {{session('wmc-application') ? (session('wmc-application')['legal_status'] == 'Private Limited Liability Company'? 'checked' : '') : ''}}>
                                        Private Limited Liability Company
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="legal_status" id="" value="Cooperate Society" {{session('wmc-application') ? (session('wmc-application')['legal_status'] == 'Cooperate Society'? 'checked' : '') : ''}}>
                                        Cooperate Society
                                    </label>
                                </div>
                                <small>(Attach Certificate of Registration, Certificate of Incorporation, Memorandum and Articles of Association, Deed Partnership, Deed Trust as Applicable.)</small>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-2 text-start">2.2. List and Particulars of shareholders <small>(Attach Particulars in Document section)</small></p>
                                <div class="row" id="shareholders_div">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="shareholder_name">Name:</label>
                                            <input type="text" value="{{old('shareholder_name')}}" name="shareholder_name[]" class="form-control" placeholder="John Doe">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="shareholder_address">Address:</label>
                                            <input type="text" value="{{old('shareholder_address')}}" name="shareholder_address[]" class="form-control" placeholder="Kuje, Abuja">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="shareholder_nationality">Nationality:</label>
                                            <input type="text" value="{{old('shareholder_nationality')}}" name="shareholder_nationality[]" class="form-control" placeholder="Nigerian">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="shareholder_country_of_residence">Country of Residence:</label>
                                            <input type="text" value="{{old('shareholder_country_of_residence')}}" name="shareholder_country_of_residence[]" class="form-control" placeholder="Nigeria">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button class="btn btn-sm btn-success shareholder-clone-button">+</button>
                                    <button class="btn btn-sm btn-danger shareholder-remove-button">-</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">2.3. State if any shareholder has ever been convinced of a criminal offense in Nigeria or in any other country:</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="shareholder_criminal_status" id="" value="yes" {{session('wmc-application') ? (session('wmc-application')['shareholder_criminal_status'] == 'yes'? 'checked' : '') : ''}}>
                                        Yes <input type="text" class="form-control" placeholder="if Yes, Details of conviction" name="shareholder_criminal_status_details" value="{{session('wmc-application')['shareholder_criminal_status_details'] ?? ''}}">
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="shareholder_criminal_status" id="" value="no" {{session('wmc-application') ? (session('wmc-application')['shareholder_criminal_status'] == 'no'? 'checked' : '') : ''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-2 text-start">2.4. List and Particulars of Directors <small>(Attach Particulars in Document section)</small> </p>
                                <div class="row" id="directors_div">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="director_name">Name:</label>
                                            <input type="text" value="{{old('director_name')}}" name="director_name[]" class="form-control" placeholder="John Doe">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="director_address">Address:</label>
                                            <input type="text" value="{{old('director_address')}}" name="director_address[]" class="form-control" placeholder="Kuje, Abuja">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="director_nationality">Nationality:</label>
                                            <input type="text" value="{{old('director_nationality')}}" name="director_nationality[]" class="form-control" placeholder="Nigerian">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="director_country_of_residence">Country of Residence:</label>
                                            <input type="text" value="{{old('director_country_of_residence')}}" name="director_country_of_residence[]" class="form-control" placeholder="Nigeria">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button class="btn btn-sm btn-success shareholder-clone-button">+</button>
                                    <button class="btn btn-sm btn-danger shareholder-remove-button">-</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">2.5. State if any director has ever been convinced of a criminal offense in Nigeria or in any other country:</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="director_criminal_status" id="" value="yes" {{session('wmc-application') ? (session('wmc-application')['director_criminal_status'] == 'yes'? 'checked' : '') : ''}}>
                                        Yes <input type="text" class="form-control" placeholder="if Yes, Details of conviction" name="director_criminal_status_details" value="{{session('wmc-application')['director_criminal_status_details'] ?? ''}}">
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="director_criminal_status" id="" value="no" {{session('wmc-application') ? (session('wmc-application')['director_criminal_status'] == 'no'? 'checked' : '') : ''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <h3 class="mt-3">3. TYPE OF LICENSE REQUIRED</h3>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="license_sub_category_id" class="mb-3">3.1. Select Category of License you require</label>
                                    <select name="license_sub_category_id" value="{{ session('wmc-application')['license_sub_category_id'] ?? '' }}" class="form-select" required>
                                        <option>- Select an Option -</option>
                                        @if($subCat)
                                            @php
                                                // Group subcategories by their license category
                                                $groupedSubCategories = [];
                                                foreach ($subCat as $cat) {
                                                    $groupedSubCategories[$cat->license_category->name][] = $cat;
                                                }
                                            @endphp

                                            @foreach ($groupedSubCategories as $categoryName => $subCategories)
                                                <optgroup label="{{ $categoryName }}">
                                                    @foreach ($subCategories as $cat)
                                                        <option value="{{ $cat->id }}">
                                                            {{ $cat->name }} | (Processing Fee: {{ number_format($cat->processing_fee) }}) | (Licensing Fee: {{ number_format($cat->licensing_fee) }})
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">3.2. Does the Applicant have an existing licence/permit/agreement issued by the NIWRMC/FMWR/River Basin Development Authority, or any other water management agency?</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="existing_license" id="" value="yes" {{session('wmc-application') ? (session('wmc-application')['existing_license'] == 'yes'? 'checked' : '') : ''}}>
                                        Yes <small>(Attach a copy)</small>
                                        <input type="text" class="form-control" placeholder="if Yes, State the nature of license, date issued, and the license number" name="existing_license_details" value="{{session('wmc-application')['existing_license_details'] ?? ''}}">
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="existing_license" id="" value="no" {{session('wmc-application') ? (session('wmc-application')['existing_license'] == 'no'? 'checked' : '') : ''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">3.3. Does the Applicant own more than ten percent (10%)  shareholding in another entity that has applied for a licence or has been granted a licence by the Ministry?</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="own_10_share_of_another_licensed_entity" id="" value="yes" {{session('wmc-application') ? (session('wmc-application')['own_10_share_of_another_licensed_entity'] == 'yes'? 'checked' : '') : ''}}>
                                        Yes
                                        <input type="text" class="form-control" placeholder="if Yes, State the name of the entoty, nature of license, date issued, and the license number" name="share_licensed_entity_details" value="{{session('wmc-application')['share_licensed_entity_details'] ?? ''}}">
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="own_10_share_of_another_licensed_entity" id="" value="no" {{session('wmc-application') ? (session('wmc-application')['own_10_share_of_another_licensed_entity'] == 'no'? 'checked' : '') : ''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">3.4. Has the Applicant ever been refused a licence or had its licence suspended or cancelled by the Ministry or Commission?</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="has_applicant_been_denied_suspended_cancelled" id="" value="yes" {{session('wmc-application') ? (session('wmc-application')['has_applicant_been_denied_suspended_cancelled'] == 'yes'? 'checked' : '') : ''}}>
                                        Yes
                                        <input type="text" class="form-control" placeholder="if Yes, give details of refusal, suspension or cancellation" name="denied_suspended_cancelled_details" value="{{session('wmc-application')['denied_suspended_cancelled_details'] ?? ''}}">
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="has_applicant_been_denied_suspended_cancelled" id="" value="no" {{session('wmc-application') ? (session('wmc-application')['has_applicant_been_denied_suspended_cancelled'] == 'no'? 'checked' : '') : ''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <h3 class="mt-3">4. FINANCIAL STATUS OF APPLICANT</h3>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="share_capital_of_applicant_authorized">Share Capital of Applicant (Authorized):</label>
                                    <input type="text" name="share_capital_of_applicant_authorized" class="form-control" placeholder="100,000,000" value="{{old('share_capital_of_applicant_authorized')}}{{session('wmc-application')['share_capital_of_applicant_authorized'] ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="share_capital_of_applicant_fully_paid">Share Capital of Applicant (Fully Paid):</label>
                                    <input type="text" name="share_capital_of_applicant_fully_paid" class="form-control" placeholder="100,000,000" value="{{old('share_capital_of_applicant_fully_paid')}}{{session('wmc-application')['share_capital_of_applicant_fully_paid'] ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="mb-2 text-start">4.2. Name and Address of Bankers inside and outside of Nigeria (Including phone number and fax)</small> </p>
                                <div class="row" id="bankers_div">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="banker_name">Institution Name:</label>
                                            <input type="text" value="{{old('banker_name')}}" name="banker_name[]" class="form-control" placeholder="Access Bank Plc">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="banker_address">Address:</label>
                                            <input type="text" value="{{old('banker_address')}}" name="banker_address[]" class="form-control" placeholder="Kuje, Abuja">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="banker_contact_person">Contact Person:</label>
                                            <input type="text" value="{{old('banker_contact_person')}}" name="banker_contact_person[]" class="form-control" placeholder="Nigerian">
                                        </div>
                                    </div>
                                </div>
                                <small class="text-center">(The Commission may independently verify with your bankers)</small>

                                <div class="col-md-12 mb-2">
                                    <button class="btn btn-sm btn-success shareholder-clone-button">+</button>
                                    <button class="btn btn-sm btn-danger shareholder-remove-button">-</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">4.3 Sources of Funding for the proposed project:</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="source_of_funding" id="" value="Share Capital Contribution" {{session('wmc-application') ? (session('wmc-application')['source_of_funding'] == 'Share Capital Contribution'? 'checked' : '') : ''}}>
                                        Share Capital Contribution:<input type="text" class="form-control" placeholder="Specify Foreign or Local" name="source_of_funding_share_capital" value="{{session('wmc-application')['source_of_funding_share_capital'] ?? ''}}">
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="source_of_funding" id="" value="Loan Capital" {{session('wmc-application') ? (session('wmc-application')['source_of_funding'] == 'Loan Capital'? 'checked' : '') : ''}}>
                                        Loan Capital:<input type="text" class="form-control" placeholder="Specify and provide evidence" name="source_of_funding_loan_capital" value="{{session('wmc-application')['source_of_funding_loan_capital'] ?? ''}}">
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="source_of_funding" id="" value="Others" {{session('wmc-application') ? (session('wmc-application')['source_of_funding'] == 'Others'? 'checked' : '') : ''}}>
                                        Others: <input type="text" class="form-control" placeholder="Specify" name="source_of_funding_others" value="{{session('wmc-application')['source_of_funding_others'] ?? ''}}">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="main_business_activity_of_applicant">Main Business Activity:</label>
                                    <input type="text" name="main_business_activity_of_applicant" class="form-control" placeholder="Electricity Generation" value="{{old('main_business_activity_of_applicant')}}{{session('wmc-application')['main_business_activity_of_applicant'] ?? ''}}" required>
                                </div>
                            </div>
                            <h3 class="mt-3">5. TECHNICAL CAPACITY AND MANAGEMENT EXPERIENCE</h3>
                            <small>
                                Please provide detailed statement of Applicant's technical capacity and management
                                competence and experience to undertake the proposed project. (Use additional sheet if
                                necessary)
                            </small>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="technical_capacity_of_applicant">Technical Capacity</label>
                                    <textarea name="technical_capacity_of_applicant" class="form-control" cols="30" rows="10">{{session('wmc-application')['technical_capacity_of_applicant'] ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="managerial_competence_of_applicant">Managerial Competence</label>
                                    <textarea name="managerial_competence_of_applicant" class="form-control" cols="30" rows="10">{{session('wmc-application')['managerial_competence_of_applicant'] ?? ''}}</textarea>
                                </div>
                            </div>
                            <p class="text-start mb-2 mt-0">5.2 Describe the technical and industrial supportfrom domestic and foriegn sources:</p>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="technical_support_from_foreign_sources">Foriegn</label>
                                    <textarea name="technical_support_from_foreign_sources" class="form-control" cols="30" rows="10">{{session('wmc-application')['technical_support_from_foreign_sources'] ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="technical_support_from_domestic_sources">Domestic</label>
                                    <textarea name="technical_support_from_domestic_sources" class="form-control" cols="30" rows="10">{{session('wmc-application')['technical_support_from_domestic_sources'] ?? ''}}</textarea>
                                </div>
                            </div>
                            <h3 class="mt-3">6. TECHNICAL CAPACITY AND MANAGEMENT EXPERIENCE</h3>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description_of_proposed_project">6.1. Please provide a detailed description of the project: <small>(Please Attach feasibility study)</small></label>
                                    <textarea name="description_of_proposed_project" class="form-control" cols="30" rows="10">{{session('wmc-application')['description_of_proposed_project'] ?? ''}}</textarea>
                                </div
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="initial_capacity_of_project">6.2. State Initial capacity of the proposed project: (Amount of power to be initially generated, transmitted, distributed or supplied/amount of crops to be produced / amount of aquaculture to be harvested as applicable)</label>
                                    <input type="text" name="initial_capacity_of_project" class="form-control" placeholder="Electricity Generation" value="{{old('initial_capacity_of_project')}}{{session('wmc-application')['initial_capacity_of_project'] ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proposed_future_capacity_of_project">6.3. Proposed Future Capacity:</label>
                                    <input type="text" name="proposed_future_capacity_of_project" class="form-control" placeholder="Electricity Generation" value="{{old('proposed_future_capacity_of_project')}}{{session('wmc-application')['proposed_future_capacity_of_project'] ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="implementation_schedule_of_project">6.4. Implementation Schedule of Project</label>
                                    <input type="text" name="implementation_schedule_of_project" class="form-control" placeholder="Electricity Generation" value="{{old('implementation_schedule_of_project')}}{{session('wmc-application')['implementation_schedule_of_project'] ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="is_there_access_to_public_private_land">6.5. State if there is need to access public or private land:</label>
                                    <input type="text" name="is_there_access_to_public_private_land" class="form-control" placeholder="Electricity Generation" value="{{old('is_there_access_to_public_private_land')}}{{session('wmc-application')['is_there_access_to_public_private_land'] ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">6.6. Does the area of business cover space occupied by the Federal Ministry of Dafence?</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="does_area_of_business_operation_cover_defense_ministry" id="" value="yes" {{session('wmc-application') ? (session('wmc-application')['does_area_of_business_operation_cover_defense_ministry'] == 'yes'? 'checked' : '') : ''}}>
                                        Yes
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="does_area_of_business_operation_cover_defense_ministry" id="" value="no" {{session('wmc-application') ? (session('wmc-application')['does_area_of_business_operation_cover_defense_ministry'] == 'no'? 'checked' : '') : ''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-start mb-2 mt-0">6.6. Does the area of business cover River Basin Development Authority Land?</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="does_area_of_business_operation_cover_river_basin_DA_land" id="" value="yes" {{session('wmc-application') ? (session('wmc-application')['does_area_of_business_operation_cover_river_basin_DA_land'] == 'yes'? 'checked' : '') : ''}}>
                                        Yes
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-checkbox" name="does_area_of_business_operation_cover_river_basin_DA_land" id="" value="no" {{session('wmc-application') ? (session('wmc-application')['does_area_of_business_operation_cover_river_basin_DA_land'] == 'no'? 'checked' : '') : ''}}>
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="environmental_impact_of_project">Environmental Impact Assessment: <small>(Attach Environmental Inpact Assessment form the Federal Government)</small></label>
                                    <textarea name="environmental_impact_of_project" class="form-control" cols="20" rows="10">{{session('wmc-application')['environmental_impact_of_project'] ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="geographic_area_license_is_required">State the geographical area(s) in which the licence is required <small>(Provide detailed 10 years Business Plan including cash flow projections, tariff methodology and calculation, investment plan, etc (Detailed Business plan should be attached))</small></label>
                                    <textarea name="geographic_area_license_is_required" class="form-control" cols="20" rows="10">{{session('wmc-application')['geographic_area_license_is_required'] ?? ''}}</textarea>
                                </div>
                            </div>
                            <h3 class="mt-3">7. DECLARATION BY THE APPLICANT</h3>
                            <small>(Notary Public Seal and Attestation Required)</small>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label" style="line-height: 1px !important;">
                                        <input type="checkbox" class="form-checkbox" name="declaration_by_applicant_that_info_is_true" id="" value="I Agree" {{session('wmc-application') ? (session('wmc-application')['declaration_by_applicant_that_info_is_true'] == 'I Agree'? 'checked' : '') : ''}} required>
                                        The project is not unlawful or contrary to the interest of the Federal Republic of Nigeria. I/We hereby declare that the details stated above are, to the best of my knowledge, true and correct. On this day Dated: {{ now()->format('jS F Y') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <input type="hidden" name="cust_id" value="{{Auth::guard('customer')->check() ? Auth::guard('customer')->user()->id : session('wmc-customer')['id']}}">
                                <input type="hidden" name="application_id" value="{{session('wmc-application')['id'] ?? ''}}">
                                <button type="submit" href="#" class="btn_1 text-center" style="background-color: #55a51c; border:none; color: #fff;">Save</button>
                            </div>
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
        $(".shareholder-clone-button").click(function () {
            // Clone the entire row
            var clonedRow = $(this).parent().prev().clone();

            clonedRow.find('input').val('');

            $(this).parent().before(clonedRow);

            $(".shareholder-remove-button").prop("disabled", false);
        });

        $(".shareholder-remove-button").click(function () {
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
