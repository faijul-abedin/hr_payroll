@extends('admin.layouts.dashboard')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Increment Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Increment Management</a></li>
                    <li class="breadcrumb-item active">Increment Management</li>
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
                <h1 class="card-title">Increment Management</h1>

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
                    <h3 class="mt-4">Increment Management</h3>
                
                    <form action="{{ route('increment.submit') }}" method="post" enctype="multipart/form-data" class="mt-4">
                        @csrf 
                        <div class="form-group row">
                            <label for="employeeName" class="col-sm-2 col-form-label">Employee Name:</label>
                            <div class="col-sm-10">
                                <select name="employee_id" id="mySelect" class="form-control @error('employee_id') is-invalid @enderror">
                                    <option value="">Please Select Employee</option>
                                    @foreach($employee as $employees) <!-- Changed variable name to $employees -->
                                        <option value="{{$employees->id}}">{{$employees->name}}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="currentSalary" class="col-sm-2 col-form-label">Current Salary:</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="CurrentSalary" name="salaryrate">
                                    <option value="">Select Current Salary</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="incrementPercentage" class="col-sm-2 col-form-label">Increment Percentage:</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('increment_rate') is-invalid @enderror" name="increment_rate" id="incrementPercentage" placeholder="Enter increment percentage">
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
              
              <h2>Increment List</h2>
              <ul class="late-list" id="late-list"></ul>
              <div class="card-body">
                              <table id="example2" class="table">
                                  <thead>
                                      <tr>
                                          <th scope="col">ID</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Previous Salary</th>
                                          <th scope="col">Current Salary</th>
                                          <th scope="col">Incremented Percentage (%)</th>
                                          <th scope="col">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($increment as $i=>$item)
                                      <tr>
                                          <th scope="row">{{$i+1}}</th>
                                          <td>{{$item->employeeIncrement->name}}</td>
                                          <td>{{$item->previousSalary}}</td>
                                            @if ($item->employeeIncrement->Salary)
                                            <td>{{ $item->employeeIncrement->Salary->rate }}</td>
                                            @else
                                            <td>Not Added</td>
                                            @endif

                                            @if ($item->increment_rate)
                                            <td>{{$item->increment_rate}}%</td>

                                            @else
                                            <td>Not Added</td>
                                            @endif

                                            <td>
                                                <a href="{{route('increment.edit',['id' => $item->id])}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                {{--<a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>--}}
                                            </td>
                                      </tr>
                                    @endforeach
                                      
                                  </tbody>
                              </table>
                              <!-- /.row -->
                          </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>
        <!-- /.card -->

</section>

<script src="/admin/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {
  $('#mySelect').select2();

  $('#mySelect').on('change', function() {
            let employee_id = $(this).val();
            if (employee_id) {
                $.ajax({
                    url: "{{route('select.salary')}}",
                    type: 'GET',
                    data: {
                        employee_id: employee_id,
                    },
                    success: function(data) {
                        $('#CurrentSalary').empty();
                        $('#CurrentSalary').removeAttr('disabled');
                        $.each(data, function(key, value) {
                            $('#CurrentSalary').append('<option value="' + key + '">' +
                                value + '</option>');
                        });
                    }
                });
            } else {
                $('#CurrentSalary').empty();
                $('#CurrentSalary').attr('disabled');
            }
        });

        $(function () {
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            });
        });
});



  



    
</script>


@endsection