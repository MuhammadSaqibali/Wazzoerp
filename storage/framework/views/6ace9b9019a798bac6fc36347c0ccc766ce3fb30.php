
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Add Expense')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- <div class="container ">
  <form class="p-3 mx-auto bg-white w-75 rounded-lg mt-4 ">
    <div class="form-row  px-3">
      <div class="form-group col-md-6">
        <label for="datee" class="form-control-lable">Expense Date</label>
        <div class="form-icon-user">
          <span><i class="fas fa-calendar"></i></span>
          <input type="text" name="date" id="datee" class="form-control datepicker">
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="merchant" class="form-control-lable">Merchant</label>
        <input type="text" class="form-control" id="merchant" placeholder="Enter Merchant Name" required>
      </div>
    </div>
    <div class="form-row px-3">
      <div class="form-group col-md-6">
        <label for="category" class="form-control-lable">Category</label>
        <select name="category" class="form-control select2" id="category">
          <option selected value="1">Medical Expense</option>
          <option value="2">Food Expense</option>
          <option value="3">Maintenance Expense</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="amount" class="form-control-lable">Amount</label>
        <div class="row">
          <div class="col-md-9 col-sm-8">
            <input type="number " class="form-control" id="amount" placeholder="Enter Amount" required>
          </div>
          <div class="col-md-3 col-sm-4">
            <select id="amount" class="form-control select2" required>
              <option selected value="1">USD</option>
              <option value="2">RS.</option>
              <option value="3">LE</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="form-row px-3">
      <div class="form-check d-flex alighn-center" onchange="enablemilage()">
        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" style="margin-top: 7px;">
        <label class="form-check-label " for="flexCheckDefault">
          Add Milage
        </label>
      </div>
    </div>
    <div class="form-row px-3 d-none" id="enteredmilage">
      <div class="form-group col-md-4">
        <label for="mile" class="form-control-lable">Miles</label>
        <input type="number" class="form-control" id="mile" placeholder="Enter Miles" required>
      </div>
      <div class="form-group col-md-4">
        <label for="milesamount" class="form-control-lable">Enter Amount</label>
        <input type="number" class="form-control" id="milesamount" placeholder="Enter Amount/mile" required>
      </div>
      <div class="form-group col-md-4">
        <label for="total" class="form-control-lable">Total Amount/Miles</label>
        <input type="number" class="form-control " id="total" placeholder="NaN" readonly></input>

      </div>
    </div>
    <div class="form-row px-3">
      <div class="form-group col-md-6">
        <label for="payment" class="form-control-lable">Payment Mode</label>
        <select name="payment" class="form-control select2" id="payment">
          <option selected value="1">Cash</option>
          <option value="2">Credit Card</option>
          <option value="3">Debit Card</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="paid" class="form-control-lable">Paid Through</label>
        <input type="text" class="form-control" id="paid" placeholder="Petty Cash" required>
      </div>
    </div>
    <div class="row px-3">
      <div class="form-group col">
        <label for="description" class="form-control-lable">Description</label>
        <textarea type="text" class="form-control" id="description" required></textarea>
        -This Expense requires description
      </div>
    </div>

    <div class="d-flex justify-content-end">
      <button class="btn btn-danger" type="submit">Add</button>
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
</script> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wazzoerp\resources\views/addExpense/addExpense.blade.php ENDPATH**/ ?>