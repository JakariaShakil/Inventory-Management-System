@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Invoice Pending</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h2 class="text-secondary">Pending List</h2>
                </div>
                {{-- <div class="tx-24 hidden-xss-down">
                    <a href="{{ route('purchase.add') }}" class="btn btn-info btn-sm float-right text-white"><i
                    class="fa fa-plus-circle"></i>Add Purchase</a>

            </div> --}}
        </div><!-- card-header -->
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>SL.</th>
                        <th>Customer Name</th>
                        <th>Invoice No.</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoicesPending as $key => $invoicePending)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            {{ $invoicePending['payment']['customer']['name'] }}
                            ( {{ $invoicePending['payment']['customer']['mobile'] }} )
                        </td>
                        <td> Invoice No #{{ $invoicePending->invoice_no }}</td>
                        <td>{{ date('d-m-Y', strtotime($invoicePending->date)) }}</td>
                        <td>{{ $invoicePending->description }}</td>
                        <td>{{ $invoicePending->payment->total_amount }}</td>
                        
                        <td>
                            @if($invoicePending->status == 0)
                            <span class="badge badge-warning">Pending</span>
                            @elseif ($invoicePending->status == 1)
                            <span class="badge badge-success">Approved</span>
                            @endif
                        </td>

                        <td>

                            @if ($invoicePending->status == 0)

                           
                            <a onclick="return confirm('Are you sure To Approved This Invoice')" href="{{ route('invoice.approve', $invoicePending->id) }}" class="btn btn-success btn-sm"><i class="fa fa-check-circle" aria-hidden="true"></i>Approve</a>

                            @endif
                           

                            <button class="btn btn-danger btn-sm" type="button" onclick="deleteItem({{ $invoicePending->id }})">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                              <form id="delete-form-{{ $invoicePending->id }}" action="{{ route('invoice.delete', $invoicePending->id) }}" method="post"
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
    function approveItem(id) {
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
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('approve-form-' + id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'Not Approved :)',
                    'error'
                )
            }
        })
    }

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
