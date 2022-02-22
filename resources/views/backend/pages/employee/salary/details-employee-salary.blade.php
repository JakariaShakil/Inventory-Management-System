@extends('backend.layout.template')

@section('body')


@endif

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Manage Employee Salary</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h3 class="box-title">Employee Salary Details</h3>
                    <h5><strong> Employee Name </strong> {{ $details->name }} </h5>
                     <h5><strong> Employee Role</strong> {{ $details->role }} </h5>
                </div>
              
            </div><!-- card-header -->
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">SL</th>  
                            <th>Previous Salary</th> 
                            <th>Increment Salary</th>
                            <th>Present Salary</th>
                            <th>Effected Date</th>
                             
                         
                             
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employeeSalary as $key => $value )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> {{ $value->previous_salary }}</td>	
                            <td> {{ $value->increment_salary }}</td>	
                            <td> {{ $value->present_salary }}</td>	
                            <td> {{ $value->effected_date }}</td>		 
                             
                             
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
    $(document).ready(function () {
        $('#example').DataTable({
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d +
                            '</option>')
                    });
                });
            }
        });
    });

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
