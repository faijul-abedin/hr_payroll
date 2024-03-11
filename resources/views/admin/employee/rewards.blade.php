<!-- resources/views/arrear_disbursement/create.blade.php -->

@extends('admin.employee.emp_index')

<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}/">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@section('emp_content')
<!-- modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Redeem My Points</h5>
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

                <form method="POST" action="{{route('employee.redeempoint',session('key'))}}">
                    @csrf

                    <div class="form-group">
                        <label for="amount">My Points</label>
                        <input type="text" class="form-control @error('amount') is-invalid @enderror" id="last_total" name="last_total" value="{{ $sub }}" readonly>
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                        <div class="form-group">
                            <label for="loan_amount">{{ __('Gift Items') }}</label>
                            <select name="gift_category" id="gift_category" class="form-control">
                                <option disabled selected value="">---Select Gift Item---</option>
                                @foreach ($gift as $category)
                                <option value="{{$category->id}}" class="text-bold">{{ $category->name }} for {{ $category->point }} points</option>
                                @endforeach
                            </select>

                            @error('loan_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="amount">Points to claim</label>
                            <input type="text" class="form-control @error('amount') is-invalid @enderror" id="redeem_point" name="redeem_point" value="0">
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <span id="alert_msg" class=""></span>
                    <br>

                    <button type="submit" id="redeem_submit" class="btn btn-primary mt-1" disabled>Redeem Reward</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<div class="card-body">
    <div class="card-header row mb-2">
        <div class="col-md-8"> <h5>Available Reward Points: {{ $sub }}</h5></div>
        <div class="col-md-4 text-right"> <button type="button" class="btn btn-sm btn-success p-2" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa-solid fa-gifts"></i> Redeem Points</button></div>
    </div>
    <div class="table-responsive card">
        <table id="example2" class="table table-bordered table-hover mt-3">
            <thead>
                <tr style="background-color:whitesmoke">
                    <th>SL</th>
                    <th>Employee ID</th>
                    <th>Point Category</th>
                    <th>Point</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($rewards as $i=>$reward)
                     <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$reward->Employee->employee_id}}</td>
                        <td>
                            @if ($reward->point_category_id == 0)
                                Attendance
                                @else
                                {{$reward->PointCategory->name}}
                            @endif
                            </td>
                        <td>{{$reward->point}}</td>
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

    $(document).ready(function() {

        // Point Category select start
        $('#gift_category').on('change', function() {
            var gift_category = $(this).val();
                $.ajax({
                    url: "{{route('select.gift_category')}}",
                    type: 'GET',
                    data: {
                        gift_category : gift_category,
                    },
                    success: function(data) {
                       $('#redeem_point').val(data.point);


                    let my_amount = $('#last_total').val();
                    if (parseInt(data.point) > parseInt(my_amount)) {
                        $('#alert_msg').text('Your gift redeem point is greater than your earned point!');
                        $('#alert_msg').addClass('text-danger');
                        $('#alert_msg').removeClass('text-success');
                        $('#redeem_submit').attr('disabled', true);
                        } else {
                            $('#alert_msg').text('You are able to redeem this gift.');
                            $('#alert_msg').addClass('text-success');
                            $('#alert_msg').removeClass('text-danger');
                            $('#redeem_submit').attr('disabled', false);
                        }
                    }
                });
        });
        // Point Category select end

    });
</script>
@endsection