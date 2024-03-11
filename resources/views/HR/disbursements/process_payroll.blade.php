@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Payroll Process</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Payroll Process</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section> 


    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Payroll Process Management</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
                
                <div class="table-responsive">

                  <form id="formId" method="post" action="{{ route('disbursment.move') }}">
                    @csrf

                    <div class="d-flex justify-content-end">
                      <button type="submit" class="btn btn-sm btn-success pr-4 pl-4">Process Payroll</button>
                  </div>

                  <table id="example2" class="table table-bordered table-hover mt-3 employee-table-">
                    <thead>
                   
                    <tr style="background-color:whitesmoke">
                      <th>SL</th>
                      <th>Employee Name</th>
                      <th>Allowances</th>
                      <th>Total</th>
                      <th class="text-center">
                            <input type="checkbox" id="applyForAll" class="form-check-input" name="" value="">
                            <text>Apply For All Employee</text>
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                   
                        
                    @foreach($employee as $i=>$item)  
                    <tr>
                      <td>{{$i+1}}</td>
                      <td>
                            <input type="checkbox" class="employeeCheckbox form-check-input ml-2" name="selected_users[]" value="{{ $item->id }}" data-index="">
                            <text class="ml-4">{{$item->name}}</text>
                        </td>

                      <td>
                        <table class="table table-bordered allowance-table-{{$i}}">
                            <tbody>

                                <tr>

                                    <td class="text-center">

                                        

                                        @if ($item->Salary)
                                        <input type="checkbox" class="form-check-input check-salary" name="salary[{{ $item->id }}]" value="{{ $item->Salary->rate }}" checked style="background-color: rgba(255, 0, 0, 0.50);" data-amount="{{ $item->Salary->rate }}">
                                        <text>Basic</text><br>
                                        <b>{{ $item->Salary->rate }} (+)</b>
                                        @else
                                        <input type="checkbox" class="form-check-input check-salary" name="salary[{{ $item->id }}]" value="0" checked style="background-color: rgba(255, 0, 0, 0.50);" data-amount="0">
                                        <text>Basic</text><br>
                                        <b class="text-danger">0 (+)</b>
                                        @endif

                                    </td>

                                    @php
                                      $bonus = $item->Bonuses->where('status',"active")->pluck('total')->sum();
                                    @endphp

                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input check-bonus" name="bonus[{{ $item->id }}]" value="{{ $bonus }}" data-amount="{{ $bonus }}">
                                        <text>Bonus</text><br>
                                        <b>{{ $bonus }} (+)</b>
                                    </td>

                                    @php
                                      $ot = $item->Overtimes->where('status',"active")->pluck('total')->sum();
                                    @endphp
                                    
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input check-ot" name="ot[{{ $item->id }}]" value="{{ $ot }}" data-amount="{{ $ot }}">
                                        <text>O.T.</text><br>
                                        <b>{{ $ot }} (+)</b>
                                    </td>

                                    
                                </tr>
                                <tr>
                                  @php
                                      $advance = $item->Disbursement->where('status',"active")->pluck('amount')->sum();
                                    @endphp
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input check-advance" name="advance[{{ $item->id }}]" value="{{ $advance }}" data-amount="-{{ $advance }}">
                                        <text>Advance</text><br>
                                        <b>{{ $advance }} (-)</b>
                                    </td>

                                    @php
                                      $loan = $item->Loans->where('due', '>', 0)->pluck('per_month')->sum();
                                    @endphp
                                    
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input check-loan" name="loan[{{ $item->id }}]" value="{{ $loan }}" data-amount="-{{ $loan }}">
                                        <text>Loan</text><br>
                                        <b>{{ $loan }} (-)</b>
                                    </td>

                                    
                                    @php
                                        $leave_deduction = $item->leaves->sum(function ($leave) {
                                          if ($leave->deduction && $leave->deduction->status === 'Approved') {
                                            return $leave->deduction->total;
                                              }
                                            return 0;
                                          });
                                          $atdnc_deduction = $item->Attendance->where('status',"Approved")->pluck('total')->sum();

                                          $deduction = $leave_deduction + $atdnc_deduction;
                                        // $deduction = $item->leaves->Deduction->where('status',"Approved")->pluck('total')->sum();
                                    @endphp

                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input check-deduction" name="deduction[{{ $item->id }}]" value="{{ $deduction }}" data-amount="-{{ $deduction }}">
                                        <text>Deduction</text><br>
                                        <b>{{ $deduction }} (-)</b>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                      </td>
                     {{-- <td class="total-amount text-bold">0</td> --}}
                     <td style="max-width: 115px;"><input type="text" style="max-width: 100%; border: none; outline: none;" class="total-amount text-bold form-control" name="total[{{ $item->id }}]" value="0"></td>

                     <td class="text-center">
                        <input type="checkbox" name="applyForAll{{$i}}" class="apply-for-all form-check-input" data-index="{{$i}}">
                        <text>Apply For All Allowance</text>
                    </td>
                            
                      
                    </tr>
                    @endforeach

               
                    
                  
                    </tbody>
                    <tfoot>
                    <tr  style="background-color:whitesmoke">
                      <th>SL</th>
                      <th>Employee Name</th>
                      <th>Allowances</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                    </tfoot>
                  </table>

                </form>

                </div>
                
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>

    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $(".apply-for-all").on("change", function() {
    var index = $(this).data("index");
    const isChecked = $(this).prop("checked");
    var allowanceTable = $(".allowance-table-" + index);

    allowanceTable.find("input[type='checkbox']").not("[name^='salary']").prop("checked", isChecked);
    const employeeNameCheckbox = allowanceTable.closest("tr").find("input[type='checkbox'].apply-for-all");
    employeeNameCheckbox.prop("checked", isChecked);
    updateTotalForAllRows();
  });

  $(document).ready(function() {
    // Get the "Apply For All Employee" checkbox
    const $applyForAllCheckbox = $('#applyForAll');

    // Get all the checkboxes in the "Employee Name" column
    const $employeeCheckboxes = $('.employeeCheckbox');
    const $bonusCheckboxes = $('.check-bonus');
    const $otCheckboxes = $('.check-ot');
    const $advanceCheckboxes = $('.check-advance');
    const $loanCheckboxes = $('.check-loan');
    const $deductionCheckboxes = $('.check-deduction');

  
    $applyForAllCheckbox.change(function() {
      const isChecked = $applyForAllCheckbox.is(':checked');
      // Set the checked status of all the employee checkboxes
      $employeeCheckboxes.prop('checked', isChecked);

      const isAnyBonusChecked = $bonusCheckboxes.is(':checked');
      if (isAnyBonusChecked) {
        $bonusCheckboxes.prop('checked', isChecked);
      }
      const isAnyOTChecked = $otCheckboxes.is(':checked');
      if (isAnyOTChecked) {
        $otCheckboxes.prop('checked', isChecked);
      }
      const isAnyAdvanceChecked = $advanceCheckboxes.is(':checked');
      if (isAnyAdvanceChecked) {
        $advanceCheckboxes.prop('checked', isChecked);
      }
      const isAnyLoanChecked = $loanCheckboxes.is(':checked');
      if (isAnyLoanChecked) {
        $loanCheckboxes.prop('checked', isChecked);
      }
      const isAnyDeductionChecked = $deductionCheckboxes.is(':checked');
      if (isAnyDeductionChecked) {
        $deductionCheckboxes.prop('checked', isChecked);
      }

      updateTotalForAllRows();

    });


    $('.check-salary').change(function() {
    const isChecked = $(this).prop('checked');
    if (!isChecked) {
      $(this).prop('checked', true);
      alert('Basic Salary can not be unchecked!')
    } else {
      updateTotalForAllRows();
    }
  });
    $('.check-bonus').change(function() {
      // Calculate and update the total for each row
      updateTotalForAllRows();
    });
    $('.check-ot').change(function() {
      // Calculate and update the total for each row
      updateTotalForAllRows();
    });
    $('.check-advance').change(function() {
      // Calculate and update the total for each row
      updateTotalForAllRows();
    });
    $('.check-loan').change(function() {
      // Calculate and update the total for each row
      updateTotalForAllRows();
    });
    $('.check-deduction').change(function() {
      // Calculate and update the total for each row
      updateTotalForAllRows();
    });
  

  // $('.allowance-table- tr input[type="checkbox"]').change(function() {
  //   var $table = $(this).closest('.allowance-table');
  //   var tableIndex = $table.data('index');
  //   // Calculate and update the total for the specific table row
  //   updateTotalForAllRows(tableIndex);
  // });


  });



    function updateTotalForRow(index) {
    const allowanceTable = $(".allowance-table-" + index);
    let total = 0;
    allowanceTable.find('input[type="checkbox"]:checked').each(function() {
      const amount = parseFloat($(this).data('amount'));
      if (!isNaN(amount)) {
        total += amount;
      }
    });
    // allowanceTable.closest('tr').find('.total-amount').text(total);
    allowanceTable.closest('tr').find('.total-amount').val(total);
  }

  function updateTotalForAllRows() {
    $('.employee-table- tr').each(function(index) {
      updateTotalForRow(index);
    });
  }

  updateTotalForAllRows();

  });


// });

</script>






@endsection