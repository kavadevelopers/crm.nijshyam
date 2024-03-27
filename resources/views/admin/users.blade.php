@extends('admin.layouts.main')


@section('content')

@if ($type == 'edit')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{ $_title }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                
            </div>
        </div>
    </div>
    <div class="page-body">
        <form method="post" action="{{ CommonHelper::admin('users/edit') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name <span class="-req">*</span></label>
                                <input name="name" type="text" class="form-control" value="{{ old("name",$item->name) }}" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Username <span class="-req">*</span></label>
                                <input name="username" type="text" class="form-control" value="{{ old("username",$item->username) }}" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="text" class="form-control" value="{{ old("password") }}" placeholder="Password">
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-footer text-right">
                    <a href="{{ CommonHelper::admin('users') }}" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <input type="hidden" name="id" value="{{ $item->id }}"/>
                </div>
            </div>
        </form>
    </div>
@endif

@if ($type == 'create')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{ $_title }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                
            </div>
        </div>
    </div>
    <div class="page-body">
        <form method="post" action="{{ CommonHelper::admin('users/create') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name <span class="-req">*</span></label>
                                <input name="name" type="text" class="form-control" value="{{ old("name") }}" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Username <span class="-req">*</span></label>
                                <input name="username" type="text" class="form-control" value="{{ old("username") }}" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Password <span class="-req">*</span></label>
                                <input name="password" type="text" class="form-control" value="{{ old("password") }}" placeholder="Password" required>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-footer text-right">
                    <a href="{{ CommonHelper::admin('users') }}" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif

@if ($type == 'list')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{ $_title }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ CommonHelper::admin('users/create') }}" class="btn btn-primary btn-mini">
                    <i class="fa fa-plus"></i> Create
                </a>  
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block table-responsive">
                        <table class="table table-bordered table-mini table-dt">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->username }}</td>
                                        <td class="text-center">
                                            <small>{{ DateTimeHelper::vcat($value->created_at)  }}</small>
                                        </td>
                                        <td class="text-center">
                                            @if (!$value->is_blocked)
                                                <a href="{{ CommonHelper::admin('users/status/'.$value->id.'/1') }}" class="btm btn-mini btn-success btn-status">Active</a>
                                            @else
                                                <a href="{{ CommonHelper::admin('users/status/'.$value->id.'/0') }}" class="btm btn-mini btn-danger btn-status">Blocked</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ CommonHelper::admin('users/edit/'.$value->id) }}" class="btn btn-primary btn-mini" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ CommonHelper::admin('users/delete/'.$value->id) }}" class="btn btn-danger btn-mini btn-delete" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>

        </div>
    </div>
@endif
@stop