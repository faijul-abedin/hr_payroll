@extends('admin.employee.emp_index')
@section('emp_content')
<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h5>
          <i class="fas fa-globe"></i> Bengal Software, Inc.
          <small class="float-right">{{ date("Y/m/d") }}</small>
        </h5>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>HR, Bengal Software</strong><br>
          Ka-1/1 Bashundhara Road,<br>
          Dhaka 1229, Opposite to jamuna future Park,<br>
          Phone: (804) 123-5432<br>
          Email: info@bengalsoftware.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>Name: {{ $salary->Employee->name }}</strong><br>
          ID: {{ $salary->Employee->employee_id }}<br>
          Department: {{ $salary->Employee->Department->name }}<br>
          Designation: {{ $salary->Employee->Designation->name }}<br>
          Contact: {{ $salary->Employee->contact }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Salary Month #{{ Carbon\Carbon::parse($salary->created_at)->format('F') }}</b><br>
        <br>
        {{-- <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567 --}}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Salary</th>
            <th>Bonus</th>
            <th>Over time</th>
            <th>Advance</th>
            <th>Loan</th>
            <th>Deductions</th>
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $salary->salary }}</td>
              <td>{{ $salary->bonus }}</td>
              <td>{{ $salary->overtime }}</td>
              <td>{{ $salary->advance }}</td>
              <td>{{ $salary->loan }}</td>
              <td>{{ $salary->diduction }}</td>
              <td class="text-bold">{{ $salary->total }}</td>
            {{-- <td>{{ $invoice->total_amount }}</td> --}}
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->

      <!-- accepted payments column -->
      <div class="col-12">
        <h6 style="margin-top: 10px;" >Payment status: <span class="text-bold">{{ $salary->status }}</span></h6> 

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
          plugg
          dopplr jibjab.
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
          plugg
          dopplr jibjab.
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
          plugg
          dopplr jibjab.
        </p>
      </div>

    </div>
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-12">
        {{-- <a href="javascript:window.print()" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> --}}
        {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
          Payment
        </button> --}}
        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
        {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
          <i class="fas fa-download"></i> Generate PDF
        </button> --}}
      </div>
    </div>
  </div>

  <script>
    // window.addEventListener("load",window.print());
    // window.onafterprint = function() {
    // history.back();
    // };
  </script>
  @endsection