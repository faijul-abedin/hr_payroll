@extends('admin.layouts.dashboard')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All attendance</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">All Attendance Report</a></li>
                    <li class="breadcrumb-item active">Add Attendance</li>
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

                <div class="card-tools">
                    <a href="{{ route('get.attendance') }}" class="btn btn-sm btn-info">Get Attendance</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {{-- <table id="example2" class="table table-bordered table-hover mt-3">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Hours</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Designation</th>
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
                            <td>
                                {{ \Carbon\Carbon::parse($record->timestamp)->format('H:m:s') }}
                            </td>
                            <td>
                                @if ($record->type == 0)
                                    Entry
                                @elseif ($record->type == 1)
                                    Exit
                                @else
                                   <span class="text-red">Wrong</span> 
                                @endif
                            </td>
                            <td></td>
                            <td>{{ $record->attendance_employee->employee_id }}</td>
                            <td>{{ $record->attendance_employee->name }}</td>
                            <td>{{ $record->attendance_employee->Department->name }}</td>
                            <td>{{ $record->attendance_employee->Designation->name }}</td>
                            <td>
                                @if ($record->is_present == 0)
                                    <a data-toggle="modal" data-target="#isPresentStatus{{ $record->id }}"><span class="badge badge-danger mr-2">No </span></a>
                                @else
                                    <a data-toggle="modal" data-target="#isPresentStatus{{ $record->id }}"><span class="badge badge-info mr-2">Yes </span></a>
                                @endif
                            </td>
                            <td>
                                @if ($record->is_late == 0)
                                    <a data-toggle="modal" data-target="#isLateStatus{{ $record->id }}"><span class="badge badge-info mr-2">No </span></a>
                                @else
                                    <a data-toggle="modal" data-target="#isLateStatus{{ $record->id }}"><span class="badge badge-danger mr-2">Yes </span></a>
                                @endif
                            </td>
                            @include('admin.attendance.ispresent_modal')
                            @include('admin.attendance.islate_modal')
                        </tr>
                        @endforeach
                    </tbody>
                </table> --}}


                <table id="example2" class="table table-bordered table-hover mt-3">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Entry Time</th>
                            <th>Exit Time</th>
                            <th>Working Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendancePairs as $attendancePair)
                        <tr>
                            <td>{{ $attendancePair['date'] }}</td>
                            <td>{{ $attendancePair['employee'] }}</td>
                            <td>{{ $attendancePair['entry']->format('H:i:s') }}</td>
                            <td>{{ $attendancePair['exit']->format('H:i:s') }}</td>
                            <td>{{ $attendancePair['hours_worked'] }}</td>
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