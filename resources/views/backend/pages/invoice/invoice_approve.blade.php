@extends('backend.layout.template')
@push('css')
<style>


.padding {
    padding: 2rem !important
}

.card {
    margin-bottom: 30px;
    border: none;
    -webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
    -moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
    box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
}

.card-header {
    background-color: #fff;
    border-bottom: 1px solid #e6e6f2
}

h3 {
    font-size: 20px
}

h5 {
    font-size: 15px;
    line-height: 26px;
    color: #3d405c;
    margin: 0px 0px 15px 0px;
    font-family: 'Circular Std Medium'
}

.text-dark {
    color: #3d405c !important
}
</style>
    
@endpush

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Manage Products</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">

            
            <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
                <div class="card">
                    <div class="card-header p-4">
                       
                        <div class="float-right">
                            <h3 class="mb-0">Invoice No: {{ $invoice->invoice_no }}</h3>
                            Date:{{ date('d-m-Y', strtotime($invoice->date)) }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            
                            <div class="col-sm-12 ">
                                
                                <h3 class="text-dark mb-1">Customer Name: {{ $invoice->payment->customer->name }}</h3>
                                <div>Customer Mobile:  {{ $invoice->payment->customer->mobile }}</div>
                                <div>Customer Email: {{ $invoice->payment->customer->email }}</div>
                                <div>Customer Adddress: {{ $invoice->payment->customer->address }}</div>
                                
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <form method="post" action="{{ route('invoice.approval.store', $invoice->id) }}">
                                @csrf
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">SL</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th class="right">Current Stock</th>
                                        <th class="center">Quantity</th>
                                        <th class="right">Unit Price</th>
                                        <th class="right">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @php 
                                        $subTotal = '0';
                                        @endphp
                                        @foreach($invoice['invoiceDetails'] as $key => $invoices)
                      
                                        <input type="hidden" name="category_id[]" value="{{ $invoices->category_id }}">
                      
                                        <input type="hidden" name="product_id[]" value="{{ $invoices->product_id }}">
                      
                                        <input type="hidden" name="selling_quantity[{{ $invoices->id }}]" value="{{ $invoices->selling_quantity }}">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $invoices->category->name }}</td>
                                        <td>{{ $invoices->product->product_name }}</td>
                                        <td>{{ $invoices->product->quantity }}</td>
                                        <td>{{ $invoices->selling_quantity }}</td>
                                        <td>{{ $invoices->unit_price }}</td>
                                        <td>{{ $invoices->selling_price }}</td>
                                    </tr>
                                    @php
                                    $subTotal += $invoices->selling_price;
                                    @endphp
                                  @endforeach
                                    
                                </tbody>
                            </table>
                            </div>
                         <div class="row">
                            <div class="col-lg-4 col-sm-5">
                            </div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Subtotal</strong>
                                            </td>
                                            <td class="right">{{ $subTotal }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Discount</strong>
                                            </td>
                                            <td class="right">{{ $invoice->payment->discount_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Paid Amount:</strong>
                                            </td>
                                            <td class="right">{{ $invoice->payment->paid_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Due Amount:</strong>
                                            </td>
                                            <td class="right">{{ $invoice->payment->due_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Total</strong> </td>
                                            <td class="right">
                                                <strong class="text-dark">{{ $invoice->payment->total_amount }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="button">
                                    <input type="submit" name="submit" value="Invoice Approved" class="btn btn-info">
                                </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
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
