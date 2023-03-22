
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
              <h1>Sale Medicine Details</h1><br />
              
              <br />
              
              <form class="ajaxForm" action="{{ route('admin.medicines.sale_store') }}" method="POST">
              @csrf
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date</label>
                      <input class="form-control" type="date" name="date" value="{{ (isset($is_update)) ? date('Y-m-d', strtotime($edit_medicine->date)) : date('Y-m-d') }}" required>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Account </label>
                      <select class="form-control select2" name="account_id" id="account_id">
                        <option value="">Select Account</option>
                        @foreach($accounts AS $account)
                          <option value="{{ $account->hashid }}" @if(@$edit_medicine->account_id == $account->id) selected @endif data-commission="{{ $account->commission }}" data-discount="{{ $account->discount }}">{{ $account->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Rate</label>
                      <input class="form-control" name="rate" id="rate" readonly value="{{ @$edit_medicine->rate }}" required>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Purchase Ammount</label>
                      <input class="form-control" name="purchase_ammount" value="{{ @$edit_medicine->purchase_ammount }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Status </label>
                        <select class="form-control select2" name="status" id="status">
                          <option value="available" @if(@$edit_medicine->status == 'available') selected @endif>Available</option>
                          <option value="not_available" @if(@$edit_medicine->status == 'not_available') selected @endif>Not Available</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Commission</label>
                      <input class="form-control" name="commission" id="commission" readonly value="{{ @$edit_medicine->commission }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Discount</label>
                      <input class="form-control" name="discount" id="discount" readonly value="{{ @$edit_medicine->discount }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Other Charges</label>
                      <input class="form-control" name="other_charges" id="other_charges" value="{{ @$edit_medicine->other_charges }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Net Ammount</label>
                      <input class="form-control" name="net_ammount" readonly id="net_ammount" value="{{ @$edit_medicine->net_ammount }}" required>
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Company(All Chicks Companies) </label>
                      <select class="form-control select2 company_id" name="company_id[]" id="company_id">
                        <option value="">Select Company</option>
                        @foreach($category->companies AS $company)
                          <option value="{{ $company->hashid }}" @if(@$edit_medicine->company_id == $company->id) selected @endif>{{ $company->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Item (selectd Companies Item)</label>
                      <select class="form-control select2 item_id" name="item_id[]" id="item_id">
                        <option value="">Select Item</option>
                        @foreach($category->items AS $item)
                          <option value="{{ $item->hashid }}" data-price="{{ $item->price }}" @if(@$edit_medicine->item_id == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Quantity</label>
                      <input class="form-control quantity" name="quantity[]" id="quantity" value="{{ @$edit_medicine->quantity }}" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-primary mt-3" id="add_row_btn">+</button>
                  </div>
                </div>
                <div class="row append_row">
                  
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="">Remarks</label>
                      <textarea class="form-control" name="remarks" id="remarks" cols="30" rows="4">{{ @$edit_medicine->remarks }}</textarea>
                    </div>
                </div>
                <input type="hidden" name="purchase_medicine_id" value="{{ @$edit_medicine->hashid }}">
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
				  <h2 class="box-title text-dark">All Sale Medicine Entries</h2>
				</div>
                <div class="col-12">

            <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Sale Medicine Details</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example5" class="text-fade table table-bordered" style="width:100%">
                    <thead>
                        <tr class="text-dark">
                            <th>Account Name</th>
                            {{-- <th>Company Name</th>
                            <th>Item</th> --}}
                            <th>Rate</th>
                            {{-- <th>Quantity</th> --}}
                            <th>Net Ammount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($sale_medicines AS $sale) 
                        <tr class="text-dark">
                          <td>{{ $sale->account->name }}</td>
                          {{-- <td>{{ $sale->company->name }}</td>
                          <td>{{ $sale->item->name }}</td> --}}
                          <td>{{ $sale->rate }}</td>
                          {{-- <td>{{ $sale->quantity }}</td> --}}
                          <td>{{ $sale->net_ammount }}</td>
                          <td>
                            <a href="{{ route('admin.medicines.sale_edit',['id'=>$sale->hashid]) }}" >
                            <span class="waves-effect waves-light btn btn-rounded btn-primary-light"><i class="fas fa-edit"></i></span>

                            </a>
                            <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.feeds.sale_delete', ['id'=>$sale->hashid]) }}"  class="waves-effect waves-light btn btn-rounded btn-primary-light">
                            <i class="fa-sharp fa-solid fa-plus"></i> &nbsp Post
                            </button>
                          </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-dark">
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

    </div>
  
@endsection

@section('page-scripts')
@include('admin.partials.datatable')
<script>

  $('#other_charges').keyup(function(){
    var other_charges = $("#other_charges").val();
    var net_val = $("#net_ammount").val();
    var final_value = net_val - other_charges;
     $("#net_ammount").val(final_value);
    
    
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
  });

  // $('.item_id').change(function(){
  //   getItemsPrice();
  //   // alert('done');
  //   // $('#rate').val($(this).find(':selected').data('price'));
  //   // calculate_net_amount();
  // });
  $(document).on('change', '.item_id', function(){
    calculate_net_amount();
  });

  //when there is change in account then put the commissiona and discount in fields
  $('#account_id').change(function(){
    $('#commission').attr('com', ($(this).find(':selected').data('commission')));
    $('#discount').attr('dis', ($(this).find(':selected').data('discount')));
    calculate_net_amount();
  });
//when there is change in quantity calculate total amount
$(document).on('keypress', '.quantity', function(){
  calculate_net_amount();
});
$('#add_row_btn').click(function(){
  var html = '<div class="row"><div class="col-md-3">'+
                    '<div class="form-group">'+
                      '<label>Company(All Chicks Companies) </label>'+
                      '<select class="form-control select2 company_id" name="company_id[]" id="company_id">'+
                        '<option value="">Select Company</option>';
                        @foreach($category->companies AS $company)
                          html +='<option value="{{ $company->hashid }}">{{ $company->name }}</option>';
                        @endforeach
    html+=             '</select>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-3">'+
                    '<div class="form-group">'+
                      '<label>Item (selectd Companies Item)</label>'+
                      '<select class="form-control select2 item_id" name="item_id[]" id="item_id">'+
                        '<option value="">Select Item</option>';
                        @foreach($category->items AS $item)
                          html += '<option value="{{ $item->hashid }}" data-price="{{ $item->price }}">{{ $item->name }}</option>';
                        @endforeach
    html+=            '</select>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-3">'+
                    '<div class="form-group">'+
                      '<label>Quantity</label>'+
                      '<input class="form-control quantity" name="quantity[]" id="quantity" value="" required>'+
                    '</div>'+
                  '</div>'+
                  '<div class="col-md-3">'+
                     '<button type="button" class="btn btn-danger remove_row_btn">x</button>'+
                  '</div></div>';
  $('.append_row').append(html);
});
//calculate net amount
function calculate_net_amount(){

  var price      = getItemsPrice();
  var quantity   = getQuantity();
  var discount   = $('#discount').attr('dis');
  var commission = $('#commission').attr('com');
  var total      = 0;
  var total_quantity = 0;
  $.each(price, function(index,item_price){
    total          = total+eval(parseInt((parseInt(item_price) * parseInt(quantity[index]))));
    total_quantity = total_quantity+eval(parseInt(quantity[index]));
  });

  if(!isNaN(total) && discount != '' && commission != ''){//if both values are set the put net amount in input field
    console.log(total);
    console.log(total_quantity);
    // var total             = (price*quantity);
    var total_commission  = (total*commission)/100;
    var total_discount    = (discount*total_quantity);
    // console.log(total_commission);
    // console.log(total_discount);
    $('#net_ammount').val(total-(total_commission+total_discount));
    $('#commission').val(total_commission);
    $('#discount').val(total_discount);
  }
}
//get selected item prices
function getItemsPrice(){
  var price_arr = [];
  $('.item_id').each(function(){
    // console.log($(this).find(':selected').data('price'));
    price_arr.push($(this).find(':selected').data('price'));
  });
  return price_arr;
}
//get quantiy  of item
function getQuantity(){
  var quantity_arr = [];
  $('.quantity').each(function(){
    quantity_arr.push($(this).val());
  });
  return quantity_arr;
}
//remove row
$(document).on('click', '.remove_row_btn', function(){
  $(this).parent().parent().remove();
  // alert('dpne');
});
</script>
@endsection