@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Update Bonus Type</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('bonus.types')}}">Bonus Type</a></li>
                <li class="breadcrumb-item active">Bonus Update</li>
            </ol>
        </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>Update Bonus Type</h6>
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
                    <form method="POST" action="{{route('bonus.types.update',$bonuses->id)}}">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bonus Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="" value="{{$bonuses->name}}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bonus Scale %</label>
                                    <input type="number" class="form-control @error('scale') is-invalid @enderror" name="scale" id="" value="{{$bonuses->scale}}">
                                    @error('scale')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Details</label>
                                    <input type="text" class="form-control @error('details') is-invalid @enderror" name="details" id="" value="{{$bonuses->details}}">
                                    @error('details')
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
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

