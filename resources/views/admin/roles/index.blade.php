@extends('admin.layouts.dashboard')

@section('content')



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Roles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<br><br>
<section class="content">
    <div id="successmsg">
        @if (Session::has('msg'))
        <div style="background-color: rgba(5, 145, 98, 0.271)" class="card text-center">
            <div class="card-body">
                <p class="card-text">{{ Session::get('msg') }}</p>
                <button class="btn btn-primary" onclick="closeMsg()">Close</button>
            </div>
        </div>
        @endif
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 id="tlabel" class="card-title">Roles</h3>

                    {{-- <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 350px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th width="5%">SL</th>
                                <th width="10%">Name</th>
                                <th width="40%">Permissions</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role )
                            <tr>
                                <td>{{$loop->index +1}}</td>
                                <td>{{$role->name}}</td>

                                <td>
                                    @foreach ($role->permissions as $rp )
                                    <span class="badge badge-info mr-2">{{$rp->name}}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <input type="hidden" id="uid" value="{{$role->id}}">
                                    <a class="btn btn-success text-white" href="{{route('admin.roles.edit',$role->id)}}"><i class="fa-regular fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$role->id}}"><i class="fa-regular fa-trash-can"></i></a>

                                </td>

                            </tr>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirmation Messege</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <!-- <span aria-hidden="true">&times;</span> -->
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        Are you sure want to delete this role?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="{{route('role.delete',$role->id)}}" type="button" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card -->
            </div>
        </div>
</section>



@endsection