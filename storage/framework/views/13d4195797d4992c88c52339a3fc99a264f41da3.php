<div class="card bg-none card-box">
    <?php echo e(Form::open(array('route'=>array('job.on.board.store',$id),'method'=>'post'))); ?>

    <div class="row">
        <?php if($id==0): ?>
            <div class="form-group col-md-12">
                <?php echo e(Form::label('application',__('Interviewer'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::select('application',$applications,null,array('class'=>'form-control select2','required'=>'required'))); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-12">
            <?php echo Form::label('joining_date', __('Joining Date'),['class'=>'form-control-label']); ?>

            <?php echo Form::text('joining_date', null, ['class' => 'form-control datepicker']); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('status',__('Status'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('status',$status,null,array('class'=>'form-control select2'))); ?>

        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>

<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/jobApplication/onboardCreate.blade.php ENDPATH**/ ?>