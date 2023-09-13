<div class="card bg-none card-box">
    <?php echo e(Form::model($allowance,array('route' => array('allowance.update', $allowance->id), 'method' => 'PUT'))); ?>

    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('allowance_option', __('Allowance Options'))); ?><span class="text-danger">*</span>
                    <?php echo e(Form::select('allowance_option',$allowance_options,null, array('class' => 'form-control select2','required'=>'required'))); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('title', __('Title'))); ?>

                    <?php echo e(Form::text('title',null, array('class' => 'form-control ','required'=>'required'))); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <?php echo e(Form::label('type', __('Type'),['class'=>'form-control-label'])); ?>

                <select name="type" id="a_type" class="form-control" required>
                    <option <?php echo e($allowance->type == "flat"?"selected":""); ?> value="flat">Flat</option>
                    <option <?php echo e($allowance->type == "percent"?"selected":""); ?> value="percent">Percent</option>
                </select>
            </div>
            <div class="form-group col-md-6 d-none type_amount">
                <?php echo e(Form::label('type_amount', __('Percentage'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::number('type_amount',null, array('value'=>$allowance->type_amount,'class' => 'form-control ','required'=>'required','max' => '100','min' => '0','step'=>'0.01'))); ?>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('amount', __('Amount'))); ?>

                    <?php echo e(Form::number('amount',null, array('class' => 'form-control a_amount','required'=>'required','step'=>'0.01'))); ?>

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

    <script>
        allowanceTypeChange()
    </script>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/allowance/edit.blade.php ENDPATH**/ ?>