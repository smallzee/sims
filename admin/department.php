<?php
  require_once '../core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  if(isset($_POST['ok-add'])){
    //check if dept exist
    //
    $name = $_POST['name'];
    $faculty = $_POST['faculty'];
    $check = $db->query("SELECT NULL FROM department WHERE name = '$name'");
    $c_c = $check->rowCount();

    $check->closeCursor();

    if($c_c == 0){
      //save
      $save = $db->query("INSERT INTO department(name,faculty) VALUES('$name','$faculty')");
      $save->closeCursor();

      set_flash("Department added successfully","success");
      header("location:department.php?act=add");
      exit();
    }else{
      set_flash("Department already exist!","warning");
    }
  }

  if(isset($_POST['ok-delete'])){

    $id = $_POST['id'];
    $department = $_POST['department'];

    if($id == $department){
      set_flash("You cannot move students into deleted department!","warning");
    }else{
      $up = $db->query("UPDATE students SET department = '$department' WHERE department = '$id'");
      $up->closeCursor();

      $del = $db->query("DELETE FROM department WHERE id = '$id'");
      $del->closeCursor();

        $del = $db->query("DELETE FROM course WHERE department = '$id'");
        $del->closeCursor();


        set_flash("Department deleted successfully","info");
      header("location:department.php");
      exit();
    }

    //exit();
  }

  if(isset($_POST['ok-edit'])){
    $id = $_GET['id'];
    $name = $_POST['name'];
    $faculty = $_POST['faculty'];
    $up = $db->query("UPDATE department SET name = '$name',faculty = '$faculty' WHERE id = '$id'");
    $up->closeCursor();
    set_flash("Department updated successfully","info");

    header("location:department.php?act=edit&id=$id");
    exit();
  }

  if(isset($_GET['act'])){
    $act = $_GET['act'];
  }else{
    $act = "";
  }
  switch ($act) {
    case 'add':
      $page_title = "Add Department";
      $inc_file = "inc/add_department.php";
      break;
    case 'edit':
      $page_title = "Edit Department";
      $inc_file = "inc/edit_department.php";
      break;
    default:
      $page_title = "All Departments";
      $inc_file = "inc/all_department.php";
      # code...
      break;
  }

  //$page_title = "Dashboard";
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
          <h3>
            <?php echo $page_title; ?>
          </h3>

          <?php 
              flash();

              include_once "$inc_file";
          ?>
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