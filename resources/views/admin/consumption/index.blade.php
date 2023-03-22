@extends('layouts.admin')
@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="header-title">Flock Items Consumption</h2>
                </div><br /><br /><br />
                <form action="{{ route('admin.consumptions.store') }}" class="ajaxForm" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Consumption Date</label>
                            <input type="date" class="form-control" name="date" id="date" value="{{ isset($is_update) ? date('Y-m-d', strtotime(@$edit_consumption->date)) : date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Shade</label>
                            <select class="form-control select2" name="shade_id" id="shade_id" required>
                                <option value="">Select Shade</option>
                                @foreach($shades AS $s)
                                    <option value="{{ $s->hashid }}" @if(@$edit_consumption->shade_id == $s->id) selected @endif>{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Flocks</label>
                            <select class="form-control select2" name="flock_id" id="flock_id" required>
                                <option value="">Select Flock</option>
                                
                            </select>
                        </div>
                    </div><br />    
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Category</label>
                            <select class="form-control select2" name="category_id" id="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories AS $cat)
                                    <option value="{{ $cat->hashid }}" @if(@$edit_consumption->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Companies</label>
                            <select class="form-control select2" name="company_id" id="company_id" required>
                                <option value="">Select Company</option>
                                
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Items</label>
                            <select class="form-control select2" name="item_id" id="item_id" required>
                                <option value="">Select Item</option>
                                
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity" value="{{ @$edit_consumption->qunantity }}" required>
                        </div>
                    </div>
                    <input type="hidden" name="consumption_id" id="consumption_id" value="{{ @$edit_consumption->hashid }}">
                    <input type="submit" class="btn btn-primary mt-3" value="{{ isset($is_update) ? 'Update' : 'Add' }}">
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
              <h2 class="box-title text-dark">Filters</h2>
            </div>
            <div class="box-body">
              <form action="{{ route('admin.consumptions.index') }}" method="GET">
                @csrf
                <div class="row">
                <div class="col-md-4">
                    <label for="">Items</label>
                    <select class="form-control" name="item_id" id="item_id" required>
                        <option value="">Select Item</option>
                        @foreach($items AS $item)
                            <option value="{{ $item->hashid }}" @if(@$edit_consumption->item_id == $item->id) selected @endif>{{ $item->name }}</option>
                        @endforeach
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
              </form>
            </div>
          </div>
    </div>        
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title">Consumption</h4>
                    {{-- <a href="{{ route('admin.staffs.add') }}" class="btn btn-primary">Add Ac</a> --}}
                </div>
                <table  class="table text-fade table-bordered table-hover display nowrap margin-top-10 w-p100" id="example">
                    <thead>
                        <tr class="text-dark">
                            <th >S.No</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consumptions AS $consumption)
                            <tr class="text-dark">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $consumption->item->name }}</td>
                                <td>{{ $consumption->qunantity}}</td>
                                <td>{{ date('d-M-Y', strtotime($consumption->date)) }}</td>
                                <td >
                                    <a href="{{route('admin.consumptions.edit', $consumption->hashid)}}" >
                                        <i                                 <span class="waves-effect waves-light btn btn-rounded btn-primary-light"><i class="fas fa-edit"></i></span>

                                    </a>
                                    <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('admin.consumptions.delete', $consumption->hashid) }}"  class="waves-effect waves-light btn btn-rounded btn-primary-lightt">
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
@endsection

@section('page-scripts')
@include('admin.partials.datatable')


<script>

    //get All Companies
    $('#shade_id').change(function(){
        var id = $(this).val();
        var route = "{{ route('admin.common.flocks', ':id') }}";
        route     = route.replace(':id', id);
        
        getAjaxRequests(route, '', 'GET', function(resp){
            $('#flock_id').html(resp.html);
        });
    });

    //get All Companies
    $('#category_id').change(function(){
        var id = $(this).val();
        var route = "{{ route('admin.common.companies', ':id') }}";
        route     = route.replace(':id', id);
        
        getAjaxRequests(route, '', 'GET', function(resp){
            $('#company_id').html(resp.html);
        });
    });


    //get All Companies
    $('#company_id').change(function(){
        var id = $(this).val();
        var route = "{{ route('admin.common.items', ':id') }}";
        route     = route.replace(':id', id);
        
        getAjaxRequests(route, '', 'GET', function(resp){
            $('#item_id').html(resp.html);
        });
    });

    

    $('#grand_parent_id').change(function(){
        var id = $(this).val();
        var route = "{{ route('admin.common.get_parent_account', ':id') }}";
        route     = route.replace(':id', id);
        
        getAjaxRequests(route, '', 'GET', function(resp){
            $('#parent_id').html(resp.html);
        });
    });
</script>
@endsection