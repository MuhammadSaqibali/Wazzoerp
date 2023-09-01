<div class="card bg-none card-box">
    <?php echo e(Form::model($loan,array('route' => array('budget.update', $loan->id), 'method' => 'PUT'))); ?>

    <?php echo e(Form::hidden('created_by',$loan->created_by, array())); ?>

    <div class="card-body p-0">
        <div class="row">
            <div class="form-group col-md-6">
                <?php echo e(Form::label('cost_center', __('Cost Center'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('cost_center',null, array('class' => 'form-control ','required'=>'required','value' => $loan->cost_center ))); ?>

            </div>


            <div class="form-group col-md-6">
                <?php echo e(Form::label('funding', __('Funding'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('funding',null, array('class' => 'form-control ','required'=>'required','value' => $loan->funding))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('activity', __('Activity'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('activity',null, array('class' => 'form-control ','required'=>'required','value' => $loan->activity))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('grant_', __('Grant'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('grant_',null, array('class' => 'form-control ','required'=>'required','value' => $loan->grant_))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('functions', __('Functions'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('functions',null, array('class' => 'form-control ','required'=>'required','value' => $loan->functions))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('csopo', __('CSOPO'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('csopo',null, array('class' => 'form-control ','required'=>'required','value' => $loan->csopo))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('donor_report', __('Donor Report'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('donor_report',null, array('class' => 'form-control ','required'=>'required','value' => $loan->donor_report))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('country', __('Country'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('country',null, array('class' => 'form-control ','required'=>'required','value' => $loan->country))); ?>

            </div>

            <div class="form-group col-md-6">
                <?php echo e(Form::label('allocation', __('Allocation'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::number('allocation',null, array( 'min'=>0, 'step' => 'any', 'class' => 'form-control ','value' => $loan->allocation,'required'=>'required'))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('control', __('Control'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('control',null, array('class' => 'form-control ','required'=>'required','value' => $loan->control))); ?>

            </div>

            <div class="col-12">
                <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>

    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/budget/edit.blade.php ENDPATH**/ ?>