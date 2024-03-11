@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h6>Create Shift</h6></div>
                
                <div class="card-tools d-flex justify-content-end my-2">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('shiftmanagement.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><h6>Shifts</h6></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Shift Name" required autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

                            <div class="col-md-6">
                                <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') }}" required>

                                @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

                            <div class="col-md-6">
                                <input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" required>

                                @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-header"><h6>Shifts</h6></div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Shift Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shifts as $key => $shift)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $shift->name }}</td>
                        <td>{{ $shift->starting }}</td>
                        <td>{{ $shift->ending }}</td>
                        <td>
                            {{-- <a href="" class="btn btn-sm btn-primary">{{ __('View') }}</a> --}}
                            <a href="{{ route('shiftmanagement.editpage', $shift->id) }}" class="btn btn-sm btn-success">{{ __('Edit') }}</a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$shift->id}}">delete</a>
                        </td>
                    </tr>

                    <!-- Modal -->
<div class="modal fade" id="deleteModal{{ $shift->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a href="{{ route('shiftmanagement.delete', $shift->id) }}" type="button" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>

                    @endforeach

                    <!-- <tr>
                        <td colspan="5" class="text-center">{{ __('No shifts found.') }}</td>
                    </tr> -->

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection