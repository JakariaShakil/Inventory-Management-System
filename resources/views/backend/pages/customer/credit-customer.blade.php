@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4> Credit Customers</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h2 class="text-secondary"> Credit Customers List</h2>
                </div>
                <div class="tx-24 hidden-xss-down">
                    <a href="{{ route('customers.credit.pdf') }}" target="_blank" class="btn btn-info btn-sm float-right text-white"><i
                            class="fa fa-download"></i>Download Pdf</a>

                </div>
                
            </div><!-- card-header -->
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                      <tr>
                        <th>SL.</th>
                        <th>Customer Info</th>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Credit Amount</th>
                        <th>Action</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                        @php
                        $subTotal = '0';
                        @endphp
                        @foreach($customersCreditDetails as $key => $payment)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>
                            {{ $payment->customer->name }} -
                            {{ $payment->customer->address }} -
                            {{ $payment->customer->mobile }}
                          </td>
                          <td>Invoice No #{{ $payment->invoice->invoice_no }}</td>
                          <td>{{ date('d-m-Y', strtotime($payment->invoice->date)) }}</td>
                          <td>{{ $payment->due_amount }} TK.</td>
                          <td>
                            <a title="Edit" class="btn btn-info" href="{{ route('customer.credit.edit', $payment->invoice_id) }}"><i class="fa fa-edit"></i></a>
                            {{-- <a target="_blank" title="Details" class="btn btn-success" href="{{ route('customer.credit.summery', $payment->invoice_id) }}"><i class="fa fa-eye"></i></a>  --}}
                          </td>
                        </tr>
                        @php 
                        $subTotal += $payment->due_amount;
                        @endphp
                        
                      @endforeach
                      <div class="txt text-warning">
                        Total Due Amount :{{   $subTotal }}
                    </div>
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
