@extends('backend.layout.template')

@section('body')


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Edit Unit</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Edit Unit</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('units.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Unit List</a>
            
              </div>
            </div><!-- card-header -->
           
              <form action="{{ route('units.update',$allUnitData->id) }}" method="POST" id="form" data-parsley-validate="" >
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">
                     
                      
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Name<span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="name" value="{{ $allUnitData->name }}"  required="" data-parsley-trigger="keyup" >

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

