@extends('layouts.admin')
@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Add Account Type</h4>
                </div>
                <form action="{{ route('admin.account_types.store') }}" class="ajaxForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5 form-group">
                            <label for="">Account Type</label>
                            <select class="form-control" name="parent_id" id="" required>
                                <option value="">Select Account Type</option>
                                <option value="{{ hashids_encode('0') }}" @if(isset($is_update) &&@$edit_account->parent_id == null) selected @endif>Grand Parent</option>
                                @foreach($grand_parents AS $parent)
                                    <option value="{{ $parent->hashid }}" @if(@$edit_account->parent_id == $parent->id) selected @endif>{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="">Account Type name</label>
                            <input type="text" class="form-control" placeholder="Enter account type name" value="{{ @$edit_account->name }}" name="name" id="name" required>
                        </div>
                        <div class="col-md-2 mt-2">
                            <input type="hidden" value="{{ @$edit_account->hashid }}" name="account_type_id" id="account_type_id">
                            <input type="submit" class="btn btn-primary" value="{{ (isset($is_update)) ? 'Update' : 'Add' }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>        
    <div class="col-12">
        <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">ALL Grand Parents & Parents List</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example" class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100">
                <thead>
                    <tr class="text-dark">
                        <th>S.No</th>
                        <th>Grand Parent</th>
                        <th>Parent</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts AS $account)
                        <tr>
                            <td class="text-dark">{{ $loop->iteration }}</td>
                            <td class="text-dark">{{ @$account->grand_parent->name }}</td>
                            <td class="text-dark">{{ $account->name }}</td>
                            <td >
                                <a href="{{route('admin.account_types.edit', $account->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.account_types.delete', $account->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
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
   
</div>
@endsection

@section('page-scripts')
@include('admin.partials.datatable')
@endsection