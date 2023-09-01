<div class="card bg-none card-box">
    {{Form::model($allowance,array('route' => array('allowance.update', $allowance->id), 'method' => 'PUT')) }}
    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('allowance_option', __('Allowance Options')) }}<span class="text-danger">*</span>
                    {{ Form::select('allowance_option',$allowance_options,null, array('class' => 'form-control select2','required'=>'required')) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('title', __('Title')) }}
                    {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {{ Form::label('type', __('Type'),['class'=>'form-control-label']) }}
                <select name="type" id="a_type" class="form-control" required>
                    <option {{$allowance->type == "flat"?"selected":""}} value="flat">Flat</option>
                    <option {{$allowance->type == "percent"?"selected":""}} value="percent">Percent</option>
                </select>
            </div>
            <div class="form-group col-md-6 d-none type_amount">
                {{ Form::label('type_amount', __('Percentage'),['class'=>'form-control-label']) }}
                {{ Form::number('type_amount',null, array('value'=>$allowance->type_amount,'class' => 'form-control ','required'=>'required','max' => '100','min' => '0','step'=>'0.01')) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('amount', __('Amount')) }}
                    {{ Form::number('amount',null, array('class' => 'form-control a_amount','required'=>'required','step'=>'0.01')) }}
                </div>
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>

    <script>
        allowanceTypeChange()
    </script>
