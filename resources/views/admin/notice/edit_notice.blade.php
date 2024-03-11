@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Update Notice</div>

                <div class="card-body">
                    <form method="POST" action="{{route('notice.update',$notice->id)}}">
                        @csrf

                        <div class="row">

                            <div class="form-group  col-md-12">

                                <input id="heading" type="text" placeholder="Enter Notice Heading" class="form-control @error('name') is-invalid @enderror" name="heading" value="{{ $notice->heading }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            

                            <div class="form-group  col-md-12">

                                <textarea class="form-control @error('reason') is-invalid @enderror" id="details" rows="3" name="details" placeholder="Enter Notice Details...">{{ $notice->details }}</textarea>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group mb-0 col-md-6">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Update Notice</button>
                                </div>
                            </div>

                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="content">
</section>
@endsection