@extends('admin.layouts.dashboard')

<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">



@section('content')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Reward Reports List</h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Rewarded List</li>
        </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>

    <section class="content">

      
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">All redeemed reward list.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Serial</th>
                  <th>Employee ID</th>
                  <th>Employee</th>
                  <th>Gift Item</th>
                  <th>Redeem Point</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                  @foreach ($redeems as $key => $redeem)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $redeem->Employee->employee_id }}</td>
                    <td>{{ $redeem->Employee->name }}</td>
                    <td>{{ $redeem->PointGift->name }}</td>
                    <td>{{ $redeem->redeem_point }}</td>
                    <td>
                        @if ($redeem->status === 'unpaid')
                            <span class="badge badge-danger">{{ $redeem->status }}</span>
                        @elseif ($redeem->status === 'paid')
                            <span class="badge badge-success">{{ $redeem->status }}</span>
                        @endif
                    </td>

                    <td class="">
                      @if ($redeem->status === 'unpaid')
                      <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$redeem->id}}"><i class="fa-solid fa-gift"></i> Give Now</a>
                        @else
                        <a class="btn btn-danger btn-sm disabled" href=""><i class="fa-solid fa-gift"></i> Give Now</a>

                      @endif
                    </td>

                    <div class="modal fade" id="deleteModal{{ $redeem->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Gift Status Confirmation Messege</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <!-- <span aria-hidden="true">&times;</span> -->
                              </button>
                            </div>
                            <div class="modal-body">
                            Are you sure want to give this GIFT?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              <a href="{{route('reward.reports.pay',$redeem->id)}}" type="button" class="btn btn-danger">Yes, Give</a>
                            </div>
                          </div>
                        </div>
                      </div>


                  </tr>

                  @endforeach
                
                
              
                  
                </tbody>
                <tfoot>
                <tr>
                    <th>Serial</th>
                    <th>Employee ID</th>
                    <th>Employee</th>
                    <th>Gift Item</th>
                    <th>Redeem Point</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
       
       

    </section>

<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/admin/plugins/jszip/jszip.min.js"></script>
<script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
{{-- <script src="/admin/dist/js/adminlte.min.js"></script> --}}

<script>
    $(function () {
    //   $("#example1").DataTable({
    //     "responsive": true, "lengthChange": false, "autoWidth": false,
    //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>

@endsection