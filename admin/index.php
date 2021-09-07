<?php
  require_once '../core/db.php';      

  /*$_SESSION['admin'] = 1;
  $_SESSION['admin_role'] = 1;
  $_SESSION['admin_name'] = "Admin";*/

  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  $page_title = "Dashboard";
  $title = $page_title;
  include_once 'head.php';
  include_once 'menu.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $page_title; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $page_title; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $page_title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">Total Students</div>
                        <div class="panel-body">
                           <h1 align="center">
                               <?php
                               $sql = $db->query("SELECT * FROM students");
                               echo $sql->rowCount();
                               ?>
                           </h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">Total Department</div>
                        <div class="panel-body">
                            <h1 align="center">
                                <?php
                                $sql = $db->query("SELECT * FROM department");
                                echo $sql->rowCount();
                                ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          &nbsp;
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  include_once 'foot.php';
?>