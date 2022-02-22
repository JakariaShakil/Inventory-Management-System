@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Product Details</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h2 class="text-secondary">Product Details</h2>
                </div>
                <div class="tx-24 hidden-xss-down">
                    <a href="{{ route('products.add') }}" class="btn btn-info btn-sm float-right mr-2 text-white"><i
                            class="fa fa-plus-circle "></i>Add Product</a>
                     
    

                </div>
            </div><!-- card-header -->
            <div class="card-body">
                <div class="d-flex justify-content-center container mt-5">
                    <div class="card p-3 bg-white">
                        
                        <div class="about-product text-center mt-2"><img src="{{  asset('Backend/img/product/'.$product->product_image) }}" width="300">
                            <div>
                                <h4>{{ $product->product_name }}</h4>
                                <h6 class="mt-0 text-black-50">Product Code:{{ $product->product_code}}</h6>
                                {!! $product->barcode !!}
                            </div>
                        </div>
                        <div class="stats mt-2">
                            <div class="d-flex justify-content-between p-price"><span>Quantity</span><span>{{ $product->quantity }}</span></div>
                            <div class="d-flex justify-content-between p-price"><span>Buying Price</span><span>{{ $product->unit_buying_price }}</span></div>
                            <div class="d-flex justify-content-between p-price"><span>Selling Price</span><span>{{ $product->unit_selling_price }}</span></div>
                            <div class="d-flex justify-content-between p-price"><span>Supplier</span><span>{{ $product->supplier->name }}</span></div>
                            <div class="d-flex justify-content-between p-price"><span>Brand</span><span>{{ $product->brand->name }}</span></div>
                        </div>
                        {{-- <div class="d-flex justify-content-between total font-weight-bold mt-4"><span>Total</span><span>$7,197.00</span></div> --}}
                    </div>
                </div>  
                
        </div>

    </div>

</div>


@endsection


