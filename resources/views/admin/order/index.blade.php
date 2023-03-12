@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Orders</h4>
                </div>
                <form action="{{ route('admin.orders.store') }}" class="ajaxForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Order Date</label>
                            <input type="date" class="form-control" name="date" id="date" value="{{ isset($is_update) ? date('Y-m-d', strtotime(@$edit_order->date)) : date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="">Accounts</label>
                            <select class="form-control select2" name="account_id" id="account_id" required>
                                <option value="">Select Account</option>
                                @foreach($accounts AS $account)
                                    <option value="{{ $account->hashid }}" @if(@$edit_order->account_id == $account->id) selected @endif>{{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Items</label>
                            <select class="form-control select2" name="item_id" id="item_id" required>
                                <option value="">Select Item</option>
                                @foreach($items AS $item)
                                    <option value="{{ $item->hashid }}" @if(@$edit_order->item_id == $item->id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" value="{{ @$edit_order->qunantity }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks" cols="" rows="">{{ @$edit_order->remarks }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="order_id" id="order_id" value="{{ @$edit_order->hashid }}">
                    <input type="submit" class="btn btn-primary mt-3" value="{{ isset($is_update) ? 'Update' : 'Add' }}">
                </form>
            </div>
        </div>
    </div>        
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Orders</h4>
                </div>
                <p class="sub-header">Following is the list of all the orders.</p>
					  <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                    <thead>
                        <tr>
                            <th width="20">S.No</th>
                            <th>Account</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders AS $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$order->account->name }}</td>
                                <td>{{ @$order->item->name }}</td>
                                <td>{{ $order->qunantity}}</td>
                                <td>{{ date('d-M-Y', strtotime($order->date)) }}</td>
                                <td>{{ $order->remarks }}</td>
                                <td width="120">
                                    <a href="{{route('admin.orders.edit', $order->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.orders.delete', $order->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
@include('admin.partials.datatable')
@endsection