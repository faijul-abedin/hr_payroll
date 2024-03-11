@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>Create Points Gift</h6>
                </div>

                <div class="card-tools d-flex justify-content-end my-2">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="card-body row">
                    <form method="POST" action="{{ route('gift.types.save') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gift Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Points Value</label>
                                    <input type="number" class="form-control @error('scale') is-invalid @enderror" name="point" id="">
                                    @error('scale')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-8 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
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
        <div class="card-header">
            <h6>Gift Types</h6>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Gift Name</th>
                        <th>Point Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gift as $key => $g)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $g->name }}</td>
                        <td>{{ $g->point }} points</td>
                        <td>
                            {{-- <a href="" class="btn btn-sm btn-primary">{{ __('View') }}</a> --}}
                            <a href="{{ route('gift.types.edit', $g->id) }}" class="btn btn-sm btn-success">{{ __('Edit') }}</a>
                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$g->id}}">delete</a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{ $g->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <a href="{{ route('gift.types.delete', $g->id) }}" type="button" class="btn btn-danger">Delete</a>
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



<script src="/admin/plugins/jquery/jquery.min.js"></script>


@endsection