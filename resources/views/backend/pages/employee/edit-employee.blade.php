@extends('backend.layout.template')

@section('body')


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Edit Employee</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Edit Employee</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('employees.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Employee List</a>
            
              </div>
            </div><!-- card-header -->
           
              <form action="{{ route('employees.update',$allEmployeeData->id) }}" method="POST" id="form"  enctype="multipart/form-data">
                @csrf
                <div class="br-section-wrapper">
                  <div class="form-layout form-layout-1">


                    <div class="row mg-b-25">
                        
                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="role">Role<span class="tx-danger">*</span></label>
                          <select class="form-control @error('role') is-invalid @enderror" name="role"  >
                            <option label="Select Role"></option>
                            <option value="Manager"  {{ ($allEmployeeData->role == "Manager" )?"selected":"" }}>Manager</option>
                            <option value="Cashier" {{ ($allEmployeeData->role == "Cashier" )?"selected":"" }}>Cashier</option>
                            <option value="Salesperson" {{ ($allEmployeeData->role == "Salesperson" )?"selected":"" }}>Salesperson</option>
                          </select>
                          @error('role')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Image<span class="tx-danger">*</span></label>
                          <input type="file" name="image" class="form-control-file @error('name') is-invalid @enderror">
                          @error('image')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Name<span class="tx-danger">*</span></label>
                          <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{$allEmployeeData->name}}" placeholder="Enter Name"   >
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
                          <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ $allEmployeeData->email }}" placeholder="Enter email address"   >
                          @error('email')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Phone<span class="tx-danger">*</span></label>
                          <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ $allEmployeeData->phone }}"  placeholder="Enter phone number" >
                          @error('phone')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Address<span class="tx-danger">*</span></label>
                          <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" value="{{ $allEmployeeData->address }}"  placeholder="Enter address" >
                          @error('address')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                          <label class="form-control-label" for="gender">Gender<span class="tx-danger">*</span></label>
                          <select class="form-control" name="gender"  >
                            <option label="Select Gender"></option>
                            <option value="Male" {{ ($allEmployeeData->gender == "Male" )?"selected":"" }}>Male</option>
                            <option value="Female" {{ ($allEmployeeData->gender == "Female" )?"selected":"" }}>Female</option>      
                          </select>
                         
                        </div>
                      </div>

                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Join Date<span class="tx-danger">*</span></label>
                          <input class="form-control @error('join_date') is-invalid @enderror" type="date" name="join_date" value="{{$allEmployeeData->join_date }}"  placeholder="dd-mm-yyyy" >
                          @error('join_date')
                          <span class="invalid-feedback " role="alert">
                              <strong > {{ $message }}</strong>
                          </span>        
                          @enderror
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label class="form-control-label">Salary<span class="tx-danger">*</span></label>
                          <input class="form-control @error('salary') is-invalid @enderror" type="text" name="salary" value="{{ $allEmployeeData->salary }}"  placeholder="Enter salary" >
                          @error('salary')
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
