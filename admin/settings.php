<?php
  require_once '../core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

if(isset($_POST['ok']))
{


    $id = $_POST['id'];
    $name = $_POST['name'];


    $c = count($id);

    for($i = 0; $i < $c; $i++){
        $ids = $id[$i];
        $na = $name[$i];
        $up = $db->prepare("UPDATE settings SET value = :value WHERE id = :id");
        $up->execute(array(
            'value' => $na,
            'id' => $ids
        ));
        $up->closeCursor();
    }

    set_flash("Settings updated successfully","info");
    header("location:settings.php");
    exit();
}

  $page_title = "Settings";
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
          <form action="" method="post" role='form'>
            <?php flash(); ?>
              <?php
              $sql = $db->prepare("SELECT * FROM settings ORDER BY id ASC");
              $sql->execute();
              while($rs = $sql->fetch(PDO::FETCH_ASSOC))
              {
                  ?>
                  <div class="form-group">
                      <label>
                          <?php echo $rs['info'];?>
                      </label>
                      <input type="hidden" name="id[]" value="<?php echo $rs['id']; ?>">
                      <input type="text" class="form-control" required="" name="name[]" value="<?php echo $rs['value']; ?>">
                  </div>
                  <?php
              }
              $sql->closeCursor();
              ?>

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