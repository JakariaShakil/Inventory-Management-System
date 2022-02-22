@extends('backend.layout.template')


@section('body')


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Add Product</h4>

    </div>
  </div>

  {{-- @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
 @endif --}}


  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Add Product</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('products.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Product List</a>
            
              </div>
            </div><!-- card-header -->


           
              <form action="{{ route('products.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Product Name<span class="tx-danger">*</span></label>
                          <input class="form-control  @error('product_name') is-invalid @enderror" type="text" name="product_name" value="{{ old('product_name') }}" >

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
                          <input class="form-control @error('product_code') is-invalid @enderror"   type="text" name="product_code" value="{{ old('product_code') }}"   >

                          @error('product_code')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Category Type<span class="tx-danger">*</span></label>
                          <select class="form-control selection_class @error('category_id') is-invalid @enderror" name="category_id"  >
                            <option label="Select Category"  value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                             @endforeach
                            
                          </select>
                          @error('category_id')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                         
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Brand Type<span class="tx-danger">*</span></label>
                          <select class="form-control selection_class @error('brand_id') is-invalid @enderror" name="brand_id" >
                            <option label="Select Brand" value="" disabled selected>Select Brand</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                             @endforeach
                            
                          </select>
                          @error('brand_id')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                         
                        </div>
                      </div>
                     
                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Supplier Type<span class="tx-danger">*</span></label>
                          <select class="form-control selection_class  @error('supplier_id') is-invalid @enderror" name="supplier_id" >
                            <option label="Select Supplier" value="" disabled selected>Select Supplier</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                             @endforeach
                            
                          </select>
                          @error('supplier_id')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                         
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Unit Type<span class="tx-danger">*</span></label>
                          <select class="form-control selection_class @error('unit_id') is-invalid @enderror" name="unit_id"  >
                            <option label="Select Unit" value="" disabled selected>Select Unit</option>
                            @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                             @endforeach
                            
                          </select>
                          @error('supplier_id')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                         
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Product Image<span class="tx-danger">*</span></label>
                          <input type="file" name="product_image"  class="form-control-file  @error('product_image') is-invalid @enderror"> 
                          @error('product_image')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
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
 
@endsection
@push('scripts')
<script type="text/javascript">
  $(document).ready(function () {
      $('.selection_class').select2();
  });
</script>



  
@endpush


