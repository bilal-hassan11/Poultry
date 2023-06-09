
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
              <h1>Purchase Feed Details</h1><br />
              
              <br />
              
              <form class="ajaxForm" role="form" action="{{ route('admin.feeds.sale_store') }}" method="POST" novalidate>
                @csrf
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Date</label>
                        <input class="form-control" type="date" required data-validation-required-message="This field is required"  name="date" value="{{ (isset($is_update)) ? date('Y-m-d', strtotime($edit_feed->date)) : date('Y-m-d') }}" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Company(All Chicks Companies) </label>
                        <select class="form-control select2" name="company_id" id="company_id">
                          <option value="">Select Company</option>
                          @foreach($category->companies AS $company)
                            <option value="{{ $company->hashid }}" @if(@$edit_feed->company_id == $company->id) selected @endif>{{ $company->name }}</option>
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
                            <option value="{{ $item->hashid }}" data-price="{{ $item->price }}" @if(@$edit_feed->item_id == $item->id) selected @endif>{{ $item->name }}</option>
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
                            <option value="{{ $account->hashid }}" @if(@$edit_feed->account_id == $account->id) selected @endif>{{ $account->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Rate</label>
                        <input class="form-control" name="rate" id="rate" readonly value="{{ @$edit_feed->rate }}" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Quantity</label>
                        <input class="form-control" name="quantity" id="quantity" value="{{ @$edit_feed->quantity }}" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Net Ammount</label>
                        <input class="form-control" name="net_ammount" readonly id="net_ammount" value="{{ @$edit_feed->net_ammount }}" required>
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Status </label>
                          <select class="form-control select2" name="status" id="status">
                            <option value="available" @if(@$edit_feed->status == 'available') selected @endif>Available</option>
                            <option value="not_available" @if(@$edit_feed->status == 'not_available') selected @endif>Not Available</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                          <div class="col-md-12 form-group">
                              <label for="">Remarks</label>
                              <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="4">{{ @$edit_sale->remarks }}</textarea>
                          </div>
                    </div>
                    <input type="hidden" name="sale_feed_id" value="{{ @$edit_feed->hashid }}">
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
      <form class="ajaxForm" role="form" action="{{ route('admin.flocks.store') }}" method="POST" novalidate>
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
                      <label>Company(All Chicks Companies) </label>
                      <select class="form-control select2" name="shade" id="shade">
                        <option value="">Select Company</option>
                        
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Item (selectd Companies Item)</label>
                      <select class="form-control select2" name="shade" id="shade">
                        <option value="">Select Item</option>
                        
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Account </label>
                      <select class="form-control select2" name="shade" id="shade">
                        <option value="">Select Account</option>
                        
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Rate</label>
                      <input class="form-control" name="rate" value="{{ @$edit_receipt->name }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Quantity</label>
                      <input class="form-control" name="quantity" value="{{ @$edit_receipt->name }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Purchase Ammount</label>
                      <input class="form-control" name="purchase_ammount" value="{{ @$edit_receipt->purchase_ammount }}" required>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Status </label>
                        <select class="form-control select2" name="status" id="status">
                          <option value="available">Available</option>
                          <option value="not_available">Not Available</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Commission</label>
                      <input class="form-control" name="commission" value="{{ @$edit_receipt->commission }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Discount</label>
                      <input class="form-control" name="discount" value="{{ @$edit_receipt->discount }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Other Charges</label>
                      <input class="form-control" name="other_charges" value="{{ @$edit_receipt->other_charges }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Net Ammount</label>
                      <input class="form-control" name="net_ammount" value="{{ @$edit_receipt->net_ammount }}" required>
                    </div>
                  </div>
                  
                  
                </div>
                <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="4">{{ @$edit_account->address }}</textarea>
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
                      @foreach($sale_feed AS $sale) 
                      <tr>
                        <td>{{ $sale->account->name }}</td>
                        <td>{{ $sale->company->name }}</td>
                        <td>{{ $sale->item->name }}</td>
                        <td>{{ $sale->rate }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ $sale->net_ammount }}</td>
                        <td>
                          <a href="{{ route('admin.feeds.sale_edit',['id'=>$sale->hashid]) }}" class="btn btn-primary btn-xs waves-effect waves-light"  >
                              <i class="fas fa-edit"></i>
                          </a>
                          <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.feeds.sale_delete', ['id'=>$sale->hashid]) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                          <i class="fa-sharp fa-solid fa-plus"></i> &nbsp Post
                          </button>
                        </td>
                      </tr>
                  @endforeach
                    </tbody>
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
  })
</script>
@endsection