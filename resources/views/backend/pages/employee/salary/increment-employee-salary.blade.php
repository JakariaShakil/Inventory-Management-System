@extends('backend.layout.template')

@section('body')
@if(session()->has('success'))

<script type="text/javascript">

 $(function(){
   $.notify("{{ session()->get('success') }}",{globalPosition:'top right',className:'success'});
 });

</script>

@endif

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Employee Salary</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Employee Salary Increment</h2>
              </div>
              <div class="tx-24 hidden-xss-down">
                <a href="{{ route('employees.salary.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Employee List</a>
            
              </div>
            </div><!-- card-header -->
           
            <form method="post" action="{{ route('update.increment.store',$editData->id) }}">
              @csrf
                     <div class="row">
                     <div class="col-12">	
    
            <div class="row">
              <div class="col-md-6">
         
             <div class="form-group">
             <h5>Salary Amount <span class="text-danger">*</span></h5>
             <div class="controls">
            <input type="text" name="increment_salary" class="form-control" > 
             </div>
              
           </div>
         
         
              </div> <!-- // end col md-6 -->
         
         
                <div class="col-md-6">
         
               <div class="form-group">
             <h5>Effected Date  <span class="text-danger">*</span></h5>
             <div class="controls">
            <input type="date"  name="effected_date" class="form-control" > 
             </div>
              
           </div>
                
              </div> <!-- // end col md-6 -->
              
            </div> <!-- // end row -->
         
            
                        
                     <div class="text-xs-right">
            <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit">
                     </div>
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