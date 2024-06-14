@extends('layouts.app', [$pageTitle = 'NIWRMC | Customer Invoices'])

@section('content')
    <div class="main_content_iner ">
        <h4>All Invoices</h4>
        <div class="row justify-content-center">
            <table class="table invoices_table">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Remite RRR</th>
                        <th scope="col">Item</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($invoices)>0)
                        @foreach ($invoices as $key => $invoice)
                            <tr>
                                <th scope="row">
                                    {{$key + 1}}
                                </th>
                                <td>{{$invoice->remita_rrr}}</td>
                                <td>{{$invoice->item}}</td>
                                <td>{{$invoice->customer->first_name. ' ' . $invoice->customer->last_name}}</td>
                                <td>{{$invoice->category}}</td>
                                <td>{{$invoice->desc ?? '. . .'}}</td>
                                <td>{{$invoice->currency}} {{number_format($invoice->amount,2)}}</td>
                                <td><a href="#" class="status_btn bg-warning">{{$invoice->status}}</a></td>
                                <td>{{($invoice->created_at)->format('D, d M Y')}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        @can('view invoice')
                                            <button type="button" title="View Invoice" onclick="viewInvoice({{$invoice->customer_id}}, '{{$invoice->category}}')" class="btn btn-primary">
                                                <i class="ti-eye"></i>
                                            </button>
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

@can('view invoice')
    @include('customer.invoice.view')
@endcan

@push('js')
    <script>
        $(".invoices_table").DataTable({
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
