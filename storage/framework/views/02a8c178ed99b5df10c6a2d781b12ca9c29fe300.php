<form class="pl-3 pr-3" method="post" action="<?php echo e(route('projects.update',[$currantWorkspace->slug,$project->id])); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="projectname"><?php echo e(__('Name')); ?></label>
                <input class="form-control" type="text" id="projectname" name="name" value="<?php echo e($project->name); ?>" required="" placeholder="<?php echo e(__('Project Name')); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status"><?php echo e(__('Status')); ?></label>
                        <select id="status" name="status" class="form-control">
                            <option value="Ongoing"><?php echo e(__('Ongoing')); ?></option>
                            <option value="Finished" <?php if($project->status == 'Finished'): ?> selected <?php endif; ?>><?php echo e(__('Finished')); ?></option>
                            <option value="OnHold" <?php if($project->status == 'OnHold'): ?> selected <?php endif; ?>><?php echo e(__('OnHold')); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="budget"><?php echo e(__('Budget')); ?></label>
                        <div class="input-group">
                            <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span class="input-group-text">$</span></span>
                            <input class="form-control" type="number" min="0" id="budget" name="budget" value="<?php echo e($project->budget); ?>" placeholder="<?php echo e(__('Project Budget')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="start_date"><?php echo e(__('Start Date')); ?></label>
                <input class="form-control date" type="text" id="start_date" name="start_date" value="<?php echo e($project->start_date); ?>" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="end_date"><?php echo e(__('End Date')); ?></label>
                <input class="form-control date" type="text" id="end_date" name="end_date" value="<?php echo e($project->end_date); ?>" autocomplete="off">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="description"><?php echo e(__('Description')); ?></label>
                <textarea class="form-control" id="description" name="description"><?php echo e($project->description); ?></textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit"><?php echo e(__('Edit Project')); ?></button>
    </div>
</form>
<script>
    $( function() {
        var dateFormat = "yy-mm-dd",
            from = $( "#start_date" )
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3,
                    dateFormat:dateFormat
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            to = $( "#end_date" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 3,
                dateFormat:dateFormat
            })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });

        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }

            return date;
        }
    } );
</script>
<?php /**PATH D:\PersonalPJ\Projects\DoAnWebBE\BE\resources\views/projects/edit.blade.php ENDPATH**/ ?>