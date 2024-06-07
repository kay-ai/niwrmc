@extends('layouts.app', [$pageTitle = 'NIWRMC | License Application'])

@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_box mb_30">
                        <div class="box_header ">
                            <div class="main-title">
                                <h3 class="mb-0">Apply For a License</h3>
                            </div>
                        </div>

                        <div class="accordion accordion_custom mb_50" id="accordion_ex">
                            <div class="card">
                                <div class="card-header" id="heading_discharge_of_waste">
                                    <h2 class="mb-0">
                                        <a href="#" class="btn" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#discharge_of_waste" aria-expanded="true"
                                            aria-controls="discharge_of_waste">
                                            Application for Discharge of Waste into Water Bodies
                                        </a>
                                    </h2>
                                </div>
                                <div id="discharge_of_waste" class="collapse show" aria-labelledby="heading_discharge_of_waste"
                                    data-parent="#accordion_ex">
                                    <div class="card-body">
                                        <h5>Requirements:</h5>
                                        <ol>
                                            <li>1. Business Development plan</li>
                                            <li>2. Feasibility Studies</li>
                                            <li>3. Company Profile</li>
                                        </ol>
                                        <a class="btn btn-primary mt-3" href="/discharge-of-waste-step1" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading_amendment_of_license">
                                    <h2 class="mb-0">
                                        <a href="#" class="btn collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#amendment_of_license" aria-expanded="false"
                                            aria-controls="amendment_of_license">
                                            Application for Ammendment of Licence
                                        </a>
                                    </h2>
                                </div>
                                <div id="amendment_of_license" class="collapse" aria-labelledby="heading_amendment_of_license"
                                    data-parent="#accordion_ex">
                                    <div class="card-body">
                                        <h5>Requirements:</h5>
                                        <ol>
                                            <li>1. Audited account details</li>
                                            <li>2. Previous Application</li>
                                        </ol>
                                        <a class="btn btn-primary mt-3" href="/amendment-of-license" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading_borehole_contractors_license">
                                    <h2 class="mb-0">
                                        <a href="#" class="btn collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#borehole_contractors_license" aria-expanded="false"
                                            aria-controls="borehole_contractors_license">
                                            Application for Borehole Construction Contractors Licence
                                        </a>
                                    </h2>
                                </div>
                                <div id="borehole_contractors_license" class="collapse" aria-labelledby="heading_borehole_contractors_license"
                                    data-parent="#accordion_ex">
                                    <div class="card-body">
                                        <h5>Requirements:</h5>
                                        <ol>
                                            <li>1. CV of Company Directors and Technical Officers</li>
                                        </ol>

                                        <a class="btn btn-primary mt-3" href="/borehole-contractors-license" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading_drillers_license">
                                    <h2 class="mb-0">
                                        <a href="#" class="btn collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#drillers_license" aria-expanded="false"
                                            aria-controls="drillers_license">
                                            Application of drillers Licence
                                        </a>
                                    </h2>
                                </div>
                                <div id="drillers_license" class="collapse" aria-labelledby="heading_drillers_license"
                                    data-parent="#accordion_ex">
                                    <div class="card-body">
                                        <h5>Requirements:</h5>
                                        <ol>
                                            <li>1. Passport Photograph (Max size: 2mb)</li>
                                            <li>2. Certificates of Educational Training</li>
                                            <li>3. Certificates of Professional Training</li>
                                            <li>4. Documents showing relevant drilling experience</li>
                                            <li>5. Documents showing Membership of Professional Associations</li>
                                        </ol>

                                        <a class="btn btn-primary mt-3" href="/drillers-license-step1" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
