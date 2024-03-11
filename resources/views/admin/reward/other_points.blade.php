@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Others Point Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('user.index')}}">UserList</a></li>
                    <li class="breadcrumb-item active">Other Point</li>
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
                <h3 class="card-title">Add other point for employee</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form method="POST" action="{{route('reward.point.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="employee_id">Employee</label>
                                <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                                    <option disabled selected value="">---Please Select Employee---</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->employee_id }} : {{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="loan_amount">{{ __('Point Category') }}</label>
                                <select name="point_category" id="point_category" class="form-control">
                                    <option disabled selected value="">---Select Point Category---</option>
                                    @foreach ($points_category as $category)
                                    <option value="{{$category->id}}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @error('loan_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="interest_rate">{{ __('Point Amount') }}</label>
                                <input id="point_amount" type="text" class="form-control @error('interest_rate') is-invalid @enderror" name="point_amount" value="0" readonly>

                                @error('interest_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">

                        <div class="col-md-4 offset-8">
                            <div class="form-group">
                                {{-- <label for="">Submit</label> --}}
                                <button type="submit" class="btn btn-success form-control ">Add Reward Point</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
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

        // Point Category select start
        $('#point_category').on('change', function() {
            var point_category = $(this).val();
                $.ajax({
                    url: "{{route('select.point_category')}}",
                    type: 'GET',
                    data: {
                        point_category : point_category,
                    },
                    success: function(data) {
                       $('#point_amount').val(data.point);
                    }
                });
        });
        // Point Category select end

    });
</script>
@endsection