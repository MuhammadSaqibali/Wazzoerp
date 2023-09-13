<div class="card bg-none card-box">
    <?php echo e(Form::model($lead, array('route' => array('leads.update', $lead->id), 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="col-6 form-group">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('subject', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('user_id', __('User'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('user_id', $users,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('email', __('Email'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::email('email', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('pipeline_id', __('Pipeline'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('pipeline_id', $pipelines,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('stage_id', __('Stage'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('stage_id', [''=>__('Select Stage')],null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('sources', __('Sources'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('sources[]', $sources,null, array('class' => 'form-control select2','multiple'=>'','required'=>'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('products', __('Products'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('products[]', $products,null, array('class' => 'form-control select2','multiple'=>'','required'=>'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('notes', __('Notes'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::textarea('notes',null, array('class' => 'summernote-simple'))); ?>

        </div>
        <div class="col-12 text-right">
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>

    <?php echo e(Form::close()); ?>

</div>


<script>
    var stage_id = '<?php echo e($lead->stage_id); ?>';

    $(document).ready(function () {
        var pipeline_id = $('[name=pipeline_id]').val();
        getStages(pipeline_id);
    });

    $(document).on("change", "#commonModal select[name=pipeline_id]", function () {
        var currVal = $(this).val();
        console.log('current val ',currVal);
        getStages(currVal);
    });

    function getStages(id) {
        $.ajax({
            url: '<?php echo e(route('leads.json')); ?>',
            data: {pipeline_id: id, _token: $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            success: function (data) {
                var stage_cnt = Object.keys(data).length;
                $("#stage_id").empty();
                if (stage_cnt > 0) {
                    $.each(data, function (key, data1) {
                        var select = '';
                        if (key == '<?php echo e($lead->stage_id); ?>') {
                            select = 'selected';
                        }
                        $("#stage_id").append('<option value="' + key + '" ' + select + '>' + data1 + '</option>');
                    });
                }
                $("#stage_id").val(stage_id);
                $('#stage_id').select2({
                    placeholder: "<?php echo e(__('Select Stage')); ?>"
                });
            }
        })
    }
</script>
<?php /**PATH /home/wazzoconsulting/wazzoerp.wazzoconsulting.com/resources/views/leads/edit.blade.php ENDPATH**/ ?>