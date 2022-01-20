@extends('backend.layout.template')

@section('body')


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Edit Supplier</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Edit Supplier</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('suppliers.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Supplier List</a>
            
              </div>
            </div><!-- card-header -->
           
              <form action="{{ route('suppliers.update',$allSupplierData->id) }}" method="POST" id="form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">
                     
                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Supplier Type<span class="tx-danger">*</span></label>
                          <select class="form-control" name="type" required="" >
                            <option label="Select Type"></option>
                            <option value="Distributor"  {{ ($allSupplierData->type == "Distributor" )?"selected":"" }}>Distributor</option>
                            <option value="Whole Seller" {{ ($allSupplierData->type == "Whole Seller" )?"selected":"" }}>Whole Seller</option>
                          </select>
                         
                        </div>
                      </div>
                      

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Name<span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="name" value="{{ $allSupplierData->name }}"  required="" data-parsley-trigger="keyup" data-parsley-pattern="\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+" >

                          @error('name')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Image<span class="tx-danger">*</span></label>
                          @if (!is_null($allSupplierData->image))
                          <img src="{{ asset('Backend/img/supplier') }}/{{$allSupplierData->image }}" alt="" width="35">
                          @else
                            No Thumbnail
                          @endif
                          <input type="file" name="image" class="form-control-file" > 
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">E-mail<span class="tx-danger">*</span></label>
                          <input type="email" name="email" class="form-control" value="{{ $allSupplierData->email }}" data-parsley-type="email" data-parsley-trigger="keyup" > 

                          @error('email')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror    
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Mobile<span class="tx-danger">*</span></label>
                          <input type="text" name="mobile" class="form-control"  value="{{$allSupplierData->mobile }}" required="" > 
                          @error('mobile')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror                   
                        </div>
                      </div>
                      
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Address<span class="tx-danger">*</span></label>
                          <input type="text" name="address" class="form-control"  value="{{ $allSupplierData->address }}" required="" > 
                          @error('address')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror     
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">City<span class="tx-danger">*</span></label>
                          <input type="text" name="city" class="form-control" value="{{ $allSupplierData->city }}" required="">   
                          @error('city')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">account_number<span class="tx-danger">*</span></label>
                          <input type="text" name="account_number" class="form-control" value="{{$allSupplierData->account_number}}">

                          @error('account_number')
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

  <script type="text/javascript">
    $(function () {
      $('#form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })
      .on('form:submit', function() {
        return false; 
      });
    });
    </script>
  
@endsection

