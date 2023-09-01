<?php $__env->startSection('page-title'); ?>
    <?php echo e(ucwords($project->project_name).__("'s Expenses")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create expense')): ?>
            <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto ml-2" data-url="<?php echo e(route('projects.expenses.create',$project->id)); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Expense')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i><?php echo e(__('Create')); ?></span>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('projects.show',$project->id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
            <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i><?php echo e(__('Back')); ?></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo e(__('Attachment')); ?></th>
                            <th scope="col"><?php echo e(__('Name')); ?></th>
                            <th scope="col"><?php echo e(__('Date')); ?></th>
                            <th scope="col"><?php echo e(__('Amount')); ?></th>
                            <?php if(Gate::check('edit expense') || Gate::check('delete expense')): ?>
                                <th scope="col"></th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody class="list">
                            <?php if(isset($project->expense) && !empty($project->expense) && count($project->expense) > 0): ?>
                                <?php $__currentLoopData = $project->expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row">
                                            <?php if(!empty($expense->attachment)): ?>
                                                <a href="<?php echo e(asset(Storage::url($expense->attachment))); ?>" class="btn btn-sm btn-secondary btn-icon rounded-pill" download>
                                                    <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="#" class="btn btn-sm btn-secondary btn-icon rounded-pill">
                                                    <span class="btn-inner--icon"><i class="fas fa-times-circle"></i></span>
                                                </a>
                                            <?php endif; ?>
                                        </th>
                                        <td>
                                            <span class="h6 text-sm font-weight-bold mb-0"><?php echo e($expense->name); ?></span>
                                            <?php if(!empty($expense->task)): ?><span class="d-block text-sm text-muted"><?php echo e($expense->task->name); ?></span><?php endif; ?>
                                        </td>
                                        <td><?php echo e((!empty($expense->date)) ? \App\Utility::getDateFormated($expense->date) : '-'); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($expense->amount)); ?></td>
                                        <?php if(Gate::check('edit expense') || Gate::check('delete expense')): ?>
                                            <td class="text-right w-15">
                                                <div class="actions">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit expense')): ?>
                                                        <a href="#" class="action-item px-2" data-url="<?php echo e(route('projects.expenses.edit',[$project->id,$expense->id])); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit ').$expense->name); ?>" data-toggle="tooltip" data-original-title="Edit">
                                                            <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete expense')): ?>
                                                        <a href="#" class="action-item text-danger px-2" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-expense-<?php echo e($expense->id); ?>').submit();">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.expenses.destroy',$expense->id],'id'=>'delete-expense-'.$expense->id]); ?>

                                                <?php echo Form::close(); ?>

                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <th scope="col" colspan="5"><h6 class="text-center"><?php echo e(__('No Expense Found.')); ?></h6></th>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/expenses/index.blade.php ENDPATH**/ ?>