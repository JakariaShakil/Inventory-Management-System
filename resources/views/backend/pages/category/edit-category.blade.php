@extends('backend.layout.template')

@section('body')


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Edit Category</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Edit Category</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('categories.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Customer List</a>
            
              </div>
            </div><!-- card-header -->
           
            <form action="{{ route('categories.update',$allCategoryData->id) }}" method="POST" id="form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">
                    
                    <div  class="row mg-b-25">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Category Name<span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="name" value="{{  $allCategoryData->name }}"  required="" data-parsley-trigger="keyup" data-parsley-pattern="\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+" >

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

