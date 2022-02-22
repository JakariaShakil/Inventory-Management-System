@extends('backend.layout.template')

@section('body')


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Add Brand</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Add Brand</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('brands.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Brand List</a>
            
              </div>
            </div><!-- card-header -->
           
            <form action="{{ route('brands.store') }}" method="POST"  >
              @csrf
              <div class="br-section-wrapper">
                <div class="form-layout form-layout-1">
                  
                  <div  class="row mg-b-25">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Brand Name<span class="tx-danger">*</span></label>
                        <input class="form-control  @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}"  >

                        @error('name')
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

