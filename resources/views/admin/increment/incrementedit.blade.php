@extends('admin.layouts.dashboard')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Increment Update</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('increment.add')}}">Increment Management</a></li>
                    <li class="breadcrumb-item active">Update Increment</li>
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
                <h1 class="card-title">Manage Increment Update</h1>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="container">
                    <h3 class="mt-4">Update</h3>
                
                    <form action="{{route('increment.update',['id' => $increments->id])}}" method="post" enctype="multipart/form-data" class="mt-4">
                        @csrf 
                        <div class="form-group row">
                            <label for="employeeName" class="col-sm-2 col-form-label">Employee Name:</label>
                            <div class="col-sm-10">

                              <input type="hidden" name="employee_in" value="{{ $increments->employee_id }}">
                                
                                <input type="text" class="form-control" name="employee_id" value="{{ $increments->employeeIncrement->name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currentSalary" class="col-sm-2 col-form-label">Previous Salary:</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="previoussalaryrate" value="{{ $previousSalary }}" disabled>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="currentSalary" class="col-sm-2 col-form-label">Current Salary:</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="CurrentSalary" name="salaryrate" value="{{ $increments->employeeIncrement->Salary->rate }}" disabled>
                                
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="incrementPercentage" class="col-sm-2 col-form-label">Incremented Percentage (%):</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('increment_rate') is-invalid @enderror" value="{{$increments->increment_rate}}" name="increment_rate" id="incrementPercentage" placeholder="Enter increment percentage">
                                @error('increment_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Calculate Increment</button>
                            </div>
                        </div>
                    </form>

                
                    <div id="result" class="mt-4"></div>
                  </div>
              
              
            </div>
            <!-- /.card-body -->
            
        </div>
        <!-- /.card -->

</section>



@endsection