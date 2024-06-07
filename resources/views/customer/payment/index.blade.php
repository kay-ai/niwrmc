@extends('layouts.app', [$pageTitle = 'NIWRMC | Customer Payments'])

@section('content')
    <div class="main_content_iner ">
        <h4>All Payments</h4>
        <div class="row justify-content-center">
            <table class="table payments_table">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Remita RRR</th>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Amount Paid</th>
                        <th scope="col">Purpose</th>
                        <th scope="col">License Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($payments)>0)
                        @foreach ($payments as $key => $payment)
                            <tr>
                                <th scope="row">
                                    {{$key + 1}}
                                </th>
                                <td>{{$payment->invoice->remita_rrr}}</td>
                                <td>{{$payment->transaction_id}}</td>
                                <td>&#8358; {{number_format($payment->amount_paid, 2)}}</td>
                                <td>{{$payment->purpose}}</td>
                                <td>{{$payment->license_type}}</td>
                                <td><a href="#" class="status_btn {{$payment->status == 'unverified' ? 'bg-warning' : 'bg-success'}}">{{$payment->status}}</a></td>
                                <td>{{($payment->created_at)->format('D, d M Y')}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="">
                                        @if (count($payment->payment_receipts) > 0)
                                            <a class="btn btn-primary" title="View Payment Receipt" href="javascript:void(0);" onclick="viewReceipt({{$payment->id}})" role="button" >
                                                <i class="ti-file"></i>
                                            </a>
                                        @else
                                            <p>. . .</p>
                                        @endif
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
@include('customer.payment.view-receipt')

@push('js')
    <script>
        $(".payments_table").DataTable({
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
