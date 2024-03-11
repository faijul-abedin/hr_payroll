
@extends('admin.employee.emp_index')
@section('emp_content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Application List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Employe Application</a></li>
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
                <h3 class="card-title">All Applications</h3>
            </div>
            <!-- /.card-header -->
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DataTable with minimal features & hover style</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Serial</th>
                      <th>Employee ID</th>
                      <th>Employee</th>
                      <th>Departmnet</th>
                      <th>Salary Total</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
    
                      @foreach ($employees as $key => $employee)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $employee->Employee->employee_id }}</td>
                        <td>{{ $employee->Employee->name }}</td>
                        <td>{{ $employee->Employee->Department->name }}</td>
                        <td>{{ $employee->total }}</td>
                        <td>
                            @if ($employee->status === 'unpaid')
                                <span class="badge badge-danger">{{ $employee->status }}</span>
                            @elseif ($employee->status === 'paid')
                                <span class="badge badge-success">{{ $employee->status }}</span>
                            @endif
                        </td>
                        <td class="">
                          <a href="{{ route('employee.print',$employee->id) }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-print"></i></a>
                        </td>
                      </tr>
    
                      @endforeach
                      
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Serial</th>
                        <th>Employee ID</th>
                        <th>Employee</th>
                        <th>Departmnet</th>
                        <th>Salary Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
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