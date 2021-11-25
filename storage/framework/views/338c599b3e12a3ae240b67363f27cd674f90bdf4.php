<?php $__env->startComponent('mail::message'); ?>
# <?php echo e(__('Hello')); ?>, <?php echo e($user->name); ?>


<?php echo e(__('You invite in new Workspace')); ?> <b> <?php echo e($workspace->name); ?></b> <?php echo e(__('by')); ?> <?php echo e($workspace->creater->name); ?>


<?php $__env->startComponent('mail::button', ['url' => route('home',[$workspace->slug])]); ?>
    <?php echo e(__('Open Workspace')); ?>

<?php echo $__env->renderComponent(); ?>

<?php echo e(__('Thanks')); ?>,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH D:\PersonalPJ\Projects\DoAnWebBE\BE\resources\views/email/workspace_invitation.blade.php ENDPATH**/ ?>