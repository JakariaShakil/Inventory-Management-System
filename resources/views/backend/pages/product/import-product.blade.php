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
      <h4>Product Import</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Download Xlsx</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('export') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Download Xlsx</a>
            
              </div>
            </div><!-- card-header -->
           
            <form action="{{ route('import') }}" method="POST" id="form" data-parsley-validate="" enctype="multipart/form-data" >
              @csrf
              <div class="br-section-wrapper">
                <div class="form-layout form-layout-1">
                  
                  <div  class="row mg-b-25">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label">Xlsx File Import<span class="tx-danger">*</span></label>
                        <input class="form-control  @error('name') is-invalid @enderror" type="file" name="import_file" value="{{ old('name') }}"  required>

                        {{-- @error('name')
                        <span class="invalid-feedback " role="alert">
                            <strong > {{ $message }}</strong>
                        </span>        
                        @enderror  --}}
                      </div>
                    </div>
                  </div>

      
                  <div class="form-layout-footer">
                    <button class="btn btn-info" type="submit" value="submit">Upload</button>

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

