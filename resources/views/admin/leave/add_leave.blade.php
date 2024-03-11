@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add Leave for this Employee</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('user.index')}}">Add Leave</a></li>
          <li class="breadcrumb-item active">Add Leave</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Employee Information</h3>


      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="{{route('leave.store',$employee->id)}}" method="post">
          @csrf
          <div class="row">
            @if ($activities->count()>0)


            <div class="col-md-12">
              <div class="form-group">
                <label class="text-danger" for="duration">This Emplyee already have taken {{$activities->count()}} leave in this month.</label>
              </div>

            </div>
            @endif
            <div class="col-md-3">
              <div class="form-group">
                <label for="leaveType">Leave Type</label>
                <select class="form-select @error('type') is-invalid @enderror" id="leaveType" name="type">
                <option disabled selected value="">Select Leave Type</option>
                  <option value="Vacation">Vacation</option>
                  <option value="Sick">Sick Leave</option>
                  <option value="Maternity">Maternity Leave</option>
                  <option value="Personal">Personal Leave</option>
                  <option value="Study">Study Leave</option>
                </select>
                @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="duration">Duration</label>
                <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" placeholder="Enter Leave Duration">
                @error('duration')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="dates">Start Date</label>
                <input type="date" class="form-control @error('start') is-invalid @enderror" id="dates" name="start" placeholder="Enter Leave Start Date">
                @error('start')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="payment_status">Paid/Unpaid</label>
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="payment_status">
                  <option disabled selected value="">Please Select</option>
                  <option value="Paid">Paid</option>
                  <option value="Unpaid">Unpaid</option>
                </select>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="leaveReason">Leave Reason</label>
                <textarea class="form-control @error('reason') is-invalid @enderror" id="leaveReason" rows="3" name="reason" placeholder="Enter Leave Reason..."></textarea>
                @error('reason')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

            </div>
            <div class="col-md-4" id="d_rate"></div>

            <div class="form-group" id="deductionRateField" style="display: none;">
              <label for="leaveReason">Deduction amount(day)</label>
              <input id="deduction" value="{{$per_day_salary}}" name="deduction" class="form-control" type="number">
            </div>
            <div class="col-md-2">
              <div class="d-flex justify-content-end mt-5">
                <button type="submit" class="btn btn-success">Setup Leave</button>
              </div>

            </div>

            <hr />
            <div class="col-md-4">
              <div class="form-group">
                <label>Employee</label>
                <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{$employee->name}}" disabled>
              </div>

            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Department</label>
                <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{$employee->Department->name}}" disabled>
              </div>

            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Designation</label>
                <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{$employee->Designation->name}}" disabled>
              </div>

            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{$employee->contact}}" disabled>
              </div>

            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nationality</label>
                <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{$employee->nationality}}" disabled>
              </div>

            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Present Address</label>
                <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{$employee->present_address}}" disabled>
              </div>

            </div>




          </div>
        </form>



        {{-- <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 ">Create</button>
                </div> --}}



        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">

      </div>
    </div>
    <!-- /.card -->

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#payment_status').on('change', function() {
      if ($(this).val() === 'Unpaid') {
        $('#d_rate').append($('#deductionRateField'));
        $('#deductionRateField').show();
      } else {
        $('#deductionRateField').hide();
      }
    });
  });
</script>

@endsection