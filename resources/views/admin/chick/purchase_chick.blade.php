
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
              <h1>Flock Details</h1><br />
              
              <br />
              
              <form class="ajaxForm" role="form" action="{{ route('admin.chicks.purchase_store') }}" method="POST" novalidate>
              @csrf
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" type="date" required data-validation-required-message="This field is required"  name="date" value="{{ (isset($is_update)) ? date('Y-m-d', strtotime($edit_purchase->date)) : date('Y-m-d') }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Company(All Chicks Companies) </label>
                      <select class="form-control select2" name="company_id" id="company_id">
                        <option value="">Select Company</option>
                        @foreach($category->companies AS $company)
                          <option value="{{ $company->hashid }}" @if(@$edit_purchase->company_id == $company->id) selected @endif>{{ $company->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Item (selectd Companies Item)</label>
                      <select class="form-control select2" name="item_id" id="item_id">
                        <option value="">Select Item</option>
                        @foreach($category->items AS $item)
                          <option value="{{ $item->hashid }}" data-price="{{ $item->price }}" @if(@$edit_purchase->item_id == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Account </label>
                      <select class="form-control select2" name="account_id" id="account_id">
                        <option value="">Select Account</option>
                        @foreach($accounts AS $account)
                          <option value="{{ $account->hashid }}" @if(@$edit_purchase->account_id == $account->id) selected @endif>{{ $account->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Rate</label>
                      <input class="form-control" name="rate" id="rate" readonly value="{{ @$edit_purchase->rate }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Quantity</label>
                      <input class="form-control" name="quantity" id="quantity" value="{{ @$edit_purchase->quantity }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Net Ammount</label>
                      <input class="form-control" name="net_ammount" readonly id="net_ammount" value="{{ @$edit_purchase->net_ammount }}" required>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Status </label>
                        <select class="form-control select2" name="status" id="status">
                          <option value="available" @if(@$edit_purchase->status == 'available') selected @endif>Available</option>
                          <option value="not_available" @if(@$edit_purchase->status == 'not_available') selected @endif>Not Available</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="4">{{ @$edit_purchase->remarks }}</textarea>
                        </div>
                  </div>
                  <input type="hidden" name="purchase_chick_id" value="{{ $edit_purchase->hashid }}">
                  <input type="submit" class="btn btn-primary" value="{{ (isset($is_update)) ? 'Update' : 'Add' }}">
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
        <form action="" method="GET">
          @csrf
          <div class="row">
            
            <div class="col-md-2">
              <label for="">Accounts</label>
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">Select  Account</option>
              </select>
            </div>
            <div class="col-md-2">
              <label for="">Company</label>
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">Select  Account</option>
              </select>
            </div>
            <div class="col-md-2">
              <label for="">Item</label>
              <select class="form-control" name="parent_id" id="parent_id">
                <option value="">Select Item</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="">From</label>
              <input type="date" class="form-control" name="from_date" id="from_date">
            </div>
            <div class="col-md-3">
              <label for="">To</label>
              <input type="date" class="form-control" name="to-date" id="to-date">
            </div>
            <div class="col-md-2">
              <input type="submit" class="btn btn-primary" value="Search">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="box">
				<div class="box-header with-border">
				  <h2 class="box-title text-dark">All Purchase Chicks Entries</h2>
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
                            <th>Account Name</th>
                            <th>Company Name</th>
                            <th>Item</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Net Ammount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-dark">Donna Snider</td>
                            <td>Customer Support</td>
                            <td>Customer Support</td>
                            <td>27</td>
                            <td>27</td>
                            <td>27</td>
                            <td>Ation</td>

                        </tr>
                    </tbody>
                    @foreach($purchase_chicks AS $purchase) 
                      <tr>
                        <td>{{ $purchase->account->name }}</td>
                        <td>{{ $purchase->company->name }}</td>
                        <td>{{ $purchase->item->name }}</td>
                        <td>{{ $purchase->rate }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ $purchase->net_ammount }}</td>
                        <td>
                          <a href="{{ route('admin.chicks.purchase_edit',['id'=>$purchase->hashid]) }}" class="btn btn-primary btn-xs waves-effect waves-light"  >
                              <i class="fas fa-edit"></i>
                          </a>
                          <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.chicks.purchase_delete', ['id'=>$purchase->hashid]) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                          <i class="fa-sharp fa-solid fa-plus"></i> &nbsp Post
                          </button>
                  </td>
                      </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <th>Acount Name</th>
                            <th>Company Name</th>
                            <th>Item</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Net Ammount</th>
                            <th>Action</th>
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
  });

  $('#item_id').change(function(){
    $('#rate').val($(this).find(':selected').data('price'));
    calculate_net_amount();
  });
  //calculate net amount
  function calculate_net_amount(){
    var price = $('#item_id').find(':selected').data('price')
    var quantity = $('#quantity').val();

    if(price != '' &&  quantity != ''){//if both values are set the put net amount in input field
      $('#net_ammount').val(price*quantity);
    }
  }
</script>
@endsection