<div class="card bg-none card-box">
    <?php echo e(Form::model($overtime,array('route' => array('overtime.update', $overtime->id), 'method' => 'PUT'))); ?>

    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('title', __('Title'))); ?>

                    <?php echo e(Form::text('title',null, array('class' => 'form-control ','required'=>'required'))); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('number_of_days', __('Number Of Days'))); ?>

                    <?php echo e(Form::text('number_of_days',null, array('class' => 'form-control ','required'=>'required'))); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('hours', __('Hours'))); ?>

                    <?php echo e(Form::text('hours',null, array('class' => 'form-control ','required'=>'required'))); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('rate', __('Rate'))); ?>

                    <?php echo e(Form::number('rate',null, array('class' => 'form-control ','required'=>'required'))); ?>

                </div>
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>


</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/overtime/edit.blade.php ENDPATH**/ ?>