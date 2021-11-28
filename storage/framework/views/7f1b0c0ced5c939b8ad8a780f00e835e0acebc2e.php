<form class="pl-3 pr-3" method="post" action="<?php echo e(route('notes.update',[$currantWorkspace->slug,$notes->id])); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label for="title"><?php echo e(__('Title')); ?></label>
        <input class="form-control" type="text" id="title" name="title" value="<?php echo e($notes->title); ?>" required="" placeholder="<?php echo e(__('Title')); ?>">
    </div>
    <div class="form-group">
        <label for="description"><?php echo e(__('Description')); ?></label>
        <textarea class="form-control" id="description" name="text" required><?php echo e($notes->text); ?></textarea>
    </div>
    <div class="form-group">
        <label for="color"><?php echo e(__('Color')); ?></label>
        <select class="form-control" name="color" required>
            <option value="bg-primary"><?php echo e(__('Primary')); ?></option>
            <option <?php if($notes->color == 'bg-secondary'): ?> selected <?php endif; ?> value="bg-secondary"><?php echo e(__('Secondary')); ?></option>
            <option <?php if($notes->color == 'bg-info'): ?> selected <?php endif; ?> value="bg-info"><?php echo e(__('Info')); ?></option>
            <option <?php if($notes->color == 'bg-warning'): ?> selected <?php endif; ?> value="bg-warning"><?php echo e(__('Warning')); ?></option>
            <option <?php if($notes->color == 'bg-danger'): ?> selected <?php endif; ?> value="bg-danger"><?php echo e(__('Danger')); ?></option>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit"><?php echo e(__('Update Note')); ?></button>
    </div>
</form><?php /**PATH D:\PersonalPJ\Projects\DoAnWebBE\BE\resources\views/notes/edit.blade.php ENDPATH**/ ?>