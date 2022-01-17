@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Manage User</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Users List</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('users.add') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-plus-circle"></i>Add User</a>
            
              </div>
            </div><!-- card-header -->
            <div class="card-body">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-15p">SL.</th>
                    <th class="wd-15p">Role</th>
                    <th class="wd-20p">Name</th>
                    <th class="wd-15p">E-mail</th>
                    <th class="wd-10p">Action</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allData as $key => $user )
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->user_type }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                      <a href="{{ route('users.delete',$user->id) }}" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>   
                  </tr>
                  @endforeach
                  
                </tbody>
                </table>
            </div>
          </div>

    </div>

  </div>
  
  
@endsection