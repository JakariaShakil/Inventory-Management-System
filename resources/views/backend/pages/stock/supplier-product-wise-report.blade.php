@extends('backend.layout.template')

@section('body')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
        <h4>Manage Supplier/Product Wise Stock</h4>

    </div>
</div>

<div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4" style="min-height: 80vh">
            <div class="card-header">
                <div class="hidden-xs-down">
                    <h2 class="text-secondary">Supplier/Product Wise Stock</h2>
                </div>
               
            </div><!-- card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                      <label>
                        <strong>Supplier Wise Report</strong>
                      </label>
                      <input type="radio" name="supplier_wise" value="supplier_wise"  class="search_value">
                      &nbsp; &nbsp;

                     
                    </div>
             

                  </div>
                  <div class="row justify-content-center">
                      <!---- supplier wais Report start ---->
                <div id="supplier" style="margin-top: 25px; display: none;" >
                    <form method="GET" action="{{ route('stock.supplier.report.pdf') }}" target="_blank" class="d-flex"  data-parsley-validate="" >
                      <div class="form-row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>Supplier Name</label>
                                <select name="supplier_id" class="form-control select_class"  required="" style="width:100%">
                                  <option value="">
                                  *Select Supplier*
                                  </option>
                                  @foreach($suppliers as $supplier)
                                  <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                  </option>
                                  @endforeach
                               </select>
                                 @error('supplier_id')
                                 <strong class="alert alert-danger">{{ $message }}
                                 </strong>
                                 @enderror
                            </div> 
                          </div>
                      </div>
                        
                        <div class="col-sm-4">
                          <div class="form-group">
                            <input type="submit" class="btn btn-info mt-4" value="Search">
                          </div> 
                        </div>
                      
                    </form>
                  </div>
                <!---- supplier wais Report End ---->

                  </div>
                
               
               
                
        </div>

    </div>

</div>


@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
      $('#supplierWiseForm').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })
      .on('form:submit', function() {
        return false; // Don't submit form for this demo
      });
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
          // supplier wais //
          $(document).on('change','.search_value', function(){
            var searchValue = $(this).val();
            if(searchValue == 'supplier_wise'){
              $('#supplier').show();
            } else{
              $('#supplier').hide();
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
