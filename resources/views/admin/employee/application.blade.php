@extends('admin.employee.emp_index')
@section('emp_content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Leave application</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('user.index')}}">Employee</a></li>
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
          <h3 class="card-title">Application Information</h3>
  
  
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{route('employee.application.save',session('key'))}}" method="post">
            @csrf
            <div class="row">

            
              <div class="col-md-4">
                <div class="form-group">
                  <label for="leaveType">Leave Type</label>
                  <select class="form-select" id="leaveType" name="type">
                    <option>Select Leave Type</option>
                    <option value="Vacation">Vacation</option>
                    <option value="Sick">Sick Leave</option>
                    <option value="Maternity">Maternity Leave</option>
                    <option value="Personal">Personal Leave</option>
                    <option value="Study">Study Leave</option>
                  </select>
                </div>
  
              </div>
  
              <div class="col-md-4">
                <div class="form-group">
                  <label for="duration">Duration</label>
                  <input type="number" class="form-control" id="duration" name="duration" placeholder="Enter Leave Duration">
                </div>
  
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dates">Start Date</label>
                  <input type="date" class="form-control" id="dates" name="start" placeholder="Enter Leave Start Date">
                </div>
  
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="leaveReason">Leave Reason</label>
                  <textarea class="form-control" id="leaveReason" rows="3" name="reason" placeholder="Enter Leave Reason..."></textarea>
                </div>
  
              </div>
              <div class="col-md-12">
                <div class="d-flex justify-content-end mt-1">
                  <button type="submit" class="btn btn-success">Apply for paid leave</button>
                </div>
  
              </div>
  
            </div>

        </div>
          </form>
  
  
  
          {{-- <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 ">Create</button>
                  </div> --}}
  
  
  
          <!-- /.row -->
        <!-- /.card-body -->
        <div class="card-footer">
  
        </div>
      </div>
      <!-- /.card -->
  
  </section>

  @endsection