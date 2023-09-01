
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Expenses')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <style>
        @import  url(<?php echo e(asset('css/font-awesome.css')); ?>);
    
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jszip.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/pdfmake.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/buttons.html5.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/buttons.print.min.js')); ?>"></script>
<script>
    
    function saveAsPDF() {
        var filename = $('#filename').val();
        var element = document.getElementById('printableArea');
        var opt = {
            margin: 0.3,
            filename: filename,
            image: {
                type: 'jpeg',
                quality: 1
            },
            html2canvas: {
                scale: 2,
                dpi: 192,
                letterRendering: true
            },
            jsPDF: {
                unit: 'in',
                format: 'A3'
            }
        };
        html2pdf().set(opt).from(element).save();

    }

    $(document).ready(function () {
    var filename = $('#filename').val();
    var table = $('#report-dataTable').DataTable({
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: filename,
                exportOptions: {
                    columns: ':not(.d-none)'
                }
            },
            {
                extend: 'pdfHtml5',
                title: filename,
                exportOptions: {
                    columns: ':not(.d-none)'
                }
            },
            {
                extend: 'csvHtml5',
                title: filename,
                exportOptions: {
                    columns: ':not(.d-none)'
                }
            }
        ]
    });
});

</script>

    <script>
         $(document).ready(function(){
            // code to read selected table row cell data (values).
            $(".btnSelect").on('click',function(){
                // alert("hello");
                 var currentRow=$(this).closest("tr");
                 var col1=currentRow.find("td:eq(1)").html();
                 var col2=currentRow.find("td:eq(2)").html();
                 var col3=currentRow.find("td:eq(3)").html();
                 var col4=currentRow.find("td:eq(4)").html()+" "+currentRow.find("td:eq(5)").html();
                 var col5=currentRow.find("td:eq(13)").html()+" "+currentRow.find("td:eq(5)").html();
                 var col_mamount=currentRow.find("td:eq(8)").html()+" "+currentRow.find("td:eq(5)").html();
                 var col7=currentRow.find("td:eq(9)").html();
                 var col8=currentRow.find("td:eq(10)").html();
                 var col9=currentRow.find("td:eq(11)").html();
                 var col10=currentRow.find("td:eq(14)").find("img").attr('src');
                 var data=col1+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+col_mamount+"\n"+col7+"\n"+col8+"\n"+col9;
                  $("#date").text(col1);
                  $("#mname").text(col2);
                  $("#category").text(col3);
                  $("#amnt").text(col4);
                  $("#mamnt").text(col5);
                  var col6 = parseInt(col_mamount);
                  var test =  currentRow.find("td:eq(5)").html();
                  $("#tamnt").text(col6 +" "+test)
                  $("#pmode").text(col7);
                  $("#paid").text(col8);
                  $("#description").text(col9);
                  $("#attachment").attr('src', col10);
                  
                  

            });
                        $(".idSelect").on('click',function(){
                 var currentRow=$(this).closest("tr");
                 var col1=currentRow.find("td:eq(0)").html();
                  $("#input").val(col1);
            });
        });




        $(document).ready(function(){
            $(".btnSelect3").on('click',function(){
                var currentRow=$(this).closest("tr");
                var col13=currentRow.find("td:eq(12)").html();
                $("#ide12").val(col13);
            });
        });



        $(document).ready(function(){
        $(".btnSelect1").on('click',function(){
            var currentRow=$(this).closest("tr");

            var col0=currentRow.find("td:eq(0)").html();
            var col1=currentRow.find("td:eq(1)").html();
                 var col2=currentRow.find("td:eq(2)").html();
                 var col3=currentRow.find("td:eq(3)").html();
                 var col4=currentRow.find("td:eq(4)").html();
                 var col5=currentRow.find("td:eq(7)").html();
                 var col7=currentRow.find("td:eq(9)").html();
                 var col8=currentRow.find("td:eq(10)").html();
                 var col9=currentRow.find("td:eq(11)").html();
                 var col10=currentRow.find("td:eq(6)").html();
                 var col11=currentRow.find("td:eq(7)").html();
                 var col12=currentRow.find("td:eq(5)").html();
                 var col13=currentRow.find("td:eq(12)").html();
                 var col14=currentRow.find("td:eq(14)").find("img").attr('src');
                 var col6=col10*col11;

                 var data=col1+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5+"\n"+"\n"+col7+"\n"+col8+"\n"+col9;
                 // for edit modal
                 $("#datee").val(col1);
                 $("#merchant").val(col2);
                 $("#categorye").val(col3);
                 if(col3 == 'Software'){
                    $("#categorye").val('1');
                 }else if(col12 == 'Sales'){
                    $("#categorye").val('2');
                 }else{
                    $("#categorye").val('3');
                 }
                 $("#total").val(col6);
                 $("#amount").val(col4);
                 $("#totalamnt1").val(col5);
                 if(col7 == 'Cash'){
                    $("#payment").val('1');
                 }else if(col12 == 'Credit Card'){
                    $("#payment").val('2');
                 }else{
                    $("#payment").val('3');
                 }
                 $("#paide").val(col8);
                 $("#descriptions").val(col9);
                 $("#mile").val(col10);
                 $("#milesamount").val(col11);
                 if(col12 == 'USD'){
                    $("#currency").val('1');
                 }else if(col12 == 'Rs.'){
                    $("#currency").val('2');
                 }else{
                    $("#currency").val('3');
                 }
                 $("#ide").val(col13);
                 $("#attachment1").attr('src', col14);
                 


                //  alert(col13)
                 var mileageValue = col10 ;
                //  alert(mileageValue)

                 if (mileageValue !== "0"){
                    // $('#checkbox1').is(":checked");
                    // $('#checkbox1').attr('checked')
                    $( "#checkbox" ).prop( "checked", true );
                    document.getElementById('enteredmilage').classList.remove('d-none')

                 }else{
                    $( "#checkbox" ).prop( "checked", false );

                    document.getElementById('enteredmilage').classList.add('d-none')
                 
                 }
                 

            });
        });

    </script>
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

<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bill')): ?>
<div class=" row d-flex justify-content-end">
    <div class="col-2 my-custom-btn">
        <div class="all-button-box">
            <a href="<?php echo e(url('addExpense')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

            </a>
        </div>
    </div>
    <div class="col-auto my-custom">
        <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row" id="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body py-0 mt-2">
                <div class="table-responsive">
                    <form class="form-row  px-3" action="/filter_expence" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group col-md-4">
                            <label for="sdate" class="form-control-lable"><?php echo e(__('Start Date')); ?></label>
                            <div class="form-icon-user">
                                <span><i class="fas fa-calendar"></i></span>
                                <input type="text" name="startdate" id="sdate" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="form-group col-md-4 offset-md-1">
                            <label for="edate" class="form-control-lable"><?php echo e(__('End Date')); ?></label>
                            <div class="form-icon-user">
                                <span><i class="fas fa-calendar"></i></span>
                                <input type="text" name="enddate" id="edate" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="form-group offset-md-1 col-md-2">
                            <label for="filter" class="form-control-lable"></label>
                            <div class="form-icon-user">
                                <button class="btn btn-danger form-control" type="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div id="printableArea" class="table-responsive pt-4 container ">
                        <table class="table table-striped mb-0" id="report-dataTable">
                            <thead>
                                <tr>
                                    <th> <?php echo e(__('Expense Id')); ?></th>
                                    <th> <?php echo e(__('Expense Date')); ?></th>
                                    <th> <?php echo e(__('Merchant Name')); ?></th>
                                    <th> <?php echo e(__('Category')); ?></th>
                                    <th  class="d-none" > <?php echo e(__('Amount')); ?></th>
                                    <th  class="d-none" > <?php echo e(__('Amount')); ?></th>
                                    <th  class="d-none" > <?php echo e(__('Amount')); ?></th>
                                    <th  class="d-none" > <?php echo e(__('Attachment')); ?></th>
                                    <th  class="d-none" > <?php echo e(__('Currency')); ?></th>
                                    <th class="d-none" > <?php echo e(__('Miles')); ?></th>
                                    <th class="d-none" > <?php echo e(__('Amount/Mile')); ?></th>
                                    <th><?php echo e(__('Total Amount')); ?></th>
                                    <th><?php echo e(__('Payment Mode')); ?></th>
                                    <th class="d-none" ><?php echo e(__('Paid Through')); ?></th>
                                    <th class="d-none" ><?php echo e(__('Description')); ?></th>
                                    <th> <?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Id">

                                        <a href="">#EXPENSE 00<?php echo e($bill->id); ?></a>

                                    </td>

                                    <td> <?php echo e($bill->date); ?> </td>

                                    <td><?php echo e($bill->m_name); ?></td>
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($row->id == $bill->c_id): ?>
                                    <td><?php echo e($row->name); ?></td>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td class="d-none" ><?php echo e($bill->amount); ?></td>
                                    <?php if($bill->currency == 1): ?>
                                    <td class="d-none" >USD</td>
                                    <?php elseif($bill->currency == 2): ?>
                                    <td class="d-none" >Rs.</td>
                                    <?php elseif($bill->currency == 3): ?>
                                    <td class="d-none" >Le</td>
                                    <?php endif; ?>
                                    <td class="d-none" ><?php echo e($bill->mile); ?></td>
                                    <td class="d-none" ><?php echo e($bill->m_amount); ?></td>
                                    <td><?php echo e($bill->totalexp); ?>

                                    <?php if($bill->currency == 1): ?>
                                    USD
                                    <?php elseif($bill->currency == 2): ?>
                                    Rs.
                                    <?php elseif($bill->currency == 3): ?>
                                    Le.
                                    <?php endif; ?>
                                    </td>
                                    <?php if($bill->payment_mode == 1): ?>
                                    <td>Cash</td>
                                    <?php elseif($bill->payment_mode == 2): ?>
                                    <td>Credit Card</td>
                                    <?php elseif($bill->payment_mode == 3): ?>
                                    <td>Debit Card</td>
                                    <?php endif; ?>
                                    <td class="d-none" ><?php echo e($bill->paid_through); ?></td>
                                    <td class="d-none" ><?php echo e($bill->description); ?></td>
                                    <td class="d-none" >
                                        
                                        <?php echo e($bill->id); ?>

                                        
                                    </td>
                                    <td class="d-none" ><?php echo e($bill->totalm_amount); ?></td>
                                    <td class="d-none"><img src="<?php echo e(asset('uploads/expense/'.$bill->attachment)); ?>" width="100px;" height="80px">
                                    </td>
                                    <td class="col-2 my-custom-btn">
                                        <div class="-button-box d-flex">
                                            <a href="#" data-size="lg"   data-title="<?php echo e(__('Bill Detail')); ?>" class="btnSelect edit-icon bg-success"  type="button"  data-toggle="modal" data-target="#view" data-original-title="<?php echo e(__('View Detail')); ?>"><i class="fas fa-eye"></i></a>
                                            <a href="#" data-size="lg" data-title="<?php echo e(__('Bill Detail')); ?>" class="edit-icon btnSelect1" type=" button" data-toggle="modal" data-target="#edit" data-original-title="<?php echo e(__('Edit Detail')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="<?php echo e(url('/receipt',$bill->id)); ?>" data-size="lg"   data-title="<?php echo e(__('Print Detail')); ?>" class="btnSelect edit-icon bg-primary"  type="button" data-original-title="<?php echo e(__('Print Detail')); ?>"> <i class="fas fa-print"></i></a>
                                            <a href="#" data-size="lg" data-title="<?php echo e(__('Bill Detail')); ?>" class="delete-icon btnSelect3" type=" button" data-toggle="modal" data-target="#delete" data-original-title="<?php echo e(__('Delete Detail')); ?>"><i class="fas fa-trash"></i></a>
                                           
                                            
                                        </div>
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
</div>
<style>
    .hover:hover{
        color: blue;
    }
    #attachment:hover{
        width: 200px;
        height: 600px;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="viewLabel" aria-hidden="true">
    <div class="modal-dialog bg-transparent" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLabel">View Details</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <a class="hover">
                    Close
                    </a>
                <span aria-hidden="true" class="text-dark bg-danger rounded-circle px-2">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;"><?php echo e(__('Attacmnet')); ?> : </p>
                    </div>
                    <div >
                        <img src="" id="attachment" width="100px;" height="80px" style=" margin-bottom:0px;">
                        
                    </div>
                </div> 
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;"><?php echo e(__('Expense Date')); ?> : </p>
                    </div>
                    <div >
                        <p style=" margin-bottom:0px;" id="date"></p>
                    </div>
                </div>
        
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;"><?php echo e(__('Merchant Name')); ?> : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="mname">w</p>
                    </div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;"><?php echo e(__('Category')); ?> : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="category">b</p>
                    </div>
                </div>
                <p style=" margin-bottom:0px;border-bottom: dashed 2px #000"></p>

                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div><?php echo e(__('Expense Amount')); ?> : </div>
                    <div  id="amnt">x</div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div><?php echo e(__('Milage Expense')); ?> : </div>
                    <div id="mamnt">y</div>
                </div>
                    <p style=" margin-bottom:0px; border-bottom: dashed 2px #000"></p>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;"><?php echo e(__('Total Expense')); ?> : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="tamnt">x</p>
                    </div>
                </div>

                <div style="display: flex; justify-content:space-between; margin-top:15px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;"><?php echo e(__('Payment Mode')); ?> : </p>
                    </div>
                
                    <div>
                        <p style=" margin-bottom:0px;" id="pmode"><?php echo e(__('Debit Card')); ?></p>
                    </div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;"><?php echo e(__('Payment Through')); ?> : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="paid">i</p>
                    </div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; padding: 0px 20px 0px 20px;">
                    <div>
                        <p style=" margin-bottom:0px;"><?php echo e(__('Description')); ?> : </p>
                    </div>
                    <div>
                        <p style=" margin-bottom:0px;" id="description">i</p>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
            </div>
    </div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="EditLabel" aria-hidden="true">
    <div class="modal-dialog bg-transparent" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditLabel">Edit Details</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <a class="hover">
                    Close
                    </a>
                <span aria-hidden="true" class="text-dark bg-danger rounded-circle px-2">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <div class="container ">
                    <form class="p-3 mx-auto bg-white rounded-lg mt-4 " method="post" action="/edit_expence" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-row  px-3">
                            <div class="form-group col-md-4">
                                <label for="datee" class="form-control-lable"><?php echo e(__('Expense Date')); ?></label>
                                <div class="form-icon-user">
                                    <span><i class="fas fa-calendar"></i></span>
                                    <input type="text" name="date" id="datee" class="form-control datepicker">
                                    <input type="hidden" name="ide" id="ide" >
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
                                            <input type="file" class="form-control" name="attachment" id="attachment" data-filename="attachment_create" >
                                        </label>
                                        <p class="attachment_create"></p>
                                        
                                    </div>
                            </div>
                        </div>
                        <div class="form-row px-3">
                                <div class="form-group col-md-6 m-0">
                                    <label for="categorye" class="form-control-lable"><?php echo e(__('Category')); ?></label>
                                    <select name="category" class=" form-control " id="categorye" style="height:38px;border:1px solid lightgrey;border-radius:8px;font-size: 12px; font-weight: bold; color: #898989;padding: 0px 10px;">
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
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
                                        <select id="currency" class="selectid" name="currency" style="height:38px;border:1px solid lightgrey;border-radius:8px;font-size: 12px; font-weight: bold; color: #898989;" >
                                        <option value="1">USD</option>
                                        <option value="2">Rs.</option>
                                        <option value="3">Le.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row px-4 my-2">
                            <div class="form-check d-flex alighn-center" onchange="enablemilage()">
                                <input class="form-check-input" type="checkbox" value="1" id="checkbox" style="margin-top: 7px;">
                                <label class="form-check-label " for="flexCheckDefault">
                                <?php echo e(__('Add Milage')); ?>

                                </label>
                            </div>
                        </div>
                        <div class="form-row px-3 d-none" id="enteredmilage">
                            <div class="form-group col-md-4">
                                <label for="mile" class="form-control-lable"><?php echo e(__('Miles')); ?></label>
                                <input type="number" class="form-control" name="mile" id="mile" placeholder="<?php echo e(__('Enter Miles')); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="milesamount" class="form-control-lable"><?php echo e(__('Enter Amount')); ?></label>
                                <input type="number" class="form-control" name="milesamount" id="milesamount" placeholder="<?php echo e(__('Enter Amount/mile')); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="total" class="form-control-lable"><?php echo e(__('Total Amount/Miles')); ?></label>
                                <input type="number" class="form-control " name="total" id="total" placeholder="<?php echo e(__('NaN')); ?>" readonly></input>

                            </div>
                        </div>
                        <div class="form-row px-3">
                            <div class="form-group col-md-6">
                                <label for="payment" class="form-control-lable"><?php echo e(__('Payment Mode')); ?></label>
                                <select name="payment" class="selectid form-control" name="payment" id="payment" style="height:38px;border:1px solid lightgrey;border-radius:8px;font-size: 12px; font-weight: bold; color: #898989;padding: 0px 10px;">
                                <option selected value="1"><?php echo e(__('Cash')); ?></option>
                                <option value="2"><?php echo e(__('Credit Card')); ?></option>
                                <option value="3"><?php echo e(__('Debit Card')); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 m-0">
                                <label for="paid" class="form-control-lable"><?php echo e(__('Paid Through')); ?></label>
                                <select name="paid" class="form-control" id="paide"style="height:38px;border:1px solid lightgrey;border-radius:8px;font-size: 12px; font-weight: bold; color: #898989;padding: 0px 10px;">
                                <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option selected value="<?php echo e($row->holder_name); ?>"><?php echo e($row->holder_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row px-3">
                            <div class="form-group col">
                                <label for="descriptions" class="form-control-lable"><?php echo e(__('Description')); ?></label>
                                <textarea type="text" class="form-control" name="description" id="descriptions" required></textarea>
                                -<?php echo e(__('This Expense requires description')); ?>

                            </div>
                        </div>

                        <div class="modal-footer float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Save changes</button>
                        </div>            
                    </form>
                </div>
               
            </div>
        </div>
            
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="EditLabel" aria-hidden="true">
    <div class="modal-dialog bg-transparent" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditLabel">Delete Details</h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <a class="hover">
                    Close
                    </a>
                <span aria-hidden="true" class="text-dark bg-danger rounded-circle px-2">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <h4 class="px-3 pb-3">Are you sure you want to delete this data?</h4>
                <form action="/delete" method="post">
                    <?php echo csrf_field(); ?>
                        <input type="hidden" name="ide12" id="ide12" >
                        <div class="modal-footer float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                </form>
            </div>
        </div>
            
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wazzoerp\resources\views/addExpense/expense.blade.php ENDPATH**/ ?>