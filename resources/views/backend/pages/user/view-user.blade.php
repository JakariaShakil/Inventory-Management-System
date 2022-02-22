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
              <table id="example"  class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Image</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Action</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allData as $key => $user )
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                      @if (!is_null($user->image))
                      <img src="{{ asset('Backend/img/user') }}/{{ $user->image }}" alt="" width="35">
                      @else
                        No Thumbnail
                      @endif
                    </td>
                    <td>{{ $user->user_type }}</td>
                    <td>{{ $user->name }}</td>
                   
                    <td>{{ $user->email }}</td>
                    <td>
                      @if ($user->user_type == 'User')
                      <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a>
                     
                      <button class="btn btn-danger btn-sm" type="button" onclick="deleteItem({{ $user->id }})">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                      <form id="delete-form-{{ $user->id }}" action="{{ route('users.delete', $user->id) }}" method="post"
                        style="display:none;">
                      @csrf
                      @method('DELETE')
                      
                    
                  </form>
                      @endif
                      
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