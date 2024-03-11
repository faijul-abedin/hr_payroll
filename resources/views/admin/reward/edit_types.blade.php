@extends('admin.layouts.dashboard')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Update Reward Type</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('bonus.types')}}">Reward Type</a></li>
                <li class="breadcrumb-item active">Reward Type Update</li>
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
                    <form method="POST" action="{{route('reward.types.update',$type->id)}}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Points Category Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $type->name }}" name="name" id="">
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
                                    <input type="number" class="form-control @error('scale') is-invalid @enderror" name="point" id="" value="{{ $type->point }}">
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

