<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Document</title>
</head>
<body>
    


<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
           
           
            <div class="card-body">
                
                    
                        <div class="row">
                            @foreach ($products_info as $product_info )
                            <div class="col-lg-4 col-md-4 col-sm-12 mt-3 text-center">
                                <div class="card">
                                    <div class="card-body text-center">
                                        {{-- @if (!is_null($product_info->barcode))
                                        <img src="{{ asset('Backend/img/product/barcode/' .$product_info->barcode) }}" alt="" height="60px" width="200">
                                        @else
                                          No Thumbnail
                                        @endif --}}
                                        {!! $product_info->barcode !!}
                                        <h5 class="text-center text-dark mt-2">{{ $product_info->product_code }}</h5>
                                
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
        
                            @endforeach
                            
                               
                            
                        </div>

                   
                
                   
                    
               
                
            </div>
        

        </div>
    </div>

</div>
<script>
    setTimeout(() => {
        window.print()
    }, 100);
</script>
</body>
</html>