@extends('layouts.app', [$pageTitle = 'NIWRMC | Permission Assignment'])

@include('modals.add-permission')
@include('modals.delete-permission')
@include('modals.edit-permissions')
@section('content')
<!-- Row -->
<div class="main_content_iner ">
        @can('create permissions')
            <div class="col-sm-12 mb-4 d-flex justify-content-end">
                <a class="btn_1 btn my-3" href="javascript:void(0);" onclick="$('#add-permission').modal('show');" role="button">Create Permission</a>
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
                        @if ($permissions)
                            @foreach ($permissions as $key => $permission)
                                @php
                                    $createdAt = $permission->created_at;
                                    $formattedDate = ($createdAt->isToday()) ? 'Today' : (($createdAt->isYesterday()) ? 'Yesterday' : $createdAt->format('M d'));
                                    $formattedDateTime = $createdAt->format('h:i A');
                                @endphp
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->guard_name}}</td>
                                    <td style="font-size: 11px;">{{$formattedDate}}, {{$formattedDateTime}}</td>
                                    <td class="action-btn">
                                        <div class="btn-group btn-group-sm" role="group">
                                            @can('edit permissions')
                                                <button class="btn btn-sm btn-primary" onclick="editPermission({{$permission->id}}, '{{$permission->name}}')">
                                                    <i class='ti-pencil'></i>
                                                </button>
                                            @endcan
                                            @can('delete permissions')
                                                <button class="btn btn-sm btn-danger" onclick="deletePermission({{$permission->id}})">
                                                    <i class='ti-trash'></i>
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
</div>
<!-- /Row -->
@endsection
