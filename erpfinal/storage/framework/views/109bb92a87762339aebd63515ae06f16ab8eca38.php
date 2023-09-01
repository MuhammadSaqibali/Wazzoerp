<div class="card bg-none card-box">
<?php echo e(Form::model($formField, array('route' => array('form.bind.store', $form->id)))); ?>

<div class="row">
    <div class="col-12 pb-3">
        <span class="text-xs"><b><?php echo e(__('It will auto convert from response on lead based on below setting. It will not convert old response.')); ?></b></span>
    </div>
</div>
<div class="row px-2">
    <div class="col-4">
        <div class="form-group">
            <?php echo e(Form::label('active', __('Active'),['class'=>'form-control-label'])); ?>

        </div>
    </div>
    <div class="col-8">
        <div class="d-flex radio-check">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="on" value="1" name="is_lead_active" class="custom-control-input lead_radio" <?php echo e(($form->is_lead_active == 1) ? 'checked' : ''); ?>>
                <label class="custom-control-label form-control-label" for="on"><?php echo e(__('On')); ?></label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="off" value="0" name="is_lead_active" class="custom-control-input lead_radio" <?php echo e(($form->is_lead_active == 0) ? 'checked' : ''); ?>>
                <label class="custom-control-label form-control-label" for="off"><?php echo e(__('Off')); ?></label>
            </div>
        </div>
    </div>
</div>
<div id="lead_activated" class="d-none">
    <div class="row px-2">
        <div class="col-4">
            <div class="form-group">
                <?php echo e(Form::label('subject_id', __('Subject'),['class'=>'form-control-label'])); ?>

            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('subject_id', $types,null, array('class' => 'form-control','data-toggle'=>'select'))); ?>

            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <?php echo e(Form::label('name_id', __('Name'),['class'=>'form-control-label'])); ?>

            </div>
        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('name_id', $types,null, array('class' => 'form-control','data-toggle'=>'select'))); ?>

            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('email_id', __('Email'),['class'=>'form-control-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('email_id', $types,null, array('class' => 'form-control','data-toggle'=>'select'))); ?>

            </div>
            <?php echo e(Form::hidden('form_id',$form->id)); ?>

            <?php echo e(Form::hidden('form_response_id',(!empty($formField)) ? $formField->id : '')); ?>

        </div>
        <div class="col-4">
            <?php echo e(Form::label('user_id', __('User'),['class'=>'form-control-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control','data-toggle'=>'select'))); ?>

                <?php if(count($users) == 0): ?>
                    <div class="text-muted text-xs">
                        <?php echo e(__('Please create new employee')); ?> <a href="<?php echo e(route('employee.index')); ?>" ><?php echo e(__('here')); ?></a>.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-4">
            <?php echo e(Form::label('pipeline_id', __('Pipelines'),['class'=>'form-control-label'])); ?>

        </div>
        <div class="col-8">
            <div class="form-group">
                <?php echo e(Form::select('pipeline_id', $pipelines,null, array('class' => 'form-control','data-toggle'=>'select'))); ?>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn-create badge-blue">

    </div>
</div>
<?php echo e(Form::close()); ?>

</div>

<script>
    $(document).ready(function () {
        var lead_active = <?php echo e($form->is_lead_active); ?>;
        if (lead_active == 1) {
            $('#lead_activated').removeClass('d-none');
        }
    });
    $(document).on('click', function () {
        $('.lead_radio').on('click', function () {
            var inputValue = $(this).attr("value");
            if (inputValue == 1) {
                $('#lead_activated').removeClass('d-none');
            } else {
                $('#lead_activated').addClass('d-none');
            }
            $('.lead_radio').removeAttr('checked');
            $(this).prop("checked", true);
        })
    });
</script>
<?php /**PATH /home4/softgearcom/public_html/wazooerp/wazooerp/resources/views/form_builder/form_field.blade.php ENDPATH**/ ?>