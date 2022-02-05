<!DOCTYPE html>
<html>
<head>
	<title>Purchase</title>
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}
</head>
<style>
    .body-main {
        background: #ffffff;
        border-bottom: 15px solid #1E1F23;
        border-top: 15px solid #1E1F23;
        margin-top: 30px;
        margin-bottom: 30px;
        padding: 40px 30px !important;
        position: relative;
        box-shadow: 0 1px 21px #808080;
        font-size: 10px
    }

    .main thead {
        background: #1E1F23;
        color: #fff
    }

    .img {
        height: 100px
    }

    h1 {
        text-align: center
    }
</style>

<body>
	
    
        
            <div class="row">
                <div class="col-md-6 col-md-offset-3 body-main">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4"> <img class="img" alt="Invoce Template"
                                    src="http://pngimg.com/uploads/shopping_cart/shopping_cart_PNG59.png" /> </div>
                            <div class="col-md-8 text-right">
                                <h4 style="color: #F81D2D;"><strong>SAIM</strong></h4>
                                <p>221 ,Baker Street</p>
                                <p>01601089623</p>
                                <p>jakariashakil28@gmail.com</p>
                            </div>
                        </div> <br />
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>PURCHASE INVOICE</h2>
                                <strong> ( {{ date('d-m-Y', strtotime($sdate)) }} - {{ date('d-m-Y', strtotime($edate)) }} )
                                </strong>
                                <!-- <h5>04854654101</h5> -->
                            </div>
                        </div> <br />
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>SL.</td>
                                        <td>Supplier Name</td>
                                        <td>Category Name</td>
                                        <td>Product Name</td>
                                        <td>Buying Quantity</td>
                                        <td>Unit Price</td>
                                        <td>Buying Price</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $subTotal = '0';
                                    @endphp
                                    @foreach($purchases as $key => $purchase)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $purchase->supplier->name }}</td>
                                        <td>{{ $purchase->category->name }}</td>
                                        <td>{{ $purchase->product->product_name }}</td>
                                        <td>{{ $purchase->buying_quantity }}</td>
                                        <td>{{ $purchase->unit_price }}</td>
                                        <td>{{ $purchase->buying_price }}</td>
                                    </tr>
                                    @php
                                    $subTotal += $purchase->buying_price;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td style="text-align: right; color:green;" colspan="6">Sub Total:-</td>
                                        <td style="color:green;">{{ $subTotal }}</td>
                                    </tr>
                                </tbody>
                            </table>
                           
                        </div>
                        <div>
                            <div class="col-md-12">
                                <p><b>Date :</b>  @php
                            $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                            @endphp</p> <br />
                                <p><b>Signature</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
    
</body>
</html>