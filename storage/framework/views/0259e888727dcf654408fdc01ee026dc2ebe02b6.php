<div class="card bg-none card-box">
<?php echo e(Form::model($form_field, array('route' => array('form.field.update', $form->id, $form_field->id), 'method' => 'post'))); ?>

<div class="row" id="frm_field_data">
    <div class="col-12 form-group">
        <?php echo e(Form::label('name', __('Question Name'),['class'=>'form-control-label'])); ?>

        <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

    </div>
    <div class="col-12 form-group">
        <?php echo e(Form::label('type', __('Type'),['class'=>'form-control-label'])); ?>

        <?php echo e(Form::select('type', $types,null, array('class' => 'form-control','data-toggle'=>'select','required'=>'required'))); ?>

    </div>
    <div class="col-md-12">
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
    </div>
</div>
<?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/form_builder/field_edit.blade.php ENDPATH**/ ?>