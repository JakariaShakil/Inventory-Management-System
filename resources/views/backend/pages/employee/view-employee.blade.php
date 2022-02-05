@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Manage Employee</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Employee List</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('employees.add') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-plus-circle"></i>Add Employee</a>
            
              </div>
            </div><!-- card-header -->
            <div class="card-body">
              <table id="example"  class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Image</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Join Date</th>
                    <th>Salary</th>
                    <th>Action</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allData as $key => $employee )
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                      @if (!is_null($employee->image))
                      <img src="{{ asset('Backend/img/employee') }}/{{ $employee->image }}" alt="" width="35">
                      @else
                        No Thumbnail
                      @endif
                    </td>
                    <td>{{ $employee->role }}</td> 
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->gender }}</td>
                    <td>{{ $employee->join_date }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>
                      <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                      {{-- <a href="{{ route('users.delete',$user->id) }}" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a> --}}
                      <button class="btn btn-danger btn-sm" type="button" onclick="deleteItem({{ $employee->id }})">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                      <form id="delete-form-{{ $employee->id }}" action="{{ route('employees.delete', $employee->id) }}" method="post"
                        style="display:none;">
                      @csrf
                      @method('DELETE')
                      
                    
                  </form>
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

@push('scripts')

<script type="text/javascript">
  $(document).ready(function() {
      $('#example').DataTable( {
          initComplete: function () {
              this.api().columns().every( function () {
                  var column = this;
                  var select = $('<select><option value=""></option></select>')
                      .appendTo( $(column.footer()).empty() )
                      .on( 'change', function () {
                          var val = $.fn.dataTable.util.escapeRegex(
                              $(this).val()
                          );
   
                          column
                              .search( val ? '^'+val+'$' : '', true, false )
                              .draw();
                      } );
   
                  column.data().unique().sort().each( function ( d, j ) {
                      select.append( '<option value="'+d+'">'+d+'</option>' )
                  } );
              } );
          }
      } );
  } );
  
  </script>

<script>
  @if(Session::has('message'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
    "closeButton" : true,
    "progressBar" : true
  }
      toastr.warning("{{ session('warning') }}");
  @endif

</script> 
 <script type="text/javascript">
  function deleteItem(id) {
      const swalWithBootstrapButtons = swal.mixin({
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false,
      })
      swalWithBootstrapButtons({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
      }).then((result) => {
          if (result.value) {
              event.preventDefault();
              document.getElementById('delete-form-'+id).submit();
          } else if (
              // Read more about handling dismissals
              result.dismiss === swal.DismissReason.cancel
          ) {
              swalWithBootstrapButtons(
                  'Cancelled',
                  'Your data is safe :)',
                  'error'
              )
          }
      })
  }
</script>
  
@endpush