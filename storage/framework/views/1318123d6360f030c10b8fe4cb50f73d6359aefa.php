<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Support')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0 "><?php echo e(__('Support')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Support')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <a href="<?php echo e(route('support.index')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
        <i class="fas fa-list"></i> <?php echo e(__('List View')); ?></span>
    </a>
    <a href="#" data-size="lg" data-url="<?php echo e(route('support.create')); ?>" data-toggle="tooltip" data-ajax-popup="true" data-title="<?php echo e(__('Create New Support')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
        <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

    </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3">
                <div class="card card-fluid">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#" class="avatar rounded-circle">
                                    <img alt="" class="" <?php if(!empty($support->createdBy) && !empty($support->createdBy->avatar)): ?> src="<?php echo e(asset(Storage::url('uploads/avatar')).'/'.$support->createdBy->avatar); ?>" <?php else: ?>  src="<?php echo e(asset(Storage::url('uploads/avatar')).'/avatar.png'); ?>" <?php endif; ?>>
                                    <?php if($support->replyUnread()>0): ?>
                                        <span class="avatar-child avatar-badge bg-success"></span>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="col">
                                <a href="#!" class="d-block h6 mb-0"><?php echo e(!empty($support->createdBy)?$support->createdBy->name:''); ?></a>
                                <small class="d-block text-muted"><?php echo e($support->subject); ?></small>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col text-center">
                                <span class="h6 mb-0"><?php echo e($support->ticket_code); ?></span>
                                <span class="d-block text-sm"><?php echo e(__('Code')); ?></span>
                            </div>
                            <div class="col text-center">
                                <span class="h6 mb-0">
                                     <?php if($support->priority == 0): ?>
                                        <span  class="text-capitalize badge badge-primary rounded-pill badge-sm">   <?php echo e(__(\App\Support::$priority[$support->priority])); ?></span>
                                    <?php elseif($support->priority == 1): ?>
                                        <span  class="text-capitalize badge badge-info rounded-pill badge-sm">   <?php echo e(__(\App\Support::$priority[$support->priority])); ?></span>
                                    <?php elseif($support->priority == 2): ?>
                                        <span  class="text-capitalize badge badge-warning rounded-pill badge-sm">   <?php echo e(__(\App\Support::$priority[$support->priority])); ?></span>
                                    <?php elseif($support->priority == 3): ?>
                                        <span  class="text-capitalize badge badge-danger rounded-pill badge-sm">   <?php echo e(__(\App\Support::$priority[$support->priority])); ?></span>
                                    <?php endif; ?>
                                </span>
                                <span class="d-block text-sm"><?php echo e(__('Priority')); ?></span>
                            </div>
                            <div class="col text-center">
                                <span class="h6 mb-0">
                                    <?php if(!empty($support->attachment)): ?>
                                        <a href="<?php echo e(asset(Storage::url('uploads/supports')).'/'.$support->attachment); ?>" download="" class="btn btn-sm btn-secondary btn-icon rounded-pill" target="_blank"><span class="btn-inner--icon"><i class="fas fa-download"></i></span></a>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </span>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#" data-toggle="tooltip" data-title="<?php echo e(__('Created Date')); ?>"><?php echo e(\Auth::user()->dateFormat($support->created_at)); ?></a>
                            </div>
                            <div class="col text-right">
                                <a href="<?php echo e(route('support.reply',\Crypt::encrypt($support->id))); ?>" data-title="<?php echo e(__('Support Reply')); ?>" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Reply')); ?>">
                                    <i class="fas fa-reply"></i>
                                </a>
                                <?php if(\Auth::user()->id==$support->ticket_created): ?>
                                    <a href="#" data-size="lg" data-url="<?php echo e(route('support.edit',$support->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Support')); ?>" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="#!" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($support->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['support.destroy', $support->id],'id'=>'delete-form-'.$support->id]); ?>

                                    <?php echo Form::close(); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/support/grid.blade.php ENDPATH**/ ?>