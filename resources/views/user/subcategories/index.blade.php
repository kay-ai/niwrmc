@extends('layouts.app', [$pageTitle = 'NIWRMC | Categories'])

@section('content')
    <div class="main_content_iner ">
        <h4>All License Types</h4>
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex justify-content-end my-3" >
                @can('create license-type')
                    <a class="btn btn-success" onclick="$('#create-subcategory').modal('show');" role="button">
                        <i class="ti-plus"></i> Create License Type
                    </a>
                @endcan
            </div>
            <table class="table subcategories_table">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Processing Fee</th>
                        <th scope="col">Licensing Fee</th>
                        <th scope="col">Created At</th>
                        <th scope="col" style="min-width:75px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($subcategories)>0)
                        @foreach ($subcategories as $key => $cat)
                            <tr>
                                <th scope="row">
                                    {{$key + 1}}
                                </th>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->license_category->name}}</td>
                                <td>&#8358; {{number_format($cat->processing_fee, 2)}}</td>
                                <td>&#8358; {{number_format($cat->licensing_fee, 2)}}</td>
                                <td>{{($cat->created_at)->format('D, d M Y')}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a class="btn btn-success" title="Edit License Type" href="javascript:void(0);" onclick="verifyPay({{$cat->id}})" role="button">
                                            <i class="ti-pencil"></i>
                                        </a>
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
@include('modals.create-subcategory', $categories)

@push('js')
    <script>
        $(".subcategories_table").DataTable({
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
