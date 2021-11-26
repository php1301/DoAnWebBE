<?php $__env->startSection('content'); ?>

<section class="section">
    <?php if ($currantWorkspace) : ?>
        <h2 class="section-title"><?php echo e(__('Projects')); ?></h2>

        <div class="row">
            <div class="col-12">
                <div class="card widget-inline">
                    <div class="card-body p-0">
                        <div class="row no-gutters">
                            <div class="col-sm-6 col-xl-3 animated">
                                <div class="card shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                        <h3><span><?php echo e($totalProject); ?></span></h3>
                                        <p class="text-muted font-15 mb-0"><?php echo e(__('Total Projects')); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3 animated">
                                <div class="card shadow-none m-0 border-left">
                                    <div class="card-body text-center">
                                        <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                        <h3><span><?php echo e($totalTask); ?></span></h3>
                                        <p class="text-muted font-15 mb-0"><?php echo e(__('Total Tasks')); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3 animated">
                                <div class="card shadow-none m-0 border-left">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                        <h3><span><?php echo e($totalMembers); ?></span></h3>
                                        <p class="text-muted font-15 mb-0"><?php echo e(__('Members')); ?></p>
                                    </div>
                                </div>
                            </div>


                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-12">
                <div class="card animated">
                    <div class="card-header">
                        <h4><?php echo e(__('Tasks Overview')); ?></h4>
                    </div>
                    <div class="card-body">

                        <div class="mt-3 chartjs-chart" style="height: 320px;">
                            <canvas id="task-area-chart"></canvas>
                        </div>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->


        <div class="row">
            <div class="col-xl-4">
                <div class="card animated">
                    <div class="card-header">
                        <h4><?php echo e(__('Project Status')); ?></h4>
                    </div>
                    <div class="card-body">

                        <div class="my-4 chartjs-chart" style="height: 202px;">
                            <canvas id="project-status-chart"></canvas>
                        </div>

                        <div class="row text-center mt-2 py-2">

                            <?php $__currentLoopData = $arrProcessPer;
                            $__env->addLoop($__currentLoopData);
                            foreach ($__currentLoopData as $index => $value) : $__env->incrementLoopIndices();
                                $loop = $__env->getLastLoop(); ?>

                                <div class="col-4">
                                    <i class="mdi mdi-trending-up <?php echo e($arrProcessClass[$index]); ?> mt-3 h3"></i>
                                    <h3 class="font-weight-normal">
                                        <span><?php echo e($value); ?>%</span>
                                    </h3>
                                    <p class="text-muted mb-0"><?php echo e($arrProcessLable[$index]); ?></p>
                                </div>

                            <?php endforeach;
                            $__env->popLoop();
                            $loop = $__env->getLastLoop(); ?>

                        </div>
                        <!-- end row-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->

            <div class="col-xl-8">
                <div class="card animated">
                    <div class="card-header">
                        <h4><?php echo e(__('Tasks')); ?></h4>
                    </div>
                    <div class="card-body">

                        <p><b><?php echo e($completeTask); ?></b> <?php echo e(__('Tasks completed out of')); ?> <?php echo e($totalTask); ?></p>

                        <div class="table-responsive">
                            <table class="table table-centered table-hover mb-0 animated">
                                <tbody>
                                    <?php $__currentLoopData = $tasks;
                                    $__env->addLoop($__currentLoopData);
                                    foreach ($__currentLoopData as $task) : $__env->incrementLoopIndices();
                                        $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="font-14 my-1"><a href="<?php echo e(route('projects.task.board', [$currantWorkspace->slug, $task->project_id])); ?>" class="text-body"><?php echo e($task->title); ?></a></div>
                                                <span class="text-muted font-13"><?php echo e(__('Due in')); ?> <?php echo e(\App\Utility::get_timeago(strtotime($task->due_date))); ?></span>
                                            </td>
                                            <td>
                                                <span class="text-muted font-13"><?php echo e(__('Status')); ?></span> <br />
                                                <?php if ($task->status == 'todo') : ?>
                                                    <span class="badge badge-primary"><?php echo e(ucfirst($task->status)); ?></span>
                                                <?php elseif ($task->status == 'in progress') : ?>
                                                    <span class="badge badge-warning"><?php echo e(ucfirst($task->status)); ?></span>
                                                <?php elseif ($task->status == 'review') : ?>
                                                    <span class="badge badge-danger"><?php echo e(ucfirst($task->status)); ?></span>
                                                <?php elseif ($task->status == 'done') : ?>
                                                    <span class="badge badge-success"><?php echo e(ucfirst($task->status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-muted font-13"><?php echo e(__('Project')); ?></span>
                                                <div class="font-14 mt-1 font-weight-normal"><?php echo e($task->project->name); ?></div>
                                            </td>
                                            <?php if ($currantWorkspace->permission == 'Owner') : ?>
                                                <td>
                                                    <span class="text-muted font-13"><?php echo e(__('Assigned to')); ?></span>
                                                    <div class="font-14 mt-1 font-weight-normal"><?php echo e($task->user->name); ?></div>
                                                </td>
                                            <?php endif; ?>

                                        </tr>
                                    <?php endforeach;
                                    $__env->popLoop();
                                    $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>
<?php if ($currantWorkspace) : ?>
    <?php $__env->startPush('scripts'); ?>
    <!-- third party js -->
    <script src="<?php echo e(asset('assets/js/vendor/Chart.bundle.min.js')); ?>"></script>
    <!-- third party js ends -->
    <!-- demo app -->
    <script>
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        (function(global) {
            var MONTHS = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            var COLORS = [
                '#4dc9f6',
                '#f67019',
                '#f53794',
                '#537bc4',
                '#acc236',
                '#166a8f',
                '#00a950',
                '#58595b',
                '#8549ba'
            ];

            var Samples = global.Samples || (global.Samples = {});
            var Color = global.Color;

            Samples.utils = {
                // Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
                srand: function(seed) {
                    this._seed = seed;
                },

                rand: function(min, max) {
                    var seed = this._seed;
                    min = min === undefined ? 0 : min;
                    max = max === undefined ? 1 : max;
                    this._seed = (seed * 9301 + 49297) % 233280;
                    return min + (this._seed / 233280) * (max - min);
                },

                numbers: function(config) {
                    var cfg = config || {};
                    var min = cfg.min || 0;
                    var max = cfg.max || 1;
                    var from = cfg.from || [];
                    var count = cfg.count || 8;
                    var decimals = cfg.decimals || 8;
                    var continuity = cfg.continuity || 1;
                    var dfactor = Math.pow(10, decimals) || 0;
                    var data = [];
                    var i, value;

                    for (i = 0; i < count; ++i) {
                        value = (from[i] || 0) + this.rand(min, max);
                        if (this.rand() <= continuity) {
                            data.push(Math.round(dfactor * value) / dfactor);
                        } else {
                            data.push(null);
                        }
                    }

                    return data;
                },

                labels: function(config) {
                    var cfg = config || {};
                    var min = cfg.min || 0;
                    var max = cfg.max || 100;
                    var count = cfg.count || 8;
                    var step = (max - min) / count;
                    var decimals = cfg.decimals || 8;
                    var dfactor = Math.pow(10, decimals) || 0;
                    var prefix = cfg.prefix || '';
                    var values = [];
                    var i;

                    for (i = min; i < max; i += step) {
                        values.push(prefix + Math.round(dfactor * i) / dfactor);
                    }

                    return values;
                },

                months: function(config) {
                    var cfg = config || {};
                    var count = cfg.count || 12;
                    var section = cfg.section;
                    var values = [];
                    var i, value;

                    for (i = 0; i < count; ++i) {
                        value = MONTHS[Math.ceil(i) % 12];
                        values.push(value.substring(0, section));
                    }

                    return values;
                },

                color: function(index) {
                    return COLORS[index % COLORS.length];
                },

                transparentize: function(color, opacity) {
                    var alpha = opacity === undefined ? 0.5 : 1 - opacity;
                    return Color(color).alpha(alpha).rgbString();
                }
            };

            // DEPRECATED
            window.randomScalingFactor = function() {
                return Math.round(Samples.utils.rand(-100, 100));
            };

            // INITIALIZATION

            Samples.utils.srand(Date.now());


        }(this));


        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var config = {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chartData['label']); ?>,
                datasets: [{
                        label: "<?php echo e(__('Todo')); ?>",
                        fill: !0,
                        backgroundColor: "transparent",
                        borderColor: "#fa5c7c",
                        data: <?php echo json_encode($chartData['todo']); ?>

                    },
                    {
                        label: "<?php echo e(__('In Progress')); ?>",
                        fill: !0,
                        backgroundColor: "transparent",
                        borderColor: "#727cf5",
                        data: <?php echo json_encode($chartData['progress']); ?>

                    },
                    {
                        label: "<?php echo e(__('Review')); ?>",
                        fill: !0,
                        backgroundColor: "transparent",
                        borderColor: "#0acf97",
                        borderDash: [5, 5],
                        data: <?php echo json_encode($chartData['review']); ?>

                    },
                    {
                        label: "<?php echo e(__('Done')); ?>",
                        backgroundColor: "rgba(10, 207, 151, 0.3)",
                        borderColor: "#0acf97",
                        data: <?php echo json_encode($chartData['done']); ?>

                    },
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        reverse: !0,
                        gridLines: {
                            color: "rgba(0,0,0,0.05)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 10,
                            display: !1
                        },
                        min: 10,
                        max: 100,
                        display: !0,
                        borderDash: [5, 5],
                        gridLines: {
                            color: "rgba(0,0,0,0)",
                            fontColor: "#fff"
                        }
                    }]
                },
                responsive: true,
                title: {
                    display: false,
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                legend: {
                    display: false
                }
            }
        };


        var config1 = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: <?php echo json_encode($arrProcessPer); ?>,
                    backgroundColor: ["#0acf97", "#727cf5", "#fa5c7c"],
                    borderColor: "transparent",
                    borderWidth: "3"
                }],
                labels: <?php echo json_encode($arrProcessLable); ?>

            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                },
                title: {
                    display: false,
                    text: 'Chart.js Doughnut Chart'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };


        window.onload = function() {
            var ctx = document.getElementById('task-area-chart').getContext('2d');
            window.myLine = new Chart(ctx, config);
            var ctx1 = document.getElementById('project-status-chart').getContext('2d');
            window.myDoughnut = new Chart(ctx1, config1);
        };
    </script>
    <!-- end demo js-->
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MIJOB\MIJOB\resources\views/home.blade.php ENDPATH**/ ?>