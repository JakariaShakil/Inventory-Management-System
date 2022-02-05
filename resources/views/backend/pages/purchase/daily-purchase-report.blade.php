@extends('backend.layout.template')
@section('body')
<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Daily Purchase Report</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Daily Purchase Report</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('employees.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Employee List</a>
            
              </div>
            </div><!-- card-header -->
           
            <form target="_blank" method="GET" action="{{ route('purchase.report.pdf') }}">
                <div class="row">
                  <!---- From Colum Start ---->
                      
                            <div class="col-lg-5">
                                <div class="form-group">
                                  <label>Start Date</label>
                                  <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                                  @error('start_date')
                                     <strong class="alert alert-danger">{{ $message }}
                                     </strong>
                                    @enderror
                                </div> 
                            </div>
            
                             <div class="col-lg-5">
                                <div class="form-group">
                                  <label>End Date</label>
                                  <input type="date" name="end_date" id="end_date" class="form-control form-control-sm">
                                  @error('end_date')
                                     <strong class="alert alert-danger">{{ $message }}
                                     </strong>
                                    @enderror
                                </div> 
                            </div>
            
                            <div class="col-lg-2">
                              <input type="submit" name="submit" class="btn btn-primary mt-4" value="Search">
                            </div>
                     
              </div><!--End row -->
            </form>
            
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


