@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add PayScale</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.index')}}">Add PayScale</a></li>
              <li class="breadcrumb-item active">Add PayScale</li>
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
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Department</label>
                            <select name="depertment" class="form-select" id="s_department">
                                <option value="">--Select Department--</option>
                                @foreach ($departments as $department)
                                  <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                                </select>
                        </div>
               
                    </div>  

                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Designation</label>
                            <select class="form-control" name="designation" id="s_designation" disabled>
                              <option value="">---Select Designation---</option>
                            </select>
                        </div>
               
                    </div>  

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Search</label>
                            <button id="get_employees" class="btn btn-success">Get Employees </button>
                        </div>
               
                    </div>

                </div>



                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody id="employee_table">
                      
                      <tr>
                        
                        
                        
                      </tr>
                      
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Action</th>
                      </tr>
                      </tfoot>
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
    <script src="/admin/plugins/jquery/jquery.min.js"></script>
    <script>

      jQuery(document).ready(function(){
  
            // Designation select start
            $('#s_department').on('change', function() {
              var department_id = $(this).val();
              if (department_id) {
                  $.ajax({
                      url: "{{route('select.designation.payscal')}}",
                      type: 'GET',
                      data: {
                          department_id: department_id,
                      },
                      success: function(data) {
                          $('#s_designation').empty();
                          $('#s_designation').removeAttr('disabled');
                          $.each(data, function(key, value) {
                              $('#s_designation').append('<option value="' + key + '">' +
                                  value + '</option>');
                          });
                      }
                  });
              } else {
                  $('#s_designation').empty();
                  $('#s_designation').attr('disabled');
              }
          });
          // Designation select end



          // Employee select start
          $('#get_employees').on('click', function() {
              var designation_id = $('#s_designation').val();
              if (designation_id) {
                  $.ajax({
                      url: "{{route('select.employee.payscal')}}",
                      type: 'GET',
                      data: {
                        designation_id: designation_id,
                      },
                      success: function(data) {
                          // $('#s_designation').empty();
                          // console.log(data.employees);
                          var rows = "";
                          $.each(data.employees, function(key,value){


                            rows += 
                            `<tr class="pt-30">

                            <td>${value.name}</td>
                            <td>${value.department.name}</td>
                            <td>${value.designation.name}</td>
                            <td>
                              <a class="btn btn-danger btn-sm" href="/salary/payscal/${value.id}"><i class="fa-solid fa-money-bill"></i></a>
                            </td>
                        
                            </tr> `


                          });
                          $('#employee_table').html(rows);
                      }
                  });
              } else {
                  $('#s_designation').empty();
                  // $('#s_designation').attr('disabled');
              }
          });
          // Employee select end
  
      });
  
  </script>

@endsection