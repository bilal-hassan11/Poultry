
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
              <h1>Add Company Details</h1><br />
              
              <br />
              
              <form class="ajaxForm" role="form" action="{{ route('admin.companys.store') }}" method="POST" novalidate>
              @csrf
                <div class="row">
                  
                   <input type="hidden" name="company_id" value="{{ @$edit_company->hashid }}">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Categories </label>
                      <select class="form-control select2" name="category" id="category">
                        <option value="">Select Category</option>
                        @foreach($categories AS $c)
                          <option value="{{ $c->hashid }}" @if(@$edit_company->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Name</label>
                      <input class="form-control" name="name" value="{{ @$edit_company->name }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Phone No</label>
                      <input class="form-control" name="phone_no" value="{{ @$edit_company->phone_no }}" required>
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
                        <textarea class="form-control" name="address" value="{{ @$edit_company->address }}"  cols="30" rows="4"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1 ">
                        <div class="form-group">
                            <button type="submit" value="Submit" name="save_company" class="btn btn-success"> Submit </button>
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
				  <h2 class="box-title text-dark">All Companies Entries</h2>
				</div>
                <div class="col-12">

            <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title"> Companies Details</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example5" class="text-fade table table-bordered" style="width:100%">
                    <thead>
                        <tr class="text-dark">
                            <th>Category</th>
                            <th>Company Name</th>
                            <th>Phone No</th>
                            <th>Status</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies AS $c)
                        <tr>
                            <td class="text-dark">{{ $c->category->name }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->phone_no }}</td>
                            <td>{{ $c->status }}</td>
                            <td>{{ $c->address }}</td>
                            <td width="120">
                                <a href="{{route('admin.companys.edit', $c->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.companys.delete', $c->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>Acount Name</th>
                            <th>Company Name</th>
                            <th>Item</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Net Ammount</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> -->
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