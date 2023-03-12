@extends('layouts.admin')
@section('content')
@isset($is_update)
  @php 
        $purchase_amount = $edit_purchase->item->price * $edit_purchase->company_weight ;
        
        $purchase_amount = $edit_purchase->item->price * $edit_purchase->	company_weight;
        $get_commission = ($edit_purchase->account->commission /100) *  $purchase_amount ;
        $get_discount = $edit_purchase->account->discount * $edit_purchase->no_of_bags;
        $get_net_discount = $get_commission +  $get_discount ;
        //dd($get_net_discount);

        //$commission      = $purchase_amount * $edit_purchase->account->commission;
        //$discount        = $edit_purchase->no_of_bags * $edit_purchase->account->discount;
        $purchase_amount -= $edit_purchase->fare;
        $purchase_amount -= $get_net_discount;

  @endphp
@endisset
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
              <h5>Add Purchase Details</h5>
              <form class="ajaxForm" role="form" action="{{ route('admin.purchases.store') }}" method="POST">
                @csrf
                <div  class="row" >
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" type="date" name="purchase_date" value="{{ (isset($is_update)) ? date('Y-m-d', strtotime($edit_purchase->date)) : date('Y-d-d') }}"
                      required>
                    </div>
                  </div>
                  <div class="col-md-3">
                        <div class="form-group">
                            <label>Vehical No</label>
                            <input class="form-control" name="vehicle_no" type="text" id="remarks"  value="{{ @$edit_purchase->vehicle_no }}"
                            >
                        </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Bilty No</label>
                      <input class="form-control" type="number" name="bilty_no" value="{{ @$edit_purchase->bilty_no }}"
                       >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>P.Invoice No</label>
                      <input class="form-control" type="text" name="prod_inv_no" value="{{ @$edit_purchase->pro_inv_no }}"
                       >
                    </div>
                  </div>
                </div>
                <div class="row">
                  
                  <div class="col-md-3">
                    <div class="form-group ">
                      <label>Account Name </label>                        
                      <select class="form-control select2" id="payment_account" type="text" name="account_id"   >
                      <option value="">Select account </option>
                      @foreach($accounts AS $account)
                        <option value="{{ $account->hashid }}" @if(@$edit_purchase->account_id == $account->id) selected @endif>{{ $account->name }}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Item Name</label>
                      <select class="form-control select2"  type="text" name="item_id"   required>                          <option value="">Select item</option>
                        @foreach($items AS $item)
                          <option value="{{ $item->hashid }}"  @if(@$edit_purchase->item_id == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label>Company Weight  </label>
                          <input class="form-control" type="number" name="company_weight" id="company_weight" value="{{ @$edit_purchase->company_weight }}" required>
                      </div>
                    </div>    
                    <div class="col-md-3">
                      <div class="form-group">
                          <label>party Weight  </label>
                          <input class="form-control" type="number" name="party_weight" id="party_weight" value="{{ @$edit_purchase->party_weight }}" required>
                      </div>
                    </div>
                </div>
                
                <div class="row" >
                  <div class="col-md-3">
                      <div class="form-group">
                          <label> Weight  Difference </label>
                          <input class="form-control" readonly type="number"  name="weight_difference" id="weight_difference" value="{{ @$edit_purchase->weight_difference }}" required>
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>posted weight </label>
                        <input class="form-control" type="number" name="posted_weight" id="posted_weeight" value="{{ @$edit_purchase->posted_weight }}" >
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Rate</label>
                      <input class="form-control" name="rate" type="number" id="rate"  value="{{ @$edit_purchase->item->price }}"
                      required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gross Amount</label>
                      <input class="form-control" type="number" name="gross_ammount" id="gross_ammount" value="{{ @$purchase_amount }}"
                      required>
                    </div>
                  </div> 
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Fare </label>
                        <input class="form-control" type="number" name="fare" id="fare" value="{{ @$edit_purchase->fare }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Other Charges  </label>
                        <input class="form-control" type="number" name="others_charges" id="others_charges" value="{{ @$edit_purchase->other_charges }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Net Amount  </label>
                        <input class="form-control" type="number" name="net_ammount" id="net_ammount" value="{{ @$purchase_amount }}" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-11">
                    <div class="form-group">
                        <label>Remarks </label>
                        <input class="form-control" type="text" name="remarks" id="remarks" value="{{ @$edit_purchase->remarks }}" required>
                    </div>
                  </div>  
                </div>
                <div class="row" >
                    
                    
                    <div class="col-md-2 mt-4 mr-8">
                        <div class="form-group">
                          <input type="hidden" name="purchase_id" value="{{ @$edit_purchase->hashid }}">
                            <button type="submit" name="save_purchase" class="btn btn-success "><i class="fa fa-check"></i> save</button>
                        </div>
                        
                    </div>
                </div>
                
              </form>  
               
              <br /><br />         

</div>


<div class="box">
  <div class="box-header with-border">
    <h2 class="box-title text-dark">Filters</h2>
  </div>
  <div class="box-body">
    <form action="{{ route('admin.purchases.index') }}" method="GET">
      @csrf
      <div class="row">
        <div class="col-md-4">
          <label for="">Grand Parent</label>
          <select class="form-control" name="grand_parent_id" id="grand_parent_id">
            <option value="">Select grand parent</option>
            @foreach($account_types AS $type)
              @foreach($type->childs AS $child)
                <option value="{{ $child->hashid }}">{{ $type->name }}--{{ $child->name }}</option>
              @endforeach
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label for="">Parent Account</label>
          <select class="form-control" name="parent_id" id="parent_id">
            <option value="">Select  Account</option>
          </select>
        </div>
        <div class="col-md-4">
          <label for="">Items</label>
          <select class="form-control" name="item_id" id="item_id">
            <option value="">Select item</option>
            @foreach($items AS $item)
              <option value="{{ $item->hashid }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label for="">Vehicle No</label>
          <input type="date" class="form-control" name="vehicle_no" id="vehicle_no">
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
    </form>
  </div>
</div>



<div class="box">
				<div class="box-header with-border">
				  <h2 class="box-title text-dark">All Purchase Entries</h2>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
          <table  class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100" id="example">
      <thead>
          <tr style="border-color:black;">
            <th>Id.No</th>
            <th>Date</th>
            <th> Account Name </th>
            <th> Item Name </th>
            <th> Vehicle No </th>
            <th> No Of Begs </th>
            <th> Fare </th>
            <th> Bilty No </th>
            <th> GP no </th>
            <th>Remarks</th>
            <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach($inwards AS $inward)
          <tr style="border-color:black;">
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('d-M-Y', strtotime($inward->date)) }}</td>
            <td>{{ $inward->account->name }}</td>
            <td>{{ $inward->item->name }}</td>
            <td>{{ $inward->vehicle_no }}</td>
            <td>{{ $inward->no_of_begs }}</td>
            <td>{{ $inward->fare }}</td>
            <td>{{ $inward->bilty_no }}</td>
            <td>{{ $inward->gp_no }}</td>
            <td>{{ $inward->remarks }}</td>
            <td width="120">
                    <a href="{{route('admin.purchases.edit', $inward->hashid)}}" class="btn btn-primary btn-xs waves-effect waves-light"  >
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.purchases.migrate_to_purchase', ['id'=>$inward->hashid]) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                    <i class="fa-sharp fa-solid fa-plus"></i> &nbsp Post
                    </button>
                  </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
      </tfoot>
    </table>
					</div>              
				</div>
				<!-- /.box-body -->
			  </div>
                
             </div> 
           </div>
         </div>
      </div>
 
</div>

</div>
</div>

@endsection

@section('page-scripts')
@include('admin.partials.datatable')
<script>
  function check_weight_difference(){//calculate the weight differnce
    var company_weight = $("input[name='company_weight']").val();
    var party_weight   = $("input[name='party_weight']").val();
    var weight_difference = 0;
    if(company_weight != '' && party_weight != ''){
        weight_difference = parseInt(party_weight) - parseInt(company_weight);
        $("input[name=weight_difference]").val(weight_difference);
    }
  }
  $('#company_weight, #party_weight').bind('keyup change', function(){
    check_weight_difference();
  });

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