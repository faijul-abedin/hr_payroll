@extends('admin.layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="container mb-2">
        <div class="row">
            <div class="col-md-11 mx-auto cf-container">
                <form action="{{route('leave.update',$leave->id)}}" method="post">
                @csrf
                    <div class="cf-cover">
                        <div class="session-title row">
                            <h2>Leave application</h2>

                        </div>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="">Employee ID</label>
                                <input type="text" required="" value="{{$leave->leave_employee->employee_id}}" disabled placeholder="Employee Id" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Employee Name </label>
                                <input type="text" placeholder="Employee Name" value="{{$leave->leave_employee->name}}" disabled class="form-control">
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="">Department</label>
                                <input type="text" placeholder="Employee Department" disabled value="{{$leave->leave_employee->Department->name}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Designation</label>
                                <input type="text" placeholder="Employee Designation" disabled value="{{$leave->leave_employee->Designation->name}}" class="form-control">
                            </div>

                        </div>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="">Leave Type</label>
                                <input type="text" placeholder="" disabled value="{{$leave->type}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Duration</label>
                                <input type="text" placeholder="" disabled value="{{$leave->duration}} days" class="form-control">
                            </div>

                        </div>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="">Starting time</label>
                                <input type="text" placeholder="" disabled value="{{$leave->start}}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Pay Status</label>
                                <input type="text" placeholder="" disabled value="{{$leave->pay_status}} " class="form-control">
                            </div>

                        </div>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label for="">Added by</label>
                                @if ($leave->user_id == 0){
                                <input type="text" placeholder="" disabled value="Employee" class="form-control">
                                }
                                @else
                                @foreach ($leave->leave_user->roles as $role)
                                <input type="text" placeholder="" disabled value="{{ $role->name}}" class="form-control">
                                @endforeach
                                @endif
                                
                            </div>
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <input type="text" placeholder="" disabled value="{{$leave->status}} " class="form-control">
                            </div>

                        </div>

                        <div class="form-row row">
                            <div class="col-md-12">
                                <label for="">Reason in details</label> <span class="text-danger"> (This employee already have taken {{$activities->sum('duration')}} days of leave in this month)</span>
                                <textarea placeholder="" rows="3" class="form-control">{{$leave->reason}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label>Approved / Rejected by
                                    <hr>
                                </label><br>
                                @if ($leave->approved_by == 0)
                                <i>~none</i>
                                @else
                                <i>{{$leave->approved->name}}</i><br>
                                @foreach ($leave->approved->roles as $role)
                                <span class="badge badge-info mr-1">
                                    {{ $role->name }}
                                </span>
                                @endforeach
                                @endif

                            </div>

                         
                            <div class="col-md-4">

                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="">
                                    <option disabled selected value="">Select Status</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Approved">Approved</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="col-md-2">

                                <input class="form-control btn btn-sm btn-success" value="UPDATE" type="submit">
                            </div>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection