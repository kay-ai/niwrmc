@extends('layouts.app', [$pageTitle = 'NIWRMC | Permission Assignment'])

@section('content')
<!-- Row -->
@include('modals.assign-permissions')

<div class="main_content_iner ">
    <div class="col-md-12">
        <div class="card shadow-sm p-3">
            <h5 class="text-kdis-2 subheader">Roles</h5>
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
                                <td style="min-width: 120px;">
                                    <div class="btn-group btn-group-sm" role="group">
                                        @can('assign permission')
                                            <a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="viewAssignPermission({{$role->id}}, '{{$role->name}}')" role="button">
                                                <i class="ti-plus"></i>
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
</div>
<!-- /Row -->
@endsection
