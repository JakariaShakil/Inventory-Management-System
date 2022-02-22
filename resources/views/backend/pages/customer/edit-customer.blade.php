@extends('backend.layout.template')

@section('body')


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Edit Customer</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Edit Customer</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('customers.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Customer List</a>
            
              </div>
            </div><!-- card-header -->
           
            <form action="{{ route('customers.update', $allCustomerData->id) }}" method="POST" >
              @csrf
              <div class="br-section-wrapper">
                <div class="form-layout form-layout-1">
          
          
                  <div class="row mg-b-25">
          
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Name<span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="name" value="{{ $allCustomerData->name }}"  >
          
                        @error('name')
                        <span class="invalid-feedback " role="alert">
                            <strong > {{ $message }}</strong>
                        </span>        
                        @enderror 
                      </div>
                    </div>
          
                   
                   
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Mobile<span class="tx-danger">*</span></label>
                        <input type="text" name="mobile" class="form-control"  value="{{ $allCustomerData->mobile }}" > 
                        @error('mobile')
                        <span class="invalid-feedback " role="alert">
                            <strong > {{ $message }}</strong>
                        </span>        
                        @enderror                   
                      </div>
                    </div>
          
          
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">E-mail<span class="tx-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ $allCustomerData->email }}" > 
          
                        @error('email')
                        <span class="invalid-feedback " role="alert">
                            <strong > {{ $message }}</strong>
                        </span>        
                        @enderror    
                      </div>
                    </div>
                    
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Address<span class="tx-danger">*</span></label>
                        <input type="text" name="address" class="form-control"  value="{{ $allCustomerData->address }}" > 
                        @error('address')
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

