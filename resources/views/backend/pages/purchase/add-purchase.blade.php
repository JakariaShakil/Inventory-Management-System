@extends('backend.layout.template')

@section('body')
<script src="{{ asset('Backend/lib/jquery/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js" integrity="sha512-RNLkV3d+aLtfcpEyFG8jRbnWHxUqVZozacROI4J2F1sTaDqo1dPQYs01OMi1t1w9Y2FdbSCDSQ2ZVdAC8bzgAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- @if(session()->has('success'))

<script type="text/javascript">

 $(function(){
   $.notify("{{ session()->get('success') }}",{globalPosition:'top right',className:'success'});
 });

</script>

@endif --}}

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Add Purchase</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Add Purchase</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('purchase.view') }}" class="btn btn-success btn-sm float-right text-white"><i class="fa fa-list"></i>Purchase List</a>
            
              </div>
            </div><!-- card-header -->
           
             {{-- card start here --}}
                
                  <div class="form-layout form-layout-1">
                    <div class="row mg-b-25 form-layout">

                        <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">Date<span class="tx-danger">*</span></label>
                              <input class="form-control @error('date') is-invalid @enderror" type="date" name="date" id="date" value="{{ old('date') }}" required="" placeholder="dd-mm-yyyy" >
                              @error('date')
                              <span class="invalid-feedback " role="alert">
                                  <strong > {{ $message }}</strong>
                              </span>        
                              @enderror
                            </div>
                          </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Purchase No<span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="purchase_no" id="purchase_no" value="{{ old('purchase_no') }}"  required=""  >

                          @error('purchase_no')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Supplier Name<span class="tx-danger">*</span></label>
                          <select class="form-control select2" name="supplier_id" id="supplier_id" required="" >
                            <option label="Select Supplier" value="" disabled selected></option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                             @endforeach
                            
                          </select>
                         
                        </div>
                      </div>

                      <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Category Name<span class="tx-danger">*</span></label>
                          <select class="form-control select2" name="category_id" id="category_id" required="" >
                            <option label="Select Category" value="" disabled selected></option>       
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-lg-3">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Brand Name<span class="tx-danger">*</span></label>
                          <select class="form-control select2" name="brand_id" id="brand_id" required="" >
                            <option label="Select Brand" value="" disabled selected></option>       
                          </select>
                        </div>
                      </div>

                      
                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Product Name<span class="tx-danger">*</span></label>
                          <select class="form-control select2" name="product_id" id="product_id" required="" >
                            <option label="Select Product" value="" disabled selected></option>       
                          </select>
                        </div>
                      </div>

                      <div class="form-group col-lg-2">
                        <button class="btn btn-info btn-sm" id="addeventmore" style="margin-top:35px" type="submit" value="submit"><i class="fa fa-plus-circle"></i>Add Item</button>
                      </div>

                      <div class="card-body">
                        <form method="post" action="{{ route('purchase.store') }}" id="myForm">
                          @csrf
                          <table class="table-sm table table-bordered" width="100%">
                            <thead>
                              <tr>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th width= "7%">Pcs/kg</th>
                                <th width = "10%">Unit Price</th>
                                <th>Description</th>
                                <th width="10%">Total Price</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody id="addRow" class= "addRow">
      
                            </tbody>
                            <tbody>
                              <tr>
                                <td colspan="5"></td>
                                <td>
                                  <input type="text" name="estimated_ammount" value="0" id="estimated_ammount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
                                </td>
                                <td>  
                                </td>
                              </tr>
                            </tbody>
      
                          </table>
                            <button type="submit" class="btn btn-info" id="storeButton">Purchase Store</button>
                        </form>
                      </div>
                        
                     
 
                    </div>
        

                  </div>
                
                {{-- card end here --}}

              
               
                
                
            
            
          </div>

    </div>

  </div>  
@endsection


@push('scripts')


<script  id="document-template" type="text/x-handlebars-template">
  <tr class="delete_add_more_item" id="delete_add_more_item">

      <input type="hidden" name="date[]" value="@{{date}}">
      <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
      <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
      <input type="hidden" name="brand_id[]" value="@{{brand_id}}">

      <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{category_name}}
    </td>
    
    <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
        @{{product_name}}
    </td>

      <td>
          <input type="number" min="1" class="form-control form-control-sm text-right buying_quantity" name="buying_quantity[]" value="1">
      
      </td>

      <td>
          <input type="number"  class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
      
      </td>

      <td>
          <input type="text" name="description[]" class="form-control form-control-sm">
      </td>

      <td>
          <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
      </td>

      <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i> </td>

  </tr>

</script> 


<script type="text/javascript">
 
  $(document).on('click','#addeventmore',function(){
     
      $('.table').show();

      var date = $('#date').val();
      var purchase_no = $('#purchase_no').val();
      var supplier_id = $('#supplier_id').val();
      var category_id = $('#category_id').val();
      //var category_name = $('#category_id').find('option:selected').text();
      var category_name = $( "#category_id option:selected" ).text();
      var brand_id = $('#brand_id').val();
      
      var product_id= $('#product_id').val();
      //var product_name= $('#product_id').val().find('option:selected').text();
      var product_name = $( "#product_id option:selected" ).text();
 
      
      var source = $("#document-template").html();
      var template = Handlebars.compile(source);
 
      var data = {
        date:date,
        purchase_no:purchase_no,
        supplier_id:supplier_id,
        category_id:category_id,
        category_name:category_name,
        brand_id:brand_id,
        product_id:product_id,
        product_name:product_name,

      }
 
      var html = template(data);
      $("#addRow").append(html)
    
      total_ammount_price();
  });
 
   $(document).on('click','.removeeventmore',function(event){
     $(this).closest('.delete_add_more_item').remove();
     total_ammount_price();
   });

   $(document).on('keyup click','.unit_price,.buying_quantity',function() {
    
    var unit_price = $(this).closest("tr").find("input.unit_price").val();
    var quantity  =  $(this).closest("tr").find("input.buying_quantity").val();
    var total = unit_price*quantity;
    $(this).closest("tr").find("input.buying_price").val(total);
    total_ammount_price();

});
 
   function total_ammount_price() {
     var sum = 0;
     $('.buying_price').each(function(){
       var value = $(this).val();
       if(value.length != 0)
       {
         sum += parseFloat(value);
       }
     });
     $('#estimated_ammount').val(sum);
   }
                        
 </script>




<script type="text/javascript">
$(function(){
  $(document).on('change','#supplier_id',function(){
    var supplier_id = $(this).val();
    $.ajax({
      url:"{{ route('get-category')}}",
      type:"GET",
      dataType:"json",
      data:{supplier_id:supplier_id},
      
      // data:{supplier_id:supplier_id},
      success: function(data) {
        // var html ='<option value="">Select Category</option>';
          $("#category_id").empty();
          $("#category_id").append('<option value="">Select Category</option>');
          $.each(data,function(key,value){
            $("#category_id").append('<option value="'+value.category_id+'"">'+value.category.name+'</option>');
          })
      }
    });
  });
});

      
   </script> 

<script type="text/javascript">
  $(function(){
    $(document).on('change','#category_id',function(){
      var category_id = $(this).val();
      $.ajax({
        url:"{{ route('get-brand')}}",
        type:"GET",
        dataType:"json",
        data:{category_id:category_id},
        
        // data:{supplier_id:supplier_id},
        success: function(data) {
          // var html ='<option value="">Select Category</option>';

            $("#brand_id").empty();
            $("#brand_id").append('<option value="">Select Brand</option>');
            $.each(data,function(key,value){
              $("#brand_id").append('<option value="'+value.brand_id+'"">'+value.brand.name+'</option>');
            })
        }
      });
    });
  });
  </script>


<script type="text/javascript">
   $(function(){
    $(document).on('change','#brand_id',function(){
      var brand_id = $(this).val();
      var category_id = $('#category_id').val();
    
      $.ajax({
        url:"{{ route('get-product')}}",
        type:"GET",
        dataType:"json",
        data:{brand_id:brand_id,category_id:category_id},
        
        // data:{supplier_id:supplier_id},
        success: function(data) {
          // var html ='<option value="">Select Category</option>';
            $("#product_id").empty();
            $("#product_id").append('<option value="">Select Product</option>');
            $.each(data,function(key,value){
              $("#product_id").append('<option value="'+value.id+'"">'+value.product_name+'</option>');
            })
        }
      });
    });
  });
  </script>

    <script type="text/javascript">
        $(function () {
          $('#form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
          })
          .on('form:submit', function() {
            return false; // Don't submit form for this demo
          });
        });
        </script>
@endpush



