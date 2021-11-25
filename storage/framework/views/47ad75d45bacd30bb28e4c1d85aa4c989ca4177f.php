<?php $__env->startSection('content'); ?>
<section class="section">

    <h2 class="section-title"><?php echo e(__('User Profile')); ?></h2>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link show active animated" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block"><?php echo e(__('Account')); ?></span>
                                </a>
                                <a class="nav-link animated" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block"><?php echo e(__('Change Password')); ?></span>
                                </a>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-sm-9">
                            <div class="tab-content animated" id="v-pills-tabContent">
                                <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <form method="post" action="<?php echo e(route('update.account')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="fullname"><?php echo e(__('Full Name')); ?></label>
                                                    <input class="form-control <?php if ($errors->has('name')) :
                                                                                    if (isset($message)) {
                                                                                        $messageCache = $message;
                                                                                    }
                                                                                    $message = $errors->first('name'); ?> is-invalid <?php unset($message);
                                                                                    if (isset($messageCache)) {
                                                                                        $message = $messageCache;
                                                                                    }
                                                                                endif; ?>" name="name" type="text" id="fullname" placeholder="<?php echo e(__('Enter Your Name')); ?>" value="<?php echo e($user->name); ?>" required autocomplete="name">
                                                    <?php if ($errors->has('name')) :
                                                        if (isset($message)) {
                                                            $messageCache = $message;
                                                        }
                                                        $message = $errors->first('name'); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
                                                        if (isset($messageCache)) {
                                                            $message = $messageCache;
                                                        }
                                                    endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="avatar"><?php echo e(__('Avatar')); ?></label>
                                                    <input class="form-control <?php if ($errors->has('avatar')) :
                                                                                    if (isset($message)) {
                                                                                        $messageCache = $message;
                                                                                    }
                                                                                    $message = $errors->first('avatar'); ?> is-invalid <?php unset($message);
                                                                                    if (isset($messageCache)) {
                                                                                        $message = $messageCache;
                                                                                    }
                                                                                endif; ?>" name="avatar" type="file" id="avatar" accept="image/*">
                                                    <?php if ($errors->has('avatar')) :
                                                        if (isset($message)) {
                                                            $messageCache = $message;
                                                        }
                                                        $message = $errors->first('avatar'); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
                                                        if (isset($messageCache)) {
                                                            $message = $messageCache;
                                                        }
                                                    endif; ?>
                                                    <span>
                                                        <small><?php echo e(__('Please upload a valid image file. Size of image should not be more than 2MB.')); ?></small>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-center pt-5 pl-5 pr-5">
                                                <img <?php if ($user->avatar) : ?> src="<?php echo e(asset('/storage/avatars/' . $user->avatar)); ?>" <?php else : ?> avatar="<?php echo e($user->name); ?>" <?php endif; ?> id="myAvatar" alt="user-image" class="rounded-circle img-thumbnail w-100">
                                                <?php if ($user->avatar != '') : ?>
                                                    <button type="button" class="btn btn-danger mt-2" onclick="document.getElementById('delete_avatar').submit();">
                                                        <i class="mdi mdi-delete mr-1"></i> <?php echo e(__('Delete')); ?>

                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="mdi mdi-update mr-1"></i> <?php echo e(__('Update')); ?> </button>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </form>
                                    <?php if ($user->avatar != '') : ?>
                                        <form action="<?php echo e(route('delete.avatar')); ?>" method="post" id="delete_avatar">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                        </form>
                                    <?php endif; ?>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <form method="post" action="<?php echo e(route('update.password')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="old_password"><?php echo e(__('Old Password')); ?></label>
                                                    <input class="form-control <?php if ($errors->has('old_password')) :
                                                                                    if (isset($message)) {
                                                                                        $messageCache = $message;
                                                                                    }
                                                                                    $message = $errors->first('old_password'); ?> is-invalid <?php unset($message);
                                                                                    if (isset($messageCache)) {
                                                                                        $message = $messageCache;
                                                                                    }
                                                                                endif; ?>" name="old_password" type="password" id="old_password" required autocomplete="old_password" placeholder="<?php echo e(__('Enter Old Password')); ?>">
                                                    <?php if ($errors->has('old_password')) :
                                                        if (isset($message)) {
                                                            $messageCache = $message;
                                                        }
                                                        $message = $errors->first('old_password'); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
                                                        if (isset($messageCache)) {
                                                            $message = $messageCache;
                                                        }
                                                    endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password"><?php echo e(__('Password')); ?></label>
                                                    <input class="form-control <?php if ($errors->has('password')) :
                                                                                    if (isset($message)) {
                                                                                        $messageCache = $message;
                                                                                    }
                                                                                    $message = $errors->first('password'); ?> is-invalid <?php unset($message);
                                                                                    if (isset($messageCache)) {
                                                                                        $message = $messageCache;
                                                                                    }
                                                                                endif; ?>" name="password" type="password" required autocomplete="new-password" id="password" placeholder="<?php echo e(__('Enter Your Password')); ?>">
                                                    <?php if ($errors->has('password')) :
                                                        if (isset($message)) {
                                                            $messageCache = $message;
                                                        }
                                                        $message = $errors->first('password'); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
                                                        if (isset($messageCache)) {
                                                            $message = $messageCache;
                                                        }
                                                    endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                                                    <input class="form-control <?php if ($errors->has('password_confirmation')) :
                                                                                    if (isset($message)) {
                                                                                        $messageCache = $message;
                                                                                    }
                                                                                    $message = $errors->first('password_confirmation'); ?> is-invalid <?php unset($message);
                                                                                    if (isset($messageCache)) {
                                                                                        $message = $messageCache;
                                                                                    }
                                                                                endif; ?>" name="password_confirmation" type="password" required autocomplete="new-password" id="password_confirmation" placeholder="<?php echo e(__('Enter Your Password')); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                                <div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="mdi mdi-lock mr-1"></i> <?php echo e(__('Change Password')); ?> </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MIJOB\MIJOB\resources\views/users/account.blade.php ENDPATH**/ ?>