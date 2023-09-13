<div class="card bg-none card-box">
    {{Form::open(array('url'=>'budget','method'=>'post'))}}
    {{ Form::hidden('employee_id',$employee->id, array()) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('cost_center', __('Cost Center'),['class'=>'form-control-label']) }}
            {{ Form::text('cost_center',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>


        <div class="form-group col-md-6">
            {{ Form::label('funding', __('Funding'),['class'=>'form-control-label']) }}
            {{ Form::text('funding',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('activity', __('Activity'),['class'=>'form-control-label']) }}
            {{ Form::text('activity',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('grant_', __('Grant'),['class'=>'form-control-label']) }}
            {{ Form::text('grant_',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('functions', __('Functions'),['class'=>'form-control-label']) }}
            {{ Form::text('functions',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('csopo', __('CSOPO'),['class'=>'form-control-label']) }}
            {{ Form::text('csopo',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('donor_report', __('Donor Report'),['class'=>'form-control-label']) }}
            {{ Form::text('donor_report',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('country', __('Country'),['class'=>'form-control-label']) }}
            {{ Form::text('country',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>


        <div class="form-group col-md-6">
            {{ Form::label('allocation', __('Allocation'),['class'=>'form-control-label']) }}
            {{ Form::number('allocation',null, array( 'min'=>0, 'step' => 'any', 'class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('control', __('Control'),['class'=>'form-control-label']) }}
            {{ Form::text('control',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>


        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
