@extends('admin.layouts.dashboard')
@section('titel')
Generate Payslip
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="container">
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Generate Payslip</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payroll</li>
                        <li class="breadcrumb-item active">Generate Payslip</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
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
    <!-- modal started -->
    <!-- Button trigger modal -->
    <!-- Modal 1 started -->
    <div class="modal fade" id="payment"  tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View Payment History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Annual CTC</td>
                                <td>Basic Salary</td>
                                <td>Date</td>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td id="slip_id"></td>
                                <td id="b_ctc"></td>
                                
                                <td id="b_salary"></td>
                                <td id="date"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <h4 id="net_salary"></h4>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 1 ended -->

    <!-- Modal 2-->
    <div class="modal fade" id="payment2"  tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Payment History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Annual CTC</td>
                                <td>Basic Salary</td>
                                

                            </tr>
                        </thead>
                        <tbody>
                            <form action="" method="post">
                                @csrf
                                <tr>
                            <td id="s_id">
                            </td>
                            <input type="hidden" name="sid" id="id" value="">
                                <td> <input name="ctc" id="ctc" type="input" value="" class="form-control"></td>
                                
                                <td><input name="salary" id="salary" value="" type="input" class="form-control"></td>
                               
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right" ><input type="submit" value="UPDATE" class="btn btn-primary"></td>
                            </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    <!-- end modal -->

    <!-- Main content -->


    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-cyan">


                    <!-- Editable table -->
                    <div class="card">
                        <div class="card-body">
                            <div id="table" class="table-editable">

                                <table class="table table-responsive-md table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Employee ID</th>
                                            <th class="text-center">Profile</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Designation</th>

                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                       
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <img style="width:35px; border-radius:50%;"
                                                    src=""
                                                    alt="none">
                                            </td>
                                            <td>Imon Faysal</td>
                                            <td>
                                                Jr. Software Engineer
                                            </td>
                                            <td>
                                               
                                                
                                                    
                                                
                                                <a href="javascript:void(0)"
                                                    style="border:1px solid lightgray;color:gray;" id="payment_history"
                                                    data-url=""
                                                    class="btn px-4 py-2">
                                                    <i class="fas fa-eye fa"></i> Salary History</a>

                                                

                                                    <a href="javascript:void(0)" id="payment_edit"
                                                    data-url=""
                                                    style="border:1px solid lightgray;color:gray;"
                                                    class="btn px-4 py-2">
                                                    <i class="fas fa-pen fa"></i> Edit Salary</a>
                                                       
                                                        <!-- <a href="" 
                                                    style="border:1px solid lightgray;color:gray;"
                                                    class="btn px-4 py-2">
                                                    Send for Payment  <i class="fas fa-paper-plane fa"></i></a> -->
                                                   
                                                    <!-- <button style="border:1px solid lightgray;color:gray;"
                                                    class="btn px-4 py-2">
                                                    <i class="fas fa-thumbtack fa"></i> Waiting for clearance </button> -->
                                                       
                                                    
                                             
                                                <a href=""
                                                    style="border:1px solid lightgray;color:gray;"
                                                    class="btn px-4 py-2">
                                                    <i class="fas fa-plus fa"></i> Add Salary</a>
                                               
                                                   
                                            </td>
                                        </tr>
                                       
                                       

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Editable table -->
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '#p_edit', function() {
        var current_row = $(this).closest('tr');
        var emp_id = current_row.find('#emp_id').text();
        var emp_name = current_row.find('#emp_name').text();
        var basic_salary = current_row.find('#basic_salary').text();
        var net_salary = current_row.find('#net_salary').text();
        var expence = current_row.find('#expence').text();
        var allowances = current_row.find('#allowances').text();
        var deductions = current_row.find('#deductions').text();
        var grand_total = current_row.find('#grand_total').text();
        $.ajax({
            url: "",
            method: 'GET',
            data: {
                emp_id: emp_id,
                emp_name: emp_name,
                basic_salary: basic_salary,
                net_salary: net_salary,
                expence: expence,
                allowances: allowances,
                deductions: deductions,
                grand_total: grand_total
            },
            success: function(res) {
                alert(res);
            }
        });
    });

    $('body').on('click', '#payment_history', function() {
        var urlData = $(this).data('url');
        $.get(urlData, function(data) {
            let month_cost = data.annual_ctc/12;
            let allowances = month_cost - data.basic_salary;
            let total = data.basic_salary + allowances;
            $('#payment').modal('show');
            $('#slip_id').text(data.id);
            $('#b_ctc').text(data.annual_ctc);
            $('#b_salary').text(data.basic_salary);
            $('#date').text(data.created_at);
            $('#net_salary').text("Net Salary : " +total);


        });
    });

    $('body').on('click', '#payment_edit', function() {
        var urlData = $(this).data('url');
        $.get(urlData, function(data) {
            let month_cost = data.annual_ctc/12;
            let allowances = month_cost - data.basic_salary;
            let total = data.basic_salary + allowances;
            $('#payment2').modal('show');
            $('#s_id').text(data.id);
            $('#id').val(data.id);
            $('#ctc').val(data.annual_ctc);
            $('#salary').val(data.basic_salary);
            $('#salary').text("Net Salary : " +total);
           
           


        });
    });
});
function closeMsg() {
            document.getElementById("successmsg").style.display = "none";
        }
</script>

@endsection