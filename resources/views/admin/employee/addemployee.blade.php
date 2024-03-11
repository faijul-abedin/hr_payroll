@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Employee</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('user.index')}}">UserList</a></li>
                <li class="breadcrumb-item active">Add Employee</li>
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
          <h3 class="card-title">Add Employee Information</h3>

          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
              </button>
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <form id="formId" method="post" action="{{ route('employee.save') }}" enctype="multipart/form-data">
            @csrf

          <div class="row">
              <div class="col-md-6">

                  <div class="card card-success">
                      <div class="card-header">
                          <h3 class="card-title">Personal Details</h3>
                      </div>
                      <div class="card-body">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                              <label>Name:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input type="text" class="form-control @error('employee_name') is-invalid @enderror" name="employee_name" id="" placeholder="Employee Name">
                                  @error('employee_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              <!-- /.input group -->
                          </div>
                          <!-- /.form group -->

                          
                          <div class="form-group">
                              <label>Date of Birth:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                  </div>
                                  <input type="date" class="form-control @error('birth') is-invalid @enderror" name="birth" id="">
                                  @error('birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           
                          </div>
                          
                          <div class="form-group">
                              <label>Gender:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-venus"></i></span>
                                  </div>
                                  <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="">
                                    <option disabled selected value="">Please Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                  </select>
                                  @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              
                          </div>

                          <div class="form-group">
                              <label>Phone 1*:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                  </div>
                                  <input type="number" placeholder="Phone 1" class="form-control @error('phone_1') is-invalid @enderror" name="phone_1" id="">
                                  @error('phone_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              <!-- /.input group -->
                          </div>

                          <div class="form-group">
                              <label>Phone 2:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                  </div>
                                  <input type="number" placeholder="Phone 2" class="form-control" name="phone_2" id="">
                              </div>
                              <!-- /.input group -->
                          </div>

                          <div class="form-group">
                              <label>Present Address*:</label>

                              <div class="input-group">
                                <div class="input-group">
                                    
                                    <textarea class="form-control @error('present_address') is-invalid @enderror" placeholder="Present Address" name="present_address" id=""></textarea>
                                    @error('present_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              </div>
                              <!-- /.input group -->
                          </div>

                          <div class="form-group">
                              <label>Permanent Address*:</label>

                              <div class="input-group">
                                  
                                  <textarea class="form-control @error('permanent_address') is-invalid @enderror" placeholder="Permanent Address" name="permanent_address" id=""></textarea>
                                  @error('permanent_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              <!-- /.input group -->
                          </div>

                          <div class="form-group">
                              <label>Nationality:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                  </div>
                                  <input type="text" placeholder="Nationality" class="form-control @error('nationality') is-invalid @enderror" name="nationality" id="">
                                  @error('nationality')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           
                          </div>

                          <div class="form-group">
                              <label>Reference 1:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input type="text" placeholder="Reference Name 2" class="form-control" name="rer_1" id="">
                              </div>
                           
                          </div>
                          <div class="form-group">
                              <label>Reference Phone 1*:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                  </div>
                                  <input type="number" placeholder="Reference Phone 1" class="form-control" name="ref_1_phone" id="">
                              </div>
                              <!-- /.input group -->
                          </div>

                          <div class="form-group">
                              <label>Reference 2:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input type="text" placeholder="Reference Name 2" class="form-control" name="rer_2" id="">
                              </div>
                           
                          </div>
                          <div class="form-group">
                              <label>Reference Phone 2*:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                  </div>
                                  <input type="number" class="form-control" placeholder="Reference Phone 2" name="ref_1_phone" id="">
                              </div>
                              <!-- /.input group -->
                          </div>

                          <div class="form-group">
                              <label>Marital Status:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class=""></i></span>
                                  </div>
                                  <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" id="">
                                    <option value=""> Select Status </option>
                                    <option value="Married">Married</option>
                                    <option value="Unmarried">Unmarried</option>
                                    
                                  </select>
                                  @error('marital_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                              
                          </div>

                          <div class="form-group">
                              <label>Photo:</label>

                              <div class="input-group">
                                  <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="">
                                  @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           
                          </div>

                          

                            



                           
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->


                  <!-- /.card -->

              </div>
              <!-- /.col (left) -->
              <div class="col-md-6">
                  <div class="card card-info">
                      <div class="card-header">
                          <h3 class="card-title">Account Login</h3>
                      </div>
                      <div class="card-body">

                          <!-- Color Picker -->
                          <div class="form-group">
                              <label>Email:</label>

                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                  </div>
                                  <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              </div>
                           
                          </div>
                          <!-- /.form group -->

                          <!-- time Picker -->
                          <div class="bootstrap-timepicker">
                              <div class="form-group">
                                  <label>Password:</label>

                                  <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <div class="input-group-append">
                                          <div class="input-group-text"><i class="fas fa-key"></i></div>
                                        </div>
                                        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id=""/>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                                  <!-- /.input group -->
                              </div>
                              <!-- /.form group -->
                          </div>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <div class="col-md-12">
                      <div class="card card-primary">
                          <div class="card-header">
                              <h3 class="card-title">Company Details</h3>
                          </div>
                          <div class="card-body">
                             
                              {{-- <div class="form-group">
                                  <label>Employee Id:</label>
                                  <div class="input-group">
                                      <input type="text" placeholder="Unique Employee ID" name="employee_id" class="form-control"/>
                                      
                                  </div>
                              </div> --}}
                              
                              <div class="form-group">
                                  <label>Department:</label>
                                  <div class="input-group">
                                      <select class="form-control @error('department') is-invalid @enderror" name="department" id="department">

                                        <option value="">---Select Department---</option>
                                        @foreach ($department as $dp)
                                        <option value="{{ $dp->id }}">{{ $dp->name }}</option> 
                                        @endforeach

                                      </select>
                                      @error('department')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                              </div>

                             
                              <div class="form-group">
                                  <label>Designation:</label>
                                  <div class="input-group">
                                      <select class="form-control @error('designation') is-invalid @enderror" name="designation" id="designation">
                                        <option value="">---Select Designation---</option>
                                      </select>
                                      @error('designation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label>Date of Joining:</label>
                                  <div class="input-group">
                                      <input type="date" class="form-control @error('join_date') is-invalid @enderror" name="join_date" id=""/>
                                       @error('join_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label>Date of Leaving:</label>
                                  <div class="input-group">
                                      <input type="date" class="form-control @error('leave_date') is-invalid @enderror" name="leave_date" id=""/>
                                      @error('leave_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                              </div>

                              {{-- <div class="form-group">
                                  <label>Manager:</label>
                                  <div class="input-group">
                                      <select class="form-control" name="manager_id" id="">
                                        <option>select</option>
                                        <option>Faisal Ahmed</option>
                                        <option>Sabbir Rahman</option>
                                      </select>
                                      
                                  </div>
                              </div> --}}
                              <div class="form-group">
                                  <label>Shift:</label>
                                  <div class="input-group">
                                      <select class="form-control @error('shift') is-invalid @enderror" name="shift" id="">
                                        <option value="">---Select Shift---</option>
                                        @foreach ($shift as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option> 
                                        @endforeach
                                      </select>
                                      @error('shift')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                              </div>
                              <div class="form-group mb-5">
                                  <label>Status:</label>
                                  <div class="input-group">
                                      <select class="form-control @error('status') is-invalid @enderror" name="status" id="">
                                        <option disabled selected value="">Please Select</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                      </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                              </div>


                              <div class="form-group">
                                <label>Comment:</label>
  
                                <div class="input-group">
                                  <div class="input-group">
                                      
                                      <textarea class="form-control" name="comment" id="" placeholder="Write some comments"></textarea>
                                  </div>
                                </div>
                                
                            </div>
                              
                              <!-- /.form group -->
                          </div>
                          <div class="card-footer">
                              
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->




                  </div>
                  <!-- /.col (right) -->
              </div>
              <!-- /.row -->



              <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">

          </div>

          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success mt-4 pr-4 pl-4 ">Save</button>
        </div>

        </form>

        </div>
      <!-- /.card -->
        
                
</section>

<script src="/admin/plugins/jquery/jquery.min.js"></script>

<script>

    jQuery(document).ready(function(){

          // Designation select start
          $('#department').on('change', function() {
            var department_id = $(this).val();
            if (department_id) {
                $.ajax({
                    url: "{{route('select.designation')}}",
                    type: 'GET',
                    data: {
                        department_id: department_id,
                    },
                    success: function(data) {
                        $('#designation').empty();
                        $('#designation').removeAttr('disabled');
                        $.each(data, function(key, value) {
                            $('#designation').append('<option value="' + key + '">' +
                                value + '</option>');
                        });
                    }
                });
            } else {
                $('#designation').empty();
                $('#designation').attr('disabled');
            }
        });
        // Designation select end

    });

</script>

@endsection