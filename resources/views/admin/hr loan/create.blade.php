@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>HR Loan Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('user.index')}}">UserList</a></li>
                    <li class="breadcrumb-item active">HR Loan</li>
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
                <h3 class="card-title">Create HR Loan</h3>

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

                <form method="POST" action="{{route('loan.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="employee_id">Employee</label>
                                <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                                    <option disabled selected value="">Please Select</option>
                                    @foreach ($employee as $item)
                                    <option value="{{$item->Employee->id}}">{{$item->Employee->name."(".$item->Employee->employee_id.")"}}</option>
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
                                <label for="loan_amount">{{ __('Loan Amount') }}</label>
                                <input id="loan_amount" type="text" class="form-control @error('loan_amount') is-invalid @enderror" name="loan_amount" value="" style="background-color:whitesmoke">

                                @error('loan_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="interest_rate">{{ __('Interest Rate') }}</label>
                                <input id="interest_rate" type="text" class="form-control @error('interest_rate') is-invalid @enderror" name="interest_rate" value="" style="background-color:whitesmoke">

                                @error('interest_rate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">




                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="repayment_term">{{ __('Repayment Term') }}</label>
                                <select class="form-control @error('repayment_term') is-invalid @enderror" name="repayment_term" id="repayment_term">
                                    <option disabled selected value="">Select repayment term</option>
                                    <option value="Month">Month</option>
                                    <option value="Year">Year</option>
                                </select>

                                @error('repayment_term')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="loan_year">{{ __('Loan Year/Month') }}</label>
                                <input id="loan_year" type="number" class="form-control @error('loan_year') is-invalid @enderror" name="loan_year" value="" style="background-color:whitesmoke">

                                @error('loan_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Submit</label>
                                <button type="submit" class="btn btn-primary form-control ">Create Loan</button>
                            </div>
                        </div>
                    </div>






            </div>

            <!-- Additional form fields for installment frequency, etc. -->


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
    });
</script>
@endsection