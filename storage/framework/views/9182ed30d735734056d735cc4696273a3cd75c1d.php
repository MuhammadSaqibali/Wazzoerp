<?php $__env->startSection('page-title'); ?>
    <?php echo e($deal->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/dropzonejs/dropzone.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.css')); ?>">
    <style>
        .nav-tabs .nav-link-tabs.active {
            background: none;
        }
    </style>

    <?php if($calenderTasks): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')); ?>">
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/dropzonejs/min/dropzone.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.js')); ?>"></script>
    <script>
        $(document).on("change", "#change-deal-status select[name=deal_status]", function () {
            $('#change-deal-status').submit();
        });

        <?php if(Auth::user()->type != 'client' || in_array('Client View Files',$permission)): ?>
            Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget", {
            maxFiles: 20,
            maxFilesize: 20,
            parallelUploads: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "<?php echo e(route('deals.file.upload',$deal->id)); ?>",
            success: function (file, response) {
                if (response.is_success) {
                    dropzoneBtn(file, response);
                } else {
                    myDropzone.removeFile(file);
                    show_toastr('Error', response.error, 'error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    show_toastr('Error', response.error, 'error');
                } else {
                    show_toastr('Error', response, 'error');
                }
            }
        });
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("deal_id", <?php echo e($deal->id); ?>);
        });

        myDropzone2 = new Dropzone("#dropzonewidget2", {
            maxFiles: 20,
            maxFilesize: 20,
            parallelUploads: 1,
            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "<?php echo e(route('deals.file.upload',$deal->id)); ?>",
            success: function (file, response) {
                if (response.is_success) {
                    dropzoneBtn(file, response);
                } else {
                    myDropzone2.removeFile(file);
                    show_toastr('Error', response.error, 'error');
                }
            },
            error: function (file, response) {
                myDropzone2.removeFile(file);
                if (response.error) {
                    show_toastr('Error', response.error, 'error');
                } else {
                    show_toastr('Error', response, 'error');
                }
            }
        });
        myDropzone2.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("deal_id", <?php echo e($deal->id); ?>);
        });

        function dropzoneBtn(file, response) {
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "badge badge-pill badge-blue mx-1");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "<?php echo e(__('Download')); ?>");
            download.innerHTML = "<i class='fas fa-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href', response.delete);
            del.setAttribute('class', "badge badge-pill badge-danger mx-1");
            del.setAttribute('data-toggle', "tooltip");
            del.setAttribute('data-original-title', "<?php echo e(__('Delete')); ?>");
            del.innerHTML = "<i class='fas fa-trash'></i>";

            del.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                        url: btn.attr('href'),
                        data: {_token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'DELETE',
                        success: function (response) {
                            if (response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            } else {
                                show_toastr('Error', response.error, 'error');
                            }
                        },
                        error: function (response) {
                            response = response.responseJSON;
                            if (response.is_success) {
                                show_toastr('Error', response.error, 'error');
                            } else {
                                show_toastr('Error', response, 'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.appendChild(download);
            <?php if(Auth::user()->type != 'client'): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
            html.appendChild(del);
            <?php endif; ?>
            <?php endif; ?>

            file.previewTemplate.appendChild(html);

            if ($(".top-5-scroll").length) {
                $(".top-5-scroll").css({
                    height: 315
                }).niceScroll();
            }
        }

        <?php $__currentLoopData = $deal->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(file_exists(storage_path('deal_files/'.$file->file_path))): ?>


        // Create the mock file:
        var mockFile = {name: "<?php echo e($file->file_name); ?>", size: <?php echo e(\File::size(storage_path('deal_files/'.$file->file_path))); ?> };
        // Call the default addedfile event handler
        myDropzone.emit("addedfile", mockFile);
        // And optionally show the thumbnail of the file:
        myDropzone.emit("thumbnail", mockFile, "<?php echo e(asset(Storage::url('deal_files/'.$file->file_path))); ?>");
        myDropzone.emit("complete", mockFile);

        dropzoneBtn(mockFile, {download: "<?php echo e(route('deals.file.download',[$deal->id,$file->id])); ?>", delete: "<?php echo e(route('deals.file.delete',[$deal->id,$file->id])); ?>"});

        // Create the mock file:
        var mockFile2 = {name: "<?php echo e($file->file_name); ?>", size: <?php echo e(\File::size(storage_path('deal_files/'.$file->file_path))); ?> };
        // Call the default addedfile event handler
        myDropzone2.emit("addedfile", mockFile2);
        // And optionally show the thumbnail of the file:
        myDropzone2.emit("thumbnail", mockFile2, "<?php echo e(asset(Storage::url('deal_files/'.$file->file_path))); ?>");
        myDropzone2.emit("complete", mockFile2);

        dropzoneBtn(mockFile2, {download: "<?php echo e(route('deals.file.download',[$deal->id,$file->id])); ?>", delete: "<?php echo e(route('deals.file.delete',[$deal->id,$file->id])); ?>"});
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
        $('.summernote-simple').on('summernote.blur', function () {
            $.ajax({
                url: "<?php echo e(route('deals.note.store',$deal->id)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), notes: $(this).val()},
                type: 'POST',
                success: function (response) {
                    if (response.is_success) {
                        // show_toastr('Success', response.success,'success');
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('Error', response.error, 'error');
                    } else {
                        show_toastr('Error', response, 'error');
                    }
                }
            })
        });
        <?php else: ?>
        $('.summernote-simple').summernote('disable');
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit task')): ?>
        $(document).on("click", ".task-checkbox", function () {
            var chbox = $(this);
            var lbl = chbox.parent().parent().find('label');

            $.ajax({
                url: chbox.attr('data-url'),
                data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
                type: 'PUT',
                success: function (response) {
                    if (response.is_success) {
                        chbox.val(response.status);
                        if (response.status) {
                            lbl.addClass('strike');
                            lbl.find('.badge').removeClass('badge-warning').addClass('badge-success');
                        } else {
                            lbl.removeClass('strike');
                            lbl.find('.badge').removeClass('badge-success').addClass('badge-warning');
                        }
                        lbl.find('.badge').html(response.status_label);

                        show_toastr('Success', response.success, 'success');
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('Error', response.error, 'error');
                    } else {
                        show_toastr('Error', response, 'error');
                    }
                }
            })
        });
        <?php endif; ?>

        $(document).ready(function () {
            var tab = 'general';
                <?php if($tab = Session::get('status')): ?>
            var tab = '<?php echo e($tab); ?>';
            <?php endif; ?>
            $("#myTab2 .nav-link-tabs[href='#" + tab + "']").trigger("click");
        });
    </script>

    <?php if($calenderTasks): ?>
        <script src="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
        <script>
            $(document).ready(function () {
                var e, t, a = $('[data-toggle="event_calendar"]');
                a.length && (t = {
                    header: {right: "", center: "", left: "",},
                    buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
                    theme: !1,
                    selectable: !0,
                    selectHelper: !0,
                    editable: false,
                    events: <?php echo json_encode($calenderTasks); ?>,
                    eventStartEditable: !1,
                    locale: '<?php echo e(basename(App::getLocale())); ?>',
                    viewRender: function (t) {
                        e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
                    },
                }, (e = a).fullCalendar(t),
                    $("body").on("click", "[data-calendar-view]", function (t) {
                        t.preventDefault(), $("[data-calendar-view]").removeClass("active"), $(this).addClass("active");
                        var a = $(this).attr("data-calendar-view");
                        e.fullCalendar("changeView", a)
                    }), $("body").on("click", ".fullcalendar-btn-next", function (t) {
                    t.preventDefault(), e.fullCalendar("next")
                }), $("body").on("click", ".fullcalendar-btn-prev", function (t) {
                    t.preventDefault(), e.fullCalendar("prev")
                }), $("body").on("click", ".fc-today-button", function (t) {
                    t.preventDefault(), e.fullCalendar("today")
                }));

                $(document).on('click', '.fc-day-grid-event', function (e) {
                    if (!$(this).hasClass('deal')) {
                        e.preventDefault();
                        var event = $(this);
                        var title = $(this).find('.fc-content .fc-title').html();
                        var size = 'md';
                        var url = $(this).attr('href');
                        $("#commonModal .modal-title").html(title);
                        $("#commonModal .modal-dialog").addClass('modal-' + size);

                        $.ajax({
                            url: url,
                            success: function (data) {
                                $('#commonModal .modal-body').html(data);
                                $("#commonModal").modal('show');
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                show_toastr('Error', data.error, 'error')
                            }
                        });
                    }
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6" data-toggle="tooltip" data-original-title="<?php echo e(__('Change Deal Status')); ?>">
          <span class="py-0">
          <?php echo e(Form::open(array('route' => array('deals.change.status',$deal->id),'id'=>'change-deal-status','class'=>'mr-2'))); ?>

              <?php echo e(Form::select('deal_status', \App\Deal::$statues,$deal->status, array('class' => 'form-control select2','id'=>'deal_status'))); ?>

              <?php echo e(Form::close()); ?>

          </span>
            </div>

        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/labels')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Labels')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-tags"></i> <?php echo e(__('Label')); ?></a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('edit deal')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-pencil-alt"></i> <?php echo e(__('Edit')); ?></a>
            </div>
        <?php endif; ?>

        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="<?php echo e(route('deals.index')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i><?php echo e(__('Back')); ?></span>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php ($labels = $deal->labels()); ?>
    <?php if($labels): ?>
        <div class="row">
            <div class="col-12 mb-2">
                <div class="text-right">
                    <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge badge-pill badge-<?php echo e($label->color); ?>"><?php echo e($label->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12 mb-3">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#general" role="tab" aria-controls="home" aria-selected="true"><?php echo e(__('General')); ?></a>
                </li>
                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#tasks" role="tab" aria-controls="profile" aria-selected="false"><?php echo e(__('Tasks')); ?></a>
                </li>
                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#products" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(__('Products')); ?></a>
                </li>
                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#sources" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(__('Sources')); ?></a>
                </li>
                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#files" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(__('Files')); ?></a>
                </li>
                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#discussion" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(__('Discussion')); ?></a>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                    <li>
                        <a class="nav-link-tabs" data-toggle="tab" href="#notes" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(__('Notes')); ?></a>
                    </li>
                <?php endif; ?>
                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#clients" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(__('Clients')); ?></a>
                </li>
                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#calls" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(__('Calls')); ?></a>
                </li>

                <li>
                    <a class="nav-link-tabs" data-toggle="tab" href="#emails" role="tab" aria-controls="contact" aria-selected="false"><?php echo e(__('Emails')); ?></a>
                </li>

            </ul>
        </div>

        <div class="col-12">
            <div class="tab-content tab-bordered">
                <div class="tab-pane fade show active" id="general" role="tabpanel">
                    <div class="card py-2 text-sm">
                        <ul class="nav nav-pills p-1">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><?php echo e(__('Price')); ?> <span class="badge badge-pill badge-primary"><?php echo e(\Auth::user()->priceFormat($deal->price)); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-success" href="#"><?php echo e(__('Pipeline')); ?> <span class="badge badge-pill badge-success"><?php echo e($deal->pipeline->name); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="#"><?php echo e(__('Stage')); ?> <span class="badge badge-pill badge-warning"><?php echo e($deal->stage->name); ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><?php echo e(__('Created')); ?> <span class="badge badge-pill badge-secondary"><?php echo e(\Auth::user()->dateFormat($deal->created_at)); ?></span></a>
                            </li>
                            <li class="nav-item deal_status pr-3" data-toggle="tooltip" data-original-title="<?php echo e(__('Deal Status')); ?>">
                                <?php if($deal->status == 'Won'): ?>
                                    <a href="#" class="btn btn-xs btn-white bg-success btn-icon-only width-auto"><?php echo e(__($deal->status)); ?></a>
                                <?php elseif($deal->status == 'Loss'): ?>
                                    <a href="#" class="btn btn-xs btn-white bg-danger btn-icon-only width-auto"><?php echo e(__($deal->status)); ?></a>
                                <?php else: ?>
                                    <a href="#" class="btn btn-xs btn-white bg-info btn-icon-only width-auto"><?php echo e(__($deal->status)); ?></a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>

                    <?php
                    $tasks = $deal->tasks;
                    $products = $deal->products();
                    $sources = $deal->sources();
                    $calls = $deal->calls;
                    $emails = $deal->emails;
                    ?>

                    <div class="row">
                        <div class="col">
                            <div class="card card-box">
                                <div class="left-card">
                                    <div class="icon-box"><i class="fas fa-tasks"></i></div>
                                    <h4 class="pt-3"><?php echo e(__('Task')); ?></h4>
                                </div>
                                <div class="number-icon"><?php echo e(count($tasks)); ?></div>
                                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-box">
                                <div class="left-card">
                                    <div class="icon-box bg-info"><i class="fas fa-dolly"></i></div>
                                    <h4 class="pt-3"><?php echo e(__('Product')); ?></h4>
                                </div>
                                <div class="number-icon"><?php echo e(count($products)); ?></div>
                                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-box">
                                <div class="left-card">
                                    <div class="icon-box bg-warning"><i class="fas fa-eye"></i></div>
                                    <h4 class="pt-3"><?php echo e(__('Source')); ?></h4>
                                </div>
                                <div class="number-icon"><?php echo e(count($sources)); ?></div>
                                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-box">
                                <div class="left-card">
                                    <div class="icon-box bg-danger"><i class="fas fa-file-alt"></i></div>
                                    <h4 class="pt-3"><?php echo e(__('Files')); ?></h4>
                                </div>
                                <div class="number-icon"><?php echo e(count($deal->files)); ?></div>
                                <img src="<?php echo e(asset('assets/img/dot-icon.png')); ?>" class="dotted-icon"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-sm-6 col-md-6">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Users')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                    <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.users.edit',$deal->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add User')); ?>">
                                        <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="card bg-none height-450 top-5-scroll">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <tbody class="list">
                                        <?php $__currentLoopData = $deal->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <img data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?> width="30" class="avatar-sm rounded-circle">
                                                </td>
                                                <td>
                                                    <span class="number-id"><?php echo e($user->name); ?></span>
                                                </td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                    <td>
                                                        <?php if($deal->created_by == \Auth::user()->id): ?>
                                                            <a href="#" class="delete-icon float-right" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($user->id); ?>').submit();">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.users.destroy',$deal->id,$user->id],'id'=>'delete-form-'.$user->id]); ?>

                                                            <?php echo Form::close(); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-sm-6 col-md-6">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Products')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                    <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.products.edit',$deal->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Products')); ?>">
                                        <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="card bg-none height-450 top-5-scroll">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <tbody class="list">
                                        <?php ($products=$deal->products()); ?>
                                        <?php if($products): ?>
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>
                                                        <img width="30" <?php if($product->avatar): ?> src="<?php echo e(asset('/storage/product/'.$product->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/news/img01.jpg')); ?>" <?php endif; ?>>
                                                    </td>
                                                    <td>
                                                        <span class="number-id"><?php echo e($product->name); ?> </span> (<span class="text-muted"><?php echo e(\Auth::user()->priceFormat($product->price)); ?></span>)
                                                    </td>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                        <td>
                                                            <a href="#" class="delete-icon float-right" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('product-delete-form-<?php echo e($product->id); ?>').submit();">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.products.destroy',$deal->id,$product->id],'id'=>'product-delete-form-'.$product->id]); ?>

                                                            <?php echo Form::close(); ?>

                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td><?php echo e(__('No Product Found.!')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Files')); ?></h4>
                            </div>
                            <div class="card height-450">
                                <div class="card-body bg-none top-5-scroll">
                                    <div class="col-md-12 dropzone top-5-scroll browse-file" id="dropzonewidget"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                            <div class="col-6">
                                <div class="justify-content-between align-items-center d-flex">
                                    <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Notes')); ?></h4>
                                </div>
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <textarea class="summernote-simple"><?php echo $deal->notes; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-6">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Activity')); ?></h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="scrollbar-inner">
                                        <div class="mh-500 min-h-500">
                                            <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                                                <?php if(!$deal->activities->isEmpty()): ?>
                                                    <?php $__currentLoopData = $deal->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="timeline-block">
                                                            <span class="timeline-step timeline-step-sm bg-dark border-dark text-white">
                                                                <i class="fas <?php echo e($activity->logIcon()); ?>"></i>
                                                            </span>
                                                            <div class="timeline-content">
                                                                <span class="text-dark text-sm"><?php echo e(__($activity->log_type)); ?></span>
                                                                <a class="d-block h6 text-sm mb-0"><?php echo $activity->getRemark(); ?></a>
                                                                <small><i class="fas fa-clock mr-1"></i><?php echo e($activity->created_at->diffForHumans()); ?></small>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    No activity found yet.
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($calenderTasks): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card author-box card-primary">
                                    <div class="card-header">
                                        <div class="row justify-content-between align-items-center full-calender">
                                            <div class="col d-flex align-items-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                                                        <i class="fas fa-angle-left"></i>
                                                    </a>
                                                    <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                                                        <i class="fas fa-angle-right"></i>
                                                    </a>
                                                </div>
                                                <h5 class="fullcalendar-title h4 d-inline-block font-weight-400 mb-0"></h5>
                                            </div>
                                            <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="fc-today-button btn btn-sm btn-neutral" type="button"><?php echo e(__('Today')); ?></button>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month"><?php echo e(__('Month')); ?></a>
                                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek"><?php echo e(__('Week')); ?></a>
                                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay"><?php echo e(__('Day')); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id='calendar-container'>
                                            <div id='calendar' data-toggle="event_calendar"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade show" id="tasks" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Tasks')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create task')): ?>
                                    <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.tasks.create',$deal->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create Task')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Create')); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                            <?php if(!$tasks->isEmpty()): ?>
                                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-switch">
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit task')): ?>
                                                                    <input type="checkbox" class="custom-control-input task-checkbox" id="task_<?php echo e($task->id); ?>" <?php if($task->status): ?> checked="checked" <?php endif; ?> type="checkbox" value="<?php echo e($task->status); ?>" data-url="<?php echo e(route('deals.tasks.update_status',[$deal->id,$task->id])); ?>"/>
                                                                <?php endif; ?>
                                                                <label for="task_<?php echo e($task->id); ?>" class="custom-control-label ml-4 <?php if($task->status): ?> strike <?php endif; ?>">
                                                                    <h6 class="media-title text-sm">
                                                                        <?php echo e($task->name); ?>

                                                                        <?php if($task->status): ?>
                                                                            <div class="badge badge-pill badge-success mb-1"><?php echo e(__(\App\DealTask::$status[$task->status])); ?></div>
                                                                        <?php else: ?>
                                                                            <div class="badge badge-pill badge-warning mb-1"><?php echo e(__(\App\DealTask::$status[$task->status])); ?></div>
                                                                        <?php endif; ?>
                                                                    </h6>
                                                                    <div class="text-xs text-muted"><?php echo e(__(\App\DealTask::$priorities[$task->priority])); ?> -
                                                                        <span class="text-primary"><?php echo e(Auth::user()->dateFormat($task->date)); ?> <?php echo e(Auth::user()->timeFormat($task->time)); ?></span></div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="Action">
                                                            <span>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit task')): ?>
                                                                    <a href="#" class="edit-icon" data-title="<?php echo e(__('Edit Task')); ?>" data-url="<?php echo e(route('deals.tasks.edit',[$deal->id,$task->id])); ?>" data-ajax-popup="true" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete task')): ?>
                                                                    <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('task-delete-form-<?php echo e($task->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.tasks.destroy',$deal->id,$task->id],'id'=>'task-delete-form-'.$task->id]); ?>

                                                                    <?php echo Form::close(); ?>

                                                                <?php endif; ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <div class="text-center">
                                                    No Tasks Available.!
                                                </div>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="products" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Products')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                    <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.products.edit',$deal->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Products')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <tbody class="list">
                                            <?php if($products): ?>
                                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <img width="50" <?php if($product->avatar): ?> src="<?php echo e(asset('/storage/product/'.$product->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/news/img01.jpg')); ?>" <?php endif; ?>>
                                                        </td>
                                                        <td>
                                                            <span class="number-id"><?php echo e($product->name); ?> </span> (<span class="text-muted"><?php echo e(\Auth::user()->priceFormat($product->price)); ?></span>)
                                                        </td>
                                                        <td>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead')): ?>
                                                                <a href="#" class="delete-icon float-right" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('product-delete-form-<?php echo e($product->id); ?>').submit();">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.products.destroy',$deal->id,$product->id],'id'=>'product-delete-form-'.$product->id]); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <div class="text-center">
                                                    No Product Found.!
                                                </div>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="sources" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Sources')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                    <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.sources.edit',$deal->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Sources')); ?>"><i class="fas fa-pen"></i> <?php echo e(__('Edit')); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <tbody class="list">
                                            <?php if($sources): ?>
                                                <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>
                                                            <span class="text-dark"><?php echo e($source->name); ?></span>
                                                        </td>
                                                        <td>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                                <a href="#" class="delete-icon float-right" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('source-delete-form-<?php echo e($source->id); ?>').submit();">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.sources.destroy',$deal->id,$source->id],'id'=>'source-delete-form-'.$source->id]); ?>

                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <div class="text-center">
                                                    No Source Added!
                                                </div>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="files" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Files')); ?></h4>
                            </div>
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="col-md-12 dropzone top-5-scroll browse-file" id="dropzonewidget2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="discussion" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Discussion')); ?></h4>
                                <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.discussions.create',$deal->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Message')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add Message')); ?></a>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <?php if(!$deal->discussions->isEmpty()): ?>
                                            <?php $__currentLoopData = $deal->discussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discussion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="media mb-2">
                                                    <img alt="image" class="mr-3 rounded-circle" width="50" height="50" data-original-title="<?php echo e((!empty($discussion->user)?$discussion->user->name:'')); ?>" <?php if($discussion->user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$discussion->user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?> width="30">
                                                    <div class="media-body">
                                                        <div class="mt-0 mb-1 font-weight-bold text-sm"><?php echo e($discussion->user->name); ?>

                                                            <small><?php echo e($discussion->user->type); ?></small>
                                                            <small class="float-right"><?php echo e($discussion->created_at->diffForHumans()); ?></small>
                                                        </div>
                                                        <div class="text-xs"> <?php echo e($discussion->comment); ?></div>

                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="text-center">
                                                No Discussion Found!
                                            </div>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="notes" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Notes')); ?></h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <textarea class="summernote-simple"><?php echo $deal->notes; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="custom_fields" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Custom Fields')); ?></h4>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <tbody class="list">
                                            <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="text-dark"><?php echo e($field->name); ?></td>
                                                    <?php if(!empty($deal->customField)): ?>
                                                        <td><?php echo e($deal->customField[$field->id]); ?></td>
                                                    <?php endif; ?>
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

                <div class="tab-pane fade show" id="clients" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Clients')); ?></h4>
                                <?php if(\Auth::user()->type == 'comapny'): ?>
                                    <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.clients.edit',$deal->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Add Client')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add Client')); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped dataTable">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('Avatar')); ?></th>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Email')); ?></th>
                                            <?php if(count($deal->clients) != 1): ?>
                                                <th><?php echo e(__('Action')); ?></th>
                                            <?php endif; ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $deal->clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><img data-original-title="<?php echo e((!empty($client->avatar)?$client->name:'')); ?>" <?php if($client->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$client->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?> class="rounded-circle mr-1" width="40" height="40"></td>
                                                <td><?php echo e($client->name); ?></td>
                                                <td><?php echo e($client->email); ?></td>
                                                <?php if(count($deal->clients) != 1): ?>
                                                    <td>
                                                        <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('client-delete-form-<?php echo e($client->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.clients.destroy',$deal->id,$client->id],'id'=>'client-delete-form-'.$client->id]); ?>

                                                        <?php echo Form::close(); ?>

                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="calls" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Calls')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create deal call')): ?>
                                    <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.calls.create',$deal->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Add Call')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add Call')); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped dataTable">
                                            <thead>
                                            <tr>
                                                <th><?php echo e(__('Subject')); ?></th>
                                                <th><?php echo e(__('Call Type')); ?></th>
                                                <th><?php echo e(__('Duration')); ?></th>
                                                <th><?php echo e(__('User')); ?></th>
                                                <th width="14%"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $calls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($call->subject); ?></td>
                                                    <td><?php echo e(ucfirst($call->call_type)); ?></td>
                                                    <td><?php echo e($call->duration); ?></td>
                                                    <td><?php echo e($call->getDealCallUser->name); ?></td>
                                                    <td class="Action">
                                                            <span>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal call')): ?>
                                                                    <a href="#" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/call/'.$call->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Deal Call')); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                                                <?php endif; ?>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete deal call')): ?>
                                                                    <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($call->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.calls.destroy',$deal->id ,$call->id],'id'=>'delete-form-'.$call->id]); ?>

                                                                    <?php echo Form::close(); ?>

                                                                <?php endif; ?>
                                                            </span>
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

                <div class="tab-pane fade show" id="emails" role="tabpanel">
                    <div class="row pt-2">
                        <div class="col-12">
                            <div class="justify-content-between align-items-center d-flex">
                                <h4 class="h4 font-weight-400 float-left"><?php echo e(__('Emails')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create deal email')): ?>
                                    <a href="#" class="btn btn-sm btn-white float-right add-small" data-url="<?php echo e(route('deals.emails.create',$deal->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Add Email')); ?>"><i class="fas fa-plus"></i> <?php echo e(__('Add Email')); ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <?php if(!$emails->isEmpty()): ?>
                                            <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="media">
                                                    <img alt="image" class="mr-3 mb-3 rounded-circle" width="50" height="50" src="<?php echo e(asset('assets/img/avatar/avatar-1.png')); ?>">
                                                    <div class="media-body">
                                                        <div class="mt-0 mb-1 font-weight-bold text-sm"><?php echo e($email->subject); ?>

                                                            <small class="float-right"><?php echo e($email->created_at->diffForHumans()); ?></small>
                                                        </div>
                                                        <div class="text-xs"><?php echo e($email->to); ?></div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <div class="text-center">
                                                No Emails Found!
                                            </div>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/deals/show.blade.php ENDPATH**/ ?>