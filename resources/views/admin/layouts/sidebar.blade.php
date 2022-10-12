 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Supremetech <sup>Eshop</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item">
         <a class="nav-link" href="#">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <!-- Heading -->
     <div class="sidebar-heading">
         Interface
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
             aria-controls="collapseTwo">
             <i class="fas fa-fw fa-cog"></i>
             <span>Components</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Custom Components:</h6>
                 <a class="collapse-item" href="buttons.html">Buttons</a>
                 <a class="collapse-item" href="cards.html">Cards</a>
             </div>
         </div>
     </li>
     <li class="nav-item {{ activeAdminMenu('categories') }}">
         <a class="nav-link" href="{{ route('admin.categories.index') }}">
             <i class="fas fa-fw fa-poll-h"></i>
             <span>Categories</span>
         </a>
     </li>
     <li class="nav-item {{ activeAdminMenu('brands') }}">
         <a class="nav-link" href="{{ route('admin.brands.index') }}">
             <i class="fas fa-fw fa-tags"></i>
             <span>Brands</span>
         </a>
     </li>
     <li class="nav-item {{ activeAdminMenu('users') }}">
         <a class="nav-link" href="{{ route('admin.users.index') }}">
             <i class="fas fa-fw fa-users"></i>
             <span>Users</span>
         </a>
     </li>
     <li class="nav-item {{ activeAdminMenu('statistic') }}">
         <a class="nav-link" href="{{ route('admin.statistic.index') }}">
             <i class="fas fa-chart-bar"></i>
             <span>Statistic</span>
         </a>
     </li>
     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->
