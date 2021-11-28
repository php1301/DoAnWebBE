<?php $__env->startSection('content'); ?>
<!-- Start Content-->
<section class="section">

    <?php if($currantWorkspace || Auth::user()->type == 'admin'): ?>

        <div class="row mb-2">
            <div class="col-sm-4">
                <h2 class="section-title"><?php echo e(__('Users')); ?></h2>
            </div>
            <?php if($currantWorkspace && $currantWorkspace->creater->id == Auth::user()->id): ?>
            <div class="col-sm-8">
                <div class="text-sm-right">
                    <button type="button" class="btn btn-primary btn-rounded mt-4" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Invite New User')); ?>" data-url="<?php echo e(route('users.invite',$currantWorkspace->slug)); ?>">
                        <i class="mdi mdi-plus"></i> <?php echo e(__('Invite User')); ?>

                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>


        <div class="row">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-4 animated">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$user->avatar)); ?>" width="75px" <?php else: ?> avatar="<?php echo e($user->name); ?>"<?php endif; ?> alt="" class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">

                            <?php if(Auth::user()->type == 'admin'): ?>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label"><?php echo e(__('Number of Workspaces')); ?></div>
                                    <div class="profile-widget-item-value"><?php echo e($user->countWorkspace()); ?></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label"><?php echo e(__('Number of Users')); ?></div>
                                    <div class="profile-widget-item-value"><?php echo e($user->countUsers(($currantWorkspace)?$currantWorkspace->id:'')); ?></div>
                                </div>
                                
                            <?php endif; ?>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label"><?php echo e(__('Number of Projects')); ?></div>
                                <div class="profile-widget-item-value"><?php echo e($user->countProject(($currantWorkspace)?$currantWorkspace->id:'')); ?></div>
                            </div>
                            <?php if(Auth::user()->type != 'admin'): ?>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label"><?php echo e(__('Number of Tasks')); ?></div>
                                    <div class="profile-widget-item-value"><?php echo e($user->countTask(($currantWorkspace)?$currantWorkspace->id:'')); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="profile-widget-description pb-0">
                        <div class="card-body p-0">
                            <div class="card-header-action">
                                <div class="dropdown card-widgets text-right">
                                    <?php if($currantWorkspace->permission == 'Owner' && Auth::user()->id != $user->id): ?>
                                        <div class="dropdown card-widgets float-right">
                                            <a href="#" class="dropdown-toggle arrow-none text-muted" data-toggle="dropdown" aria-expanded="false">
                                                <i class="dripicons-gear"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit User')); ?>" data-url="<?php echo e(route('users.edit',[$currantWorkspace->slug,$user->id])); ?>"><i class="mdi mdi-pencil mr-1"></i><?php echo e(__('Edit')); ?></a>
                                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-<?php echo e($user->id); ?>').submit(): '');" class="dropdown-item"><i class="mdi mdi-delete mr-1"></i><?php echo e(__('Remove User From Workspace')); ?></a>
                                                <form method="post" id="delete-form-<?php echo e($user->id); ?>" action="<?php echo e(route('users.remove',[$currantWorkspace->slug,$user->id])); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="profile-widget-name"><?php echo e($user->name); ?> <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo e($user->permission); ?></div></div>

                            <p><label class="font-weight-bold"><?php echo e(__('Email Address ')); ?> : </label> <?php echo e($user->email); ?></p>
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PersonalPJ\Projects\DoAnWebBE\BE\resources\views/users/index.blade.php ENDPATH**/ ?>