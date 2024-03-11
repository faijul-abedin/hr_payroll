


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
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Employee Id</th>
                      <th>Leave Type</th>
                      <th>Duration</th>
                      <th>Starting Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($leave as $item)
                    <tr>
                      <td>{{$item->leave_employee->employee_id}}</td>
                      <td>{{$item->type}}</td>
                      <td>{{$item->duration}} days</td>
                      <td>{{$item->start}}</td>
                      @if ($item->status === 'pending')
                      <td class="text-warning">
                          {{$item->status}}
                      </td>
                      @elseif ($item->status === 'Approved')
                      <td class="text-success">
                          {{$item->status}}
                      </td>
                      @elseif ($item->status === 'Rejected')
                      <td class="text-danger">
                          {{$item->status}}
                      </td>   
                      @endif
                      
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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