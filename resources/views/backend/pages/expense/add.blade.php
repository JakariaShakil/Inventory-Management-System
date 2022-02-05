@extends('backend.layout.template')

@section('body')
{{-- @if(session()->has('success'))

<script type="text/javascript">

 $(function(){
   $.notify("{{ session()->get('success') }}",{globalPosition:'top right',className:'success'});
 });

</script>

@endif --}}

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Add Expense</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Add Expense</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('expenses.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Expenses List</a>
            
              </div>
            </div><!-- card-header -->
           
            <form role="form" action="{{ route('expenses.store') }}" method="post">
                @csrf
                <div class="br-section-wrapper">
                    <div class="form-layout form-layout-1">
                      <div class="row mg-b-25">
                        <div class="form-group col-md-5">
                            <label>Expense Title</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Expense Title">
                        </div>
                        <div class="form-group col-md-5">
                            <label>Expense Amount</label>
                            <input type="number" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="Enter Expense Amount">
                        </div>
                        <div class="col-md-2 form-group">
                            <button type="submit" class="btn btn-info" style="margin-top:30px">Add Expense</button>
                        </div>
                    

                      </div>
                    </div>
                </div>
                            
                <!-- /.card-body -->

                
            </form>
            
          </div>

    </div>

  </div>

  <script type="text/javascript">
    $(function () {
      $('#form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })
      .on('form:submit', function() {
        return false; // Don't submit form for this demo
      });
    });
    </script>
  
@endsection

