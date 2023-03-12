@extends('layouts.admin')
@section('content')

<div class="box">
    <div class="box-header with-border">
      <h2 class="box-title text-dark">Filters</h2>
    </div>
    <div class="box-body">
      <form action="{{ route('admin.items.index') }}" method="GET">
        @csrf
        <div class="row">
          <div class="col-md-4">
            <label for="">Item type</label>
            <select class="form-control" name="item_type" id="item_type">
                <option value="">Select item type</option>
                <option value="purchase">Purchase</option>
                <option value="sale">Sale</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="">status</label>
            <select class="form-control" name="status" id="status">
                <option value="">Select status</option>
                <option value="1">active</option>
                <option value="0">deactive</option>
            </select>
          </div>
          <div class="col-md-2">
            <input type="submit" class="btn btn-primary" value="Search">
          </div>
        </div>
      </form>
    </div>
  </div>
<div class="col-12">
        <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">All Items Detail</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                    <tr class="text-dark">
                        <th >S.No</th>
                        <th>Category</th>
                        <th>Item <br />Name</th>
                        <th>Available <br />Stock</th>
                        <th>Rate</th>
                        <th>Item <br /> Type</th>
                        <th>Stock <br /> Status</th>
                        <th>Item <br />Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items AS $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->stock_qty }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->type }}</td>
                            <td>
                                @if($item->stock_status == 1)
                                    Enabled
                                @else
                                    Disabled
                                @endif
                            </td>
                            <td>
                                @if($item->status == 1)
                                    Active
                                @else
                                    Deactive
                                @endif
                            </td>
                            <td>{!! wordwrap($item->remarks, 10, "<br />\n", true) !!}</td>
                            <td width="120">
                                <a href="{{route('admin.items.edit', $item->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.items.delete', $item->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>              
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->          
    </div>
@endsection

@section('page-scripts')
@include('admin.partials.datatable')
@endsection