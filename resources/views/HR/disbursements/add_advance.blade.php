@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add PayScal for this Employee</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.index')}}">Add PayScal</a></li>
              <li class="breadcrumb-item active">Add PayScal</li>
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

                  <form id="" method="post" action="{{ route('advance.salary.save',$employee->id) }}">
                    @csrf

                    <div class="row">

                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Salary</label>
                            @if ($employee->Salary)
                            <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{ $employee->Salary->rate }}" disabled>
                            @else
                            <input type="text" class="form-control text-danger" name="" id="" style="background-color:rgb(250, 230, 230)" value="Salary not added yet." disabled>
                            @endif
                        </div>
               
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Advance</label>
                            @if ($advance)
                            <input type="text" class="form-control text-danger" name="" id="" style="background-color:rgb(250, 230, 230)" value="{{ $advance->amount }}" disabled>
                            @else
                            <input type="text" class="form-control text-success" name="" id="" style="background-color:rgb(230, 255, 220)" value="No advance taken this month." disabled>
                            @endif
                        </div>
               
                    </div>    
    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Advance Amount</label>
                            <input type="number" class="form-control" name="amount" id="" required>
                        </div>
               
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Reason</label>
                            <input type="text" class="form-control" name="reason" id="" placeholder="Enter reason for advance..." required>
                        </div>
               
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end mb-3">
                            <button type="submit" class="btn btn-success">Pay Advance</button>
                        </div>
               
                    </div>

                    </div>

                  

                  </form>

                <hr/>


                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Employee</label>
                        <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{ $employee->name }}" disabled>
                    </div>
           
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Department</label>
                      <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{ $employee->Department->name }}" disabled>
                  </div>
         
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{ $employee->Designation->name }}" disabled>
                </div>
       
            </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{ $employee->contact }}" disabled>
                </div>
       
            </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Education</label>
                    <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="Fashin Designer(Diploma)" disabled>
                </div>
       
            </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="" id="" style="background-color:whitesmoke" value="{{ $employee->present_address }}" disabled>
                </div>
       
            </div>

    

                      
                </div>



                
                
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
@endsection