<div class="card bg-none card-box">
<?php echo e(Form::model($expense, ['route' => ['projects.expenses.update',[$project->id,$expense->id]], 'id' => 'edit_expense', 'method' => 'POST','enctype' => 'multipart/form-data'])); ?>

<div class="row">
    <div class="col-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'),['class' => 'form-control-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control','required'=>'required'])); ?>

        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <?php echo e(Form::label('date', __('Date'),['class' => 'form-control-label'])); ?>

            <?php echo e(Form::text('date', null, ['class' => 'form-control datepicker'])); ?>

        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <?php echo e(Form::label('amount',__('Amount'),['class'=>'form-control-label'])); ?>

            <div class="form-icon-user">
                <span class="input-group-text cur"><?php echo e(\Auth::user()->currencySymbol()); ?></span>
                <?php echo e(Form::number('amount',null,array('class'=>'form-control','required' => 'required','min' => '0'))); ?>

            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <?php echo e(Form::label('task_id', __('Task'),['class' => 'form-control-label'])); ?>

            <select class="form-control select2" name="task_id" id="task_id">
                <option class="text-muted" value="0" disabled selected> Choose Task </option>
                <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($task->id); ?>" <?php echo e(($task->id == $expense->task_id) ? 'selected' : ''); ?>><?php echo e($task->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'),['class' => 'form-control-label'])); ?>

            <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('This textarea will autosize while you type')); ?></small>
            <?php echo e(Form::textarea('description', null, ['class' => 'form-control','rows' => '1','data-toggle' => 'autosize'])); ?>

        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('attachment', __('Attachment'),['class' => 'form-control-label'])); ?>

            <input type="file" name="attachment" id="attachment" class="custom-input-file"/>
            <label for="attachment">
                <i class="fa fa-upload"></i>
                <span><?php echo e(__('Choose a file…')); ?></span>
            </label>
        </div>
    </div>
</div>

<div class="col-12 text-right">
      <input type="submit" name="Update" value="Update" class="btn-create badge-blue">
</div>
<?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/expenses/edit.blade.php ENDPATH**/ ?>