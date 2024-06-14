@extends('layouts.app', [$pageTitle = 'NIWRMC | All Licenses'])

@section('content')
    <div class="main_content_iner ">
        <h4>All Licenses</h4>
        <div class="row justify-content-center">
            <table class="table license_table">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">License Holder</th>
                        <th scope="col">License Name</th>
                        <th scope="col">Approved By</th>
                        <th scope="col">Valid Period</th>
                        <th scope="col">Revalidated</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($licenses)>0)
                        @foreach ($licenses as $key => $license)
                            <tr>
                                <th scope="row">
                                    {{$key + 1}}
                                </th>
                                <td>{{$license->customer->first_name. ' ' . $license->customer->last_name ?? ''}}</td>
                                <td>{{$license->license_holder ?? ''}}</td>
                                <td>{{$license->name ?? ''}}</td>
                                <td>{{$license->approved_by->first_name . ' ' . $license->approved_by->last_name}}</td>
                                <td>{{$license->valid_period}}</td>
                                <td>
                                    {{$license->revalidate}}
                                </td>
                                <td>{{($license->created_at)->format('D, d M Y')}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        @can('generate license')
                                            @if (!$license->generated_at)
                                                <a class="btn btn-primary" title="Generate License" href="javascript:void(0);" onclick="generateLicense({{$license->id}})" role="button" >
                                                    <i class="ti-zip"></i>
                                                </a>
                                            @endif
                                        @endcan
                                        @can('delete license')
                                            <a class="btn btn-danger" title="Delete License" href="javascript:void(0);" onclick="deleteLicense({{$license->id}})" role="button" >
                                                <i class="ti-trash"></i>
                                            </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@can('delete license')
    @include('user.license.delete-license')
@endcan

@can('generate license')
    @include('user.license.generate-license')
@endcan

@push('js')
    <script>
        $(".license_table").DataTable({
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
