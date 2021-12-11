<link href="<?php echo e(asset('assets/css/vendor/bootstrap-tagsinput.css')); ?>" rel="stylesheet">
<form class="pl-3 pr-3" method="post" action="<?php echo e(route('projects.invite.update',[$currantWorkspace->slug,$project->id])); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label for="users_list"><?php echo e(__('Users')); ?></label>
        <select class="select2 form-control select2-multiple" id="users_list" name="users_list[]" data-toggle="select2" multiple="multiple" data-placeholder="<?php echo e(__('Select Users ...')); ?>">
            <?php $__currentLoopData = $currantWorkspace->users($currantWorkspace->created_by); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($user->email); ?>"><?php echo e($user->name); ?> - <?php echo e($user->email); ?></option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit"><?php echo e(__('Invite Users')); ?></button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<?php /**PATH D:\PersonalPJ\Projects\DoAnWebBE\BE\resources\views/projects/invite.blade.php ENDPATH**/ ?>