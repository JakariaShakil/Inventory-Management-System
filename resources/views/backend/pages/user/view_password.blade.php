@extends('backend.layout.template')

@section('body')


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Change Password</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Change Password</h2>
              </div>
              
            </div><!-- card-header -->
           
              <form action="{{ route('profile.password.update') }}" method="POST" id="form" data-parsley-validate="">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">
                      
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Current Password<span class="tx-danger">*</span></label>
                          <input class="form-control @error('current_password') is-invalid @enderror" type="password" name="current_password" id="current_password" placeholder="Enter current password" required="">
                          @error('current_password')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">New Password<span class="tx-danger">*</span></label>
                          <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="New password" required="" >

                          @error('password')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Confirm Password<span class="tx-danger">*</span></label>
                          <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" data-parsley-equalto="#password" placeholder="Confirm password" required="" >
                          @error('password_confirmation')
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
        return false; // Don't submit form for this demo
      });
    });
    </script>
@endsection