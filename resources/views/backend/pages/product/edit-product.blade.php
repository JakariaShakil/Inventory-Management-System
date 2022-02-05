@extends('backend.layout.template')

@section('body')

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
      <h4>Edit Product</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Edit Product</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('products.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Product List</a>
            
              </div>
            </div><!-- card-header -->
           
              <form action="{{ route('products.update',$products->id) }}" method="POST" id="form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Product Name<span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="product_name" value="{{ $products->product_name}}"  required="" data-parsley-trigger="keyup" >

                          @error('product_name')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Product Code<span class="tx-danger">*</span></label>
                          <input class="form-control" type="text"  name="product_code" value="{{ $products->product_code}}"  required="" >

                          @error('product_code')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div>

                      {{-- <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Product Quantity<span class="tx-danger">*</span></label>
                          <input class="form-control" type="number" name="quantity" value="{{ $products->quantity}}"  required="" data-parsley-trigger="keyup" >

                          @error('quantity')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div> --}}

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Category Type<span class="tx-danger">*</span></label>
                          <select class="form-control" name="category_id" required="" >
                            <option label="Select Type" value="" disabled selected></option>
                            
                         
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $products->category->id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                           
                            
                          </select>
                         
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Brand Type<span class="tx-danger">*</span></label>
                          <select class="form-control" name="brand_id" required="" >
                            <option label="Select Type" value="" disabled selected></option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $products->brand->id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                            
                            
                          </select>
                         
                        </div>
                      </div>
                     
                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Supplier Type<span class="tx-danger">*</span></label>
                          <select class="form-control" name="supplier_id" required="" >
                            <option label="Select Type" value="" disabled selected></option>

                             @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $products->supplier->id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                            
                          </select>
                         
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Unit Type<span class="tx-danger">*</span></label>
                          <select class="form-control" name="unit_id" required="" >
                            <option label="Select Type" value="" disabled selected></option>
                            @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ $products->unit->id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                            @endforeach
                            
                          </select>
                         
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Product Image<span class="tx-danger">*</span></label>
                          @if (!is_null($products->product_image))
                          <img src="{{ asset('Backend/img/product') }}/{{$products->product_image }}" alt="" width="35">
                          @else
                            No Thumbnail
                          @endif
                          <input type="file" name="product_image" class="form-control-file" > 
                        </div>
                      </div>

                  
                    </div>
        
                    <div class="form-layout-footer">
                      <button class="btn btn-info" type="submit" value="submit">Submit</button>

                    </div>
  
                  </div>
                </div>
                
              </form>
            
          </div>

    </div>

  </div>

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
  
@endsection

