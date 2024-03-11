<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Employee</a></li>
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
        
        <!-- ./col -->
        <div class="col-lg-6 col-6">

          @php
              $rewards = $employee->Reward->where('status',"active")->pluck('point')->sum();
              $redeem = $employee->RedeemPoint->pluck('redeem_point')->sum();
          @endphp
          <!-- small box -->
          <div class="small-box"  style="background: #e7b2ff">
            <div class="inner">
              <h3>{{ $rewards - $redeem }}<sup style="font-size: 20px">points</sup></h3>

              <h5>Available Points</h5>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-6 col-6">

          @php
              $ot = $employee->Overtimes->where('status',"active")->pluck('hrs')->sum();
              $ot_tk = $employee->Overtimes->where('status',"active")->pluck('total')->sum();
          @endphp
          <!-- small box -->
          <div class="small-box" style="background: #32b189dc">
            <div class="inner">
              <h3>{{ $ot }}<sup style="font-size: 20px">hrs</sup> : {{ $ot_tk }}<sup style="font-size: 20px">TK</sup></h3>

              <h5>Over Time</h5>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">

          @php
            $advance = $employee->Disbursement->where('status',"active")->pluck('amount')->sum();
          @endphp
          <!-- small box -->
          <div class="small-box" style="background: #ffd386e7">
            <div class="inner">
              <h3>{{ $advance }}<sup style="font-size: 20px">TK</sup></h3>

              <h5>Advance</h5>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box" style="background: #da4747e4">
            <div class="inner">
              <h3>0<sup style="font-size: 20px">TK</sup></h3>

              <h5>Deduction</h5>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-4 col-6">

          @php
            $loan = $employee->Loans->pluck('due')->sum();
          @endphp
            <!-- small box -->
            <div class="small-box" style="background: #856cbada">
              <div class="inner">
                <h3 class="text-dark">{{ $loan }}<sup style="font-size: 20px">TK</sup></h3>
  
                <h5 class="text-dark">Loan's Due</h5>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>

        
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="">Notice Board</h3>
                {{-- <a href="javascript:void(0);">View Report</a> --}}
              </div>
            </div>

            @foreach ($notices as $notice)

            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-lg">{{ $notice->heading }}</span>
                  {{-- <span>Visitors Over Time</span> --}}
                </p>
                <p class="ml-auto d-flex flex-column text-right text-bold text-md">
                  <span class="text-danger">
                    By HR
                  </span>
                </p>
              </div>
              <!-- /.d-flex -->

              <div class="position-relative mb-4" style="background: rgb(255, 230, 230)">
                <p class="p-2">
                    {{ $notice->details }}
                </p>
              </div>

              <div class="d-flex flex-row justify-content-end">
                
              </div>
            </div>
            @endforeach
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->