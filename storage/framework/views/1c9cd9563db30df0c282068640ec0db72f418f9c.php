<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Bug Report')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bug report')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="<?php echo e(route('task.bug.create',$project->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create Bug')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('Create')); ?></a>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug report')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="<?php echo e(route('task.bug.kanban',$project->id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-table"></i> <?php echo e(__('Bug Kanban')); ?> </a>
            </div>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project')): ?>
          <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="<?php echo e(route('projects.show',$project->id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i><?php echo e(__('Back')); ?></span>
            </a>
          </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped dataTable">
                        <thead>
                        <tr>
                            <th> <?php echo e(__('Bug Id')); ?></th>
                            <th> <?php echo e(__('Assign To')); ?></th>
                            <th> <?php echo e(__('Bug Title')); ?></th>
                            <th> <?php echo e(__('Start Date')); ?></th>
                            <th> <?php echo e(__('Due Date')); ?></th>
                            <th> <?php echo e(__('Status')); ?></th>
                            <th> <?php echo e(__('Priority')); ?></th>
                            <th> <?php echo e(__('Created By')); ?></th>
                            <th width="10%"> <?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $bugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(\Auth::user()->bugNumberFormat($bug->bug_id)); ?></td>
                                <td><?php echo e((!empty($bug->assignTo)?$bug->assignTo->name:'')); ?></td>
                                <td><?php echo e($bug->title); ?></td>
                                <td><?php echo e(Auth::user()->dateFormat($bug->start_date)); ?></td>
                                <td><?php echo e(Auth::user()->dateFormat($bug->due_date)); ?></td>
                                <td><?php echo e((!empty($bug->bug_status)?$bug->bug_status->title:'')); ?></td>
                                <td><?php echo e($bug->priority); ?></td>
                                <td><?php echo e($bug->createdBy->name); ?></td>
                                <td class="Action" width="10%">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit bug report')): ?>
                                        <a href="#" class="edit-icon" data-url="<?php echo e(route('task.bug.edit',[$project->id,$bug->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Bug Report')); ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete bug report')): ?>
                                        <a href="#" class="delete-icon" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($bug->id); ?>').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['task.bug.destroy', $project->id,$bug->id],'id'=>'delete-form-'.$bug->id]); ?>

                                        <?php echo Form::close(); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/projects/bug.blade.php ENDPATH**/ ?>