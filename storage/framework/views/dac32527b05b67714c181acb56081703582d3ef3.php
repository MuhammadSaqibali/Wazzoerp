<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url' => 'form_builder'))); ?>

    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=> 'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('active', __('Active'),['class'=>'form-control-label'])); ?>

            <div class="d-flex radio-check">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="on" value="1" name="is_active" class="custom-control-input" checked="checked">
                    <label class="custom-control-label form-control-label" for="on"><?php echo e(__('On')); ?></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="off" value="0" name="is_active" class="custom-control-input">
                    <label class="custom-control-label form-control-label" for="off"><?php echo e(__('Off')); ?></label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/form_builder/create.blade.php ENDPATH**/ ?>