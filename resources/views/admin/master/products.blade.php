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
                        <form method="post" action="{{ CommonHelper::admin('master/products/save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h5>Add Product</h5>
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
                                        <label>Order</label>
                                        <input name="order" type="text" class="form-control numbers" value="" placeholder="Order" maxlength="100">
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
                        <form method="post" action="{{ CommonHelper::admin('master/products/update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h5>Edit Product</h5>
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
                                        <label>Order</label>
                                        <input name="order" type="text" class="form-control numbers" value="{{ $item->order }}" placeholder="Order" maxlength="100">
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
                                    <th>Name</th>
                                    <th class="text-center">Order</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($list as $key => $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td class="text-center">
                                            {{ $value->order }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ CommonHelper::admin('master/products/edit/'.$value->id) }}" class="btn btn-primary btn-mini" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ CommonHelper::admin('master/products/delete/'.$value->id) }}" class="btn btn-danger btn-mini btn-delete" title="Delete">
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
