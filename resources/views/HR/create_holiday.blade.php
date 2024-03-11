<!-- resources/views/holidays/create.blade.php -->

@extends('admin.layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Add Holiday</h1>

        <form action="{{route('holiday.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Holiday Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date">Holiday Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Holiday</button>
        </form>
    </div>
@endsection
