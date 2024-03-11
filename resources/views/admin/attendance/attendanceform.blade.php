@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Employee</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Employee List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<section class="content">

    <!-- Default box -->
    <form action="{{route('attendance.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">View Employee Informations</h3>

                <div class="card-tools">
                    <input type="submit" class="btn btn-primary" value="Apply attendance">
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive mt-4">
                    <table id="example2" class="table table-bordered table-hover mt-3">
                        <thead>
                            <tr style="background-color:whitesmoke">
                                <th>SL</th>
                                <th>Employee Id</th>
                                <th>Employee Name</th>
                                <th>Designation</th>
                                <th>Department</th>

                                <th>

                                    <input type="checkbox" class="employee" id="all_employee" name="selected_employees"> <label for="all_employee">Select All</label>
                                </th>
                                <th>Is late?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee as $key => $employee)


                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $employee->employee_id }}
                                    <input type="hidden" value="{{$employee->id}}" name="em_id[]">
                                </td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->Designation->name }}</td>
                                <td>{{ $employee->Department->name }}</td>

                                <td>
                                    <input type="checkbox" value="1" class="employee" name="selected_employees[]">

                                </td>
                                <td>
                                    <input type="checkbox" value="1" class="late" name="late[]">
                                </td>
                            </tr>

                            @endforeach


                        </tbody>

                    </table>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
    </form>
    <!-- /.card -->

</section>

<script src="/admin/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#all_employee').on('click', function() {
            var isChecked = $(this).prop('checked');
            $('.employee').prop('checked', isChecked);
        });
        $('.employee').on('click', function() {
            // Check if all individual employee checkboxes are checked
            var allChecked = $('.employee').length === $('.employee:checked').length;

            // Set the checked status of the "all_employee" checkbox to match all individual employee checkboxes
            $('#all_employee').prop('checked', allChecked);
        });
        $('.late').on('click', function() {
            // Get the row containing the clicked 'late' checkbox
            const row = $(this).closest('tr');

            // Find the 'employee' checkbox within the same row and set its state
            const employeeCheckbox = row.find('.employee');
            employeeCheckbox.prop('checked', this.checked);
        });
    });
    $(function() {
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
</script>
@endsection