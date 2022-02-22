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
        <h4>Manage Employee Salary</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h2 class="text-secondary">Employee Salary List</h2>
                </div>
                <div class="tx-24 hidden-xss-down">
                    <a href="{{ route('employees.add') }}" class="btn btn-info btn-sm float-right text-white"><i
                            class="fa fa-plus-circle"></i>Add Employee</a>

                </div>
            </div><!-- card-header -->
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>Join Date</th>
                            <th>Salary</th>

                            <th width="20%">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allEmployeeData as $key => $value )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> 
                                @if (!is_null($value->image))
                                <img src="{{ asset('Backend/img/employee') }}/{{$value->image }}" alt="" width="35">
                                @else
                                  No Thumbnail
                                @endif
                            </td>

                            <td> {{ $value->name }}</td>
                            <td> {{ $value->phone }}</td>
                            <td> {{ $value->gender }}</td>
                            <td> {{ date('d-m-Y',strtotime($value->join_date))  }}</td>
                            <td> {{ $value->salary }}</td>
                            <td>
                                <a title="Increment" href="{{ route('employees.salary.increment',$value->id) }}" class="btn btn-sm btn-info"><i class="fa fa-plus-circle"></i></a>
                               
                                <a title="Details" target="_blank"
                                href="{{ route('employees.salary.details',$value->id) }}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-eye"></i></a>
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
