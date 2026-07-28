 <!-- leftbar-tab-menu -->
 <div class="startbar d-print-none">
     <!--start brand-->
     <div class="brand">
         <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo">
             <span>
                 <img src="<?php echo e(!empty($siteSettings?->logo) ? asset('storage/' . $siteSettings->logo) : asset('') . 'assets/images/logo_dark.png'); ?>"
                     alt="logo-small" class="logo-sm" style="width:210px; height:110px; object-fit:contain;">
             </span>
             <span class="">
                 <img src="<?php echo e(!empty($siteSettings?->logo) ? asset('storage/' . $siteSettings->logo) : asset('') . 'assets/images/AirTickets_text_navy_orange.png'); ?>"
                     alt="logo-large" class="logo-light" style="width:210px; height:110px; object-fit:contain;">
                 <img src="<?php echo e(!empty($siteSettings?->logo) ? asset('storage/' . $siteSettings->logo) : asset('') . 'assets/images/AirTickets_text_blue.png'); ?>"
                     alt="logo-large" class="logo-dark" style="width:210px; height:110px; object-fit:contain;">
             </span>
         </a>
     </div>
     <div class="startbar-menu">
         <div class="startbar-collapse h-100" id="startbarCollapse" data-simplebar>

             <div class="d-flex flex-column justify-content-between h-100">

                 <!-- Navigation -->
                 <ul class="navbar-nav mb-auto w-100">

                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
                             <i class="iconoir-report-columns menu-icon"></i>
                             <span>Dashboard</span>
                             <span class="badge text-bg-info ms-auto">overview</span>
                         </a>
                     </li><!--end nav-item-->
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo e(route('admin.airports.index')); ?>">
                             <i class="iconoir-city menu-icon"></i>
                             <span>Airports</span>
                         </a>
                     </li><!--end nav-item-->
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo e(route('admin.airlines.index')); ?>">
                             <i class="iconoir-airplane menu-icon"></i>
                             <span>Airlines</span>
                         </a>
                     </li><!--end nav-item-->
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo e(route('admin.routes.index')); ?>">
                             <i class="iconoir-route menu-icon"></i>
                             <span>Routes</span>
                         </a>
                     </li><!--end nav-item-->
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo e(route('admin.flight-schedules.index')); ?>">
                             <i class="iconoir-calendar menu-icon"></i>
                             <span>Flight Schedules</span>
                         </a>
                     </li><!--end nav-item-->
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo e(route('admin.agents.index')); ?>">
                             <i class="iconoir-group menu-icon"></i>
                             <span>Agents</span>
                         </a>
                     </li><!--end nav-item-->
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo e(route('admin.settings.index')); ?>">
                             <i class="iconoir-settings menu-icon"></i>
                             <span>Settings</span>
                         </a>
                     </li><!--end nav-item-->

                 </ul><!--end navbar-nav--->

                 <!-- Bottom Buttons -->
                 <div class="sidebar-bottom p-3">
                     <a href="<?php echo e(url('/')); ?>" target="_blank" class="btn btn-primary w-100 mb-2">
                         <i class="fas fa-globe me-2"></i> Visit Site
                     </a>

                     <form action="<?php echo e(route('logout')); ?>" method="POST">
                         <?php echo csrf_field(); ?>
                         <button type="submit" class="btn btn-danger w-100">
                             <i class="fas fa-sign-out-alt me-2"></i> Logout
                         </button>
                     </form>
                 </div>

             </div>

         </div>
     </div>
 </div>
 <div class="startbar-overlay d-print-none"></div>
<?php /**PATH C:\xampp\htdocs\Air_Ticketing_System\resources\views/admin/sidebar.blade.php ENDPATH**/ ?>