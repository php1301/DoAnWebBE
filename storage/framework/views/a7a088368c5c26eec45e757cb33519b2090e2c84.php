<?php $__env->startComponent('mail::message'); ?>
# <?php echo e(__('Hello')); ?>, <?php echo e($user->name); ?>


<?php echo e(__('You invite in new project')); ?> <b> <?php echo e($project->name); ?></b> <?php echo e(__('by')); ?> <?php echo e($project->creater->name); ?>


<?php $__env->startComponent('mail::button', ['url' => route('projects.show',[$project->workspaceData->slug,$project->id])]); ?>
<?php echo e(__('Open Project')); ?>

<?php echo $__env->renderComponent(); ?>

<?php echo e(__('Thanks')); ?>,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\PersonalPJ\Projects\DoAnWebBE\BE\resources\views/email/invitation.blade.php ENDPATH**/ ?>