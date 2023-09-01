
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Employee Set Salary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Employee Salary')); ?></h6>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create set salary')): ?>
                                    <div class="col text-right">
                                        <a href="#" data-url="<?php echo e(route('employee.basic.salary',$employee->id)); ?>"
                                           data-size="md" data-ajax-popup="true"
                                           data-title="<?php echo e(__('Set Basic Sallary')); ?>" data-toggle="tooltip"
                                           data-original-title="<?php echo e(__('Basic Salary')); ?>" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-info d-flex text-sm">
                                <div class="project-info-inner mr-3 col-3">
                                    <b class="m-0"> <?php echo e(__('Payslip Type')); ?> </b>
                                    <div
                                        class="project-amnt pt-1"><?php if(!empty($employee->salary_type())): ?><?php echo e($employee->salary_type()); ?><?php else: ?>
                                            -- <?php endif; ?></div>
                                </div>
                                <div class="project-info-inner mr-3 col-3">
                                    <b class="m-0"> <?php echo e(__('Salary Based')); ?> </b>
                                    <div
                                        class="project-amnt pt-1"><?php if(!empty($employee->salary_based)): ?><?php echo e(ucwords(str_replace("_"," ",$employee->salary_based))); ?><?php else: ?>
                                            -- <?php endif; ?></div>
                                </div>
                                <div class="project-info-inner mr-3 col-3">
                                    <b class="m-0"> <?php echo e(__('Payment Method')); ?> </b>
                                    <div
                                        class="project-amnt pt-1"><?php if(!empty($employee->salary_payment_method)): ?><?php echo e(ucwords(str_replace("_"," ",$employee->salary_payment_method))); ?><?php else: ?>
                                            -- <?php endif; ?></div>
                                </div>
                                <div class="project-info-inner mr-3 col-3">
                                    <b class="m-0"> <?php echo e(__('Salary')); ?> </b>
                                    <div
                                        class="project-amnt pt-1"><?php if(!empty($employee->salary)): ?><?php echo e(\Auth::user()->priceFormat($employee->salary)); ?><?php else: ?>
                                            -- <?php endif; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card  min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Commission')); ?></h6>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create commission')): ?>
                                    <div class="col text-right">
                                        <a href="#" data-url="<?php echo e(route('commissions.create',$employee->id)); ?>"
                                           data-size="md" data-ajax-popup="true"
                                           data-title="<?php echo e(__('Create Commission')); ?>" data-toggle="tooltip"
                                           data-original-title="<?php echo e(__('Create Commission')); ?>" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if(!$commissions->isEmpty()): ?>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Employee Name')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Amount')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(!empty($commission->employee())?$commission->employee()->name:''); ?></td>
                                            <td><?php echo e($commission->title); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat( $commission->amount)); ?></td>
                                            <td class="text-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit commission')): ?>
                                                    <a href="#"
                                                       data-url="<?php echo e(URL::to('commission/'.$commission->id.'/edit')); ?>"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="<?php echo e(__('Edit Commission')); ?>" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete commission')): ?>
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Delete')); ?>"
                                                       data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>"
                                                       data-confirm-yes="document.getElementById('commission-delete-form-<?php echo e($commission->id); ?>').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['commission.destroy', $commission->id],'id'=>'commission-delete-form-'.$commission->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="mt-2 text-center">
                                    No Commission Found!
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card  min-height-253">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Allowance')); ?></h6>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create allowance')): ?>
                                    <div class="col text-right">
                                        <a href="#" data-url="<?php echo e(route('allowances.create',$employee->id)); ?>"
                                           data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Create Allowance')); ?>"
                                           data-toggle="tooltip" data-original-title="<?php echo e(__('Create Allowance')); ?>"
                                           class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if(!$allowances->isEmpty()): ?>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Employee Name')); ?></th>
                                        <th><?php echo e(__('Allownace Option')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Amount')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allowance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(!empty($allowance->employee())?$allowance->employee()->name:''); ?></td>
                                            <td><?php echo e(!empty($allowance->allowance_option())?$allowance->allowance_option()->name:''); ?></td>
                                            <td><?php echo e($allowance->title); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat($allowance->amount)); ?></td>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit allowance')): ?>
                                                    <a href="#"
                                                       data-url="<?php echo e(URL::to('allowance/'.$allowance->id.'/edit')); ?>"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="<?php echo e(__('Edit Allowance')); ?>" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete allowance')): ?>
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Delete')); ?>"
                                                       data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>"
                                                       data-confirm-yes="document.getElementById('allowance-delete-form-<?php echo e($allowance->id); ?>').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['allowance.destroy', $allowance->id],'id'=>'allowance-delete-form-'.$allowance->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="mt-2 text-center">
                                    No Allowance Found!
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Saturation Deduction')); ?></h6>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create saturation deduction')): ?>
                                    <div class="col text-right">
                                        <a href="#" data-url="<?php echo e(route('saturationdeductions.create',$employee->id)); ?>"
                                           data-size="md" data-ajax-popup="true"
                                           data-title="<?php echo e(__('Create Saturation Deduction')); ?>" data-toggle="tooltip"
                                           data-original-title="<?php echo e(__('Create Saturation Deduction')); ?>"
                                           class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if(!$saturationdeductions->isEmpty()): ?>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Employee Name')); ?></th>
                                        <th><?php echo e(__('Deduction Option')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Amount')); ?></th>
                                        <th><?php echo e(__('Type')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $saturationdeductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $saturationdeduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(!empty($saturationdeduction->employee())?$saturationdeduction->employee()->name:''); ?></td>
                                            <td><?php echo e(!empty($saturationdeduction->deduction_option())?$saturationdeduction->deduction_option()->name:''); ?></td>
                                            <td><?php echo e($saturationdeduction->title); ?></td>
                                            <td><?php echo e($saturationdeduction->amount[0]??$saturationdeduction->amount); ?></td>
                                            <td><?php echo e($saturationdeduction->deduction_type[0]??ucwords($saturationdeduction->deduction_type)); ?></td>
                                            <td class="text-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit saturation deduction')): ?>
                                                    <a href="#"
                                                       data-url="<?php echo e(URL::to('saturationdeduction/'.$saturationdeduction->id.'/edit')); ?>"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="<?php echo e(__('Edit Saturation Deduction')); ?>"
                                                       class="edit-icon" data-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete saturation deduction')): ?>
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Delete')); ?>"
                                                       data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>"
                                                       data-confirm-yes="document.getElementById('deduction-delete-form-<?php echo e($saturationdeduction->id); ?>').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['saturationdeduction.destroy', $saturationdeduction->id],'id'=>'deduction-delete-form-'.$saturationdeduction->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="mt-2 text-center">
                                    No Saturation Deduction Found!
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Other Payment')); ?></h6>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create other payment')): ?>
                                    <div class="col text-right">
                                        <a href="#" data-url="<?php echo e(route('otherpayments.create',$employee->id)); ?>"
                                           data-size="md" data-ajax-popup="true"
                                           data-title="<?php echo e(__('Create Other Payment')); ?>" data-toggle="tooltip"
                                           data-original-title="<?php echo e(__('Create Other Payment')); ?>" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if(!$otherpayments->isEmpty()): ?>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Employee')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Amount')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $otherpayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherpayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(!empty($otherpayment->employee())?$otherpayment->employee()->name:''); ?></td>
                                            <td><?php echo e($otherpayment->title); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat($otherpayment->amount)); ?></td>
                                            <td class="text-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit other payment')): ?>
                                                    <a href="#"
                                                       data-url="<?php echo e(URL::to('otherpayment/'.$otherpayment->id.'/edit')); ?>"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="<?php echo e(__('Edit Other Payment')); ?>" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete other payment')): ?>
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Delete')); ?>"
                                                       data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>"
                                                       data-confirm-yes="document.getElementById('payment-delete-form-<?php echo e($otherpayment->id); ?>').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['otherpayment.destroy', $otherpayment->id],'id'=>'payment-delete-form-'.$otherpayment->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="mt-2 text-center">
                                    No Other Payment Data Found!
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Overtime')); ?></h6>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create overtime')): ?>
                                    <div class="col text-right">
                                        <a href="#" data-url="<?php echo e(route('overtimes.create',$employee->id)); ?>"
                                           data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Create Overtime')); ?>"
                                           data-toggle="tooltip" data-original-title="<?php echo e(__('Create Overtime')); ?>"
                                           class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if(!$overtimes->isEmpty()): ?>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Employee Name')); ?></th>
                                        <th><?php echo e(__('Overtime Title')); ?></th>
                                        <th><?php echo e(__('Number of days')); ?></th>
                                        <th><?php echo e(__('Hours')); ?></th>
                                        <th><?php echo e(__('Rate')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(!empty($overtime->employee())?$overtime->employee()->name:''); ?></td>
                                            <td><?php echo e($overtime->title); ?></td>
                                            <td><?php echo e($overtime->number_of_days); ?></td>
                                            <td><?php echo e($overtime->hours); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat($overtime->rate)); ?></td>
                                            <td class="text-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit overtime')): ?>
                                                    <a href="#"
                                                       data-url="<?php echo e(URL::to('overtime/'.$overtime->id.'/edit')); ?>"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="<?php echo e(__('Edit OverTime')); ?>" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete overtime')): ?>
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Delete')); ?>"
                                                       data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>"
                                                       data-confirm-yes="document.getElementById('overtime-delete-form-<?php echo e($overtime->id); ?>').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['overtime.destroy', $overtime->id],'id'=>'overtime-delete-form-'.$overtime->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="mt-2 text-center">
                                    No Overtime Data Found!
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if(false): ?>
                    <div class="col-md-6">
                        <div class="card  min-height-253">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-0"><?php echo e(__('Income Tax')); ?></h6>
                                    </div>
                                    <?php if($iTaxes->isEmpty()): ?>
                                        <div class="col text-right">
                                            <a href="#" data-url="<?php echo e(route('income_tax.create',$employee->id)); ?>"
                                               data-size="md" data-ajax-popup="true"
                                               data-title="<?php echo e(__('Create Income Tax')); ?>" data-toggle="tooltip"
                                               data-original-title="<?php echo e(__('Create Income Tax')); ?>" class="apply-btn">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <?php if(!$iTaxes->isEmpty()): ?>
                                    <table class="table table-striped mb-0">

                                        <tbody>
                                        <?php $__currentLoopData = $iTaxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th colspan="3"><?php echo e(!empty($loan->employee())?$loan->employee()->name:''); ?></th>
                                            </tr>
                                            <tr>
                                                <th>Min Salary</th>
                                                <th>Max Salary</th>
                                                <th>Tax</th>
                                            </tr>
                                            <tr>
                                                <td><?php echo e($loan->group_1['min_salary']); ?></td>
                                                <td><?php echo e($loan->group_1['max_salary']); ?></td>
                                                <td><?php echo e($loan->group_1['tax_percent']); ?>%</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e($loan->group_2['min_salary']); ?></td>
                                                <td><?php echo e($loan->group_2['max_salary']); ?></td>
                                                <td><?php echo e($loan->group_2['tax_percent']); ?>%</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e($loan->group_3['min_salary']); ?></td>
                                                <td><?php echo e($loan->group_3['max_salary']); ?></td>
                                                <td><?php echo e($loan->group_3['tax_percent']); ?>%</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e($loan->group_4['min_salary']); ?></td>
                                                <td><?php echo e($loan->group_4['max_salary']); ?></td>
                                                <td><?php echo e($loan->group_4['tax_percent']); ?>%</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e($loan->group_5['min_salary']); ?></td>
                                                <td><?php echo e($loan->group_5['max_salary']); ?></td>
                                                <td><?php echo e($loan->group_5['tax_percent']); ?>%</td>
                                            </tr>
                                            <tr>
                                                <td><?php echo e($loan->group_6['min_salary']); ?></td>
                                                <td><?php echo e($loan->group_6['max_salary']); ?></td>
                                                <td><?php echo e($loan->group_6['tax_percent']); ?>%</td>
                                            </tr>



                                            <td colspan="3" class="text-right">

                                                <a href="#" data-url="<?php echo e(URL::to('income_tax/'.$loan->id.'/edit')); ?>"
                                                   data-size="lg" data-ajax-popup="true"
                                                   data-title="<?php echo e(__('Edit Income Tax')); ?>" class="edit-icon"
                                                   data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                        class="fas fa-pencil-alt"></i></a>

                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                   data-original-title="<?php echo e(__('Delete')); ?>"
                                                   data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>"
                                                   data-confirm-yes="document.getElementById('itax-delete-form-<?php echo e($loan->id); ?>').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['income_tax.destroy', $loan->id],'id'=>'itax-delete-form-'.$loan->id]); ?>

                                                <?php echo Form::close(); ?>


                                            </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <div class="mt-2 text-center">
                                        No Income Tax Data Found!
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-md-12">
                    <div class="card  min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Loan')); ?></h6>
                                </div>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create loan')): ?>
                                    <div class="col text-right">
                                        <a href="#" data-url="<?php echo e(route('loans.create',$employee->id)); ?>" data-size="md"
                                           data-ajax-popup="true" data-title="<?php echo e(__('Create Loan')); ?>"
                                           data-toggle="tooltip" data-original-title="<?php echo e(__('Create Loan')); ?>"
                                           class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if(!$loans->isEmpty()): ?>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Employee')); ?></th>
                                        <th><?php echo e(__('Installments')); ?></th>
                                        <th><?php echo e(__('Loan Options')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Loan Amount')); ?></th>
                                        <th><?php echo e(__('Loan Type')); ?></th>
                                        <th><?php echo e(__('Start Date')); ?></th>
                                        <th><?php echo e(__('End Date')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(!empty($loan->employee())?$loan->employee()->name:''); ?></td>
                                            <td><?php echo e(ucwords(str_replace("_"," ",$loan->loan_installments))); ?></td>
                                            <td><?php echo e(!empty( $loan->loan_option())? $loan->loan_option()->name:''); ?></td>
                                            <td><?php echo e($loan->title); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat($loan->amount)); ?></td>
                                            <td><?php echo e(ucwords($loan->loan_type)); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat($loan->start_date)); ?></td>
                                            <td><?php echo e(\Auth::user()->dateFormat( $loan->end_date)); ?></td>
                                            <td class="text-right">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit loan')): ?>
                                                    <a href="#" data-url="<?php echo e(URL::to('loan/'.$loan->id.'/edit')); ?>"
                                                       data-size="lg" data-ajax-popup="true"
                                                       data-title="<?php echo e(__('Edit Loan')); ?>" class="edit-icon"
                                                       data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete loan')): ?>
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                       data-original-title="<?php echo e(__('Delete')); ?>"
                                                       data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>"
                                                       data-confirm-yes="document.getElementById('loan-delete-form-<?php echo e($loan->id); ?>').submit();"><i
                                                            class="fas fa-trash"></i></a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['loan.destroy', $loan->id],'id'=>'loan-delete-form-'.$loan->id]); ?>

                                                    <?php echo Form::close(); ?>

                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="mt-2 text-center">
                                    No Loan Data Found!
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card  min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0"><?php echo e(__('Budget')); ?></h6>
                                </div>

                                <div class="col text-right">
                                    <a href="#" data-url="<?php echo e(route('budget.create',$employee->id)); ?>" data-size="md"
                                       data-ajax-popup="true" data-title="<?php echo e(__('Create Budget')); ?>" data-toggle="tooltip"
                                       data-original-title="<?php echo e(__('Create Budget')); ?>" class="apply-btn">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if(!$budgets->isEmpty()): ?>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('Employee')); ?></th>
                                        <th><?php echo e(__('Cost Center')); ?></th>
                                        <th><?php echo e(__('Funding')); ?></th>
                                        <th><?php echo e(__('Activity')); ?></th>
                                        <th><?php echo e(__('Grant')); ?></th>
                                        <th><?php echo e(__('Functions')); ?></th>
                                        <th><?php echo e(__('CSOPO')); ?></th>
                                        <th><?php echo e(__('Donor Report')); ?></th>
                                        <th><?php echo e(__('Country')); ?></th>
                                        <th><?php echo e(__('Allocation')); ?></th>
                                        <th><?php echo e(__('Control')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $budgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(!empty($loan->employee())?$loan->employee()->name:''); ?></td>
                                            <td><?php echo e($loan->cost_center); ?></td>
                                            <td><?php echo e($loan->funding); ?></td>
                                            <td><?php echo e($loan->activity); ?></td>
                                            <td><?php echo e($loan->grant_); ?></td>
                                            <td><?php echo e($loan->functions); ?></td>
                                            <td><?php echo e($loan->csopo); ?></td>
                                            <td><?php echo e($loan->donor_report); ?></td>
                                            <td><?php echo e($loan->country); ?></td>
                                            <td><?php echo e($loan->allocation); ?>%</td>
                                            <td><?php echo e($loan->control); ?></td>
                                            <td class="text-right">

                                                <a href="#" data-url="<?php echo e(URL::to('budget/'.$loan->id.'/edit')); ?>"
                                                   data-size="lg" data-ajax-popup="true"
                                                   data-title="<?php echo e(__('Edit Budget')); ?>" class="edit-icon"
                                                   data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                        class="fas fa-pencil-alt"></i></a>

                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                   data-original-title="<?php echo e(__('Delete')); ?>"
                                                   data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>"
                                                   data-confirm-yes="document.getElementById('budget-delete-form-<?php echo e($loan->id); ?>').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['budget.destroy', $loan->id],'id'=>'budget-delete-form-'.$loan->id]); ?>

                                                <?php echo Form::close(); ?>


                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <div class="mt-2 text-center">
                                    No Loan Data Found!
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="a_basic_salary" value="<?php echo e(!empty($employee->salary)?$employee->salary:0); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>

    <script>
        <?php
            $amount_ = $amount__ = $amount___ = 0;
        ?>
        let basic_salary = <?php echo e(!empty($employee->salary)?$employee->salary:0); ?>;
        <?php if(!$allowances->isEmpty()): ?>

        <?php

            $amount_ =  $allowances->sum('amount');
                if(empty($amount_))
                    {
$amount_ = 0;
                    }
                $amount_ = (float) $amount_;
        ?>
        <?php endif; ?>

        console.log("op", "<?php echo e($amount_); ?>")

        <?php if(!$commissions->isEmpty()): ?>
        <?php

            $amount___ =  $commissions->sum('amount');
                if(empty($amount___))
                    {

                    }
                $amount___ = (float) $amount___;
        ?>
        <?php endif; ?>
        <?php if(!$overtimes->isEmpty()): ?>
        <?php

            $amount__ =  \App\Employee::overtimeCalc($overtimes);
        ?>
        <?php endif; ?>

        let gross_salary = basic_salary + <?php echo e($amount_); ?>;
        basic_salary = basic_salary + <?php echo e($amount_); ?> - <?php echo e($totaltaxDeduction); ?>;


        $(document).ready(function () {
            var d_id = $('#department_id').val();
            var designation_id = '<?php echo e($employee->designation_id); ?>';
            getDesignation(d_id);


            $("#allowance-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#commission-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#loan-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#saturation-deduction-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#other-payment-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#overtime-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });
        });

        $(document).on('change', 'select[name=department_id]', function () {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '<?php echo e(route('employee.json')); ?>',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value=""><?php echo e(__('Select any Designation')); ?></option>');
                    $.each(data, function (key, value) {
                        var select = '';
                        if (key == '<?php echo e($employee->designation_id); ?>') {
                            select = 'selected';
                        }

                        $('#designation_id').append('<option value="' + key + '"  ' + select + '>' + value + '</option>');
                    });
                }
            });
        }


        $(document).on("change", "#deduction_option", function () {
            checkDeductionOption();
        })
        let row = 1;

        $(document).on("click", ".remove_income_row", function () {
            remove_income_row();
        })
        $(document).on("click", ".insert_income_row", function () {
            insert_income_row();
        })


        function checkDeductionOption() {

            let optionid = $("#deduction_option").val()

            if (optionid == 0) {
                row = parseInt($("#_init_num").val());
                if (row < 5) {

                    let rang_row_length = $(".range_row").length;
                    if (rang_row_length == 0) {
                        row = 1;
                        insert_income_row();
                        row = 2;
                        insert_income_row();
                        row = 3;
                        insert_income_row();
                        row = 4;
                        insert_income_row();
                        row = 5;
                        insert_income_row();
                    } else {
                        if (rang_row_length == 1) {
                            row = 2;
                            insert_income_row();
                        } else if (rang_row_length == 2) {
                            row = 3;
                            insert_income_row();
                            row = 4;
                            insert_income_row();
                            row = 5;
                            insert_income_row();
                        } else if (rang_row_length == 3) {
                            row = 4;
                            insert_income_row();
                            row = 5;
                            insert_income_row();
                        } else if (rang_row_length == 4) {
                            row = 5;
                            insert_income_row();
                        }
                    }


                } else {
                    calculateMaxs(); //  every condtion ma y chaly ga

                }
                $("#income_ranges_panel").show();
                $("._no_income_tax").hide();
                $("._no_income_tax input").attr("required", false)

                $("._no_income_tax select").attr("required", false)
                $("._no_income_tax input").removeAttr("name")
                $("._no_income_tax select").removeAttr("name")

            } else {
                remove_all_income_rows();
                $("#income_ranges_panel").hide();
                $("._no_income_tax").show();
                $("._no_income_tax input").attr("required", true)
                $("._no_income_tax select").attr("required", true)
                $("._no_income_tax input").attr("name", "amount[]")
                $("._no_income_tax select").attr("name", "deduction_type[]")
            }
        }

        $(document).on("keyup", ".range_row input", function () {

            calculateMaxs();
        })

        function calculateMaxs() {
            // basic_salary
            let _index = 0;
            let _vat = 0;
            $(".range_row").each(function () {
                let min_value = 0;

                if ($(this).find(".min_income").val() != '' && $(this).find(".min_income").val() != '') {
                    min_value = parseFloat($(this).find(".min_income").val())
                }

                let min_elig = $("input[name='min_elig']").val()
                // let min_elig  = $("input[name='min_elig']").val()
                if (min_elig == "") {
                    min_elig = 0;
                }
                let max_ = min_elig - min_value;
                if (_index != 0) {

                    $prevRow = $(".range_row").eq((_index - 1));
                    let preMax = $prevRow.find(".max_income").val();
                    let preMin = $prevRow.find(".min_income").val();
                    if (preMax != '') {
                        preMax = parseFloat(preMax);
                    } else {
                        preMax = 0;
                    }
                    if (preMin != '') {
                        preMin = parseFloat(preMin);
                    } else {
                        preMin = 0;
                    }
                    max_ = preMax - min_value;
                }
                $(this).find(".max_income").val(max_)
                let tax_amount_ = 0;
                let tax_percent = 0;
                if ($(this).find(".tax_percent").val() != '' && $(this).find(".tax_percent").val() != '') {
                    tax_percent = parseFloat($(this).find(".tax_percent").val())
                }
                if (($(".range_row").length - 1) == _index) {
                    // last row
                    tax_amount_ = ((max_ * tax_percent) / 100)
                } else {
                    tax_amount_ = ((min_value * tax_percent) / 100)
                }
                _vat = _vat + tax_amount_;
                $(this).find(".tax_amount").val(tax_amount_.toFixed(2))
                _index++;
            });


            $("#vat_text").text(parseFloat(_vat).toFixed(2));
            $("#total_income_text").text(parseFloat(gross_salary - _vat).toFixed(2));
        }

        function insert_income_row() {
            let _length = $(".range_row").length;
            if (_length < 6) {

                $("#income_ranges").append(row_income_html());

            }

            calculateMaxs()
        }

        function remove_income_row() {
            let removeRow = parseInt($(".range_row").length - 1);
            if (removeRow != 0) {
                $(".range_row")[removeRow].remove();
            }
            calculateMaxs()
        }

        function remove_all_income_rows() {
            $("#income_ranges").html(``);
            row = 1;
            calculateMaxs()
        }

        function row_income_html() {
            let html_ = ``;

            if (row == 1) {
                html_ += `

                <div class="col-md-12 ">
                    <div class="form-group">
                        <label>Minimum Eligible Income</label>
<input type="number" min ="0" step="any" class="form-control " readonly value="${basic_salary.toFixed(2)}" name="min_elig" required/>
</div>
</div>

                `;
            }
            html_ += `
            <div data-r="${row}" class="w-100 range_row range_row_${row} row">

                <input type="hidden" name="deduction_type[]" value="percent" >
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Min Income</label>
                        <input type="number" min ="0" step="any" class="form-control min_income" name="min_incom[]" required/>
                    </div>
                </div>

                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Max Income</label>
                        <input type="number" min ="0" step="any" class="form-control max_income" readonly  />
                    </div>
                </div>

                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Percentage</label>
                        <input type="number" min ="0" step="any" value="0" class="form-control tax_percent" name="amount[]" required/>
                    </div>
                </div>
                <div class="col-md-3 ">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" value="0" min ="0" step="any" class="form-control tax_amount" readonly />
                    </div>
                </div>

            </div>`;

            if (row == 5) {
                html_ += `
            <div  class="w-100   row">


                <div class="col-md-6 ">
                    Total Taxable Amount
                </div>


                <div class="col-md-6 text-right text-end">
                    <span id="vat_text"></span>
                </div>

            </div>
<div  class="w-100   row">


                <div class="col-md-6 ">
                    Total Income Tax
                </div>


                <div class="col-md-6 text-right text-end">
                    <span id="total_income_text"></span>
                </div>

            </div>

`;
            }

            return html_;
        }

        $(document).on("change", "#a_type", function () {
            allowanceTypeChange()
        })

        function allowanceTypeChange() {
            let a_type = $("#a_type").val();
            if (a_type == "flat") {
                $(".type_amount").addClass("d-none")

                $(".type_amount input").attr('required', false)
                $(".type_amount input").prop('required', false)

                $(".a_amount").attr('readonly', false)
                $(".a_amount").prop('readonly', false)
            } else {
                console.log("remove")
                $(".type_amount").removeClass("d-none")

                $(".type_amount input").attr('required', true)
                $(".type_amount input").prop('required', true)

                $(".a_amount").attr('readonly', true)
                $(".a_amount").prop('readonly', true)
            }
            allowneceChangeAmount();
        }

        $(document).on("keyup", "#type_amount", function () {
            allowneceChangeAmount()
        })

        function allowneceChangeAmount() {
            let sal = $("#a_basic_salary").val()
            let a_type = $("#a_type").val();
            if (a_type != "flat") {
                console.log(sal, $("#type_amount").val());
                $(".a_amount").val(sal * ($("#type_amount").val() / 100))
            }
        }
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/setsalary/employee_salary.blade.php ENDPATH**/ ?>