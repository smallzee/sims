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
    $short_name = $_POST['short_name'];
    $capacity = $_POST['capacity'];
    $status = 1;
    $date_added = time();
    $check = $db->query("SELECT NULL FROM centers WHERE name = '$name' or short_name = '$short_name'");
    $c_c = $check->rowCount();

    $check->closeCursor();

    if($c_c == 0){
      //save
      $save = $db->query("INSERT INTO centers(name,short_name,capacity,status,date_added) VALUES('$name','$short_name','$capacity','$status','$date_added')");
      $save->closeCursor();

      set_flash("Exam Venue added successfully","success");
      header("location:venue.php?act=add");
      exit();
    }else{
      set_flash("Venue already exist!","warning");
    }
  }

  if(isset($_POST['ok-delete'])){

    $id = $_POST['id'];
    //$department = $_POST['department'];
  
    
    $del = $db->query("DELETE FROM centers WHERE id = '$id'");
    $del->closeCursor();

    set_flash("Exam Venue deleted successfully","info");
    header("location:venue.php");
    exit();    

    //exit();
  }

  if(isset($_POST['ok-edit'])){
    $id = $_GET['id'];
    $name = $_POST['name'];
    $short_name = $_POST['short_name'];
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];
    $up = $db->query("UPDATE centers SET name = '$name', short_name = '$short_name', capacity = '$capacity', status = '$status' WHERE id = '$id'");
    $up->closeCursor();
    set_flash("Exam venue updated successfully","info");

    header("location:venue.php?act=edit&id=$id");
    exit();
  }

  if(isset($_GET['act'])){
    $act = $_GET['act'];
  }else{
    $act = "";
  }
  switch ($act) {
    case 'add':
      $page_title = "Add Venue";
      $inc_file = "inc/add_venue.php";
      break;
    case 'edit':
      $page_title = "Edit Venue";
      $inc_file = "inc/edit_venue.php";
      break;
    default:
      $page_title = "All Venues";
      $inc_file = "inc/all_venue.php";
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