<?php
  require_once '../core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  if(isset($_POST['ok'])){
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
      $n = 0;
      $date = time();

      foreach ($Reader as $Row)
      {
          if($start == 0){
              $start++;
              continue;
          }

          $matric = $Row[0];
          $password = $matric;
          $name = $Row[1];
          $faculty = $Row[2];          
          $department = $Row[3];
          $level = $Row[4];
          $matric_year = $Row[5];
          $admission = $Row[6];
          $gender = $Row[7];

          $c = $db->query("SELECT NULL FROM students WHERE matric = '$matric'");
            if($c->rowCount() >= 1){
              continue;
            }
          

          //save

          $in = $db->query("INSERT INTO students(matric,password,name,gender,matric_year,faculty,department,level,admission,email,date_reg) VALUES('$matric','$password','$name','$gender','$matric_year','$faculty','$department','$level','$admission','','$date')");
          
          $total++;

          $start++;

          $n++;
      }

      //delete file

      @unlink($destination);


      set_flash("$n students imported successfully","success");
      header("location:import_students.php");
      exit();
  }

  $page_title = "Import Student";
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
          <form action="" method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <label>Student File</label>
              <input type="file" name="file" accept="xlsx">
            </div>

            <div class="form-group">
              <input type="submit" name="ok" class="btn btn-info" value="Import!">
            </div>

            <div class="form-group">
              <a href="Student-Sample.xlsx" target="_blank">View Sample</a>
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