<!-- resources/views/arrear_disbursement/create.blade.php -->

@extends('admin.layouts.dashboard')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}/">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@section('content')
<!-- modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Employee Allowances</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{route('allowances.employee')}}">
                    @csrf

                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id">
                          
                            @foreach ($employee as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach


                        </select>
                        @error('employee_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="employee_id">Allowance type</label>
                        <select class="form-control @error('allowance') is-invalid @enderror" id="allowance" name="allowance">
                        <option >Select Allowance type</option>
                            @foreach ($allowance as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach


                        </select>
                        @error('allowance')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount">
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason"></textarea>
                        @error('reason')
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
<!-- end modal -->

<div class="card-body">
    <div class="card-header row">
        <div class="col-md-8"> Allowances</div>
        <div class="col-md-4 text-right"> <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa-solid fa-plus"></i> Add disbursement</button></div>
    </div>
    <div class="table-responsive card">
        <table id="example2" class="table table-bordered table-hover mt-3">
            <thead>
                <tr style="background-color:whitesmoke">
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Employee name</th>
                    <th>Allowance</th>
                    <th>Amount</th>
                    <th>Details</th>
                    
                </tr>
            </thead>
            <tbody>
                 @foreach ($employee_allowance as $i=>$item)
                     <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$item->Employee->employee_id}}</td>
                        <td>{{$item->Employee->name}}</td>
                        <td>{{$item->Allowance->name}}</td>
                        <td>{{$item->Allowance->amount}}</td>
                        <td>{{$item->Allowance->details}}</td>
                     </tr>
                 @endforeach
            </tbody>

        </table>
    </div>

</div>
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
    $(function() {
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
            "autoWidth": false,
            "responsive": true,
            "autoHeight": true,
        });
    });
    $('#allowance').on('change', function() {
        var selectedBonusType = $(this).val();
      
        $.ajax({
            url: '{{route('allowances.search')}}',
            type: 'GET',
            data: {
                bonus_type: selectedBonusType
            },
            success: function(data) {
                $('#amount').val(data.amount);
                $('#reason').val(data.details);
            },
            error: function(xhr, status, error) {
                // Handle errors if any
            }
        });
    });
</script>
@endsection