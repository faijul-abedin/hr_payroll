@extends('admin.layouts.dashboard')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="background-color:lightgreen;">
          <div class="inner">
            <h3>{{$latestUpload->count()}}</h3>

            <p>Today's Attendee Employee</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('attendance.count')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="background-color:cadetblue;">
          <div class="inner">
            <h3>{{$leave->count()}}</h3>

            <p>Leave Application</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{route('leave.count')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>BDT{{$due_loan}}</h3>

            <p>Due Loan</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('loan.count')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box text-white" style="background-color: rgb(108, 232, 94);">
          <div class="inner">
            <h3>{{$eligible_employee}}</h3>

            <p>Attendence Point Achiver</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('attendance.point.without')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-md-6">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              Monthly Attendance and Late
            </h3>
          </div>
          <div class="card-body">
            <canvas id="lineChart"></canvas>
          </div>
        </div>
        <!-- /.card -->


        <!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header border-0">
            <h3 class="card-title">New Employee</h3>

          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>

                <tr>
                  <th>ID</th>
                  <th>Name</th>

                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employeesWithoutSalary as $item)
                <tr>
                  <td>{{$item->employee_id}}</td>
                  <td>{{$item->name}}</td>


                  <td><a class="btn btn-sm btn-primary" href="/salary/payscal/{{$item->id}}">Manage Salary</a></td>
                </tr>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->

      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /.content -->


<div class="content" id="invoiceContent">
  <div class="container-fluid">

    <div class="invoice p-3">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h4>
            <i class="fas fa-globe"></i> Monpura Group.
            <small class="float-right">Date: {{ date('d-m-Y') }}</small>
          </h4>
        </div>
        <!-- /.col -->
      </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Total Employee</th>
              <th>Total Salary</th>
              <th>Total Loan</th>
              <th>Total Advance</th>
              <th>Total Deduction</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>10</td>
              <td>200000</td>
              <td>10000</td>
              <td>5000</td>
              <td>3000</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">

        <p class="lead text-center">Net Salary {{ date('d-m-Y') }}</p>
        <!-- /.col -->
        <div class="col-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>$250.30</td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>$10.34</td>
              </tr>
              <tr>
                <th>Deduction:</th>
                <td>$5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$265.24</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->

        <!-- /.col -->
        <div class="col-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>$250.30</td>
              </tr>
              <tr>
                <th>Tax (9.3%)</th>
                <td>$10.34</td>
              </tr>
              <tr>
                <th>Deduction:</th>
                <td>$5.80</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>$265.24</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-12">
          <button type="button" class="btn btn-default btn-print no-print">
            <i class="fas fa-print"></i> Print
        </button>
          {{-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default btn-light float-right"><i class="fas fa-print"></i> Print</a> --}}
        </div>
      </div>
    </div>

  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var sales = @json($attendance);
  var purchases = @json($late);
  var month = @json($months);

  var ctxL = document.getElementById("lineChart").getContext('2d');
  var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
      labels: ["Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
          label: "Attendance",
          data: sales,
          backgroundColor: [
            'rgba(105, 0, 132, .2)',
          ],
          borderColor: [
            'rgba(200, 99, 132, .7)',
          ],
          borderWidth: 2
        },
        {
          label: "Late",
          data: purchases,
          backgroundColor: [
            'rgba(0, 137, 132, .2)',
          ],
          borderColor: [
            'rgba(0, 10, 130, .7)',
          ],
          borderWidth: 2
        }
      ]
    },
    options: {
      responsive: true
    }
  });
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function() {
      // Print button click event
      $(".btn-print").on("click", function() {
          // Get the HTML content of the specified div
          var content = $("#invoiceContent").html();
          
          // Create a new window for printing
          var printWindow = window.open('', '_blank');
          
          // Write the HTML content to the new window
          printWindow.document.write('<html><head><title>Print</title></head><body>' + content + '</body></html>');
          
          // Print the new window
          printWindow.print();
      });
  });
</script>

@endsection