<?php
  require_once '../core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

 
    


  $page_title = "All Students";
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
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $page_title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <div class="box-body">
            <?php flash(); ?>
          <?php
            if(isset($_GET['act'])){
                switch ($_GET['act']) {
                    case 'edit':
                        include_once 'inc/edit_member.php'; //show edit page
                        break;

                    case 'del':
                        include_once 'inc/delete_member.php'; //show delete page
                        break;

                    case 'view':
                        include_once 'inc/view_member.php'; //view member info
                        break;

                    case 'edit_member':
                        include_once 'inc/edit_member_info.php'; //show edit page
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }else{
                include_once 'inc/all_member.php';
            }
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