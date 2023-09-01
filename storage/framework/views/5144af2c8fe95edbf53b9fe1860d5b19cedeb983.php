
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Monthly Attendance')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
            <?php echo e(Form::open(array('route' => array('report.daily.attendance'),'method'=>'get','id'=>'report_monthly_attendance'))); ?>

            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('date',__('Date'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::date('date',isset($_GET['date'])?$_GET['date']:$date->toDateString(),array('class'=>'month-btn form-control'))); ?>

                </div>
            </div>
        </div>

        <div class="col-auto my-custom">
            <a href="#" class="apply-btn"
               onclick="document.getElementById('report_monthly_attendance').submit(); return false;"
               data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="<?php echo e(route('report.daily.attendance')); ?>" class="reset-btn" data-toggle="tooltip"
               data-original-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="printableArea">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="table-responsive py-4 attendance-table-responsive">
                        <table class="table table-striped mb-0" id="dataTable-1">
                            <thead>
                            <tr>
                                <th class="active"><?php echo e(__('Name')); ?></th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Overtime</th>
                                <th>Total Time</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $attendance  = $employee->getAttendance($date);
    $extraTime = explode(':',$attendance['extra_time']);
                                ?>
                                <tr>
                                    <td><?php echo e($employee->name); ?></td>
                                    <td><?php echo e($attendance['clock_in']); ?></td>
                                    <td><?php echo e($attendance['clock_out']); ?></td>
                                    <td>
                                        <select class="over_select" data-t="h">
                                            <?php for($i= 0;$i <=12; $i++): ?>
                                                <option <?php if( (int) $extraTime[0] ==$i): ?> selected
                                                        <?php endif; ?> value="<?php echo e(\App\Employee::zeroPrecedor($i)); ?>"><?php echo e(\App\Employee::zeroPrecedor($i)); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <span>:</span>
                                        <select class="over_select" data-t="m">
                                            <?php for($i= 0;$i <60; $i++): ?>
                                                <option <?php if( (int) $extraTime[1] ==$i): ?> selected
                                                        <?php endif; ?> value="<?php echo e(\App\Employee::zeroPrecedor($i)); ?>"><?php echo e(\App\Employee::zeroPrecedor($i)); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <span>:</span>
                                        <select class="over_select" data-t="s">
                                            <?php for($i= 0;$i <60; $i++): ?>
                                                <option <?php if( (int) $extraTime[2] ==$i): ?> selected
                                                        <?php endif; ?> value="<?php echo e(\App\Employee::zeroPrecedor($i)); ?>"><?php echo e(\App\Employee::zeroPrecedor($i)); ?></option>
                                            <?php endfor; ?>
                                        </select>

                                    </td>
                                    <td><?php echo e($attendance['total_time']); ?></td>
                                    <td>
                                        <?php if($attendance['enable_btn']): ?>
                                            <form action="<?php echo e(route('post.report.daily.attendance')); ?>" class="w-100 d-block" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" class="over_input"
                                                       value="<?php echo e($attendance['extra_time']); ?>" name="overtime">
                                                <input type="hidden" name="attendance_id"
                                                       value="<?php echo e($attendance['attendance_id']); ?>">
                                                <button type="submit" class="btn btn-block btn-primary btn-sm">Update
                                                </button>
                                            </form>

                                        <?php else: ?>
                                            <label class="badge badge-danger">Absent</label>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on("change",".over_select",function (){
            $col = $(this).parent('td');
            $row = $col.parent('tr');
            // console.log($row.find('.over_input'))

            let o_time = '';

            $col.find('.over_select').each(function (){
                o_time = o_time+($(this).val())+':'
            });

            $row.find('.over_input').val(o_time.slice(0, -1))


        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wazzoerp\resources\views/report/dailyAttendance.blade.php ENDPATH**/ ?>