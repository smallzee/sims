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

          $code = $Row[0];
          $name = $Row[1];
          $level = $Row[2];
          $unit = $Row[3];

          //save

          $in = $db->prepare("INSERT INTO course_pool(code,`title`,department,`level`,semester, unit) VALUES(:a, :b, :c, :d, :e, :f)");
          $in->execute(array(
              'a' => $code,
              'b' => $name,
              'c' => $_POST['department'],
              'd' => $level,
              'e' => $_POST['semester'],
              'f' => $unit
          ));

          $total++;

          $start++;
      }

      //delete file

      @unlink($destination);

      set_flash("Course imported successfully","success");
      header("location:course.php?act=import");
      exit();
  }

  if(isset($_POST['ok-add'])){
      $in = $db->prepare("INSERT INTO course_pool(code,`title`,department,`level`,semester,unit) VALUES(:a, :b, :c, :d, :e, :f)");
      $in->execute(array(
          'a' => $_POST['code'],
          'b' => $_POST['name'],
          'c' => $_POST['department'],
          'd' => $_POST['level'],
          'e' => $_POST['semester'],
          'f' => $_POST['unit']
      ));

      $in->closeCursor();

      set_flash("Course added successfully","success");
      header("location:course.php?act=add");
      exit();

  }

  if(isset($_POST['ok-edit'])){

      $in = $db->prepare("UPDATE course_pool SET code = :a, title = :b, department = :c, level = :d, semester = :e, unit = :f WHERE id = :i");
      $in->execute(array(
          'a' => $_POST['code'],
          'b' => $_POST['name'],
          'c' => $_POST['department'],
          'd' => $_POST['level'],
          'e' => $_POST['semester'],
          'f' => $_POST['unit'],
          'i' => $_GET['id']
      ));

      set_flash("Course updated successfully","success");
      header("location:course.php?act=edit&id=".$_GET['id']);
      exit();
  }

  if(isset($_POST['ok-delete'])){
      //delete

      $ids = $_POST['id'];

      foreach ($ids as $id) {
          $d = $db->query("DELETE FROM course_pool WHERE id = '$id'");
          $d->closeCursor();

          $d2 = $db->query("DELETE FROM course_reg WHERE course = '$id'");
          $d2->closeCursor();
      }

      set_flash(count($_POST['id'])." courses deleted successfully","success");
      header("location:course.php");
      exit();
  }

if(isset($_GET['act'])){
    $act = $_GET['act'];
}else{
    $act = "";
}
switch ($act) {
    case 'add':
        $page_title = "Add Course";
        $inc_file = "inc/add_course.php";
        break;
    case 'edit':
        $page_title = "Edit Course";
        $inc_file = "inc/edit_course.php";
        break;


    case 'import':
        $page_title = "Import Courses";
        $inc_file = "inc/import_course.php";
        break;

    case 'course_reg':
        $page_title = "Course Registered";
        $inc_file = "inc/course_reg.php";
        break;

    default:
        $page_title = "All Courses";
        $inc_file = "inc/all_courses.php";
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