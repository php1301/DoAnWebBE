<form class="pl-3 pr-3" method="post" action="<?php echo e(route('users.update',[$currantWorkspace->slug,$user->id])); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label for="name"><?php echo e(__('Name')); ?></label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>"/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit"><?php echo e(__('Update User')); ?></button>
    </div>
</form><?php /**PATH D:\PersonalPJ\Projects\DoAnWebBE\BE\resources\views/users/edit.blade.php ENDPATH**/ ?>