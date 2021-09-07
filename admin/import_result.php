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

      $session = settings("session");
      $semester = settings("semester");
      $course_id = $_POST['course_id'];
      foreach ($Reader as $Row)
      {
          if($start == 0){
              $start++;
              continue;
          }

          $matric = $Row[0];

          $score = $Row[1];
            $s = $db->query("SELECT score FROM result WHERE matric = '$matric' AND course_id = '$course_id' AND session = '$session' AND semester = '$semester'");
            if($s->rowCount() > 0){
                $up = $db->query("UPDATE result SET score = '$score' WHERE matric = '$matric' AND course_id = '$course_id' AND session = '$session' AND semester = '$semester'");
                $up->closeCursor();
                continue;
            }
          //save

          $in = $db->query("INSERT INTO result(matric,course_id,session,semester,score) 
VALUES('$matric','$course_id','$session','$semester','$score')");
          
          $total++;

          $start++;

          $n++;
      }

      //delete file

      @unlink($destination);


      set_flash("$n students result imported successfully","success");
      header("location:import_result.php");
      exit();
  }

  $page_title = "Import Students Result";
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
              <label>Result File</label>
              <input type="file" name="file" accept="xlsx" required>
            </div>


              <div class="form-group">
                  <label for="">Course</label>
                  <select name="course_id" required class="form-control select2_single">
                      <option value="">Select Course</option>
                      <?php
                        $c = $db->query("SELECT id,code,department,level FROM course_pool");
                        while($c_rs = $c->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $c_rs['id']; ?>"><?php echo $c_rs['code'];?> <?php echo dept($c_rs['department']);?> - <?php echo $c_rs['level'];?></option>
                            <?php
                        }
                      ?>
                  </select>
              </div>

            <div class="form-group">
              <input type="submit" name="ok" class="btn btn-info" value="Import!">
            </div>

            <div class="form-group">
              <a href="Result-Sample.xlsx" target="_blank">View Sample</a>
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