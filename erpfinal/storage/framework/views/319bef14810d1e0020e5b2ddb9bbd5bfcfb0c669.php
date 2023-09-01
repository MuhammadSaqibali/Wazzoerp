<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Bill Summary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('theme-script'); ?>
    <script src="<?php echo e(asset('assets/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        var e = $("#chart-sales");
        !function (e) {
            var t = {
                chart: {width: "100%", zoom: {enabled: !1}, toolbar: {show: !1}, shadow: {enabled: !1}},
                stroke: {width: 6, curve: "smooth"},
                series: [{name: "<?php echo e(__('Bill')); ?>", data: <?php echo json_encode($billTotal); ?>}],
                xaxis: {labels: {format: "MMM", style: {colors: PurposeStyle.colors.gray[600], fontSize: "14px", fontFamily: PurposeStyle.fonts.base, cssClass: "apexcharts-xaxis-label"}}, axisBorder: {show: !1}, axisTicks: {show: !0, borderType: "solid", color: PurposeStyle.colors.gray[300], height: 6, offsetX: 0, offsetY: 0}, type: "text", categories: <?php echo json_encode($monthList); ?>},
                yaxis: {labels: {style: {color: PurposeStyle.colors.gray[600], fontSize: "12px", fontFamily: PurposeStyle.fonts.base}}, axisBorder: {show: !1}, axisTicks: {show: !0, borderType: "solid", color: PurposeStyle.colors.gray[300], height: 6, offsetX: 0, offsetY: 0}},
                fill: {type: "solid"},
                markers: {size: 4, opacity: .7, strokeColor: "#fff", strokeWidth: 3, hover: {size: 7}},
                grid: {borderColor: PurposeStyle.colors.gray[300], strokeDashArray: 5},
                dataLabels: {enabled: !1}
            }, a = (e.data().dataset, e.data().labels, e.data().color), n = e.data().height, o = e.data().type;
            t.colors = [PurposeStyle.colors.theme[a]], t.markers.colors = [PurposeStyle.colors.theme[a]], t.chart.height = n || 350, t.chart.type = o || "line";
            var i = new ApexCharts(e[0], t);
            setTimeout(function () {
                i.render()
            }, 400)
        }($("#chart-sales"));
    </script>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }

        $(document).ready(function () {
            var filename = $('#filename').val();
            $('#report-dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        title: filename
                    },
                    {
                        extend: 'pdf',
                        title: filename
                    }, {
                        extend: 'csv',
                        title: filename
                    }
                ]
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <div class="col">
            <?php echo e(Form::open(array('route' => array('report.bill.summary'),'method' => 'GET','id'=>'report_bill_summary'))); ?>

            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('start_month', __('Start Month'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:'', array('class' => 'month-btn form-control'))); ?>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('end_month', __('End Month'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:'', array('class' => 'month-btn form-control'))); ?>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('vender', __('Vender'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::select('vender',$vender,isset($_GET['vender'])?$_GET['vender']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('status', __('Status'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::select('status', [''=>'All']+$status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_bill_summary').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="<?php echo e(route('report.bill.summary')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
    <?php echo e(Form::close()); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="printableArea">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="<?php echo e($filter['status'].' '.__('Bill').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange'].' '.__('of').' '.$filter['vender']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Report')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e(__('Bill Summary')); ?></h5>
                </div>
            </div>
            <?php if($filter['vender']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Vendor')); ?> :</h5>
                        <h5 class="report-text mb-0"><?php echo e($filter['vender']); ?></h5>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($filter['status']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Status')); ?> :</h5>
                        <h5 class="report-text mb-0"><?php echo e($filter['status']); ?></h5>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h5>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Total Bill')); ?></h5>
                    <h5 class="report-text mb-0"><?php echo e(Auth::user()->priceFormat($totalBill)); ?></h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Total Paid')); ?></h5>
                    <h5 class="report-text mb-0"><?php echo e(Auth::user()->priceFormat($totalPaidBill)); ?></h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Total Due')); ?></h5>
                    <h5 class="report-text mb-0"><?php echo e(Auth::user()->priceFormat($totalDueBill)); ?></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="bill-container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <ul class="nav nav-pills mb-3" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active btn-xs" id="profile-tab3" data-toggle="tab" href="#summary" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Summary')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-xs" id="contact-tab4" data-toggle="tab" href="#bills" role="tab" aria-controls="" aria-selected="false"><?php echo e(__('Bills')); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade fade" id="bills" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> <?php echo e(__('Bill')); ?></th>
                                                <th> <?php echo e(__('Date')); ?></th>
                                                <th> <?php echo e(__('Customer')); ?></th>
                                                <th> <?php echo e(__('Category')); ?></th>
                                                <th> <?php echo e(__('Status')); ?></th>
                                                <th> <?php echo e(__('	Paid Amount')); ?></th>
                                                <th> <?php echo e(__('Due Amount')); ?></th>
                                                <th> <?php echo e(__('Payment Date')); ?></th>
                                                <th> <?php echo e(__('Amount')); ?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="Id">
                                                        <a href="<?php echo e(route('bill.show',$bill->id)); ?>">
                                                            <?php echo e(AUth::user()->billNumberFormat($bill->bill_id)); ?>

                                                        </a>
                                                    </td>
                                                    <td><?php echo e(Auth::user()->dateFormat($bill->send_date)); ?></td>
                                                    <td> <?php echo e(!empty($bill->vender)? $bill->vender->name:'-'); ?> </td>
                                                    <td><?php echo e(!empty($bill->category)?$bill->category->name:'-'); ?></td>
                                                    <td>
                                                        <?php if($bill->status == 0): ?>
                                                            <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 1): ?>
                                                            <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 2): ?>
                                                            <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 3): ?>
                                                            <span class="badge badge-pill badge-info"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                                        <?php elseif($bill->status == 4): ?>
                                                            <span class="badge badge-pill badge-success"><?php echo e(__(\App\Invoice::$statues[$bill->status])); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <?php echo e(\Auth::user()->priceFormat($bill->getTotal()-$bill->getDue())); ?></td>
                                                    <td> <?php echo e(\Auth::user()->priceFormat($bill->getDue())); ?></td>
                                                    <td><?php echo e(!empty($bill->lastPayments)?\Auth::user()->dateFormat($bill->lastPayments->date):''); ?></td>
                                                    <td> <?php echo e(\Auth::user()->priceFormat($bill->getTotal())); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade fade show active" id="summary" role="tabpanel" aria-labelledby="profile-tab3">
                                        <div class="col-sm-12">
                                            <div class="scrollbar-inner">
                                                <div id="chart-sales" data-color="primary" data-type="bar" data-height="300"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/softgearcom/public_html/wazooerp/wazooerp/resources/views/report/bill_report.blade.php ENDPATH**/ ?>