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
           
              <form action="{{ route('suppliers.update',$allSupplierData->id) }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">
                     
                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="Type">Supplier Type<span class="tx-danger">*</span></label>
                          <select class="form-control @error('type') is-invalid @enderror" name="type" >
                            <option label="Select Type"></option>
                            <option value="Distributor"  {{ ($allSupplierData->type == "Distributor" )?"selected":"" }}>Distributor</option>
                            <option value="Whole Seller" {{ ($allSupplierData->type == "Whole Seller" )?"selected":"" }}>Whole Seller</option>
                          </select>
                          @error('type')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                         
                        </div>
                      </div>
                      

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Name<span class="tx-danger">*</span></label>
                          <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $allSupplierData->name }}"  >

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
                          <input type="file" name="image " class="form-control-file @error('image') is-invalid @enderror" > 
                          @error('image')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">E-mail<span class="tx-danger">*</span></label>
                          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $allSupplierData->email }}" > 

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
                          <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror"  value="{{$allSupplierData->mobile }}" > 
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
                          <input type="text" name="address" class="form-control  @error('address') is-invalid @enderror"  value="{{ $allSupplierData->address }}" > 
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
                          <input type="text" name="city" class="form-control  @error('city') is-invalid @enderror" value="{{ $allSupplierData->city }}">   
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
                          <input type="text" name="account_number" class="form-control @error('account_number') is-invalid @enderror" value="{{$allSupplierData->account_number}}">

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

  
  
@endsection

