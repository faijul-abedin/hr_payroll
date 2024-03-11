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
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">View Employee Informations</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{route('employee.create')}}"><button type="button" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add
                        </button></a>
                </div>
                
        
          
                
                <div class="table-responsive mt-4">
                  <table id="example1" class="table table-bordered table-hover mt-3">
                    <thead>
                    <tr style="background-color:whitesmoke">
                      <th>SL</th>
                      <th>Employee Id</th>
                      <th>Employee Name</th>
                      <th>Designation</th>
                      <th>Department</th>
                      <th>Joining</th>
                      <th class="no-print">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($employees as $key => $employee)
                        
                      
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $employee->employee_id }}</td>
                      <td>{{ $employee->name }}</td>
                      <td>{{ $employee->Designation->name }}</td>
                      <td>{{ $employee->Department->name }}</td>
                      <td>{{ $employee->starting }}</td>
                      <td class="no-print">
                          <input type="hidden" id="uid" value="">
                          <a class="btn btn-success text-white"
                              href="{{route('employee.edit.view',$employee->id)}}"><i class="fas fa-edit"></i></a>
                              <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$employee->id}}"><i class="fa-regular fa-trash-can"></i></a>
                          
                      </td>

                      <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Confirmation Messege</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <!-- <span aria-hidden="true">&times;</span> -->
                              </button>
                            </div>
                            <div class="modal-body">
                            Are you sure want to delete this Employee?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              <a href="{{route('employee.delete',$employee->id)}}" type="button" class="btn btn-danger">Delete</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>

                    @endforeach
                    
                  
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>SL</th>
                      <th>Employee Id</th>
                      <th>Employee Name</th>
                      <th>Designation</th>
                      <th>Department</th>
                      <th>Joining</th>
                      <th class="no-print">Action</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    
    <script src="/admin/plugins/jquery/jquery.min.js"></script>
    <script>
        $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
    </script>
@endsection