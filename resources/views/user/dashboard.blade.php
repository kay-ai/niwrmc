@extends('layouts.app', [$pageTitle = 'NIWRMC | Dashboard'])
@push('css')
    <style>
        .single_element .single_quick_activity h3{
            font-size:20px !important;
        }
    </style>
@endpush
@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid plr_30 body_white_bg pt_30 shadow-sm">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="single_element">
                        <div class="quick_activity">
                            <div class="row">
                                <div class="col-12">
                                    <div class="quick_activity_wrap">
                                        <div class="single_quick_activity">
                                            <h4>Processing Fees</h4>
                                            {{-- {{dd($processing_fees)}} --}}
                                            <h3>&#8358; <span class="counter">{{number_format(array_sum($process_amount),2)}}</span> </h3>
                                            {{-- <p>Saved 25%</p> --}}
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Licensing Fees</h4>
                                            <h3>&#8358; <span class="counter">{{number_format(array_sum($license_amount),2)}}</span> </h3>
                                            {{-- <p>Saved 25%</p> --}}
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Licenses Issued</h4>
                                            <h3><span class="counter">{{count($licenses)}}</span> </h3>
                                            {{-- <p>Saved 25%</p> --}}
                                        </div>
                                        <div class="single_quick_activity">
                                            <h4>Revalidation</h4>
                                            <h3><span class="counter">{{count($revalidate)}}</span> </h3>
                                            {{-- <p>Saved 65%</p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid plr_30 body_white_bg pt_30 mt-5 shadow-sm">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-4">
                    <h4>License Applications</h4>
                    <table class="table licenses_table">
                        <thead>
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">Applicant Name</th>
                                <th scope="col">License Type</th>
                                <th scope="col">Stage</th>
                                <th scope="col">Date Applied</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($applications)>0)
                                @foreach ($applications as $key => $application)
                                {{-- {{dd($application->application_slug)}} --}}
                                    <tr>
                                        <th scope="row">
                                            {{$key + 1}}
                                        </th>
                                        <td>{{$application->business_name}}</td>
                                        <td>{{$application->license_sub_category->name}}</td>
                                        <td>
                                            @switch($application->stage)
                                                @case('step1')
                                                    <a href="#" class="status_btn bg-warning">Created Application</a>
                                                    @break
                                                @case('step2')
                                                    <a href="#" class="status_btn bg-warning">Documents Uploaded</a>
                                                    @break
                                                @case('step3')
                                                    <a href="#" class="status_btn bg-secondary">Generated Invoice</a>
                                                    @break
                                                @case('step4')
                                                    <a href="#" class="status_btn bg-info">Paid Process Fee</a>
                                                    @break
                                                @case('step5')
                                                    <a href="#" class="status_btn bg-default">Paid License Fee</a>
                                                    @break
                                                @case('step6')
                                                    <a href="#" class="status_btn bg-primary">License Approved</a>
                                                    @break
                                                @case('step7')
                                                    <a href="#" class="status_btn bg-success">License Generated</a>
                                                    @break
                                                @default
                                            @endswitch
                                        </td>
                                        <td>{{($application->created_at)->format('D, d M Y')}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="">
                                                <button type="button" title="View Documents" class="btn btn-secondary" onclick="viewDocuments({{$application->id}}, '{{$application->application_slug}}')"><i class="ti-file"></i></button>
                                            </div>
                                            @if ($application->stage == 'step5')
                                                <div class="btn-group btn-group-sm" role="group" aria-label="">
                                                    <button type="button" title="Approve License" class="btn btn-primary" onclick="approveLicense({{$application->id}}, '{{$application->application_slug}}')">
                                                        <i class="ti-check"></i>
                                                    </button>
                                                    <button type="button" title="Decline License" class="btn btn-danger"><i class="ti-close"></i></button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('modals.view-document')
@include('user.license.approve-license')

@push('js')
    <script>
        $(".licenses_table").DataTable({
      bLengthChange: false,
      bDestroy: true,
      dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      language: {
        search: "Search:",
        searchPlaceholder: "Quick Search",
        paginate: {
          next: "<i class='ti-arrow-right'></i>",
          previous: "<i class='ti-arrow-left'></i>",
        },
      },
      columnDefs: [{ visible: true }],
      responsive: true,
      searching: true,
    });
    </script>
@endpush
