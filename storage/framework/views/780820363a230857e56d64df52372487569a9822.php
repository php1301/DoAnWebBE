<?php if ($milestone && $currantWorkspace) : ?>

    <form class="pl-3 pr-3" method="post" action="<?php echo e(route('projects.milestone.update', [$currantWorkspace->slug, $milestone->id])); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="milestone-title"><?php echo e(__('Milestone Title')); ?></label>
                    <input type="text" class="form-control form-control-light" id="milestone-title" placeholder="<?php echo e(__('Enter Title')); ?>" value="<?php echo e($milestone->title); ?>" name="title" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="milestone-status"><?php echo e(__('Status')); ?></label>
                    <select class="form-control form-control-light" name="status" id="milestone-status" required>
                        <option value="incomplete" <?php if ($milestone->status == 'incomplete') : ?> selected <?php endif; ?>><?php echo e(__('Incomplete')); ?></option>
                        <option value="complete" <?php if ($milestone->status == 'complete') : ?> selected <?php endif; ?>><?php echo e(__('Complete')); ?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="milestone-title"><?php echo e(__('Milestone Cost')); ?></label>
            <input type="number" class="form-control form-control-light" id="milestone-title" placeholder="<?php echo e(__('Enter Cost')); ?>" value="<?php echo e($milestone->cost); ?>" min="0" name="cost" required>
        </div>
        <div class="form-group">
            <label for="task-summary"><?php echo e(__('Summary')); ?></label>
            <textarea class="form-control form-control-light" id="task-summary" rows="3" name="summary"><?php echo e($milestone->summary); ?></textarea>
        </div>


        <div class="text-right">
            <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
            <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
        </div>

    </form>

<?php else : ?>
    <div class="container mt-5">
        <div class="page-error">
            <div class="page-inner">
                <h1>404</h1>
                <div class="page-description">
                    <?php echo e(__('Page Not Found')); ?>

                </div>
                <div class="page-search">
                    <p class="text-muted mt-3"><?php echo e(__('It\'s looking like you may have taken a wrong turn. Don\'t worry... it happens to the best of us. Here\'s a little tip that might help you get back on track.')); ?></p>
                    <div class="mt-3">
                        <a class="btn btn-info mt-3" href="<?php echo e(route('home')); ?>"><i class="mdi mdi-reply"></i> <?php echo e(__('Return Home')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\MIJOB\MIJOB\resources\views/projects/milestoneEdit.blade.php ENDPATH**/ ?>