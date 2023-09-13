<div class="card bg-none card-box">
    <?php echo e(Form::open(array('url'=>'indicator','method'=>'post'))); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('branch',__('Branch'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::select('branch',$brances,null,array('class'=>'form-control select2','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('department',__('Department'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::select('department',$departments,null,array('class'=>'form-control select2','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('designation',__('Designation'),['class'=>'form-control-label'])); ?>

                <select class="select2 form-control select2-multiple" id="designation_id" name="designation" data-toggle="select2" data-placeholder="<?php echo e(__('Select Designation ...')); ?>" required>
                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <h6><?php echo e(__('Technical Competencies')); ?></h6>
            <hr class="mt-0">
        </div>
        <?php $__currentLoopData = $technicals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technical): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6">
                <?php echo e($technical->name); ?>

            </div>
            <div class="col-6">
                <fieldset id='demo1' class="rating">
                    <input class="stars" type="radio" id="technical-5-<?php echo e($technical->id); ?>" name="rating[<?php echo e($technical->id); ?>]" value="5"/>
                    <label class="full" for="technical-5-<?php echo e($technical->id); ?>" title="Awesome - 5 stars"></label>
                    <input class="stars" type="radio" id="technical-4-<?php echo e($technical->id); ?>" name="rating[<?php echo e($technical->id); ?>]" value="4"/>
                    <label class="full" for="technical-4-<?php echo e($technical->id); ?>" title="Pretty good - 4 stars"></label>
                    <input class="stars" type="radio" id="technical-3-<?php echo e($technical->id); ?>" name="rating[<?php echo e($technical->id); ?>]" value="3"/>
                    <label class="full" for="technical-3-<?php echo e($technical->id); ?>" title="Meh - 3 stars"></label>
                    <input class="stars" type="radio" id="technical-2-<?php echo e($technical->id); ?>" name="rating[<?php echo e($technical->id); ?>]" value="2"/>
                    <label class="full" for="technical-2-<?php echo e($technical->id); ?>" title="Kinda bad - 2 stars"></label>
                    <input class="stars" type="radio" id="technical-1-<?php echo e($technical->id); ?>" name="rating[<?php echo e($technical->id); ?>]" value="1"/>
                    <label class="full" for="technical-1-<?php echo e($technical->id); ?>" title="Sucks big time - 1 star"></label>
                </fieldset>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <h6><?php echo e(__('Organizational Competencies')); ?></h6>
            <hr class="mt-0">
        </div>
        <?php $__currentLoopData = $organizationals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organizational): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6">
                <?php echo e($organizational->name); ?>

            </div>
            <div class="col-6">
                <fieldset id='demo1' class="rating">
                    <input class="stars" type="radio" id="organizational-5-<?php echo e($organizational->id); ?>" name="rating[<?php echo e($organizational->id); ?>]" value="5"/>
                    <label class="full" for="organizational-5-<?php echo e($organizational->id); ?>" title="Awesome - 5 stars"></label>
                    <input class="stars" type="radio" id="organizational-4-<?php echo e($organizational->id); ?>" name="rating[<?php echo e($organizational->id); ?>]" value="4"/>
                    <label class="full" for="organizational-4-<?php echo e($organizational->id); ?>" title="Pretty good - 4 stars"></label>
                    <input class="stars" type="radio" id="organizational-3-<?php echo e($organizational->id); ?>" name="rating[<?php echo e($organizational->id); ?>]" value="3"/>
                    <label class="full" for="organizational-3-<?php echo e($organizational->id); ?>" title="Meh - 3 stars"></label>
                    <input class="stars" type="radio" id="organizational-2-<?php echo e($organizational->id); ?>" name="rating[<?php echo e($organizational->id); ?>]" value="2"/>
                    <label class="full" for="organizational-2-<?php echo e($organizational->id); ?>" title="Kinda bad - 2 stars"></label>
                    <input class="stars" type="radio" id="organizational-1-<?php echo e($organizational->id); ?>" name="rating[<?php echo e($organizational->id); ?>]" value="1"/>
                    <label class="full" for="organizational-1-<?php echo e($organizational->id); ?>" title="Sucks big time - 1 star"></label>
                </fieldset>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3">
            <h6><?php echo e(__('Behavioural Competencies')); ?></h6>
            <hr class="mt-0">
        </div>
        <?php $__currentLoopData = $behaviourals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $behavioural): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6">
                <?php echo e($behavioural->name); ?>

            </div>
            <div class="col-6">
                <fieldset id='demo1' class="rating">
                    <input class="stars" type="radio" id="behavioural-5-<?php echo e($behavioural->id); ?>" name="rating[<?php echo e($behavioural->id); ?>]" value="5"/>
                    <label class="full" for="behavioural-5-<?php echo e($behavioural->id); ?>" title="Awesome - 5 stars"></label>
                    <input class="stars" type="radio" id="behavioural-4-<?php echo e($behavioural->id); ?>" name="rating[<?php echo e($behavioural->id); ?>]" value="4"/>
                    <label class="full" for="behavioural-4-<?php echo e($behavioural->id); ?>" title="Pretty good - 4 stars"></label>
                    <input class="stars" type="radio" id="behavioural-3-<?php echo e($behavioural->id); ?>" name="rating[<?php echo e($behavioural->id); ?>]" value="3"/>
                    <label class="full" for="behavioural-3-<?php echo e($behavioural->id); ?>" title="Meh - 3 stars"></label>
                    <input class="stars" type="radio" id="behavioural-2-<?php echo e($behavioural->id); ?>" name="rating[<?php echo e($behavioural->id); ?>]" value="2"/>
                    <label class="full" for="behavioural-2-<?php echo e($behavioural->id); ?>" title="Kinda bad - 2 stars"></label>
                    <input class="stars" type="radio" id="behavioural-1-<?php echo e($behavioural->id); ?>" name="rating[<?php echo e($behavioural->id); ?>]" value="1"/>
                    <label class="full" for="behavioural-1-<?php echo e($behavioural->id); ?>" title="Sucks big time - 1 star"></label>
                </fieldset>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home4/softgearcom/public_html/wazooerp/wazooerp/resources/views/indicator/create.blade.php ENDPATH**/ ?>