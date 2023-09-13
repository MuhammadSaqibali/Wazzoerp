<div class="card">
    <div class="card-header">
        <h4>{{__('Mark Attandance')}}</h4>
    </div>
    <div class="card-body dash-card-body">
        <p class="d-flex justify-content-between">
            <span
                class="text-muted pb-0-5">Clock In:@if(!empty($employeeAttendance)) {{$employeeAttendance->clock_in}} @else
                    --- @endif </span><span> Clock Out:@if(!empty($employeeAttendance) && $employeeAttendance->clock_out != '00:00:00') {{$employeeAttendance->clock_out}} @else
                    --- @endif</span>
        </p>
        <center>
            <div class="row">
                <div class="col-md-6 float-right border-right">
                    {{Form::open(array('url'=>'attendanceemployee/attendance','method'=>'post'))}}

                    @if(empty($employeeAttendance) || $employeeAttendance->clock_in == '00:00:00')
                        <button type="submit" value="0" name="in" id="clock_in"
                                class="btn-create badge-success">{{__('CLOCK IN')}}</button>
                    @else
                        <button type="button" value="0" name="in" id="clock_in"
                                class="btn-create badge-success disabled" disabled>{{__('CLOCK IN')}}</button>
                    @endif
                    {{Form::close()}}
                </div>
                <div class="col-md-6 float-left">
                    @if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00')
                        {{Form::model($employeeAttendance,array('route'=>array('attendanceemployee.update',$employeeAttendance->id),'method' => 'PUT')) }}
                        <button type="submit" value="1" name="out" id="clock_out"
                                class="btn-create badge-danger">{{__('CLOCK OUT')}}</button>
                    @else
                        <button type="button" value="1" name="out" id="clock_out"
                                class="btn-create badge-danger disabled" disabled>{{__('CLOCK OUT')}}</button>
                    @endif
                    {{Form::close()}}
                </div>
            </div>
        </center>

    </div>
</div>
