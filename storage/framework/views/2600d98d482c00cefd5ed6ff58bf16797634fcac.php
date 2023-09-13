<div class="card bg-none card-box">
    <?php echo e(Form::open(array('route' => ['leads.labels.store',$lead->id]))); ?>

    <div class="row">
        <div class="col-12 form-group">
            <div class="row gutters-xs">
                <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-12 custom-control custom-checkbox mt-2 mb-2">
                        <?php echo e(Form::checkbox('labels[]',$label->id,(array_key_exists($label->id,$selected))?true:false,['class' => 'custom-control-input','id'=>'labels_'.$label->id])); ?>

                        <?php echo e(Form::label('labels_'.$label->id, ucfirst($label->name),['class'=>'custom-control-label ml-4 text-white badge badge-pill badge-'.$label->color])); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="form-group col-12 text-right">
            <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/leads/labels.blade.php ENDPATH**/ ?>