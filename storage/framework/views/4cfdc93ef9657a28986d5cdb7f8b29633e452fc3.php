<div class="card bg-none card-box">
    <?php echo e(Form::model($lead, array('route' => array('leads.products.update', $lead->id), 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('products', __('Products'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('products[]', $products,false, array('class' => 'form-control select2','multiple'=>'','required'=>'required'))); ?>

        </div>
        <div class="col-12 form-group text-right">
            <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/leads/products.blade.php ENDPATH**/ ?>