@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Edit User</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Edit User</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('users.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>User List</a>
            
              </div>
            </div>
           
              <form action="{{ route('users.update',$allUserData->id) }}" method="POST" id="form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">
                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="user_type">User Role<span class="tx-danger">*</span></label>
                          <select class="form-control" name="user_type" required="" >
                            <option label="Select Role"></option>
                            <option value="Admin" {{ ($allUserData->user_type == "Admin" )?"selected":"" }}>Admin</option>
                            <option value="User" {{ ($allUserData->user_type == "User" )?"selected":"" }}>User</option>
                          </select>
                         
                        </div>
                      </div>

                      
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Name<span class="tx-danger">*</span></label>
                          <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $allUserData->name }}" placeholder="Enter Name" required="" data-parsley-trigger="keyup" data-parsley-length="[4, 30]" data-parsley-pattern="\b([A-ZÀ-ÿ][-,a-z. ']+[ ]*)+" >
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
                          <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $allUserData->email }}" placeholder="Enter email address" data-parsley-type="email" data-parsley-trigger="keyup" required="" >
                          @error('email')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Image<span class="tx-danger">*</span></label>
                          @if (!is_null($allUserData->image))
                          <img src="{{ asset('Backend/img/user') }}/{{$allUserData->image }}" alt="" width="35">
                          @else
                            No Thumbnail
                          @endif
                          <br>
                          <input type="file" name="image" class="form-control-file">
                        </div>
                      </div>
                      
                    </div>
        
                    <div class="form-layout-footer">
                     
                      <input  class="btn btn-info" type="submit"  value="Update">

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