<?php
  require_once '../core/db.php';
  if(!admin())
  {
    header("location:login.php");
    exit();
  }

  if($_SESSION['admin_role'] == 0){
    header("location:index.php");
    exit();
  }

  if(isset($_POST['ok-add']))
  {
    $c = $db->prepare("SELECT NULL FROM admin WHERE username = :username");
    $c->execute(array('username' => $_POST['username']));
    $n = $c->rowCount();
    $c->closeCursor();

    if($n == 0){//add
      $in = $db->prepare('INSERT INTO admin(username,password,name,role,email) VALUES(:username, :password, :name, :role, :email)');
      $in->execute(
        array(          
          'username' => $_POST['username'],
          'password' => md5($_POST['password']),
          'name' => $_POST['name'],
          'role' => $_POST['role'],
          'email' => $_POST['email']
          )
        );
      $in->closeCursor();
      set_flash("Admin added successfully!","info");
      header("location:admin.php");
      exit();
    }else{//error
      set_flash("Admin already exist!","warning");
    }
  }


  if(isset($_POST['ok-edit']))
  {
    $up = $db->prepare('UPDATE admin SET name =:name, username = :username, role = :role, email = :email WHERE id = :id');
    $up->execute(array(
      'name' => $_POST['name'],
      'username' => $_POST['username'],
      'role' => $_POST['role'],
      'email' => $_POST['email'],
      'id' => $_GET['id']
      ));
    $up->closeCursor();

    set_flash("Admin updated successfully","success");
    header("location:admin.php");
    exit();
  }

  if(isset($_POST['ok-delete']))
  {
    //DELETE USERS
      $d1 = $db->prepare('DELETE FROM admin WHERE id = :id');
      $d1->execute(array('id' => $_POST['ok-delete']));
      $d1->closeCursor();
      set_flash("Admin deleted successfully","info");
      header("location:admin.php");      
    exit();
  }

  $page_title = "Admin";
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
            if (isset($_GET['act'])) {
              switch ($_GET['act']) {
                case 'add':
                  include_once 'inc/add_admin.php';
                  break;

                case 'edit':
                  include_once 'inc/edit_admin.php';
                  break;

                case 'edit_admin':
                  include_once 'inc/edit_admin_info.php';
                  break;

                case 'del':
                  include_once 'inc/delete_admin.php';
                  break;
                
                default:
                  # code...
                  break;
              }
            }else{
              include_once 'inc/all_admin.php';
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