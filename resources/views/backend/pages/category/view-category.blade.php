@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Manage Category</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h2 class="text-secondary">Category List</h2>
                </div>
                <div class="tx-24 hidden-xss-down">
                    <a href="{{ route('categories.add') }}" class="btn btn-info btn-sm float-right text-white"><i
                            class="fa fa-plus-circle"></i>Add Category</a>

                </div>
            </div><!-- card-header -->
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr>
                        <th>SL.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($allData as $key => $category )
                      <tr>

                        <td>{{ $key+1 }}</td>
                        <td>{{ $category->name }}</td>
                        
                        <td>
                          <a href="{{ route('categories.edit',$category->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                          {{-- <a href="{{ route('customers.delete',$customer->id) }}" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a> --}}
                          <button class="btn btn-danger btn-sm" type="button" onclick="deleteItem({{ $category->id }})">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                          <form id="delete-form-{{ $category->id }}" action="{{ route('categories.delete', $category->id) }}" method="post"
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
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('info'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
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
                document.getElementById('delete-form-' + id).submit();
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
