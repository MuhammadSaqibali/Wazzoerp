<div class="card bg-none card-box">
    <?php echo e(Form::model($lead, array('route' => array('leads.sources.update', $lead->id), 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="col-12 form-group">
            <div class="row gutters-xs">
                <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 custom-control custom-checkbox mt-2 mb-2">
                        <?php echo e(Form::checkbox('sources[]',$source->id,($selected && array_key_exists($source->id,$selected))?true:false,['class' => 'custom-control-input','id'=>'sources_'.$source->id])); ?>

                        <?php echo e(Form::label('sources_'.$source->id, ucfirst($source->name),['class'=>'custom-control-label ml-4 text-sm font-weight-bold'])); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="col-12 form-group text-right">
            <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/leads/sources.blade.php ENDPATH**/ ?>