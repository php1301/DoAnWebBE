<form class="pl-3 pr-3" method="post" action="<?php echo e(route('notes.store',$currantWorkspace->slug)); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-group">
        <label for="title"><?php echo e(__('Title')); ?></label>
        <input class="form-control" type="text" id="title" name="title" required="" placeholder="<?php echo e(__('Title')); ?>">
    </div>
    <div class="form-group">
        <label for="description"><?php echo e(__('Description')); ?></label>
        <textarea class="form-control" id="description" name="text" required></textarea>
    </div>
    <div class="form-group">
        <label for="color"><?php echo e(__('Color')); ?></label>
        <select class="form-control" name="color" required>
            <option value="bg-primary"><?php echo e(__('Primary')); ?></option>
            <option value="bg-secondary"><?php echo e(__('Secondary')); ?></option>
            <option value="bg-info"><?php echo e(__('Info')); ?></option>
            <option value="bg-warning"><?php echo e(__('Warning')); ?></option>
            <option value="bg-danger"><?php echo e(__('Danger')); ?></option>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit"><?php echo e(__('Create Note')); ?></button>
    </div>
</form><?php /**PATH D:\Phat trien ung dung web\DoAnWebBE\resources\views/notes/create.blade.php ENDPATH**/ ?>