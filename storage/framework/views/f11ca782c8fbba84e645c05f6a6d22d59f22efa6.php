
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Receipt')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    @media  print {
body {
visibility: hidden;
}
.print-only{
    visibility: visible;
    
}
@page  {
    margin-top: 30px;
    margin-bottom: 30px;
  }
}

</style>
<div id='printarea' style="width:408px; height:666px; background-color:white; margin:0 auto; border-radius:10px; color:black; " onload="welcomeFunction()">
    <div style="text-align: center;">
        <img src="https://wazzoerp.wazzoconsulting.com/storage/uploads/custom_landing_page_image/logo_16664461101405650006.PNG" alt="">
        <h4 style="padding-top:20px"><?php echo e(__('WAZZO CONSULTING')); ?></h4>
        <p style="margin-top:10px; margin-bottom:0px"><?php echo e(__('21 God-win Samba Drive Jui')); ?></p>
        <h6 style="margin-top:10px"><?php echo e(__('Eastern Region,Sierra Leone')); ?></h6>
    </div>
    <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
        <div><?php echo e(__('Date')); ?> : <?php echo e($user->date); ?></div>
        <div><?php echo e(__('Time')); ?> : <?php echo e($time[1]); ?></div>
    </div>
    <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
        <div>
            <p style=" margin-bottom:0px;"><?php echo e(__('Merchant')); ?> : </p>
        </div>
        <div>
            <p style=" margin-bottom:0px;"><?php echo e($user->m_name); ?></p>
        </div>
    </div>
    <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
        <div>
            <p style=" margin-bottom:0px;"><?php echo e(__('Category')); ?> : </p>
        </div>
        <div>
            <p style=" margin-bottom:0px;"><?php echo e($category->name); ?></p>
        </div>
    </div>
    <p style=" margin-bottom:0px;border-bottom: dashed 2px #000"></p>

    <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
        <div><?php echo e(__('Expense Amount')); ?> : </div>
        <div><?php echo e($user->amount); ?></div>
    </div>
    <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
        <div><?php echo e(__('Milage Expense')); ?> : </div>
        <div><?php echo e($user->totalm_amount); ?></div>
    </div>
    <p style=" margin-bottom:0px; border-bottom: dashed 2px #000"></p>
    <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
        <div>
            <p style=" margin-bottom:0px;"><?php echo e(__('Total Expense')); ?> : </p>
        </div>
        <div>
            <p style=" margin-bottom:0px;"><?php echo e($user->totalexp); ?></p>
        </div>
    </div>

    <div style="display: flex; justify-content:space-between; margin-top:15px; padding: 0px 20px 0px 20px;">
        <div>
            <p style=" margin-bottom:0px;"><?php echo e(__('Payment Mode')); ?> : </p>
        </div>
        <?php if($user->payment_mode == 1): ?>
        <div>
            <p style=" margin-bottom:0px;"><?php echo e(__('Cash')); ?></p>
        </div>
        <?php elseif($user->payment_mode == 2): ?>
        <div>
            <p style=" margin-bottom:0px;"><?php echo e(__('Credit Card')); ?></p>
        </div>
        <?php elseif($user->payment_mode == 3): ?>
        <div>
            <p style=" margin-bottom:0px;"><?php echo e(__('Debit Card')); ?></p>
        </div>
        <?php endif; ?>
    </div>
    <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
        <div>
            <p style=" margin-bottom:0px;"><?php echo e(__('Payment Through')); ?> : </p>
        </div>
        <div>
            <p style=" margin-bottom:0px;"><?php echo e($user->paid_through); ?></p>
        </div>
    </div>
</div>

<script>
    window.load=printFunc();
    function printFunc() {
        var divToPrint = document.getElementById('printarea');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
            'border:1px solid #000;' +
        'padding;0.5em;' +
        '}' +
        '</style>';
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open(""); 
        newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wazzoerp\resources\views/addExpense/Receipt.blade.php ENDPATH**/ ?>