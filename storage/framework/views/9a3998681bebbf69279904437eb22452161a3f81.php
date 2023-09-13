<div class="card bg-none card-box">
    <?php echo e(Form::open(array('route' => array('saturationdeduction.update', $saturationdeduction->id), 'method' => 'PUT'))); ?>


    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('deduction_option', __('Deduction Options'))); ?><span class="text-danger">*</span>
                    <?php echo e(Form::select('deduction_option',$deduction_options,array($saturationdeduction->deduction_option), array('class' => 'form-control select2','required'=>'required'))); ?>

                </div>
            </div>
            <input type="hidden" id="_init_num" value="<?php echo e(count($saturationdeduction->amount)); ?>">
            <div class="w-100" id="income_ranges_panel">
                <div class="w-100" id="income_ranges">
                    <?php if($saturationdeduction->deduction_option == 0): ?>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <label>Minimum Eligible Income</label>
                                <input type="number" min="0" step="any" class="form-control " value="<?php echo e($saturationdeduction->min_elig); ?>" name="min_elig"
                                       required/>
                            </div>
                        </div>
                        <?php $__currentLoopData = $saturationdeduction->amount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div data-r="${row}" class="w-100 range_row range_row_<?php echo e($key+1); ?> row">

                                <input type="hidden" name="deduction_type[]" value="percent">
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Min Income</label>
                                        <input type="number" min="0" step="any" class="form-control min_income"
                                               name="min_incom[]" value="<?php echo e($saturationdeduction->min_incom[$key]); ?>"
                                               required/>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Max Income</label>
                                        <input type="number" min="0" step="any" class="form-control max_income"
                                               readonly/>
                                    </div>
                                </div>

                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Percentage</label>
                                        <input type="number" min="0" step="any" value="<?php echo e($amount); ?>"
                                               class="form-control tax_percent" name="amount[]" required/>
                                    </div>
                                </div>
                                <div class="col-md-3 ">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" value="0" min="0" step="any"
                                               class="form-control tax_amount" readonly/>
                                    </div>
                                </div>

                            </div>


                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        
                        <div class="w-100   row">

                
                <div class="col-md-6 ">
                    Total Taxable Amount
                </div>

              
                <div class="col-md-6 text-right text-end">
                    <span id="vat_text">0</span>
                </div>

            </div>
                        
                    <?php endif; ?>
                </div>
                
                
                
                
                
                
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <?php echo e(Form::label('title', __('Title'))); ?>

                    <?php echo e(Form::text('title',$saturationdeduction->title, array('class' => 'form-control ','required'=>'required'))); ?>

                </div>
            </div>
            <div class="form-group col-md-6 _no_income_tax">
                <?php echo e(Form::label('deduction_type', __('Deduction Type'),['class'=>'form-control-label'])); ?><span
                    class="text-danger">*</span>
                <select name="deduction_type[]" class="form-control select2" required>
                    <option
                        <?php echo e($saturationdeduction->deduction_option != 0?($saturationdeduction->amount[0] == "flat"?"selected":""):""); ?> value="flat">
                        Flat
                    </option>
                    <option
                        <?php echo e($saturationdeduction->deduction_option != 0?($saturationdeduction->amount[0] == "percent"?"selected":""):""); ?> value="percent">
                        Percent
                    </option>
                </select>
            </div>

            <input type="hidden" id="_init_num" value="1">
            <div class="form-group  col-md-6 _no_income_tax">
                <div class="form-group">
                    <?php echo e(Form::label('amount', __('Amount'))); ?>

                    <?php echo e(Form::number('amount[]',$saturationdeduction->deduction_option != 0?($saturationdeduction->amount[0]):0, array('class' => 'form-control ','required'=>'required','min' => '0' , 'step'=>'0.01'))); ?>

                </div>
            </div>
            <div class="col-12">
                <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>

<script>
    checkDeductionOption();
</script>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/saturationdeduction/edit.blade.php ENDPATH**/ ?>