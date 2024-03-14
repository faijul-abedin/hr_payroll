@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Finger Machine Setup</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Finger Machine Setup</li>
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
                <h3 class="card-title">Finger Machine Setup</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if ($setup)
                <form method="POST" action="{{route('setup.update')}}">
                    @csrf
                    <div class="row">

                        <input type="text" hidden name="id" class="form-control" value="{{ $setup->id }}" placeholder="Enter DNS" id="id">

                        <div class="form-group  col-md-12">
                            <input type="text" name="dns" class="form-control" value="{{ $setup->dns }}" placeholder="Enter DNS" id="dns">
                            @error('dns')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group  col-md-10">
                            <input type="text" name="port" class="form-control" value="{{ $setup->port }}" placeholder="Enter Port" id="port">
                            @error('port')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-0 col-md-2">
                            <div class="">
                                <button type="submit" class="btn btn-primary">Update Setup</button>
                            </div>
                        </div>
                    </div>
            </form>
                @endif
                
        </div>


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
    $(document).ready(function() {
        $('#employee_id').select2();
    });
</script>
@endsection