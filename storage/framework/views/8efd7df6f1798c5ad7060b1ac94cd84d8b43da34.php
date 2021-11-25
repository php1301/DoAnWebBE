<?php $__env->startSection('content'); ?>
<section class="section">

    <?php if ($currantWorkspace && $currantWorkspace->permission == 'Owner') : ?>

        <div class="row mb-2">
            <div class="col-sm-4">
                <h2 class="section-title"><?php echo e(__('Languages')); ?></h2>
            </div>
            <div class="col-sm-8">
                <div class="text-sm-right">
                    <button type="button" class="btn btn-primary btn-rounded mt-4" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create new')); ?>" data-url="<?php echo e(route('create_lang_workspace', $currantWorkspace->slug)); ?>">
                        <i class="mdi mdi-plus"></i> <?php echo e(__('Create new')); ?>

                    </button>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <?php $__currentLoopData = $currantWorkspace->languages();
                            $__env->addLoop($__currentLoopData);
                            foreach ($__currentLoopData as $lang) : $__env->incrementLoopIndices();
                                $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('lang_workspace', [$currantWorkspace->slug, $lang])); ?>" class="nav-link <?php if ($currantLang == $lang) : ?> active <?php endif; ?>">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block"><?php echo e(Str::upper($lang)); ?></span>
                                </a>
                            <?php endforeach;
                            $__env->popLoop();
                            $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#labels" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block"><?php echo e(__('Labels')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#messages" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                    <span class="d-none d-lg-block"><?php echo e(__('Messages')); ?></span>
                                </a>
                            </li>
                        </ul>
                        <form method="post" action="<?php echo e(route('store_lang_data_workspace', [$currantWorkspace->slug, $currantLang])); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="tab-content">
                                <div class="tab-pane active" id="labels">
                                    <div class="row">
                                        <?php $__currentLoopData = $arrLabel;
                                        $__env->addLoop($__currentLoopData);
                                        foreach ($__currentLoopData as $label => $value) : $__env->incrementLoopIndices();
                                            $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-3">
                                                    <label><?php echo e($label); ?></label>
                                                    <input type="text" class="form-control" name="label[<?php echo e($label); ?>]" value="<?php echo e($value); ?>">
                                                </div>
                                            </div>
                                        <?php endforeach;
                                        $__env->popLoop();
                                        $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="messages">
                                    <?php $__currentLoopData = $arrMessage;
                                    $__env->addLoop($__currentLoopData);
                                    foreach ($__currentLoopData as $fileName => $fileValue) : $__env->incrementLoopIndices();
                                        $loop = $__env->getLastLoop(); ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3><?php echo e(ucfirst($fileName)); ?></h3>
                                            </div>
                                            <?php $__currentLoopData = $fileValue;
                                            $__env->addLoop($__currentLoopData);
                                            foreach ($__currentLoopData as $label => $value) : $__env->incrementLoopIndices();
                                                $loop = $__env->getLastLoop(); ?>
                                                <?php if (is_array($value)) : ?>
                                                    <?php $__currentLoopData = $value;
                                                    $__env->addLoop($__currentLoopData);
                                                    foreach ($__currentLoopData as $label2 => $value2) : $__env->incrementLoopIndices();
                                                        $loop = $__env->getLastLoop(); ?>
                                                        <?php if (is_array($value2)) : ?>
                                                            <?php $__currentLoopData = $value2;
                                                            $__env->addLoop($__currentLoopData);
                                                            foreach ($__currentLoopData as $label3 => $value3) : $__env->incrementLoopIndices();
                                                                $loop = $__env->getLastLoop(); ?>
                                                                <?php if (is_array($value3)) : ?>
                                                                    <?php $__currentLoopData = $value3;
                                                                    $__env->addLoop($__currentLoopData);
                                                                    foreach ($__currentLoopData as $label4 => $value4) : $__env->incrementLoopIndices();
                                                                        $loop = $__env->getLastLoop(); ?>
                                                                        <?php if (is_array($value4)) : ?>
                                                                            <?php $__currentLoopData = $value4;
                                                                            $__env->addLoop($__currentLoopData);
                                                                            foreach ($__currentLoopData as $label5 => $value5) : $__env->incrementLoopIndices();
                                                                                $loop = $__env->getLastLoop(); ?>
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group mb-3">
                                                                                        <label><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?>.<?php echo e($label4); ?>.<?php echo e($label5); ?></label>
                                                                                        <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>][<?php echo e($label4); ?>][<?php echo e($label5); ?>]" value="<?php echo e($value5); ?>">
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach;
                                                                            $__env->popLoop();
                                                                            $loop = $__env->getLastLoop(); ?>
                                                                        <?php else : ?>
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group mb-3">
                                                                                    <label><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?>.<?php echo e($label4); ?></label>
                                                                                    <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>][<?php echo e($label4); ?>]" value="<?php echo e($value4); ?>">
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    <?php endforeach;
                                                                    $__env->popLoop();
                                                                    $loop = $__env->getLastLoop(); ?>
                                                                <?php else : ?>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group mb-3">
                                                                            <label><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?>.<?php echo e($label3); ?></label>
                                                                            <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>][<?php echo e($label3); ?>]" value="<?php echo e($value3); ?>">
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach;
                                                            $__env->popLoop();
                                                            $loop = $__env->getLastLoop(); ?>
                                                        <?php else : ?>
                                                            <div class="col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <label><?php echo e($fileName); ?>.<?php echo e($label); ?>.<?php echo e($label2); ?></label>
                                                                    <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>][<?php echo e($label2); ?>]" value="<?php echo e($value2); ?>">
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach;
                                                    $__env->popLoop();
                                                    $loop = $__env->getLastLoop(); ?>
                                                <?php else : ?>
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-3">
                                                            <label><?php echo e($fileName); ?>.<?php echo e($label); ?></label>
                                                            <input type="text" class="form-control" name="message[<?php echo e($fileName); ?>][<?php echo e($label); ?>]" value="<?php echo e($value); ?>">
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach;
                                            $__env->popLoop();
                                            $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endforeach;
                                    $__env->popLoop();
                                    $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit"><?php echo e(__('Save')); ?></button>
                        </form>
                    </div>
                </div> <!-- end card-->
            </div>
        </div>

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
</section>
<!-- container -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MIJOB\MIJOB\resources\views/lang/index.blade.php ENDPATH**/ ?>