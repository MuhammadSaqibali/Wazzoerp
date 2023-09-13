@extends('layouts.admin')
@section('page-title')
    {{__('Manage Monthly Attendance')}}
@endsection
@push('script-page')

@endpush

@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
            {{ Form::open(array('route' => array('report.daily.attendance'),'method'=>'get','id'=>'report_monthly_attendance')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('date',__('Date'),['class'=>'text-type'])}}
                    {{Form::date('date',isset($_GET['date'])?$_GET['date']:$date->toDateString(),array('class'=>'month-btn form-control'))}}
                </div>
            </div>
        </div>

        <div class="col-auto my-custom">
            <a href="#" class="apply-btn"
               onclick="document.getElementById('report_monthly_attendance').submit(); return false;"
               data-toggle="tooltip" data-original-title="{{__('apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('report.daily.attendance')}}" class="reset-btn" data-toggle="tooltip"
               data-original-title="{{__('Reset')}}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('content')
    <div id="printableArea">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="table-responsive py-4 attendance-table-responsive">
                        <table class="table table-striped mb-0" id="dataTable-1">
                            <thead>
                            <tr>
                                <th class="active">{{__('Name')}}</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Overtime</th>
                                <th>Total Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                @php
                                    $attendance  = $employee->getAttendance($date);
    $extraTime = explode(':',$attendance['extra_time']);
                                @endphp
                                <tr>
                                    <td>{{$employee->name}}</td>
                                    <td>{{$attendance['clock_in']}}</td>
                                    <td>{{$attendance['clock_out']}}</td>
                                    <td>
                                        <select class="over_select" data-t="h">
                                            @for($i= 0;$i <=12; $i++)
                                                <option @if( (int) $extraTime[0] ==$i) selected
                                                        @endif value="{{\App\Employee::zeroPrecedor($i)}}">{{\App\Employee::zeroPrecedor($i)}}</option>
                                            @endfor
                                        </select>
                                        <span>:</span>
                                        <select class="over_select" data-t="m">
                                            @for($i= 0;$i <60; $i++)
                                                <option @if( (int) $extraTime[1] ==$i) selected
                                                        @endif value="{{\App\Employee::zeroPrecedor($i)}}">{{\App\Employee::zeroPrecedor($i)}}</option>
                                            @endfor
                                        </select>
                                        <span>:</span>
                                        <select class="over_select" data-t="s">
                                            @for($i= 0;$i <60; $i++)
                                                <option @if( (int) $extraTime[2] ==$i) selected
                                                        @endif value="{{\App\Employee::zeroPrecedor($i)}}">{{\App\Employee::zeroPrecedor($i)}}</option>
                                            @endfor
                                        </select>

                                    </td>
                                    <td>{{$attendance['total_time']}}</td>
                                    <td>
                                        @if($attendance['enable_btn'])
                                            <form action="{{route('post.report.daily.attendance')}}" class="w-100 d-block" method="POST">
                                                @csrf
                                                <input type="hidden" class="over_input"
                                                       value="{{$attendance['extra_time']}}" name="overtime">
                                                <input type="hidden" name="attendance_id"
                                                       value="{{$attendance['attendance_id']}}">
                                                <button type="submit" class="btn btn-block btn-primary btn-sm">Update
                                                </button>
                                            </form>

                                        @else
                                            <label class="badge badge-danger">Absent</label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script-page')
    <script>
        $(document).on("change",".over_select",function (){
            $col = $(this).parent('td');
            $row = $col.parent('tr');
            // console.log($row.find('.over_input'))

            let o_time = '';

            $col.find('.over_select').each(function (){
                o_time = o_time+($(this).val())+':'
            });

            $row.find('.over_input').val(o_time.slice(0, -1))


        })
    </script>
@endpush
