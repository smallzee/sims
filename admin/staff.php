<?php
  require_once '../core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }


  if(isset($_POST['ok-import'])){
      $file = $_FILES['file']['name'];
      $folder = "./tmp/";
      $destination = $folder.$file;

      move_uploaded_file($_FILES['file']['tmp_name'],$destination);
      // If you need to parse XLS files, include php-excel-reader
      require('lib/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');

      require('lib/spreadsheet-reader-master/SpreadsheetReader.php');

      $Reader = new SpreadsheetReader("$destination");

      $start = 0;
      $total = 0;

      foreach ($Reader as $Row)
      {
          if($start == 0){
              $start++;
              continue;
          }

          $name = $Row[0];
          $phone = $Row[1];
          $cadre = $Row[2];
          $position = $Row[3];

          //save

          $in = $db->prepare("INSERT INTO staff(`name`,phone,`cadre`,position) VALUES(:a, :b, :c, :d)");
          $in->execute(array(
              'a' => $name,
              'b' => $phone,
              'c' => $cadre,
              'd' => $position
          ));

          $total++;

          $start++;
      }

      //delete file

      @unlink($destination);

      set_flash("Staff imported successfully","success");
      header("location:staff.php?act=import");
      exit();
  }

  if(isset($_POST['ok-add'])){
      $in = $db->prepare("INSERT INTO staff(`name`,phone,`cadre`,position) VALUES(:a, :b, :c, :d)");
      $in->execute(array(
          'a' => $_POST['name'],
          'b' => $_POST['phone'],
          'c' => $_POST['cadre'],
          'd' => $_POST['position']
      ));

      $in->closeCursor();

      set_flash("Staff added successfully","success");
      header("location:staff.php?act=add");
      exit();

  }

  if(isset($_POST['ok-edit'])){

      $in = $db->prepare("UPDATE staff SET name = :a, phone = :b, cadre = :c, position = :d WHERE id = :i");
      $in->execute(array(
          'a' => $_POST['name'],
          'b' => $_POST['phone'],
          'c' => $_POST['cadre'],
          'd' => $_POST['position'],
          'i' => $_GET['id']
      ));

      set_flash("Staff updated successfully","success");
      header("location:staff.php?act=edit&id=".$_GET['id']);
      exit();
  }

  if(isset($_POST['ok-delete'])){
      //delete

      $ids = $_POST['id'];

      foreach ($ids as $id) {
          $d = $db->query("DELETE FROM staff WHERE id = '$id'");
          $d->closeCursor();          
      }

      set_flash(count($_POST['id'])." staff deleted successfully","success");
      header("location:staff.php");
      exit();
  }

if(isset($_GET['act'])){
    $act = $_GET['act'];
}else{
    $act = "";
}
switch ($act) {
    case 'add':
        $page_title = "Add Staff";
        $inc_file = "inc/add_staff.php";
        break;
    case 'edit':
        $page_title = "Edit Staff";
        $inc_file = "inc/edit_staff.php";
        break;


    case 'import':
        $page_title = "Import Staff";
        $inc_file = "inc/import_staff.php";
        break;
    
    default:
        $page_title = "All Staff";
        $inc_file = "inc/all_staff.php";
        # code...
        break;
}


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