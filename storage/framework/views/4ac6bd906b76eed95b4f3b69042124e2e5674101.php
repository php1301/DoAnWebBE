<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'MIJOB')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/iziToast.min.css')); ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/icons.min.css')); ?>">
    <link href="<?php echo e(asset('assets/css/easy-autocomplete.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <?php echo $__env->yieldPushContent('style'); ?>
</head>

<body>

    <!-- Begin page -->
    <div>

        <div id="app">
            <div class="main-wrapper">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <?php echo $__env->make('partials.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </nav>
                <div class="main-sidebar">
                    <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <!-- Main Content -->
                <div class="main-content">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <footer class="main-footer">
                    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </footer>
            </div>
        </div>
    </div>

    <div id="commanModel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modelCommanModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelCommanModelLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <?php if (Auth::user()->type != 'admin') : ?>
        <div id="modelCreateWorkspace" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modelCreateWorkspaceLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelCreateWorkspaceLabel"><?php echo e(__('Create Your Workspace')); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="pl-3 pr-3" method="post" action="<?php echo e(route('add_workspace')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="workspacename"><?php echo e(__('Name')); ?></label>
                                <input class="form-control" type="text" id="workspacename" name="name" required="" placeholder="<?php echo e(__('Workspace Name')); ?>">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><?php echo e(__('Create Workspace')); ?></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

    <script src="<?php echo e(asset('assets/js/iziToast.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/stisla.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/scripts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/scrollreveal.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>

    <?php if (isset($currantWorkspace) && $currantWorkspace) : ?>
        <script src="<?php echo e(asset('assets/js/jquery.easy-autocomplete.min.js')); ?>"></script>

        <script>
            var options = {
                url: function(phrase) {
                    return "<?php echo e(route('search.json', $currantWorkspace->slug)); ?>/" + phrase;
                },
                categories: [{
                        listLocation: "Projects",
                        header: "<?php echo e(__('Projects')); ?>"
                    },
                    {
                        listLocation: "Tasks",
                        header: "<?php echo e(__('Tasks')); ?>"
                    }
                ],
                getValue: "text",
                template: {
                    type: "links",
                    fields: {
                        link: "link"
                    }
                }
            };
            $(".search-element input").easyAutocomplete(options);
        </script>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php if ($message = Session::get('success')) : ?>
        <script>
            toastr('Success', '<?php echo $message; ?>', 'success')
        </script>
    <?php endif; ?>

    <?php if ($message = Session::get('error')) : ?>
        <script>
            toastr('Error', '<?php echo $message; ?>', 'error')
        </script>
    <?php endif; ?>

    <?php if ($message = Session::get('info')) : ?>
        <script>
            toastr('Info', '<?php echo $message; ?>', 'info')
        </script>
    <?php endif; ?>
</body>

</html>
<?php /**PATH E:\xampp\htdocs\MIJOB\resources\views/layouts/main.blade.php ENDPATH**/ ?>