<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url' => 'chart-of-account'))); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('code', __('Code'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('code', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('type', __('Account'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('type', $types,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('sub_type',__('Type'),['class'=>'form-control-label'])); ?>

            <select class="form-control select2" name="sub_type" id="sub_type" required>

            </select>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('is_enabled',__('Is Enabled'),array('class'=>'form-control-label'))); ?>

            <div class="custom-control custom-switch">
                <input type="checkbox" class="email-template-checkbox custom-control-input" name="is_enabled" id="is_enabled" checked>
                <label class="custom-control-label form-control-label" for="is_enabled"></label>
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
<?php /**PATH /home4/softgearcom/public_html/wazooerp/wazooerp/resources/views/chartOfAccount/create.blade.php ENDPATH**/ ?>