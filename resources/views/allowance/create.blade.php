<div class="card bg-none card-box">
    {{Form::open(array('url'=>'allowance','method'=>'post'))}}
    {{ Form::hidden('employee_id',$employee->id, array()) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('allowance_option', __('Allowance Options'),['class'=>'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('allowance_option',$allowance_options,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('title', __('Title'),['class'=>'form-control-label']) }}
            {{ Form::text('title',null, array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('type', __('Type'),['class'=>'form-control-label']) }}
            <select name="type" id="a_type" class="form-control" required>
                <option value="flat">Flat</option>
                <option value="percent">Percent</option>
            </select>
        </div>
        <div class="form-group col-md-4 d-none type_amount">
            {{ Form::label('type_amount', __('Percentage'),['class'=>'form-control-label']) }}
            {{ Form::number('type_amount',null, array('class' => 'form-control ','value'=>'0','required'=>'required','max' => '100','min' => '0','step'=>'0.01')) }}
        </div>

        <div class="form-group col-md-4">
            {{ Form::label('amount', __('Amount'),['class'=>'form-control-label']) }}
            {{ Form::number('amount',null, array('class' => 'form-control a_amount','required'=>'required','step'=>'0.01')) }}
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
  <script>
        allowanceTypeChange()
    </script>