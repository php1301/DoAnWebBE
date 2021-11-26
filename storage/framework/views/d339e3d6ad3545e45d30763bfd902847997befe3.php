<?php $__env->startSection('content'); ?>

    <section class="section">

        <?php if($currantWorkspace): ?>

            <div class="row mb-2">
                <div class="col-sm-4">
                    <h2 class="section-title"><?php echo e(__('Notes')); ?></h2>
                </div>
                <div class="col-sm-8">
                    <div class="text-sm-right">
                        <button type="button" class="btn btn-primary btn-rounded mt-4" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create New Note')); ?>" data-url="<?php echo e(route('notes.create',$currantWorkspace->slug)); ?>">
                            <i class="mdi mdi-plus"></i> <?php echo e(__('Create Note')); ?>

                        </button>
                    </div>
                </div>
            </div>

            <?php if(count($notes)): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <div class="card mb-0 mt-3 text-white <?php echo e($note->color); ?>">
                                        <div class="card-body">
                                            <div class="card-widgets float-right">
                                                <a href="#" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Note')); ?>" data-url="<?php echo e(route('notes.edit',[$currantWorkspace->slug,$note->id])); ?>"><i class="mdi mdi-pencil"></i></a>
                                                <a href="#" onclick="(confirm('Are you sure ?')?document.getElementById('delete-form-<?php echo e($note->id); ?>').submit(): '');"><i class="mdi mdi-trash-can    "></i></a>
                                                <form id="delete-form-<?php echo e($note->id); ?>" action="<?php echo e(route('notes.destroy',[$currantWorkspace->slug,$note->id])); ?>" method="POST" style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            </div>
                                            <h5 class="card-title mb-0"><?php echo e($note->title); ?></h5>
                                            <div id="cardCollpase2" class="collapse pt-3 show">
                                                <?php echo e($note->text); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\BUIQUOCHUY\Desktop\DOANWEB\DoAnWebBE\resources\views/notes/index.blade.php ENDPATH**/ ?>