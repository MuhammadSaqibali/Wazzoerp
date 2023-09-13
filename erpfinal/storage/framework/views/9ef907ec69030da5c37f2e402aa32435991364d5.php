<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url' => 'lead_stages'))); ?>

    <div class="row">
        <div class="form-group col-12">
            <?php echo e(Form::label('name', __('Lead Stage Name'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-12">
            <?php echo e(Form::label('pipeline_id', __('Pipeline'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('pipeline_id', $pipelines,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="col-12 text-right">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home4/softgearcom/public_html/wazooerp/wazooerp/resources/views/lead_stages/create.blade.php ENDPATH**/ ?>