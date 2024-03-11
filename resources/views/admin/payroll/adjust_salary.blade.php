@extends('admin.layouts.dashboard')
@section('titel')
Generate Payment
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Generate Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payroll</li>
                        <li class="breadcrumb-item active">Generate Payment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div id="successmsg">
        @if (Session::has('error'))
        <div style="background-color: rgba(5, 145, 98, 0.271)" class="card text-center">
            <div class="card-body">
                <p class="card-text">{{ Session::get('error') }}</p>
                <button class="btn btn-primary" onclick="closeMsg()">Close</button>
            </div>
        </div>
        @endif
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    @csrf
                    <div class="card card-cyan">
                        <div class="row">
                            <div class="col-md-12 p-3 d-flex flex-column" style="gap:2rem;">
                                <div class="profile d-flex justify-content-between align-items-center bg-primary p-2">
                                    <label for="">Imon Faysal</label>

                                </div>

                            </div>

                        </div>
                        <div class="row px-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="annual_ctc">Annual CTC*</label>
                                    <input type="number" id="annual_ctc" name="annual_ctc" placeholder="Annual CTC" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basic_salary">Basic Salary*</label>
                                            <input type="number" id="basic_salary" name="basic_salary" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basic_type">Basic value type*</label>
                                            <select name="basic_type" id="basic_type" class="form-control">
                                                <option value="fixed">Fixed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.card -->
                    <!-- salry section started -->


                    <div class="payment_calculation">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th colspan="4" class="text-center">Earning</th>
                                </tr>
                                <tr class="bg-primary align-items-center">
                                    <td> <label for="">Salary Component</label></td>
                                    <td><label for="">Calculation Type</label></td>
                                    <td><label for="">Monthly Amount</label></td>
                                    <td> <label for="">Annual Amount</label></td>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><span>Basic Salary</span></td>
                                    <td><span>--</span></td>
                                    <td style="width:20%;"><input type=" text" class="form-control height-35 f-14" name="slack_username" id="monthly_amount" value="0.00" readonly=""></td>
                                    <td style="width:20%;"><input type="text" class="form-control height-35 f-14" name="slack_username" id="annual_amount" value="0.00" readonly=""></td>
                                </tr>
                                <tr>
                                    <td>Special Allowance</td>
                                    <td>Special Allowance</td>
                                    <td id="monthly_allowances">0.00</td>
                                    <td id="annual_allowances">0.00</td>
                                </tr>
                                <tr>
                                    <td><small>(Annual CTC - Sum of all other components)</small></td>
                                </tr>
                                <tr class="bg-primary">
                                    <td>
                                        <label>Gross Salary</label>
                                    </td>
                                    <td></td>
                                    <td id="monthly_gross">0.00</td>
                                    <td id="annual_gross">0.00</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center"><input type="submit" id="cal_sub" class="btn btn-primary" value="Save" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- salary section ended -->
                </form>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $(document).on('keyup', '#basic_salary', function() {
           
            let annual_ctc = $('#annual_ctc').val();
            let basic_salary = $(this).val();
            if (annual_ctc != '' && basic_salary != '') {
                $.ajax({
                    url: '{{route('payroll.adjust.partial')}}',
                    method: 'GET',
                    data: {
                        annual_ctc: annual_ctc,
                        basic_salary: basic_salary,
                    },
                    success: function(res) {
                        $('.payment_calculation').html(res);
                    }
                });
            } else {
                $('#cal_sub').attr('disabled', 'disabled');
            }
        });

        $(document).on('keyup', '#annual_ctc', function() {
            $('#basic_salary').val(0.00);
            $('#monthly_amount').val(0.00);
            $('#annual_amount').val(0.00);
            $('#monthly_allowances').html(0.00);
            $('#annual_allowances').html(0.00);
            $('#monthly_gross').html(0.00);
            $('#annual_gross').html(0.00);
            $('#cal_sub').attr('disabled', 'disabled');

        })

    });

    function closeMsg() {
        document.getElementById("successmsg").style.display = "none";
    }
</script>
@endsection