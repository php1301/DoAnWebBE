<div class="form-inline mr-auto">
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg" ><i class="mdi mdi-menu" style="font-size: 24px;"></i></a></li>
  </ul>
  <div class="search-element">
    <div class="input-group">
        <input class="form-control" name="query" type="text" placeholder="<?php echo e(__('Search')); ?>" aria-label="Search" data-width="250" autocomplete="off">
        <div class="input-group-append">
            <button class="btn" type="button"><i class="dripicons-search"></i></button>
        </div>
    </div>
  </div>
</div>
<ul class="navbar-nav navbar-right">
  <?php if(isset($currantWorkspace) && $currantWorkspace && $currantWorkspace->permission == 'Owner'): ?>
    <?php
      $currantLang = basename(App::getLocale());
    ?>
  <li class="dropdown dropdown-list-toggle">
    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
      <span class="align-middle"><?php echo e(Str::upper($currantLang)); ?></span>
      <i class="mdi mdi-chevron-down"></i>
    </a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
      <?php $__currentLoopData = $currantWorkspace->languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($currantLang != $lang): ?>
        <!-- item-->
          <a href="<?php echo e(route('change_lang_workspace',[$currantWorkspace->id,$lang])); ?>" class="dropdown-item">
            <span class="align-middle"><?php echo e(Str::upper($lang)); ?></span>
          </a>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
    </div>
  </li>
  <?php endif; ?>
  <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img <?php if(Auth::user()->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.Auth::user()->avatar)); ?>" <?php else: ?> avatar="<?php echo e(Auth::user()->name); ?>" <?php endif; ?> alt="user-image" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">Hi, <?php echo e(Auth::user()->name); ?></div></a>
    <div class="dropdown-menu dropdown-menu-right">
      <?php $__currentLoopData = Auth::user()->workspace; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workspace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <a href="<?php if($currantWorkspace->id == $workspace->id): ?>#<?php else: ?><?php echo e(route('change_workspace',$workspace->id)); ?><?php endif; ?>" title="<?php echo e($workspace->name); ?>" class="dropdown-item notify-item">
            <?php if($currantWorkspace->id == $workspace->id): ?>
              <i class="mdi mdi-check"></i>
            <?php endif; ?>
            <span><?php echo e($workspace->name); ?></span>
            <?php if(isset($workspace->pivot->permission)): ?>
              <?php if($workspace->pivot->permission =='Owner'): ?>
                <span class="badge badge-primary"><?php echo e($workspace->pivot->permission); ?></span>
              <?php else: ?>
                <span class="badge badge-secondary"><?php echo e(__('Shared')); ?></span>
              <?php endif; ?>
            <?php endif; ?>
          </a>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php if(isset($currantWorkspace) && $currantWorkspace): ?>
        <div class="dropdown-divider"></div>
      <?php endif; ?>

        <a href="#" class="dropdown-item notify-item" data-toggle="modal" data-target="#modelCreateWorkspace">
          <i class="mdi mdi-plus"></i>
          <span><?php echo e(__('Create New Workspace')); ?></span>
        </a>
      <?php if(isset($currantWorkspace) && $currantWorkspace): ?>
        <?php if(Auth::user()->id == $currantWorkspace->created_by): ?>
          <a href="#" class="dropdown-item notify-item" onclick="(confirm('Are you sure ?')?document.getElementById('remove-workspace-form').submit(): '');">
            <i class=" mdi mdi-delete-outline"></i>
            <span><?php echo e(__('Remove Me From This Workspace')); ?></span>
          </a>
          <form id="remove-workspace-form" action="<?php echo e(route('delete_workspace', ['id' => $currantWorkspace->id])); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
          </form>
        <?php else: ?>
          <a href="#" class="dropdown-item notify-item" onclick="(confirm('Are you sure ?')?document.getElementById('remove-workspace-form').submit(): '');">
            <i class=" mdi mdi-delete-outline"></i>
            <span><?php echo e(__('Leave Me From This Workspace')); ?></span>
          </a>
          <form id="remove-workspace-form" action="<?php echo e(route('leave_workspace', ['id' => $currantWorkspace->id])); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
          </form>
        <?php endif; ?>
      <?php endif; ?>

        <div class="dropdown-divider"></div>

      <a href="<?php echo e(route('users.my.account')); ?>" class="dropdown-item has-icon">
        <i class="mdi mdi-account-circle mr-1"></i> <?php echo e(__('My Account')); ?>

      </a>
      <div class="dropdown-divider"></div>
      <a href="<?php echo e(route('logout')); ?>" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="mdi mdi-logout mr-1"></i> <?php echo e(__('Logout')); ?>

      </a>
      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
      </form>
    </div>
  </li>
</ul>
<?php /**PATH D:\PersonalPJ\Projects\DoAnWebBE\BE\resources\views/partials/topnav.blade.php ENDPATH**/ ?>