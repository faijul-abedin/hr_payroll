@extends('admin.layouts.dashboard')

<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">



@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Salary List</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Salary List</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section> 


<!-- modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pay to Employee</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="card-body">
              <form method="POST" action="{{route('pay.complete')}}">
                  @csrf

                  <div class="form-group">
                      <label for="employee_id">Payment Method</label>
                      <select class="form-control @error('employee_id') is-invalid @enderror" id="mySelect" name="employee_id">
                          <option value="">Cash On Payment</option>
                          <option value="">Bkash Payment</option>
                          <option value="">Bank Payment</option>
                      </select>
                      @error('employee_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>

                  <div class="row">

                    <input type="hidden" id="payroll_id"  name="payroll_id"/>

                    <div class="form-group col-md-6">
                      <label for="hours">Employee Id</label>
                      <input type="text" class="form-control @error('hours') is-invalid @enderror" id="emp_id" name="hours">
                      @error('hours')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>

                  <div class="form-group col-md-6">
                      <label for="rate">Employee Name</label>
                      <input type="text" class="form-control @error('rate') is-invalid @enderror" id="emp_name" name="rate">
                      @error('rate')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="form-group col-md-6">
                      <label for="rate">Total Salary</label>
                      <input type="text" class="form-control @error('rate') is-invalid @enderror" id="emp_salary" name="rate">
                      @error('rate')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="form-group col-md-6">
                      <label for="rate">Date</label>
                      <input type="text" class="form-control @error('rate') is-invalid @enderror" id="date" name="rate">
                      @error('rate')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>

                  <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Pay This Employee</button>
                  </div>

                  </div>

                  

              </form>
          </div>
      </div>
  </div>
</div>
<!-- end modal -->


    <section class="content">

      
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
                      {{-- <a href="{{ route('delete.payscal',$salary->id) }}" class="btn btn-sm btn-danger"><i class="fa-regular fa-trash-can"></i></a> --}}
                      
                      @if ($employee->status === 'unpaid')
                      <a href="javascript:void(0)"  data-url="{{route('salary.view',$employee->id)}}" id="id"><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Pay Now <i class="fa-solid fa-money-bill"></i></button>
                        @elseif ($employee->status === 'paid')
                        <a class="btn btn-success btn-sm disabled" href="">Pay Now</a>
                        @endif

                      <a href="{{ route('salary.print',$employee->id) }}" class="btn btn-sm btn-danger"><i class="fa-solid fa-print"></i></a>
    
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
{{-- <script src="/admin/dist/js/adminlte.min.js"></script> --}}

<script>
    $(function () {
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
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>

<script>
  $(document).ready(function() {
  $('body').on('click', '#id', function(){
      var urlData = $(this).data('url');
      $.get(urlData, function(data) {
      $('#exampleModalEdit').modal('show');
      $('#payroll_id').val(data.id);
      // $('#doctor_name').val(data.doctor_name);
      // $('#salary').val(data.salary);
      $('#emp_id').val(data.emp_id);
      $('#emp_name').val(data.name);
      $('#emp_salary').val(data.salary);
      $('#date').val(data.date);
                
  });
  });
});
</script>

@endsection