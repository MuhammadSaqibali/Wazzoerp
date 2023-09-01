<div class="card bg-none card-box">
    <?php echo e(Form::model($employee, array('route' => array('employee.salary.update', $employee->id), 'method' => 'POST'))); ?>

    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('salary_type', __('Payslip Type'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('salary_type',$payslip_type,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('salary_based', __('Salary Based'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('salary_based',array('hourly' => "Hourly",'daily' => "Daily",'fournight' => "Fournight",'weakly' => "Weakly",'monthly' => "Monthly"),null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('salary_payment_method', __('Payment Method'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('salary_payment_method',array('cash_in_hand' => "Cash In Hand",'bank_transfer' => "Bank Transfer",'online_pay' => "Online Pay"),null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('salary', __('Salary'),['class'=>'form-control-label a_amount'])); ?>

            <?php echo e(Form::number('salary',null, array('class' => 'form-control a_amount','required'=>'required','step'=>'0.01'))); ?>

        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Save Change')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/setsalary/basic_salary.blade.php ENDPATH**/ ?>