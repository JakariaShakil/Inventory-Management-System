@extends('backend.layout.template')

@section('body')
@if(session()->has('success'))

<script type="text/javascript">

 $(function(){
   $.notify("{{ session()->get('success') }}",{globalPosition:'top right',className:'success'});
 });

</script>

@endif

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Add User</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Add User</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('users.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>User List</a>
            
              </div>
            </div><!-- card-header -->
           
              <form action="{{ route('users.store') }}" method="POST" id="form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">
                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="user_type">User Role<span class="tx-danger">*</span></label>
                          <select class="form-control" name="user_type" required="" >
                            <option label="Select Role"></option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                          </select>
                         
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Image<span class="tx-danger">*</span></label>
                          <input type="file" name="image" class="form-control-file">
                         
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Name<span class="tx-danger">*</span></label>
                          <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name" required="" data-parsley-trigger="keyup" data-parsley-length="[4, 30]" data-parsley-pattern="\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+" >
                          @error('name')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror 
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Email<span class="tx-danger">*</span></label>
                          <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" data-parsley-type="email" data-parsley-trigger="keyup" required="" >
                          @error('email')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>
                      
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Password<span class="tx-danger">*</span></label>
                          <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Enter password" required="">
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