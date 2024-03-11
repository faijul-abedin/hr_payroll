@extends('admin.employee.emp_index')
@section('emp_content')


<div class="page-content"> 
    <!--breadcrumb-->
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1>Employee Profile</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Employee Profile</li>
            </ol>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{url('/admin/images/employees/'.$profileData->photo)}}" alt="Admin" class="rounded-circle p-1 bg-dark" width="110" height="100">
                                <div class="mt-3">
                                    <h4>{{ $profileData->name }}</h4>
                                    {{-- <p class="text-secondary mb-1">Full Stack Developer</p> --}}
                                    <p class="text-muted font-size-sm">{{ $profileData->email }}</p>
                                </div>
                            </div>
                            <hr class="my-1" />
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <p class="text-bold">Department</p>
                                    <p class="text-bold text-success">{{ $profileData->Department->name }}</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <p class="text-bold">Designation</p>
                                    <p class="text-bold text-success">{{ $profileData->Designation->name }}</p>
                                </li>
                                
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <p class="text-bold">Contact</p>
                                    <p class="text-bold text-success">{{ $profileData->contact }}</p>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <p class="text-bold">Basic</p>
                                    <p class="text-bold text-success">{{ $profileData->Salary->rate }}</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <p class="text-bold">Shift</p>
                                    <p class="text-bold text-success">{{ $profileData->Shift->name }}</p>
                                </li>
                                
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">

                        {{-- <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data"> --}}
                            @csrf
                            
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control" value="{{ $profileData->name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Employee ID</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control" value="{{ $profileData->employee_id }}" />
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">User Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="username" class="form-control" value="{{ $profileData->username }}" readonly />
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email" class="form-control" value="{{ $profileData->email }}" />
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" class="form-control" value="{{ $profileData->phone }}" />
                                    </div>
                                </div> --}}
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control" value="{{ $profileData->present_address }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Merital Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control" value="{{ $profileData->marital_status }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nationality</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control" value="{{ $profileData->nationality }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Referance</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control" value="{{ $profileData->ref_1 }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Joining Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control" value="{{ $profileData->starting }}" />
                                    </div>
                                </div>
                                {{-- <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" name="image" class="form-control" id="image"
                                                placeholder="User Image">
                                    </div>
                                </div> --}}
    
                                {{-- <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                    <img src="{{ (!empty($profileData->image)) ? url('backend/images/users/'.$profileData->image):url('backend/images/users/no_user.png')}}" id="show_image" alt="Admin" style="width: 90px; height: 90px" width="110">
                                        
                                    </div>
                                </div> --}}
    
                                {{-- <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary d-flex justify-content-end">
                                        <input type="submit" class="btn btn-warning px-4" value="Save Changes" />
                                    </div>
                                </div> --}}
                            </div>

                        {{-- </form> --}}



                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

