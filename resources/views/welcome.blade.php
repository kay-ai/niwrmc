@extends('layouts.guest')

@push('css')
    <style>
        p{
            color: #666d8d;
            font-weight: 400;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="title-div">
                        <h4 class="text-center mb-0" style="color: #5a5a5a">Read all requirements below:
                            <a class="btn btn-primary btn-sm" href="{{route('apply.index')}}" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>Basic Document Requirements for all License types:</h4>
                    <ol>
                        <li>1. Certificate of Incorporation</li>
                        <li>2. NSITF/ITF</li>
                        <li>3. Form CA7 of CAC</li>
                        <li>4. EIA Certification</li>
                        <li>5. Tax Clearance</li>
                        <li>6. PENCOM Certification</li>
                        <li>7. Passport Photograph (Max size: 2mb)</li>
                    </ol>
                    <a class="btn btn-primary mt-3" href="{{route('apply.index')}}" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-2">License Types</h4>
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="name-header d-flex justify-content-between" style="cursor: pointer; " data-open="#discharge-of-waste-into-water-bodies">
                                        <p>Application for Discharge of Waste into Water Bodies</p>
                                        <i class="ti-angle-down" style="padding-top: 7px; transition: all 0.8s"></i>
                                    </div>
                                    <div class="license-requirements" id="discharge-of-waste-into-water-bodies" style="display:none;">
                                        <hr>
                                        <h5>Requirements:</h5>
                                        <ol>
                                            <li>1. Business Development plan</li>
                                            <li>2. Feasibility Studies</li>
                                            <li>3. Company Profile</li>
                                        </ol>
                                        <a class="btn btn-primary mt-3" href="/discharge-of-waste" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="name-header d-flex justify-content-between" style="cursor: pointer; " data-open="#ammendment-of-licence">
                                        <p>Application for Ammendment of Licence</p>
                                        <i class="ti-angle-down" style="padding-top: 7px; transition: all 0.8s"></i>
                                    </div>
                                    <div class="license-requirements" id="ammendment-of-licence" style="display:none;">
                                        <hr>
                                        <h5>Requirements:</h5>
                                        <ol>
                                            <li>1. Audited account details</li>
                                            <li>2. Previous Application</li>
                                        </ol>
                                        <a class="btn btn-primary mt-3" href="/amendment-of-license" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="name-header d-flex justify-content-between" style="cursor: pointer; " data-open="#construction-contractors-licence">
                                        <p>Application for Borehole Construction Contractors Licence</p>
                                        <i class="ti-angle-down" style="padding-top: 7px; transition: all 0.8s"></i>
                                    </div>
                                    <div class="license-requirements" id="construction-contractors-licence" style="display:none;">
                                        <hr>
                                        <h5>Requirements:</h5>
                                        <ol>
                                            <li>1. CV of Company Directors and Technical Officers</li>
                                        </ol>

                                        <a class="btn btn-primary mt-3" href="/borehole-contractors-license" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="name-header d-flex justify-content-between" style="cursor: pointer; " data-open="#drillers-licence">
                                        <p>Application of drillers Licence</p>
                                        <i class="ti-angle-down" style="padding-top: 7px; transition: all 0.8s"></i>
                                    </div>
                                    <div class="license-requirements" id="drillers-licence" style="display:none;">
                                        <hr>
                                        <h5>Requirements:</h5>
                                        <ol>
                                            <li>1. Passport Photograph (Max size: 2mb)</li>
                                            <li>2. Certificates of Educational Training</li>
                                            <li>3. Certificates of Professional Training</li>
                                            <li>4. Documents showing relevant drilling experience</li>
                                            <li>5. Documents showing Membership of Professional Associations</li>
                                        </ol>

                                        <a class="btn btn-primary mt-3" href="/drillers-license" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="name-header d-flex justify-content-between" style="cursor: pointer; " data-open="#construction-and-operation-of-dam">
                                        <p>Water licence or permit - Construction and Operation of Dam</p>
                                        <i class="ti-angle-down" style="padding-top: 7px; transition: all 0.8s"></i>
                                    </div>
                                    <div class="license-requirements" id="construction-and-operation-of-dam" style="display:none;">
                                        <hr>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa numquam, saepe nihil tenetur doloremque nisi inventore deleniti voluptatem velit vitae fuga exercitationem! Voluptate libero vel repellendus sint molestias fugit quod!</p>

                                        <a name="" id="" class="btn btn-primary mt-3" href="#" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="name-header d-flex justify-content-between" style="cursor: pointer; " data-open="#ground-water">
                                        <p>Water licence or permit - Ground Water</p>
                                        <i class="ti-angle-down" style="padding-top: 7px; transition: all 0.8s"></i>
                                    </div>
                                    <div class="license-requirements" id="ground-water" style="display:none;">
                                        <hr>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa numquam, saepe nihil tenetur doloremque nisi inventore deleniti voluptatem velit vitae fuga exercitationem! Voluptate libero vel repellendus sint molestias fugit quod!</p>

                                        <a name="" id="" class="btn btn-primary mt-3" href="#" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="name-header d-flex justify-content-between" style="cursor: pointer; " data-open="#surface-water">
                                        <p>Water licence or permit - Surface Water</p>
                                        <i class="ti-angle-down" style="padding-top: 7px; transition: all 0.8s"></i>
                                    </div>
                                    <div class="license-requirements" id="surface-water" style="display:none;">
                                        <hr>
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa numquam, saepe nihil tenetur doloremque nisi inventore deleniti voluptatem velit vitae fuga exercitationem! Voluptate libero vel repellendus sint molestias fugit quod!
                                        </p>

                                        <a name="" id="" class="btn btn-primary mt-3" href="#" role="button" style="background-color: #55a51c; border:none;">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('.name-header').click(function(){
                var target = $(this).attr('data-open');
                $(this).find('i').toggleClass('rotate-180');
                $(target).toggle('slide');
            })
        })
    </script>
@endpush
