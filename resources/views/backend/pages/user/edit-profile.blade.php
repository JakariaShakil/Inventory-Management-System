@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Edit Profile</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Edit Profile</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('users.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>User List</a>
            
              </div>
            </div>
           
              <form action="{{ route('profile.update',$user->id) }}" method="POST" id="form" data-parsley-validate="" enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">User Name<span class="tx-danger">*</span></label>
                              <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $user->name }}" placeholder="Enter Name" required="" data-parsley-trigger="keyup" data-parsley-length="[4, 30]">
                              @error('name')
                              <span class="invalid-feedback " role="alert">
                                  <strong > {{ $message }}</strong>
                              </span>        
                              @enderror 
                            </div>
                          </div>

                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">User Email<span class="tx-danger">*</span></label>
                              <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $user->email }}" placeholder="Enter email address" data-parsley-type="email" data-parsley-trigger="keyup" required="" >
                              @error('email')
                              <span class="invalid-feedback " role="alert">
                                  <strong > {{ $message }}</strong>
                              </span>        
                              @enderror
                            </div>
                          </div>

                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">User Mobile<span class="tx-danger">*</span></label>
                              <input class="form-control @error('mobile') is-invalid @enderror"  name="mobile" value="{{ $user->mobile }}" placeholder="Enter mobile number" required="">
                              @error('mobile')
                              <span class="invalid-feedback " role="alert">
                                  <strong > {{ $message }}</strong>
                              </span>        
                              @enderror
                            </div>
                          </div>
                         
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label">User Address<span class="tx-danger">*</span></label>
                              <input class="form-control @error('address') is-invalid @enderror"  name="address" value="{{ $user->address }}" placeholder="Enter user address" required="" >
                              @error('address')
                              <span class="invalid-feedback " role="alert">
                                  <strong > {{ $message }}</strong>
                              </span>        
                              @enderror
                            </div>
                          </div>

                         

                          


                        <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                            <label class="form-control-label" for="gender">User Gender<span class="tx-danger">*</span></label>
                            <select class="form-control" name="gender" required="" >
                                <option label="Select Gender"></option>
                                <option value="Male" {{ ($user->gender == "Male" )?"selected":"" }}>Male</option>
                                <option value="Female" {{ ($user->gender == "Female" )?"selected":"" }}>Female</option>
                            </select>
                            
                            </div>
                        </div>



                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Image<span class="tx-danger">*</span></label>
                          @if (!is_null($user->image))
                          <img src="{{ asset('Backend/img/user') }}/{{$user->image }}" alt="" width="35">
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