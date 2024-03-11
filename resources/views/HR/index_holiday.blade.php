@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Holiday Calander</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Holiday Calander</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">View Holiday</h3>

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
      <div class="col-12 d-flex justify-content-end">
        <a href="{{route('holiday.create')}}"><button type="button" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add
          </button></a>
      </div>
      



      <div class="table-responsive mt-3">
        <table id="example2" class="table table-bordered table-hover mt-3">
          <thead>
            <tr style="background-color:whitesmoke">
              <th>SL</th>
              <th>Name</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($holidays as $i=>$item)
            <tr>
              <td>{{$i+1}}</td>
              <td>
                {{$item->name}}
              </td>
              @php
              

              // Convert the string to a Carbon instance
              $carbonDate = \Carbon\Carbon::parse($item->date);

              // Get the date
              $dateNumber = $carbonDate->format('d');

              // Get the month name
              $monthName = $carbonDate->format('F');
              @endphp
              <td>{{$dateNumber."-".$monthName}}</td>

              <td>
                <input type="hidden" id="uid" value="{{$item->id}}">
                <a class="btn btn-success text-white" href="{{route('holiday.edit',$item->id)}}"><i class="fas fa-edit"></i></a>
                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$item->id}}"><i class="fa-regular fa-trash-can"></i></a>

              </td>
                <!-- delete model -->
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
                      Are you sure want to delete this?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="{{route('holiday.destroy',$item->id)}}" type="button" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End model -->
            </tr>
            @endforeach



          </tbody>

        </table>
      </div>

    </div>
    <!-- /.card-body -->
    <div class="card-footer">

    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

<script src="/admin/plugins/jquery/jquery.min.js"></script>
<script>
  $(function() {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection