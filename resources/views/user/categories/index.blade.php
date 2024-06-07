@extends('layouts.app', [$pageTitle = 'NIWRMC | Categories'])

@section('content')
    <div class="main_content_iner ">
        <h4>All Categories</h4>
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex justify-content-end my-3" >
                <a class="btn btn-success" onclick="$('#create-category').modal('show');" role="button">
                    <i class="ti-plus"></i> Create Category
                </a>
            </div>
            <table class="table categories_table">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col" style="min-width:75px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($categories)>0)
                        @foreach ($categories as $key => $cat)
                            <tr>
                                <th scope="row">
                                    {{$key + 1}}
                                </th>
                                <td>{{$cat->name}}</td>
                                <td>{{($cat->created_at)->format('D, d M Y')}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a class="btn btn-success" title="Edit Category" href="javascript:void(0);" onclick="verifyPay({{$cat->id}})" role="button">
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
@include('modals.create-category')

@push('js')
    <script>
        $(".categories_table").DataTable({
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
