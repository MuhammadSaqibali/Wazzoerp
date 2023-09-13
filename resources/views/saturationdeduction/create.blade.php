<div class="card bg-none card-box">
    {{Form::open(array('url'=>'saturationdeduction','method'=>'post'))}}
    {{ Form::hidden('employee_id',$employee->id, array()) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('deduction_option', __('Deduction Options'),['class'=>'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('deduction_option',$deduction_options,null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>
        <div class="w-100" id="income_ranges_panel">
            <div class="w-100" id="income_ranges"></div>
{{--            <div class="row">--}}
{{--                <div class="col-md-12 text-right">--}}
{{--                    <button class="btn btn-sm btn-danger remove_income_row" type="button"><i class="fa fa-minus-circle"></i></button>--}}
{{--                    <button class="btn btn-sm btn-primary insert_income_row" type="button"><i class="fa fa-plus-circle"></i></button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

        <div class="col-md-6 ">
            <div class="form-group">
                {{ Form::label('title', __('Title')) }}
                {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
            </div>
        </div>

        <div class="form-group col-md-6 _no_income_tax">
            {{ Form::label('deduction_type', __('Deduction Type'),['class'=>'form-control-label']) }}<span
                class="text-danger">*</span>
            {{ Form::select('deduction_type[]',array('flat'=>'Flat','percent'=>'Percent'),null, array('class' => 'form-control select2','required'=>'required')) }}
        </div>

        <input type="hidden" id="_init_num" value="0">

        <div class="col-md-6 _no_income_tax">
            <div class="form-group">
                {{ Form::label('amount', __('Amount')) }}
                {{ Form::number('amount[]',null, array('class' => 'form-control ','required'=>'required','min' => '0' , 'step'=>'0.01')) }}
            </div>
        </div>


        <div class="col-12 ">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
<script>
    checkDeductionOption();
</script>
