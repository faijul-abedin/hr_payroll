<!-- resources/views/overtime_disbursement/create.blade.php -->

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
                <h5 class="modal-title" id="exampleModalLabel">Overtime disbursement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('disbarsement.ot.store')}}">
                    @csrf

                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select class="form-control @error('employee_id') is-invalid @enderror" id="mySelect" name="employee_id">
                            <option value="">Select Employee </option>
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
                        <label for="hours">Hours</label>
                        <input type="text" class="form-control @error('hours') is-invalid @enderror" id="hours" name="hours">
                        @error('hours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control @error('rate') is-invalid @enderror" id="rate" name="rate">
                        @error('rate')
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

<!--Edit modal -->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Overtime disbursement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('ot.update')}}">
                    @csrf
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                         <input type="hidden" id="e_id" name="id" value="id">
                         <input type="hidden" id="employee_id" name="employee_id" value="">
                         <input type="text" class="form-control" id="emp_id" name="" value="">
                        @error('employee_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hours">Hours</label>
                        <input type="text" class="form-control @error('hours') is-invalid @enderror" id="hrs_time" name="hours" value="{{ old('hours') }}">
                        @error('hours')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rate">Rate</label>
                        <input type="text" class="form-control @error('rate') is-invalid @enderror" id="hrs_rate" name="rate"  value="{{old('rate')}}">
                        @error('rate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- end edit modal -->


<div class="container card">

    <div class="table-responsive">
        <div class="card-header row">
            <div class="col-md-8"> Overtime Disbursement</div>
            <div class="col-md-4 text-right"> <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa-solid fa-plus"></i> Add disbursement</button></div>
        </div>

        <table id="example2" class="table table-bordered table-hover mt-0">
            <thead>
                <tr style="background-color:whitesmoke">
                    <th>SL</th>
                    <th>Name</th>
                    <th>Hours</th>
                    <th>Rate</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($disbursement as $i=>$item)


                <tr>
                    <td>{{$i+1}}</td>
                    <td>
                        {{$item->Employee->name}}
                    </td>

                    <td>{{$item->hrs}}</td>
                    <td>{{$item->rate}}</td>
                    <td>{{$item->hrs * $item->rate}}</td>
                    <td>
                        <input type="hidden" id="uid" value="">
                        
                        <a href="javascript:void(0)" data-url="{{route('ot.edit.view',$item->id)}}" id="id">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target=".edit-example-modal-lg">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>

                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="fa-regular fa-trash-can"></i></a>

                    </td>
                </tr>
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation Messege</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <!-- <span aria-hidden="true">&times;</span> -->
                            </button>
                            </div>
                            <div class="modal-body">
                            Are you sure want to delete this OT?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <a href="{{route('ot.delete',$item->id)}}" type="button" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
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
<script src="/admin/plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE App -->
 <script src="/admin/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
       
    });
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

   

    $(document).ready(function() {
    $('body').on('click', '#id', function() {
        var urlData = $(this).data('url');
        $.get(urlData, function(data) {
            $('#exampleModalEdit').modal('show');
            $('#emp_id').val(data.name);
            $('#employee_id').val(data.info.employee_id);
            $('#hrs_time').val(data.info.hrs);
            $('#hrs_rate').val(data.info.rate);
            $('#e_id').val(data.info.id);
        });
    });
});

</script>
@endsection