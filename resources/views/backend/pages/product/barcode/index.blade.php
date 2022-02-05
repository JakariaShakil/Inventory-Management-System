@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Products Barcode</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h2 class="text-secondary">Products Barcode</h2>
                </div>
                
                
            </div><!-- card-header -->
           
            <div class="card-body">
                
                    
                        <div class="row">
                            @foreach ($products_info as $product_info )
                            <div class="col-lg-3 col-md-4 col-sm-12 mt-3 text-center">
                                <div class="card">
                                    <div class="card-body text-center">
                                        @if (!is_null($product_info->barcode))
                                        <img src="{{ asset('Backend/img/product/barcode/' .$product_info->barcode) }}" alt="" height="60px" width="200">
                                        @else
                                          No Thumbnail
                                        @endif
                                        <h5 class="text-center text-dark mt-2">{{ $product_info->product_code }}</h5>
                                
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
        
                            @endforeach
                            
                               
                            
                        </div>

                   
                
              
                    
                    <div class="paginate mt-2">
                        {{   $products_info->links()  }}
                    </div>
                   
                    
               
                
            </div>
        

        </div>
    </div>

</div>


@endsection


