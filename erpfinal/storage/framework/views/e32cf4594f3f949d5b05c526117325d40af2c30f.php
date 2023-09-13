<div class="card bg-none card-box">
    <?php echo e(Form::open(array('route' => array('bill.custom.debit.note'),'mothod'=>'post'))); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <?php echo e(Form::label('bill', __('Bill'),['class'=>'form-control-label'])); ?>

                <select class="form-control select2" required="required" id="bill" name="bill">
                    <option value="0"><?php echo e(__('Select Bill')); ?></option>
                    <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>"><?php echo e(\Auth::user()->billNumberFormat($bill)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('amount', __('Amount'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-money-bill-alt"></i></span>
                <?php echo e(Form::number('amount', null, array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

            </div>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('date', __('Date'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span><i class="fas fa-money-bill-alt"></i></span>
                <?php echo e(Form::text('date','', array('class' => 'form-control datepicker'))); ?>

            </div>
        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-control-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>
        <div class="col-md-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home4/softgearcom/public_html/wazooerp/wazooerp/resources/views/debitNote/custom_create.blade.php ENDPATH**/ ?>