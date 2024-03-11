@extends('admin.layouts.dashboard')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}/">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add Leave Page</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('user.index')}}">Add Leave</a></li>
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
        <h3 class="card-title">Employee Information</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <!-- <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Department</label>
              <select name="depertment" class="form-select" id="subcategory">
                <option>Select Department</option>
                <option> Department 1</option>
                <option> Department 2</option>
                <option> Department 3</option>
                <option> Department 4</option>
              </select>
            </div>

          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Designation</label>
              <select name="depertment" class="form-select" id="subcategory">
                <option>Select Designation</option>
                <option> Designation 1</option>
                <option> Designation 2</option>
                <option> Designation 3</option>
                <option> Designation 4</option>
              </select>
            </div>

          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>Search</label>
              <input type="text" placeholder="Search Employee for add Leave" class="form-control" name="" id="" style="background-color:whitesmoke">
            </div>

          </div>
        </div> -->



        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($employee as $i=>$item)
              <tr>
                <td>{{$item->Employee->employee_id}}</td>
                <td>{{$item->Employee->name}}</td>
                <td>{{$item->Employee->Department->name}}</td>
                <td>{{$item->Employee->Designation->name}}</td>

                <td>
                  <a class="btn btn-danger btn-sm" href="{{ route('leave.payscal',$item->Employee->id) }}">Add Leave</a>
                </td>
              </tr>
              @endforeach

            </tbody>

          </table>
        </div>


        <!-- /.col -->

        {{-- <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 ">Create</button>
                </div> --}}



        <!-- /.row -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer">

      </div>
    </div>
    <!-- /.card -->

</section>
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/admin/plugins/jszip/jszip.min.js"></script>
<script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin/plugins/jquery/jquery.min.js"></script>

<script>

  $(function() {
    //   $("#example1").DataTable({
    //     "responsive": true, "lengthChange": false, "autoWidth": false,
    //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "autoHeight": true,
    });
  });
</script>
@endsection