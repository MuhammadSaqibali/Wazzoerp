
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Add Expense')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container ">
  <form class="p-3 mx-auto bg-white w-75 rounded-lg mt-4 " method="post" action="/insert_expence" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="form-row  px-3">
      <div class="form-group col-md-4">
        <label for="datee" class="form-control-lable"><?php echo e(__('Expense Date')); ?></label>
        <div class="form-icon-user">
          <span><i class="fas fa-calendar"></i></span>
          <input type="text" name="date" id="datee" class="form-control datepicker">
        </div>
      </div>
      <div class="form-group col-md-4">
        <label for="merchant" class="form-control-lable"><?php echo e(__('Merchant')); ?></label>
        <input type="text" class="form-control" name="merchant" id="merchant" placeholder="<?php echo e(__('Enter Merchant Name')); ?>" required>
      </div>
      <div class="col-md-4">
      <label for="attachment" class="form-control-lable"><?php echo e(__('Attachment')); ?></label>
            <div class="choose-file form-group">
                <label for="attachment" class="form-control-label">
                    <div><?php echo e(__('Choose file here')); ?></div>
                    <input type="file" class="form-control" name="attachment" id="attachment" data-filename="attachment_create" required>
                </label>
                <p class="attachment_create"></p>
            </div>
        </div>

    </div>
    
    <div class="form-row px-3">
      <div class="form-group col-md-6 m-0">
        <label for="category" class="form-control-lable"><?php echo e(__('Category')); ?></label>
        <select name="category" class="form-control select2" id="category">
          <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option selected value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="form-group col-md-6 m-0">
        <label for="amount" class="form-control-lable"> <?php echo e(__('Amount')); ?></label>
        <div class="row">
          <div class="col-md-9 col-sm-8">
            <input type="number " class="form-control" name="amount" id="amount" placeholder="<?php echo e(__('Enter Amount')); ?>" required>
          </div>
          <div class="col-md-3 col-sm-4">
            <select id="amount" name="currency" class="form-control select2" required>
              <option selected value="1"><?php echo e(__('USD')); ?></option>
              <option value="2"><?php echo e(__('RS.')); ?></option>
              <option value="3"><?php echo e(__('LE')); ?></option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row px-4 my-2">
      <div class="form-check d-flex alighn-center" onchange="enablemilage()">
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" style="margin-top: 7px;">
        <label class="form-check-label " for="flexCheckDefault">
          <?php echo e(__('Add Milage')); ?>

        </label>
      </div>
    </div>
    <div class="form-row px-3 d-none" id="enteredmilage">
      <div class="form-group col-md-4">
        <label for="mile" class="form-control-lable"><?php echo e(__('Miles')); ?></label>
        <input type="number" class="form-control" value="0" name="mile" id="mile" placeholder="<?php echo e(__('Enter Miles')); ?>">
      </div>
      <div class="form-group col-md-4">
        <label for="milesamount" class="form-control-lable"><?php echo e(__('Enter Amount')); ?></label>
        <input type="number" class="form-control" value="0" name="milesamount" id="milesamount" placeholder="<?php echo e(__('Enter Amount/mile')); ?>">
      </div>
      <div class="form-group col-md-4">
        <label for="total" class="form-control-lable"><?php echo e(__('Total Amount/Miles')); ?></label>
        <input type="number" class="form-control " value="0" name="total" id="total" placeholder="<?php echo e(__('NaN')); ?>" readonly></input>

      </div>
    </div>
    <div class="form-row px-3">
      <div class="form-group col-md-6">
        <label for="payment" class="form-control-lable"><?php echo e(__('Payment Mode')); ?></label>
        <select name="payment" class="form-control select2" name="payment" id="payment">
          <option selected value="1"><?php echo e(__('Cash')); ?></option>
          <option value="2"><?php echo e(__('Credit Card')); ?></option>
          <option value="3"><?php echo e(__('Debit Card')); ?></option>
        </select>
      </div>
      <div class="form-group col-md-6 m-0">
        <label for="paid" class="form-control-lable"><?php echo e(__('Paid Through')); ?></label>
        <select name="paid" class="form-control select2" id="paid">
          <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option selected value="<?php echo e($row->holder_name); ?>"><?php echo e($row->holder_name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>
    <div class="row px-3">
      <div class="form-group col">
        <label for="description" class="form-control-lable"><?php echo e(__('Description')); ?></label>
        <textarea type="text" class="form-control" name="description" id="description" required></textarea>
        -<?php echo e(__('This Expense requires description')); ?>

      </div>
    </div>

    <div class="d-flex justify-content-end">
      <button class="btn btn-danger" type="submit"><?php echo e(__('Add')); ?></button>
    </div>
  </form>
</div>
<script>
  function enablemilage() {

    if ($('.form-check-input').is(":checked")) {
      document.getElementById('enteredmilage').classList.remove('d-none')
    } else {
      document.getElementById('enteredmilage').classList.add('d-none')
    }
  }

  const num1Input = document.getElementById('mile');
  const num2Input = document.getElementById('milesamount');
  const resultSpan = document.getElementById('total');

  function multiplyNumbers() {
    const num1 = parseFloat(num1Input.value);
    const num2 = parseFloat(num2Input.value);
    const result = num1 * num2;
    resultSpan.value = result.toString();
  }
  num1Input.addEventListener('input', multiplyNumbers);
  num2Input.addEventListener('input', multiplyNumbers);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wazzoerp\resources\views/addExpense/add_expense.blade.php ENDPATH**/ ?>