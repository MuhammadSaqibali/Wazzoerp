<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url'=>'saturationdeduction','method'=>'post'))); ?>

    <?php echo e(Form::hidden('employee_id',$employee->id, array())); ?>

    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('deduction_option', __('Deduction Options'),['class'=>'form-control-label'])); ?><span
                class="text-danger">*</span>
            <?php echo e(Form::select('deduction_option',$deduction_options,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="w-100" id="income_ranges_panel">
            <div class="w-100" id="income_ranges"></div>






        </div>

        <div class="col-md-6 ">
            <div class="form-group">
                <?php echo e(Form::label('title', __('Title'))); ?>

                <?php echo e(Form::text('title',null, array('class' => 'form-control ','required'=>'required'))); ?>

            </div>
        </div>

        <div class="form-group col-md-6 _no_income_tax">
            <?php echo e(Form::label('deduction_type', __('Deduction Type'),['class'=>'form-control-label'])); ?><span
                class="text-danger">*</span>
            <?php echo e(Form::select('deduction_type[]',array('flat'=>'Flat','percent'=>'Percent'),null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>

        <input type="hidden" id="_init_num" value="0">

        <div class="col-md-6 _no_income_tax">
            <div class="form-group">
                <?php echo e(Form::label('amount', __('Amount'))); ?>

                <?php echo e(Form::number('amount[]',null, array('class' => 'form-control ','required'=>'required','min' => '0' , 'step'=>'0.01'))); ?>

            </div>
        </div>


        <div class="col-12 ">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<script>
    checkDeductionOption();
</script>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/saturationdeduction/create.blade.php ENDPATH**/ ?>