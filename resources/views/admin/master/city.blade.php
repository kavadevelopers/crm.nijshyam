@extends('admin.layouts.main')
@section('content')

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
        <div class="row">
            @if ($type == 'list')
                <div class="col-md-4">
                    <div class="card">
                        <form method="post" action="{{ CommonHelper::admin('master/city/save') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-header">
                                <h5>Add City</h5>
                            </div>
                            <div class="card-block">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>City Name <span class="-req">*</span></label>
                                        <input name="name" type="text" class="form-control" value="" placeholder="City Name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select State<span class="-req">*</span></label>
                                        <select class="form-control select2" name="state" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($state as $key => $value )
                                                <option value="{{ $value->id }}"> {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="col-md-4">
                    <div class="card">
                        <form method="post" action="{{ CommonHelper::admin('master/city/update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-header">
                                <h5>Edit City</h5>
                            </div>
                            <div class="card-block">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>City Name <span class="-req">*</span></label>
                                        <input name="name" type="text" class="form-control" value="{{ $item->name }}" placeholder="City Name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Select State<span class="-req">*</span></label>
                                        <select class="form-control select2" name="state" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($state as $key => $value )
                                                <option value="{{ $value->id }}" <?= $item->state_id == $value->id?'selected':'' ?>> {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <input type="hidden" name="item" value="{{ $item->id }}">
                                <button class="btn btn-success">
                                    <i class="fa fa-save"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <div class="col-md-8">
                <div class="card">
                    <div class="card-block table-responsive">
                        <table class="table table-bordered table-mini table-dt">
                            <thead>
                                <tr>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($list as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->state->name }}</td>
                                        <td>{{ $value->country->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ CommonHelper::admin('master/city/edit/'.$value->id) }}" class="btn btn-primary btn-mini" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ CommonHelper::admin('master/city/delete/'.$value->id) }}" class="btn btn-danger btn-mini btn-delete" title="Delete">
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

@stop
