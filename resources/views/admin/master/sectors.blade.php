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
                        <form method="post" action="{{ CommonHelper::admin('master/sectors/save') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-header">
                                <h5>Add Sector</h5>
                            </div>
                            <div class="card-block">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name <span class="-req">*</span></label>
                                        <input name="name" type="text" class="form-control" value="" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Icon <span class="-req">*</span><small>(size must be 512*512 or 1024*1024 )</small></label>
                                        <input type="file" name="logo" class="form-control" onchange="fileExAllowedWithSize(this,'.jpg,.png,.jpeg,.JPG,.JPEG,.PNG',10)" required>
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
                        <form method="post" action="{{ CommonHelper::admin('master/sectors/update') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-header">
                                <h5>Edit Sector</h5>
                            </div>
                            <div class="card-block">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name <span class="-req">*</span></label>
                                        <input name="name" type="text" class="form-control" value="{{ $item->name }}" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Icon</label>
                                        <input type="file" name="logo" class="form-control" onchange="fileExAllowedWithSize(this,'.jpg,.png,.jpeg,.JPG,.JPEG,.PNG',10)">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <img src="{{ CommonHelper::getSectorIcon($item->logo_path) }}" class="list-image-thumbnail">
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
                                    <th class="text-center">Icon</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($list as $key => $value)

                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ CommonHelper::getSectorIcon($value->logo_path) }}" class="list-image-thumbnail">
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ CommonHelper::admin('master/sectors/edit/'.$value->id) }}" class="btn btn-primary btn-mini" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ CommonHelper::admin('master/sectors/delete/'.$value->id) }}" class="btn btn-danger btn-mini btn-delete" title="Delete">
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
