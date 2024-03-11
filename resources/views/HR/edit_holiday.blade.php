<!-- resources/views/holidays/create.blade.php -->

@extends('admin.layouts.dashboard')

@section('content')
@if($errors->any())
<div class="alert alert-danger">
    {{ $errors->first() }}
</div>
@endif

<div class="container">
    <h1>Edit Holiday</h1>

    <form action="{{route('holiday.update')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Holiday Name</label>
            <input type="hidden" value="{{$holiday->id}}" name="id">
            <input type="text" name="name" id="name" value="{{$holiday->name}}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date">Holiday Date</label>
            <input type="date" name="date" id="date" value="{{$holiday->date}}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Edit Holiday</button>
    </form>
</div>
@endsection