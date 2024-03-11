@extends('admin.layouts.dashboard')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}/">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Attendence Bonus Setting</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <form action="{{route('employee_bonus_upload')}}" method="post">
      @csrf
      <div class="card card-default">

        <!-- /.card-header -->
        <div class="card-body">

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="minimum_working_hours">Bonus Type:</label>
                <select class="form-control" name="bonus_type" required id="bonus_type">
                  <option>Select any type</option>

                  @foreach ($bonus as $item)
                  <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach

                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="attendance_threshold">Bonus Scale(%):</label>
                <input type="number" id="bonus_scale" class="form-control" disabled id="" style="background-color:whitesmoke" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="performance_metric">Action:</label>
                <input type="submit" class="btn  btn-primary form-control" value="ADD BONUS">
              </div>
            </div>
          </div>


          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="card-header">
            <input id="all_employee" type="checkbox"> <label for="all_employee">Apply for all Employees</label>
          </div>
          <table id="example2" class="table table-bordered table-hover mt-3">
            <thead>
              <tr>
                <th>Serial</th>
                <td>Employee ID</td>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($employee as $i=>$item)
              <tr>
                <td>{{$i+1}}</td>
                <td>{{$item->Employee->employee_id}}</td>
                <td>{{$item->Employee->name}}</td>
                <td>{{$item->Employee->Department->name}}</td>
                <td> <input type="checkbox" value="{{$item->Employee->id}}" class="employee" name="selected_employees[]"></td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </form>
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
<!-- AdminLTE App -->
<script>
  $(document).ready(function() {
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
    // When the "all_employee" checkbox is clicked
    $('#all_employee').on('click', function() {
      // Get the checked status of the "all_employee" checkbox
      var isChecked = $(this).prop('checked');

      // Set the checked status of all individual employee checkboxes to match the "all_employee" checkbox
      $('.employee').prop('checked', isChecked);
    });

    // When any individual employee checkbox is clicked
    $('.employee').on('click', function() {
      // Check if all individual employee checkboxes are checked
      var allChecked = $('.employee').length === $('.employee:checked').length;

      // Set the checked status of the "all_employee" checkbox to match all individual employee checkboxes
      $('#all_employee').prop('checked', allChecked);
    });
  });

  $('#bonus_type').on('change', function() {
    var selectedBonusType = $(this).val();

    $.ajax({
      url: '{{ route('get.bonus.details') }}',
      type: 'GET',
      data: {
        bonus_type: selectedBonusType
      },
      success: function(data) {
        $('#bonus_scale').val(data.bonus_scale);
        $('#bonus_details').val(data.details);
      },
      error: function(xhr, status, error) {
        // Handle errors if any
      }
    });
  });
</script>
@endsection