@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Manage Stocks</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h2 class="text-secondary">Products Stock List</h2>
                </div>
                <div class="tx-24 hidden-xss-down">
                    
                             <a target="_blank" class="btn btn-info btn-sm float-right text-white" href="{{ route('stock.report.pdf') }}"><i class="fa fa-download"></i>Download Stock PDF</a>

                </div>
            </div><!-- card-header -->
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                  <thead>
                    <tr>
                      <th>SL.</th>
                      <th>Supplier Name</th>
                      <th>Product Category</th>
                      <th>Product Name</th>
                      <th>Purchase (Stock)</th>
                      <th>Sell Qty</th>
                      <th>Current Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($products as $key => $product)
                     @php 
                     $purchase_stock = App\Purchase::where('category_id', $product->category_id)->where('product_id',$product->id)->where('status', '1')->sum('buying_quantity');
                      $selling_stock  = App\invoiceDetail::where('category_id',$product->category_id)->where('product_id', $product->id)->where('status', '1')->sum('selling_quantity');
                     @endphp
                     <tr>
                       <td>{{ $key+1 }}</td>
                       <td>{{ $product['supplier']['name'] }}</td>
                       <td>{{ $product->category->name }}</td>
                       <td>{{ $product->product_name }}</td>
                       <td>
                        {{ $purchase_stock }}
                       {{ $product['unit']['name'] }}
                     </td>
                       <td>
                         {{ $selling_stock }}
                         {{ $product['unit']['name'] }}
                       </td>
                       <td>
                        {{ $product->quantity }}
                        {{ $product['unit']['name'] }}
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




@endpush
