@extends('layouts.app', [$pageTitle = 'NIWRMC | Users'])

@section('content')
@can('assign-role')
    @include('modals.assign-role', ['roles' => $roles])
@endcan

    <div class="main_content_iner ">
        <div class="d-flex justify-content-between mb-4">
            <h4>All Users</h4>
            @can('create-user')
                <a class="btn_1 btn my-3" href="javascript:void(0);" onclick="createUser()" role="button">Create User</a>
            @endcan
        </div>
        <div class="row justify-content-center">
            <table class="table user_table">
                <thead>
                    <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users)>0)
                        @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">
                                    {{$key + 1}}
                                </th>
                                <td>{{$user->first_name. ' ' . $user->last_name ?? ''}}</td>
                                <td>{{$user->phone ?? ''}}</td>
                                <td>{{$user->email ?? ''}}</td>
                                <td>
                                    @foreach($user->getRoleNames() as $key => $val)
                                        <span>{{$val}}</span>
                                    @endforeach
                                </td>
                                <td>{{($user->created_at)->format('D, d M Y')}}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        @can('assign-role')
                                            <a class="btn btn-primary" title="Assign Role" href="javascript:void(0);" onclick="viewAssignRole({{$user->id}}, '{{$user->email}}', '{{count($user->getRoleNames())>0 ? $user->getRoleNames()[0] : ''}}')" role="button" >
                                                <i class="ti-plus"></i>
                                            </a>
                                        @endcan
                                        @can('delete-user')
                                            <a class="btn btn-danger" title="Delete user" href="javascript:void(0);" onclick="deleteuser({{$user->id}})" role="button" >
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
@can('create-user')
    @include('user.users.create-user')
@endcan
{{-- @include('user.user.generate-user') --}}

@push('js')
    <script>
        $(".user_table").DataTable({
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
