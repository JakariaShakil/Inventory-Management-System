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
      <h4> Manage Employee Attendance</h4>

    </div>
  </div>

  <div class="br-pagebody">
    <div class="row row-sm">
        <div class="card col-md-12 shadow-base bd-0 mg-t-20 widget-4">
            <div class="card-header">
              <div class="hidden-xs-down">
                <h2 class="text-secondary">Add Employee Attendance</h2>
              </div>
              {{-- <div class="tx-24 hidden-xss-down">
                <a href="{{ route('employees.salary.view') }}" class="btn btn-info btn-sm float-right text-white"><i class="fa fa-list"></i>Employee List</a>
            
              </div> --}}
            </div><!-- card-header -->
            
            <form method="post" action="{{ route('store.employee.attendance') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
            
                        <div class="row">
                            <div class="col-md-6">
            
                                <div class="form-group">
                                    <h5>Attendance Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" required ="">
                                    </div>
                                </div>
            
                            </div> <!-- // End Col md 6 -->
                        </div> <!-- // end Row  -->
            
            
                        <div class="row">
                            <div class="col-md-12">
            
                                <table class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">Sl</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee List</th>
                                            <th colspan="3" class="text-center" style="vertical-align: middle; width: 30%">
                                                Attendance Status</th>
                                        </tr>
            
                                        <tr>
                                            <th class="text-center btn present_all"
                                                style="display: table-cell; background-color: #000000">Present</th>
                                            <th class="text-center btn leave_all"
                                                style="display: table-cell; background-color: #000000">Leave</th>
                                            <th class="text-center btn absent_all"
                                                style="display: table-cell; background-color: #000000">Absent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $key => $employee)
            
                                        <tr id="div{{$employee->id}}" class="text-center">
                                            <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                                            <td>{{ $key+1  }}</td>
                                            <td>{{ $employee->name }}</td>
            
                                            <td colspan="3">
                                                <div class="switch-toggle switch-3 switch-candy">
            
                                                    <input name="attend_status{{$key}}" type="radio" value="Present"
                                                        id="present{{$key}}" checked="checked">
                                                    <label for="present{{$key}}">Present</label>
            
                                                    <input name="attend_status{{$key}}" value="Leave" type="radio"
                                                        id="leave{{$key}}">
                                                    <label for="leave{{$key}}">Leave</label>
            
                                                    <input name="attend_status{{$key}}" value="Absent" type="radio"
                                                        id="absent{{$key}}">
                                                    <label for="absent{{$key}}">Absent</label>
            
                                                </div>
                                            </td>
                                        </tr>
            
                                        @endforeach
                                    </tbody>
                                </table>
            
                            </div> <!-- // End Col md 12 -->
                        </div> <!-- // end Row  -->
            
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