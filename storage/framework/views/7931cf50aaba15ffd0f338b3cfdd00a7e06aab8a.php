<div class="card bg-none card-box">
    <?php echo e(Form::model($lead, array('route' => array('leads.discussion.store', $lead->id), 'method' => 'POST'))); ?>

    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('comment', __('Message'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::textarea('comment', null, array('class' => 'form-control'))); ?>

        </div>
        <div class="col-12 form-group text-right">
            <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/leads/discussions.blade.php ENDPATH**/ ?>