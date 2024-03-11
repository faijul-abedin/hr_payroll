@extends('admin.employee.emp_index')
@section('emp_content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Attendance Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Attendance Report</a></li>
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
                <h3 class="card-title">Attendance Report</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover mt-3">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee ID</th>
                            <th>Is Present?</th>
                            <th>Is Late?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendance as $record)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}
                            </td>
                            <td>{{ $record->attendance_employee->employee_id }}</td>
                            <td>
                                @if ($record->is_present == 0)
                                <span class="badge badge-danger mr-2">No </span>
                                @else
                                <span class="badge badge-info mr-2">Yes </span>
                                @endif
                            </td>

                            <td>
                                @if ($record->is_late == 0)
                                <span class="badge badge-info mr-2">No </span>
                                @else
                                <span class="badge badge-danger mr-2">Yes </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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