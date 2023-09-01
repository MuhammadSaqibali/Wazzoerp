<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url'=>'interview-schedule','method'=>'post'))); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('candidate',__('Interviewer'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('candidate', $candidates,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('employee',__('Assign Employee'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('employee', $employees,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('date',__('Interview Date'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('date',null,array('class'=>'form-control datepicker'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('time',__('Interview Time'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('time',null,array('class'=>'form-control timepicker'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('comment',__('Comment'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::textarea('comment',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>

<?php if($candidate!=0): ?>
    <script>
        $('select#candidate').val(<?php echo e($candidate); ?>).trigger('change');
    </script>
<?php endif; ?>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/interviewSchedule/create.blade.php ENDPATH**/ ?>