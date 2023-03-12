
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
              <h3>Receipts</h3><br />
              <form class="ajaxForm" role="form" action="{{ route('admin.shades.store') }}" method="POST" novalidate>
              @csrf
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" type="date" required data-validation-required-message="This field is required"  name="date" value="{{ (isset($is_update_receipt)) ? date('Y-m-d', strtotime(@$edit_receipt->date)) : date('Y-d-d') }}" required>
                    </div>
                  </div>
                  <!-- <input type="hidden" name="cash_id" value="{{ @$edit_receipt->hashid }}">
                  <input type="hidden" name="status" value="receipt"> -->

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Supervisor </label>
                      <select class="form-control select2" name="status" id="status">
                        <option value="">Select Supervisor</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Shade Name </label>
                      <input class="form-control" name="bil_no" value="{{ @$edit_receipt->bil_no }}" required>
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
                            <textarea class="form-control" name="address" id="address" cols="30" rows="4">{{ @$edit_account->address }}</textarea>
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
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-dark">Donna Snider</td>
                            <td>Customer Support</td>
                            <td>New York</td>
                            <td>27</td>
                            <td>2011/01/25</td>
                            <td>$112,000</td>
                        </tr>
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
<script>
  $('#grand_parent_id').change(function(){
    var id    = $(this).val();
    var route = "{{ route('admin.cash.get_parent_accounts', ':id') }}";
    route     = route.replace(':id', id);

   if(id != ''){
      getAjaxRequests(route, "", "GET", function(resp){
        $('#parent_id').html(resp.html);
      });
    }
  })
</script>
@endsection