@extends('layouts.app', [$pageTitle = 'NIWRMC | Roles'])

@section('content')
<!-- Row -->
@can('create roles')
    @include('modals.add-role')
@endcan
@can('edit roles')
    @include('modals.edit-role')
@endcan
@can('delete roles')
    @include('modals.delete-role')
@endcan

<div class="main_content_iner ">
    @can('create roles')
        <div class="col-sm-12 mb-4 d-flex justify-content-end">
            <a class="btn_1 btn my-3" href="javascript:void(0);" onclick="$('#add-role').modal('show');" role="button">Create Role</a>
        </div>
    @endcan
    <div class="col-md-12">
        <div class="card shadow-sm p-3">
            <table class="table datatable_niwrmc" style="width:100%">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Role Name</th>
                        <th>Guard</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S/N</th>
                        <th>Role Name</th>
                        <th>Guard</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody style="font-size: 12px">
                    @if ($roles)
                        @foreach ($roles as $key => $role)
                            @php
                                $createdAt = $role->created_at;
                                $formattedDate = ($createdAt->isToday()) ? 'Today' : (($createdAt->isYesterday()) ? 'Yesterday' : $createdAt->format('M d'));
                                $formattedDateTime = $createdAt->format('h:i A');
                            @endphp
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->guard_name}}</td>
                                <td style="font-size: 11px;">{{$formattedDate}}, {{$formattedDateTime}}</td>
                                <td class="action-btn">
                                    <div class="btn-group btn-group-sm" role="group">
                                        @can('edit roles')
                                            <button class="btn btn-sm btn-primary" onclick="editRole({{$role->id}}, '{{$role->name}}')">
                                                <i class='ti-pencil' aria-hidden="true"></i>
                                            </button>
                                        @endcan
                                        @can('delete roles')
                                            <button class="btn btn-sm btn-danger" onclick="deleteRole({{$role->id}})">
                                                <i class='fa fa-trash'></i>
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
</div>
<!-- /Row -->
@endsection
