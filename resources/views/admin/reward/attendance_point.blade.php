@extends('admin.layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>Attendance Point Setting</h6>
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
                    <form method="POST" action="{{ route('attendance.point.edit') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Attendance Minimization</label>
                                    <input type="number" value="{{$point->attendance_minimization}}" class="form-control @error('attendance_minimization') is-invalid @enderror" name="attendance_minimization" id="">
                                    @error('attendance_minimization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Late Minimization</label>

                                    <input type="number" value="{{$point->late_minimization}}" class="form-control @error('late_minimization') is-invalid @enderror" name="late_minimization" id="">
                                    @error('late_minimization')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <input id="including_late" checked type="checkbox">
                                    <label for="including_late">Point(with late & attendance)</label>

                                    <input type="number" value="{{$point->with_late_point}}" class="form-control @error('point_with_late') is-invalid @enderror" name="point_with_late" id="point_with_late">
                                    @error('point_with_late')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input id="excluding_late" checked type="checkbox">
                                    <label for="excluding_late">Point(no late & attendance)</label>

                                    <input type="number" class="form-control @error('point_without_late') is-invalid @enderror" name="point_without_late" id="point_without_late"  value="{{$point->without_late_point}}">
                                    @error('point_without_late')
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
<div class="container">
    <div class="card">
        <div class="card-header">
            <h6>Attendance point list</h6>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Minimized Attendance</th>
                        <th>Minimized Late</th>
                        <th>Point(with late & attendance)</th>
                        <th>Point(without late  & attendance)</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>1</td>
                        <td>{{$point->attendance_minimization}}</td>
                        <td>{{$point->late_minimization}}</td>
                        <td>{{$point->with_late_point}}</td>
                        <td>{{$point->without_late_point}}</td>
                    </tr>

                </tbody>
            </table>

        </div>


    </div>
</div>

@endsection