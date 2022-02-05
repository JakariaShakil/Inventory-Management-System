@extends('backend.layout.template')

@section('body')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 offset-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <!-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li> --> --}}
                        <li class="breadcrumb-item active">{{  date('F') }} Expenses</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="mb-3">
                        <a href="{{ route('expenses.month', 'january') }}" class="btn btn-info">January</a>
                        <a href="{{ route('expenses.month', 'february') }}" class="btn btn-primary">February</a>
                        <a href="{{ route('expenses.month', 'march') }}" class="btn btn-secondary">March</a>
                        <a href="{{ route('expenses.month', 'april') }}" class="btn btn-warning">April</a>
                        <a href="{{ route('expenses.month', 'may') }}" class="btn btn-info">May</a>
                        <a href="{{ route('expenses.month', 'june') }}" class="btn btn-success">June</a>
                        <a href="{{ route('expenses.month', 'july') }}" class="btn btn-danger">July</a>
                        <a href="{{ route('expenses.month', 'august') }}" class="btn btn-primary">August</a>
                        <a href="{{ route('expenses.month', 'september') }}" class="btn btn-info">September</a>
                        <a href="{{ route('expenses.month', 'october') }}" class="btn btn-secondary">October</a>
                        <a href="{{ route('expenses.month', 'november') }}" class="btn btn-warning">November</a>
                        <a href="{{ route('expenses.month', 'december') }}" class="btn btn-danger">December</a>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <strong class="text-danger">{{ strtoupper($month) }}</strong> EXPENSES LISTS
                                <small class="text-danger pull-right">Total Expenses : {{ $expenses->sum('amount') }} Taka</small>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Expense Title</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                               
                                <tbody>
                                @foreach($expenses as $key => $expense)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $expense->name }}</td>
                                        <td>{{ number_format($expense->amount, 2) }}</td>
                                        <td>{{ $expense->date}}</td>
                                        <td>
                                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn
                                                btn-info">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" onclick="deleteItem({{ $expense->id }})">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                            <form id="delete-form-{{ $expense->id }}" action="{{ route('expenses.delete', $expense->id) }}" method="post"
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div> <!-- Content Wrapper end -->


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
