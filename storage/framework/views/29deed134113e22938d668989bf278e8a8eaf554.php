<?php $__env->startSection('content'); ?>

<section class="section">

    <h2 class="section-title"><?php echo e(__('Projects')); ?></h2>

    <?php if($projects && $currentWorkspace): ?>

    <div class="row mb-2">
        <?php if($currentWorkspace->creater->id == Auth::user()->id): ?>
        <div class="col-sm-4">
            <button type="button" class="btn btn-primary btn-rounded mb-3" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Project')); ?>" data-url="<?php echo e(route('projects.create',$currentWorkspace->slug)); ?>">
                <i class="mdi mdi-plus"></i> <?php echo e(__('Create Project')); ?>

            </button>
        </div>
        <?php endif; ?>
        <div class="col-sm-8">
            <div class="text-sm-right status-filter">
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-primary" data-status="All"><?php echo e(__('All')); ?></button>
                </div>
                <div class="btn-group mb-3 ml-1">
                    <button type="button" class="btn btn-light" data-status="Ongoing"><?php echo e(__('Ongoing')); ?></button>
                    <button type="button" class="btn btn-light" data-status="Finished"><?php echo e(__('Finished')); ?></button>
                    <button type="button" class="btn btn-light" data-status="OnHold"><?php echo e(__('OnHold')); ?></button>
                </div>

            </div>
        </div><!-- end col-->
    </div>

    <div class="row">
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="col-12 col-sm-12 col-lg-6 animated filter <?php echo e($project->status); ?>">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="card-header-action">
                        <div class="dropdown card-widgets">
                            <a href="#" class="btn active dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="dripicons-gear"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <?php if($currentWorkspace->permission == 'Owner'): ?>
                                <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Project')); ?>" data-url="<?php echo e(route('projects.edit',[$currentWorkspace->slug,$project->id])); ?>"><i class="mdi mdi-pencil mr-1"></i><?php echo e(__('Edit')); ?></a>
                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-<?php echo e($project->id); ?>').submit(): '');" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i><?php echo e(__('Delete')); ?></a>
                                <form id="delete-form-<?php echo e($project->id); ?>" action="<?php echo e(route('projects.destroy',[$currentWorkspace->slug,$project->id])); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form>
                                <a href="#" class="dropdown-item" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Invite Users')); ?>" data-url="<?php echo e(route('projects.invite.popup',[$currentWorkspace->slug,$project->id])); ?>"><i class="mdi mdi-email-outline mr-1"></i><?php echo e(__('Invite')); ?></a>
                             
                            <?php else: ?>
                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('leave-form-<?php echo e($project->id); ?>').submit(): '');" class="dropdown-item"><i class="mdi mdi-exit-to-app mr-1"></i><?php echo e(__('Leave')); ?></a>
                                <form id="leave-form-<?php echo e($project->id); ?>" action="<?php echo e(route('projects.leave',[$currentWorkspace->slug,$project->id])); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="author-box-name">

                        <a href="<?php echo e(route('projects.show',[$currentWorkspace->slug,$project->id])); ?>" title="<?php echo e($project->name); ?>" class="text-title"><?php echo e($project->name); ?></a>

                    </div>
                    <div class="author-box-job">
                        <?php if($project->status == 'Finished'): ?>
                            <div class="badge badge-success"><?php echo e(__('Finished')); ?></div>
                        <?php elseif($project->status == 'Ongoing'): ?>
                            <div class="badge badge-secondary"><?php echo e(__('Ongoing')); ?></div>
                        <?php else: ?>
                            <div class="badge badge-warning"><?php echo e(__('OnHold')); ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="author-box-description">
                        <p>
                            <?php echo e(Str::limit($project->description, $limit = 100, $end = '...')); ?>

                        </p>
                    </div>
                    <p class="mb-1">
                        <span class="pr-2 text-nowrap mb-2 d-inline-block">
                            <i class="mdi mdi-format-list-bulleted-type text-muted"></i>
                            <b><?php echo e($project->countTask()); ?></b> <?php echo e(__('Tasks')); ?>

                        </span>
                        <span class="text-nowrap mb-2 d-inline-block">
                            <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                            <b><?php echo e($project->countTaskComments()); ?></b> <?php echo e(__('Comments')); ?>

                        </span>
                    </p>

                    <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <figure class="avatar mr-2 avatar-sm animated" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo e($user->name); ?>">
                                <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$user->avatar)); ?>" <?php else: ?> avatar="<?php echo e($user->name); ?>"<?php endif; ?> class="rounded-circle">
                            </figure>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="float-right mt-sm-0 mt-3">
                        <a href="<?php echo e(route('projects.show',[$currentWorkspace->slug,$project->id])); ?>" class="btn btn-sm btn-primary"><?php echo e(__('View More')); ?> <i class="dripicons-arrow-right"></i></a>
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php else: ?>

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
</section>
<!-- container -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('style'); ?>

    <link href="<?php echo e(asset('assets/css/vendor/bootstrap-tagsinput.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\BUIQUOCHUY\Desktop\WEBEZJOB\DoAnWebBE\resources\views/projects/index.blade.php ENDPATH**/ ?>