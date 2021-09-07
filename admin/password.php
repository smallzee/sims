<?php
  require_once '../core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  if(isset($_POST['ok']))
  {
    //var_dump($_POST);
    //exit();
    $sql = $db->prepare('UPDATE admin SET password = :password WHERE id = :admin');
    $sql->execute(array(
      'password' => md5($_POST['password']),
      'admin' => $_SESSION['admin']
      ));      
    $sql->closeCursor();
    set_flash("Password updated successfully","success");
    header('location:password.php');
    exit();
  }

  $page_title = "Update Password";
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
          <?php flash(); ?>
          <form action="" method="post" role='form'>
            <div class="form-group">
              <label>New Password</label>            
              <div class="input-group">
                <input type="password" name="password" required="" id="password" class="form-control">
                <span class="input-group-addon">
                <label><input type="checkbox" id="show_pass_btn" name="">Show Password</label>
                </span>
              </div>
            </div>


          <div class="form-group">
            <input type="submit" name="ok" class="btn btn-sm btn-success" value="Update">
          </div>
          </form>
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