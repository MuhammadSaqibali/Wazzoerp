<div class="card">
    <div class="card-header">
        <h4><?php echo e(__('Mark Attandance')); ?></h4>
    </div>
    <div class="card-body dash-card-body">
        <p class="d-flex justify-content-between">
            <span
                class="text-muted pb-0-5">Clock In:<?php if(!empty($employeeAttendance)): ?> <?php echo e($employeeAttendance->clock_in); ?> <?php else: ?>
                    --- <?php endif; ?> </span><span> Clock Out:<?php if(!empty($employeeAttendance) && $employeeAttendance->clock_out != '00:00:00'): ?> <?php echo e($employeeAttendance->clock_out); ?> <?php else: ?>
                    --- <?php endif; ?></span>
        </p>
        <center>
            <div class="row">
                <div class="col-md-6 float-right border-right">
                    <?php echo e(Form::open(array('url'=>'attendanceemployee/attendance','method'=>'post'))); ?>


                    <?php if(empty($employeeAttendance) || $employeeAttendance->clock_in == '00:00:00'): ?>
                        <button type="submit" value="0" name="in" id="clock_in"
                                class="btn-create badge-success"><?php echo e(__('CLOCK IN')); ?></button>
                    <?php else: ?>
                        <button type="button" value="0" name="in" id="clock_in"
                                class="btn-create badge-success disabled" disabled><?php echo e(__('CLOCK IN')); ?></button>
                    <?php endif; ?>
                    <?php echo e(Form::close()); ?>

                </div>
                <div class="col-md-6 float-left">
                    <?php if(!empty($employeeAttendance) && $employeeAttendance->clock_out == '00:00:00'): ?>
                        <?php echo e(Form::model($employeeAttendance,array('route'=>array('attendanceemployee.update',$employeeAttendance->id),'method' => 'PUT'))); ?>

                        <button type="submit" value="1" name="out" id="clock_out"
                                class="btn-create badge-danger"><?php echo e(__('CLOCK OUT')); ?></button>
                    <?php else: ?>
                        <button type="button" value="1" name="out" id="clock_out"
                                class="btn-create badge-danger disabled" disabled><?php echo e(__('CLOCK OUT')); ?></button>
                    <?php endif; ?>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </center>

    </div>
</div>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/aten.blade.php ENDPATH**/ ?>