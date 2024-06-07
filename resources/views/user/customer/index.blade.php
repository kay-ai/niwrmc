@extends('layouts.app', [$pageTitle = 'NIWRMC | Customers'])

@section('content')
    <div class="main_content_iner ">
        <h4>All Customers</h4>
        <div class="row justify-content-center">
            <table class="table customers_table">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($customers)>0)
                        @foreach ($customers as $key => $customer)
                            <tr>
                                <th scope="row">
                                    {{$key + 1}}
                                </th>
                                <td>{{$customer->first_name. ' '. $customer->last_name . ' ' . $customer->other_names}}</td>
                                <td>{{$customer->email ?? ''}}</td>
                                <td>{{$customer->phone ?? ''}}</td>
                                <td>{{($customer->created_at)->format('D, d M Y')}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(".customers_table").DataTable({
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
