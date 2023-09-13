<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url' => 'bank-transfer'))); ?>

    <div class="row">
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('from_account', __('From Account'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('from_account', $bankAccount,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('to_account', __('To Account'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('to_account', $bankAccount,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('amount', __('Amount'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-money-bill-alt"></i></span>
                <?php echo e(Form::number('amount', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('date', __('Date'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-calendar"></i></span>
                <?php echo e(Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('reference', __('Reference'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-clipboard"></i></span>
                <?php echo e(Form::text('reference', '', array('class' => 'form-control'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::textarea('description', '', array('class' => 'form-control','rows'=>3))); ?>

        </div>
        <div class="col-md-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home4/softgearcom/public_html/wazooerp/wazooerp/resources/views/bank-transfer/create.blade.php ENDPATH**/ ?>