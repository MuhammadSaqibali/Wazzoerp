<div class="card bg-none card-box">
    {{Form::open(array('url'=>'income_tax','method'=>'post'))}}
    {{ Form::hidden('employee_id',$employee->id, array()) }}
    @for($i = 1;$i<=6;$i++)
        <div class="row">
            <div class="col-md-12">
                <h4>Group {{$i}}</h4>
            </div>
            <div class="form-group col-md-4">
                {{ Form::label('min_salary', __('Min Salary'),['class'=>'form-control-label']) }}
                {{ Form::number('group_'.$i.'[min_salary]',null, array('class' => 'form-control ','required'=>'required')) }}
            </div>
            <div class="form-group col-md-4">
                {{ Form::label('max_salary', __('Max Salary'),['class'=>'form-control-label']) }}
                {{ Form::number('group_'.$i.'[max_salary]',null, array('class' => 'form-control ','required'=>'required')) }}
            </div>
            <div class="form-group col-md-4">
                {{ Form::label('tax_percent', __('Tax'),['class'=>'form-control-label']) }}
                {{ Form::number('group_'.$i.'[tax_percent]',null, array('class' => 'form-control ','required'=>'required','min' => 0,'max' =>100)) }}
            </div>
        </div>
    @endfor
    <div class="row">
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
