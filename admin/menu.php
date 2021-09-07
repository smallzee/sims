<?php
  $admin_name = $_SESSION['admin'];
  $admin_role = admin_role(1);
?>
  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>FPE</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>FPE</b> Ede</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">              
              <span class="hidden-xs"><i class="fa fa-user"></i> Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">                
                <p><?php echo $admin_name ?> - <?php echo $admin_role; ?></p>
              </li>              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="password.php" class="btn btn-default btn-flat">Update Password</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->          
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->
  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">        
        
      </div>      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">        
        <li class="treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a>          
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder text-green"></i>
            <span>Students</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="import_students.php">
                <i class="fa fa-file-o"></i>Import Students
              </a>
            </li>
              <li>
                  <a href="add_student.php">
                      <i class="fa fa-file-o"></i>Add Students</a>
              </li>
            <li>
              <a href="member.php">
                <i class="fa fa-users"></i> All Students
              </a>
            </li>            
                        
          </ul>          
        </li>

        


        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder text-aqua"></i>
            <span>Department</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="department.php?act=add">
                <i class="fa fa-plus"></i> Add New Department
              </a>
            </li>
            <li>
              <a href="department.php">
                <i class="fa fa-folder-o"></i>View/Edit/Delete Departments
              </a>
            </li>                        
          </ul>          
        </li>


       

          <li class="treeview">
              <a href="#">
                  <i class="fa fa-book text-green"></i>
                  <span>Courses</span>
                  <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li>
                      <a href="course.php?act=add">
                          <i class="fa fa-plus"></i> Add New Course
                      </a>
                  </li>

                  <li>
                      <a href="course.php?act=import">
                          <i class="fa fa-file"></i> Import Courses
                      </a>
                  </li>

                  <li>
                      <a href="course.php">
                          <i class="fa fa-folder-o"></i>View/Edit/Delete Courses
                      </a>
                  </li>
              </ul>
          </li>



          <li>
            <a href="import_result.php">
              <i class="fa fa-th"></i> Import Result
            </a>
          </li>


          


          

        <li><a href="password.php"><i class="fa fa-circle text-blue"></i> <span>Update Password</span></a></li>
        
        <li class="treeview">
          <a href="settings.php">
            <i class="fa fa-cog"></i> <span>Settings</span> 
          </a>          
        </li>

        <li><a href="logout.php"><i class="fa fa-sign-out text-red"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>