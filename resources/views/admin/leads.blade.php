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
        <div class="col-md-12">
            <div class="card">
                <div class="card-block table-responsive">
                    <table class="table table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>City/State</th>
                                <th>Product</th>
                                <th>Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $value)
                                <tr>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->mobile }}</td>
                                    <td>
                                        {{ $value->city }}<br />
                                        - {{ $value->address }}
                                    </td>
                                    <td>
                                        {{ $value->product->name }}
                                    </td>
                                    <td>
                                        {{ $value->source->name }}
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
