<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url'=>'custom-question','method'=>'post'))); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('question',__('Question'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('question',null,array('class'=>'form-control','placeholder'=>__('Enter question')))); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('is_required',__('Is Required'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::select('is_required', $is_required,null, array('class' => 'form-control select2','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home4/softgearcom/public_html/wazooerp/wazooerp/resources/views/customQuestion/create.blade.php ENDPATH**/ ?>