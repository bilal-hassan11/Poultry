
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
              <h1>Purchase Medicine Details</h1><br />
              
              <br />
              
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
                  <div class="col-md-2">
                              <button type="button" class="btn btn-primary mt-3 add_row">+</button>
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
				  <h2 class="box-title text-dark">All Purchase Medicine Entries</h2>
				</div>
                <div class="col-12">

            <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title"> Medicine Details</h4>
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
  var i = 0;
  $(document).on('click', '.add_row', function(e){ 
      i+= 1;
      
      let text1 = "item_name";
      let text2 = i;
      let res = text1.concat(text2);
      console.log(res);
      var html = '<div class="row">'+
                      '<div class="col-md-3 form-group">'+
                          '<label>Items</label>'+
                          '<select class="form-control js-example-basic-single" name="item_name[]" id='+res+  '>'+
                              '<option value="">Select  item</option>';
                              
                             
      html  +=           '</select>'+
                      '</div>'+
                      '<div class="col-md-4 form-group">'+
                          '<label for="">Quantity</label>'+
                          '<input type="number" class="form-control" name="item_quantity[]" id="item_weight" required>'+
                      '</div>'+
                      '<div class="col-md-2">'+
                          '<button type="button" class="btn btn-primary mt-3 add_row">+</button>'+
                          '<button type="button" class="btn btn-danger mt-3 remove_row">x</button>'+
                      '</div>'+
                  '</div>';
                  $('.btn_div').before().append(html);                 
          $.ajax({
              type: 'GET',
              datatype: 'JSON',
              contentType: 'application/json',
              url: "http://localhost/FeedSystem/public/outward/all_items",
              success: function(result){
                $.each(result, function (i, value) {
                console.log(result);
                $('#'+res).append('<option value=' + value.id + '>' + value.name + '</option>');
              });
                   
              },
              error: function(){
                  console.log("no response");
              }
               
          });
          
          $('.js-example-basic-single').select2();
     
  });

  $(document).on('click', '.remove_row', function(e){//remove row
      e.preventDefault();
      $(this).parent().parent().remove();
  });

 
    
</script>

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