<!-- resources/views/income_tax_disbursement/create.blade.php -->

@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">Create Income Tax Disbursement</div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-header text-end">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group">
                            <label for="employee_id">Employee</label>
                            <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">

                                <option value="" {{ old('employee_id') == 1 ? 'selected' : '' }}>Imon Faysal</option>

                            </select>
                            @error('employee_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}">
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-body">

    <div class="row mt-3">
        <div class="col-md-12">
            <form action="">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Type your keywords here" style="border-color: orange;">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="table-responsive">
        <table id="example2" class="table table-bordered table-hover mt-3">
            <thead>
                <tr style="background-color:whitesmoke">
                    <th>SL</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        Imon Faysal
                    </td>

                    <td>123000</td>
                    <td>
                        <input type="hidden" id="uid" value="">
                        <a class="btn btn-success text-white" href=""><i class="fas fa-edit"></i></a>
                        <button type="button" id="user_remove" class="btn btn-danger" data-bs-toggle="modal">
                            <i class="fas fa-trash"></i>
                        </button>

                    </td>
                </tr>


            </tbody>

        </table>
    </div>

</div>
@endsection