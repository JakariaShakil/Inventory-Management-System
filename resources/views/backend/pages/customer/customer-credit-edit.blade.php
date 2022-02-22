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
                       
                        {{-- <div class="float-right">
                            <h3 class="mb-0">Invoice No: {{ $invoice->invoice_no }}</h3>
                            Date:{{ date('d-m-Y', strtotime($invoice->date)) }}
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            
                            {{-- <div class="col-sm-12 ">
                                
                                <h3 class="text-dark mb-1">Customer Name: {{ $invoice->payment->customer->name }}</h3>
                                <div>Customer Mobile:  {{ $invoice->payment->customer->mobile }}</div>
                                <div>Customer Email: {{ $invoice->payment->customer->email }}</div>
                                <div>Customer Adddress: {{ $invoice->payment->customer->address }}</div>
                                
                            </div> --}}
                        </div>
                        <div class="table-responsive-sm">
                            <form method="post" action="{{ route('customer.credit.update', $payment->invoice_id) }}">
                                @csrf
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="center">SL</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
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
                                        @foreach($invoice_details as $key =>  $invoice_detail)
                      
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $invoice_detail->category->name }}</td>
                                        <td>{{ $invoice_detail->product->product_name }}</td>
                                        <td>{{ $invoice_detail->selling_quantity }}</td>
                                        <td>{{ $invoice_detail->unit_price }}</td>
                                        <td>{{ $invoice_detail->selling_price }}</td>
                                    </tr>
                                    @php
                                    $subTotal += $invoice_detail->selling_price;
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
                                            <td class="right">{{ $payment->discount_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Paid Amount:</strong>
                                            </td>
                                            <td class="right">{{ $payment->paid_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <input type="hidden" name="new_paid_amount" value="{{ $payment->due_amount }}">
                                                <strong class="text-dark">Due Amount:</strong>
                                            </td>
                                            <td class="right">{{ $payment->due_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Total</strong> </td>
                                            <td class="right">
                                                <strong class="text-dark">{{ $payment->total_amount }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!---- Three Colum Field start ---->
                                <div class="form-row">
                                  <!-- Paind Status Filed Start -->
                                  <div class="col-md-12">
                                   <div class="form-group">
                                     <label><strong>Paid Status</strong></label>
                                     <select name="paid_status" class="form-control form-control" id="paid_status">
                                       <option value="">*Select Paid status*</option>
                                       <option value="full_paid">Full Paid</option>
                                       <option id="partial_paid" value="partial_paid">Partial Paid</option>
                                     </select>
                                     <!--- After Partial Paid --->
                                     <br>
                                     <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Write Partial Amount" style="display: none;"> 
                                     {{-- @error('update_date')
                                     <strong class="alert alert-danger">{{ $message }}</strong>
                                     @enderror --}}
                                   </div>
                                  </div>
                                 
                
                                 <!-- Customer Filed Start -->
                                  <div class="col-md-12">
                                   <div class="form-group">
                                     <label><strong>Select Date</strong></label>
                                     <input type="date" name="date" class="form-control"  placeholder="dd-mm-yyyy">
                                     @error('date')
                                     <strong class="alert alert-danger">{{ $message }}</strong>
                                     @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <input type="submit" name="submit" value="Update" class="btn btn-info" style="margin-top: 29px;">
                                    </div>
                                  </div>
                                </div><!-- end row -->
                                
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
   
   <script type="text/javascript">
    $(document).ready(function () {
        // Paid Status //
        $(document).on('change', '#paid_status', function () {
            var paid_status = $(this).val();
            if (paid_status == 'partial_paid') {
                $('.paid_amount').show();
            } else {
                $('.paid_amount').hide();
            }
        });
    
    });
</script>
 

    @endpush

