@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update user</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('user.index')}}">UserList</a></li>
                    <li class="breadcrumb-item active">Update User</li>
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
                <h3 class="card-title">Add User Information</h3>

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
                <form action="{{route('user.editsub')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="user_id" hidden value="{{$user->id}}">
                                <input type="text" class="form-control" name="name" value="{{ $user->name}}" required autocomplete="name" autofocus id="" style="background-color:whitesmoke">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Business Name</label>
                                <input type="text" class="form-control" value="{{ $user->business_name }}" required autocomplete="business_name" autofocus name="business_name" id="" style="background-color:whitesmoke">
                                @error('business_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus id="" style="background-color:whitesmoke">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact_number" value="{{ $user->contact_number }}" required autocomplete="contact_number" autofocus id="" style="background-color:whitesmoke">
                                @error('contact_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Second Contact Number</label>
                                <input type="text" class="form-control" name="second_contact_number" value="{{ $user->second_contact_number }}" required autocomplete="second_contact_number" autofocus id="" style="background-color:whitesmoke">
                                @error('second_contact_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value="{{ $user->address }}" required autocomplete="address" autofocus id="" style="background-color:whitesmoke">
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" value="{{ old('password') }}" autocomplete="password" autofocus id="" style="background-color:whitesmoke">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="text" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="password_confirmation" autofocus id="" style="background-color:whitesmoke">
                                @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image" value="" autocomplete="image" autofocus id="" style="background-color:whitesmoke">
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="row mt-2">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Assign Role</label>
                                <div class="select2-purple">
                                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                                        @foreach ($role as $role_user)
                                        <option value="{{ $role_user->name }}"
                                            {{ $user->hasRole($role_user->name) ? 'selected' : '' }}>
                                            {{ $role_user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 ">Update</button>
                    </div>


                </form>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>
        <!-- /.card -->

</section>
@endsection