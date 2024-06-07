@extends('layouts.app', [$pageTitle = 'NIWRMC | License Pricing'])

@section('content')
    <div class="main_content_iner ">
        <h4>License Pricing</h4>
        <div class="row justify-content-end">
            <div class="col py-3">
                <a class="btn btn-primary ml-auto" title="Edit License Price" href="javascript:void(0);" onclick="$('#create-price').modal('show');" role="button">
                    <i class="ti-plus"></i> Create Price
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="table pricing_table">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">License Type</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Created At</th>
                        <th scope="col" style="min-width:75px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($pricings)>0)
                        @foreach ($pricings as $key => $pricing)
                            <tr>
                                <th scope="row">
                                    {{$key + 1}}
                                </th>
                                <td>{{ucwords(str_replace(['-', '_'], ' ', $pricing->item))}} License</td>
                                <td>{{ucwords(str_replace(['-', '_'], ' ', $pricing->category))}}</td>
                                <td>&#8358; {{number_format($pricing->price, 2)}}</td>
                                <td>{{($pricing->created_at)->format('D, d M Y')}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        <a class="btn btn-primary" title="Edit License Price" href="javascript:void(0);" onclick="editPrice({{$pricing->id}})" role="button">
                                            <i class="ti-marker-alt"></i>
                                        </a>
                                        <a class="btn btn-danger" title="Delete License Price" href="/delete-pricing/{{$pricing->id}}" role="button">
                                            <i class="ti-trash"></i>
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
@include('user.pricing.edit')
@include('user.pricing.create')

@push('js')
    <script>
        $(".pricing_table").DataTable({
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
