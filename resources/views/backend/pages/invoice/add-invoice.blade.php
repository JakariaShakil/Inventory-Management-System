@extends('backend.layout.template')

@section('body')

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"
    integrity="sha512-RNLkV3d+aLtfcpEyFG8jRbnWHxUqVZozacROI4J2F1sTaDqo1dPQYs01OMi1t1w9Y2FdbSCDSQ2ZVdAC8bzgAg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Add Invoice</h4>

    </div>
</div>

<div class="container">
    <div class="row  col-md-12">
        <div class="card col-md-6">
            <div class="card-header">
                <!-- <div class="hidden-xs-down">
                    <h2 class="text-secondary">Add Invoice</h2>
                </div> -->
                <div class="tx-24 hidden-xss-down">
                    <a href="{{ route('invoice.view') }}" class="btn btn-info btn-sm float-right text-white"><i
                            class="fa fa-list"></i>Invoice List</a>

                </div>
            </div><!-- card-header -->

            {{-- card start here --}}



            <div class="card-body">

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Invoice No.</label>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control form-control-sm"
                            readonly style="background-color: #D8FDBA;" value="{{ $invoiceData }}">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" id="date" value="{{ $date }}" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="category_id" class="form-control select_class" id="category_id">
                            <option label="Select Category" value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <strong class="alert alert-danger">{{ $message }}
                        </strong>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Brand Name</label>
                        <select class="form-control select_class" name="brand_id" id="brand_id">
                            <option label="Select Brand" value="" disabled selected>Select Brand</option>
                        </select>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Product</label>
                        <select name="product_id" class="form-control select_class" id="product_id">
                            <option label="Select Brand" value="" disabled selected>Select Product</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Stock(pcs/kg)</label>
                        <input type="text" name="current_stock_qty" id="current_stock_qty"
                            class="form-control form-control-sm " readonly style="background-color: #D8FDBA;">

                        <input type="hidden" name="unit_selling_price" id="unit_selling_price" value="0" >
                        
                    </div>
                </div>

                <div class="col-md-12">
                    
                        <button class="btn btn-info btn-sm" id="addeventmore" style="margin-top:25px" type="submit"
                            value="submit"><i class="fa fa-plus-circle"></i>Add Item</button>
                    
                </div>

            </div>


        </div>
    



    
        <div class="card col-md-6">
         
          
            <div class="card-body">
                <form method="post" action="{{ route('invoice.store') }}" id="myForm">
                    @csrf
                    <table class="table-sm table table-responsive" width="100%">
                        <thead class="" style="background-color: #f1e390">
                            <tr>
                                <th  width="10%" >Category</th>
                                <th  width="10%">Product</th>
                                <th width="10%">Pcs</th>
                                <th width="15%">Sell Price</th>
                                <th width="17%">Total Price</th>
                                <th width="6%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="addRow" class="addRow">

                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-right">Discount Amount</td>
                                <td>
                                    <input type="number" name="discount_amount" id="discount_amount"
                                        class="form-control" placeholder="Discount">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4" class="text-right">Grand Total</td>
                                <td>
                                    <input type="text" name="estimated_ammount" value="0" id="estimated_ammount"
                                        class="form-control form-control-sm text-right estimated_ammount" readonly
                                        style="background-color: #D8FDBA">
                                </td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>
                    <br>
                    <!---- Description Field start ---->
                    <div class="form-row">
                        <div class="col-lg-12">
                            <textarea class="form-control" rows="3" placeholder="Write Something About Invoice"
                                name="description" id="description"></textarea>
                        </div>
                    </div>
                    <!---- Description Field End ---->
                    <br>
                    <!---- Three Colum Field start ---->
                    <div class="form-row">
                        <!-- Paind Status Filed Start -->

                        <div class="form-group col-md-5">
                            <label><strong>Paid Status</strong></label>
                            <select name="paid_status" class="form-control form-control-sm select_class"
                                id="paid_status">
                                <option value="">*Select Paid status*</option>
                                <option value="full_paid">Full Paid</option>
                                <option value="full_due">Full Due</option>
                                <option id="partial_paid" value="partial_paid">Partial Paid</option>
                            </select>
                            <!--- After Partical Paid --->
                            <br><br>
                            <input type="text" name="paid_amount" class="form-control paid_amount"
                                placeholder="Write Partial Amount" style="display: none;">
                        </div>

                        <!-- Paind Status Filed Start -->

                        <!-- Customer Filed Start -->

                        <div class="form-group col-md-7">
                            <label><strong>Select Customer</strong></label>
                            <select name="customer_id" class="form-control select_class" id="customer_id">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }} | {{ $customer->mobile }} | {{ $customer->address }}
                                </option>
                                @endforeach
                                <option value="0">New Customer</option>
                            </select>
                            <!--- After New Customer Start --->
                            <br><br>
                            <div class="new_customer" style="display: none;">
                                <strong>New Customer Information Field</strong>
                                <input type="text" name="name" class="form-control" placeholder="Customer Name">
                                <br>
                                <input type="text" name="mobile" class="form-control"
                                    placeholder="Customer Mobile">
                                <br>
                                <input type="text" name="address" class="form-control" placeholder="Customer Adddress">
                            </div>
                            <!--- After New Customer End --->
                        </div>

                        <!-- Customer Filed End -->
                    </div><!-- end row -->
                    <!---- Three Colum End ---->

                    <br>

                    <button type="submit" class="btn btn-info btn-block" id="storeButton">Sell</button>
                </form>
            </div>
        </div>


    
  </div>
</div>
@endsection


@push('scripts')


<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">

      <input type="hidden" name="date" value="@{{date}}">
      <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
     
      <input type="hidden" name="brand_id[]" value="@{{brand_id}}">

      <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
        @{{category_name}}
    </td>
    
    <td>
        <input type="hidden" name="product_id[]" class="product_id" value="@{{product_id}}">
        @{{product_name}}
    </td>

      <td>
          <input type="number" min="1" max="@{{current_stock_qty}}" class="form-control form-control-sm text-right selling_quantity" name="selling_quantity[]" value="1">
      
      </td>

      <td>
          <input type="text"  class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="@{{ unit_price }}" readonly>
      
      </td>

   
      <td>
          <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="@{{ unit_price }}" readonly>
      </td>

      <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i> </td>

  </tr>

</script>


<script type="text/javascript">
    $(document).on('click', '#addeventmore', function () {

        $('.table').show();

        var date = $('#date').val();
        var invoice_no = $('#invoice_no').val();
        var category_id = $('#category_id').val();
        //var category_name = $('#category_id').find('option:selected').text();
        var category_name = $("#category_id option:selected").text();
        var brand_id = $('#brand_id').val();
        var unit_price = $('#unit_selling_price').val();

        var product_id = $('#product_id').val();
        //var product_name= $('#product_id').val().find('option:selected').text();
        var product_name = $("#product_id option:selected").text();
        var current_stock_qty = $('#current_stock_qty').val();

    


        // validation
        if (date == '') {
            $.notify("Date is required", {
                globalPosition: 'top right',
                className: 'error'
            });
            return false;
        }
        if (category_id == null || category_id == '') {
            $.notify("Category is required", {
                globalPosition: 'top right',
                className: 'error'
            });
            return false;
        }

        if (brand_id == null || brand_id == '') {
            $.notify("Brand is required", {
                globalPosition: 'top right',
                className: 'error'
            });
            return false;
        }
        if (product_id == null || product_id == '') {
            $.notify("Product is required", {
                globalPosition: 'top right',
                className: 'error'
            });
            return false;
        }

        

        if (current_stock_qty ==  0 ) {
            $.notify("Product out of stock!!", {
                globalPosition: 'top right',
                className: 'error'
            });
            return false;
        }
        var is_exists=false;

        $('.product_id').each(function () {
            var value = $(this).val();
           //console.log(value);
            if (value ==  product_id ) {
                    $.notify("This Product already added", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    is_exists=true;
                    return false;
            }

        });


        if(!is_exists) {
            var source = $("#document-template").html();
            var template = Handlebars.compile(source);

            var data = {
                date: date,
                invoice_no: invoice_no,
                category_id: category_id,
                category_name: category_name,
                brand_id: brand_id,
                product_id: product_id,
                product_name: product_name,
                unit_price: unit_price,
                current_stock_qty:current_stock_qty

            }

            var html = template(data);
            $("#addRow").append(html)

            total_ammount_price();
        }
    });

    //remove handlebar
    $(document).on('click', '.removeeventmore', function (event) {
        $(this).closest('.delete_add_more_item').remove();
        total_ammount_price();
    });
    // Handlebar Multificaion
    $(document).on('keyup click', '.selling_quantity', function () {

        var unit_price = $(this).closest("tr").find("input.unit_price").val();
        var quantity = $(this).closest("tr").find("input.selling_quantity").val();
        var total = unit_price * quantity;

        $(this).closest("tr").find("input.selling_price").val(total);
        // Discount 
        $('#discount_amount').trigger('keyup');

        total_ammount_price();
    });

    // Discount Script
    $(document).on('keyup click', '#discount_amount', function () {
        total_ammount_price();
    });

    function total_ammount_price() {
        var sum = 0;
        //sum
        $('.selling_price').each(function () {
            var value = $(this).val();
           
            if (value.length != 0) {
                sum += parseFloat(value);
            }
        });
        // Discount
        var discount_amount = parseFloat($('#discount_amount').val());
        if (!isNaN(discount_amount) && discount_amount.length != 0) {
            sum -= parseFloat(discount_amount);
        }
        $('#estimated_ammount').val(sum);
    }
</script>




<script type="text/javascript">
    $(function () {
        $(document).on('change', '#supplier_id', function () {
            var supplier_id = $(this).val();
            $.ajax({
                url: "{{ route('get-category')}}",
                type: "GET",
                dataType: "json",
                data: {
                    supplier_id: supplier_id
                },

                // data:{supplier_id:supplier_id},
                success: function (data) {
                    // var html ='<option value="">Select Category</option>';
                    $("#category_id").empty();
                    $("#category_id").append(
                        '<option value="">Select Category</option>');
                    $.each(data, function (key, value) {
                        $("#category_id").append('<option value="' + value
                            .category_id + '"">' + value.category.name +
                            '</option>');
                    })
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $(document).on('change', '#category_id', function () {
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('get-brand')}}",
                type: "GET",
                dataType: "json",
                data: {
                    category_id: category_id
                },

                // data:{supplier_id:supplier_id},
                success: function (data) {
                    // var html ='<option value="">Select Category</option>';

                    $("#brand_id").empty();
                    $("#brand_id").append('<option value="">Select Brand</option>');
                    $.each(data, function (key, value) {
                        $("#brand_id").append('<option value="' + value
                            .brand_id + '"">' + value.brand.name +
                            '</option>');
                    })
                }
            });
        });
    });
</script>


<script type="text/javascript">
    $(function () {
        $(document).on('change', '#brand_id', function () {
            var brand_id = $(this).val();
            var category_id = $('#category_id').val();

            $.ajax({
                url: "{{ route('get-product')}}",
                type: "GET",
                dataType: "json",
                data: {
                    brand_id: brand_id,
                    category_id: category_id
                },

                // data:{supplier_id:supplier_id},
                success: function (data) {
                    // var html ='<option value="">Select Category</option>';
                    $("#product_id").empty();
                    $("#product_id").append('<option value="">Select Product</option>');
                    $.each(data, function (key, value) {
                        $("#product_id").append('<option value="' + value.id +
                            '"">' + value.product_name + '</option>');
                    })
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#product_id', function () {
            var product_id = $(this).val();
            $.ajax({
                url: "{{ route('check-product-stock') }}",
                type: "GET",
                data: {
                    product_id: product_id
                },
                success: function (data) {
                    $('#current_stock_qty').val(data.stock);
                    $('#unit_selling_price').val(data.unit_selling_price);
                   
                }
            });
        });
    });
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
        // New Customer //
        $(document).on('change', '#customer_id', function () {
            var customer_id = $(this).val();
            if (customer_id == '0') {
                $('.new_customer').show();
            } else {
                $('.new_customer').hide();
            }
        });
    });
</script>




<script type="text/javascript">
    $(document).ready(function () {
        $('.select_class').select2();
    });
</script>


@endpush