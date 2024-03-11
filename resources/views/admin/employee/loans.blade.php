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
                            <th>Amount</th>
                            <th>Due</th>
                            <th>Per Month</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loans as $record)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::parse($record->created_at)->format('Y-m-d') }}
                            </td>
                            <td>{{ $record->employeeLoan->employee_id }}</td>
                            <td>{{ $record->amount }}</td>
                            <td>{{ $record->due }}</td>
                            <td>{{ $record->per_month }}</td>
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