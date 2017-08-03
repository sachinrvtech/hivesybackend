 <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo url('/admin/dashboard');?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>HT</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo config('app.name', 'Laravel');   ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo asset('/default-medium.png');?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo Auth::user()->name;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo asset('/default-medium.png');?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo Auth::user()->name;?>
                      <small>Member since Nov. 2016</small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                                        <a href="<?php echo url('/logout');?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="<?php echo url('/logout');?>" method="POST" style="display: none;">
                                          <?php echo csrf_field(); ?>
                                        </form>
                                 </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo asset('/default-medium.png');?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo Auth::user()->name;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if(Request::path()=='admin/dashboard'){echo 'active';}else{ echo ''; } ?>"><a href="<?php echo url('/').'/admin/dashboard';?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Users</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if(Request::path()=='admin/addedituser'){echo 'active';}else{ echo ''; } ?>"><a href="<?php echo url('/').'/admin/addedituser'; ?>"><i class="fa fa-circle-o"></i>New User</a></li>
                <li class="<?php if(Request::path()=='admin/users/customer'){echo 'active';}else{ echo ''; } ?>"><a href="<?php echo url('/').'/admin/users/customer'; ?>"><i class="fa fa-circle-o"></i>Users</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-briefcase" aria-hidden="true"></i> <span>Businesses</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if(Request::path()=='admin/businesses'){echo 'active';}else{ echo ''; } ?>"><a href="<?php echo url('/').'/admin/businesses'; ?>"><i class="fa fa-circle-o"></i>All Businesses</a></li>
                <li class="<?php if(Request::path()=='admin/deals'){echo 'active';}else{ echo ''; } ?>"><a href="<?php echo url('/').'/admin/deals'; ?>"><i class="fa fa-circle-o"></i>All Deals</a></li>
              </ul>

            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <script type="text/javascript">
      $(document).ready(function(){
         $('.alert-success').on('click',function(){
              $(this).hide('slow');
         });
      });
    </script>