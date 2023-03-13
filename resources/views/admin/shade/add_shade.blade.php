
@extends('layouts.admin')
@section('content')

<div class="main-content">

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">  
          <div class="card-block">
            <div class="item_row">
              <div class="row">
              </div>
              <h1>Shade Details</h1><br />
              
              <br />
              <h3>Add Shade</h3><br />
              <form class="ajaxForm" role="form" action="{{ route('admin.shades.store') }}" method="POST" novalidate>
              @csrf
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" type="date" required data-validation-required-message="This field is required"  name="date" value="{{ (isset($is_update_receipt)) ? date('Y-m-d', strtotime(@$edit_receipt->date)) : date('Y-d-d') }}" required>
                    </div>
                  </div>
                  <input type="hidden" name="shade_id" value="{{ @$edit_shade->hashid }}">
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Supervisor </label>
                      <select class="form-control select2" name="staff_id" id="staff_id">
                        <option value="">Select Supervisor</option>
                        @foreach($staff as $s)
                        <option  value="{{ $s->hashid }}" @if(@$edit_shade->staff_id == $s->id) selected @endif>{{ $s->first_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Shade Name </label>
                      <input class="form-control" name="name" value="{{ @$edit_shade->name }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Status </label>
                        <select class="form-control select2" name="status" id="status">
                          <option value="active">Active</option>
                          <option value="not_active">Not Active</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                      <label for="">Address</label>
                      <textarea class="form-control" name="address" id="address" cols="30" rows="4">{{ @$edit_shade->address }}</textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <button type="submit" value="submit" name="save_shade" class="btn btn-success"> Save </button>
                    </div>
                  </div>
                </div>  
              </form>
              
              
              <br /><br />
            </div>

          </div>
        
               
             </div> 
           </div>
         </div>
        </div>
      </div>
    </div>
    <div class="box">
      <div class="box-header with-border">
        <h2 class="box-title text-dark">Filters</h2>
      </div>
      <div class="box-body">
        <!-- <form action="{{ route('admin.cash.index') }}" method="GET">
          @csrf
          <div class="row">
            <div class="col-md-4">
              <label for="">Grand Parent</label>
              <select class="form-control" name="grand_parent_id" id="grand_parent_id">
                <option value="">Select grand parent</option>
                
              </select>
            </div>
            <div class="col-md-4">
              <label for="">Accounts</label>
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">Select  Account</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="">Status</label>
              <select class="form-control" name="status" id="status">
                <option value="">Select status</option>
                <option value="payment">Payment</option>
                <option value="receipt">Reciept</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="">From</label>
              <input type="date" class="form-control" name="from_date" id="from_date">
            </div>
            <div class="col-md-4">
              <label for="">To</label>
              <input type="date" class="form-control" name="to-date" id="to-date">
            </div>
            <div class="col-md-2">
              <input type="submit" class="btn btn-primary" value="Search">
            </div>
          </div>
        </form> -->
      </div>
    </div>
    <div class="box">
				<div class="box-header with-border">
				  <h2 class="box-title text-dark">All Shade Entries</h2>
				</div>
                <div class="col-12">

            <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title"> Shade Details</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example5" class="text-fade table table-bordered" style="width:100%">
                    <thead>
                        <tr class="text-dark">
                            <th>Start date</th>
                            <th>Supervisor Name</th>
                            <th>Shade Name</th>
                            <th>Status</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($shade AS $s)
                        <tr>
                            <td class="text-dark">{{ @$s->date }}</td>
                            <td>{{ $s->staff->first_name }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->status }}</td>
                            <td>{{ $s->address }}</td>
                            <td width="120">
                                <a href="{{route('admin.shades.edit', $s->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.shades.delete', $s->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
           </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->      
        </div> 

			  </div>
</div>
@endsection

@section('page-scripts')
@include('admin.partials.datatable')

@endsection