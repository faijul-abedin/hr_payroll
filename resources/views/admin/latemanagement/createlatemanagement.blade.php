@extends('admin.layouts.dashboard')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Late Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Late Management</a></li>
                    <li class="breadcrumb-item active">Add Latemanagement</li>
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
                <h3 class="card-title">Late Management</h3>

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
                <form class="late-form row" action="{{route('absence.deduction')}}" method="post">
                    @csrf
                    <div class="form-group col-md-4">
                        <label for="name">Name:</label>
                        <select required name="employee_id" id="employee_id" class="form-control">
                            <option>Search Employee</option>
                            @foreach ($salary as $item)
                            <option value="{{$item->Employee->id}}">{{$item->Employee->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="year">Year:</label>
                        <input name="year" type="number" class="form-control" id="year" value="{{ now()->year }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="month">Month:</label>
                        <select name="month" class="form-control" id="month">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="total_working_days">Total Working days:</label>
                        <input required type="number" readonly class="form-control" id="total_working_days">
                    </div>
                    <div class="form-group col-md-1 mt-4 d-flex align-items-center justify-content-between">
                        <i class="fa-solid fa-minus"></i>

                    </div>
                    <div class="form-group col-md-3">
                        <label for="leave">Leave count:</label>
                        <input required type="number" readonly class="form-control" id="leave">
                    </div>
                    <div class="form-group col-md-1 mt-4 d-flex align-items-center justify-content-between">
                        <i class="fa-solid fa-equals"></i>

                    </div>
                    <div class="form-group col-md-3">
                        <label for="expected">(Expected Working days:</label>
                        <input required type="number" readonly class="form-control" id="expected">
                    </div>
                    <div class="form-group col-md-1 mt-4 d-flex align-items-center justify-content-between">
                        <i class="fa-solid fa-minus"></i>

                    </div>
                    <div class="form-group col-md-3">
                        <label for="attendance">Attendance count):</label>
                        <input required type="number" readonly class="form-control" id="attendance">
                    </div>
                    <div class="form-group col-md-1 mt-4 d-flex align-items-center justify-content-between">
                        <i class="fa-solid fa-plus"></i>

                    </div>
                    <div class="form-group col-md-3">
                        <label for="late">Late count:</label>
                        <input required readonly type="number" class="form-control" id="late">
                    </div>
                    <div class="form-group col-md-1 mt-4 d-flex align-items-center justify-content-between">
                        <i class="fa-solid fa-divide"></i>
                        <h5>3</h5>
                    </div>
                    <div class="form-group col-md-1 mt-4 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-equals"></i>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="total_deductions">Total deduction days:</label>
                        <input readonly type="number" required name="total_deductions" class="form-control" id="total_deductions">
                    </div>
                    <div class="d-flex justify-content-end"> <button type="submit" class="btn btn-primary ">Submit</button></div>

                </form>


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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#employee_id").change(function() {
            fetchEmployeeCounts();
        });

        $("#year, #month").change(function() {
            fetchEmployeeCounts();
        });

        function fetchEmployeeCounts() {
            var employeeId = $("#employee_id").val();
            var year = $("#year").val();
            var month = $("#month").val();

            if (employeeId !== "Search Employee") {
                // Make an AJAX request to fetch attendance and late counts for the selected employee
                $.ajax({
                    url: "/fetch_employee_counts",
                    type: "GET",
                    data: {
                        employee_id: employeeId,
                        year: year,
                        month: month
                    },
                    success: function(data) {
                        $("#total_working_days").val(data.total_days);
                        $("#leave").val(data.leave_count);
                        $("#attendance").val(data.attendance_count);
                        $("#late").val(data.late_count);
                        var deduction_day = data.late_count / 3;
                        var expected_working_days = data.total_days - data.leave_count;
                        $("#expected").val(expected_working_days);
                        $("#total_attendance").val(deduction_day);
                        var total_deductions = (expected_working_days - data.attendance_count) + deduction_day;
                        $("#total_deductions").val(total_deductions.toFixed(2));
                    },
                    error: function(error) {
                        console.error("Error fetching data:", error);
                    }
                });
            } else {
                $("#attendance").val("");
                $("#late").val("");
                $("#total_attendance").val("");
            }
        }
    });
</script>
@endsection