<?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <th scope="row">
            <div class="media align-items-center">
                <div>
                    <img data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?>  class="avatar rounded-circle avatar-sm">
                </div>
                <div class="media-body ml-3">
                    <a class="name mb-0 h6 text-sm"><?php echo e($user->name); ?></a>
                    <br>
                    <a class="text-sm text-muted"><?php echo e($user->email); ?></a>
                </div>
            </div>
        </th>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/projects/users.blade.php ENDPATH**/ ?>