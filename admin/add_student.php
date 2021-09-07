<?php
require_once '../core/db.php';
if(!admin())
{
    header("location:login.php");
    exit();
}

if (isset($_POST['add'])){

    $error = array();

    // student information
    $matric = $_POST['matric'];
    $password = $matric;
    $email = $_POST['email'];
    $fname = $_POST['name'];
    $gender = $_POST['gender'];
    $matric_year = $_POST['matric_year'];
    $phone_number = $_POST['phone_number'];
    $faculty = $_POST['faculty'];
    $program = $_POST['program'];
    $admission = $_POST['admission'];
    $level = $_POST['level'];
    $address = $_POST['address'];
    $department = $_POST['department'];

    // guardian information
    $gname = $_POST['gname'];
    $gaddress = $_POST['gaddress'];
    $gphone = $_POST['gphone'];

    $date_reg = time();

    // next of kin information
    $kname = $_POST['kname'];
    $kphone = $_POST['kphone'];
    $kaddress = $_POST['kaddress'];

    $sql = $db->query("SELECT * FROM student WHERE matric='$matric'");
    if ($sql->rowCount() >= 1){
        $error[] = "Matric number is already exist";
    }

    if (isset($_FILES['passport'])){
        $file = $_FILES['passport'];
        $passport_name = $file['name'];

        $passport = time().$passport_name;
        $folder = "../students/img/students/";
        $destination = $folder.$passport;
    }

    $error_count = count($error);
    if ($error_count == 0){

        if (move_uploaded_file($file['tmp_name'],$destination)){

            $db->query("INSERT INTO students(matric,password,name,gender,email,date_reg,matric_year,faculty,department,program,admission,level,address,guardian_name,kin_name,kin_address,kin_phone,guardian_phone,status,passport)VALUES ('$matric','$password','$fname','$gender','$email','$date_reg','$matric_year','$faculty','$department','$program','$admission','$level','$address','$gname','$kname','$kaddress','$kphone','$gphone','1','$passport')");
        }

    }else{
        $msg = ($error == 1) ? 'An error(s) occurred' : 'Some error(s) are occurred';
        foreach ($error as $value){
            $msg.='<p>'.$value.'</p>';
        }
        set_flash($msg,'danger');
    }

}

$page_title = "Add Student";
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

                    <form action="" method="post" enctype="multipart/form-data">

                        <h5 class="page-header">Student Information</h5>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Matric Number</label>
                                    <input type="text" class="form-control" name="matric" required placeholder="Matric Number" id="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" class="form-control" required placeholder="Full Name" name="name" id="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="email" class="form-control" required name="email" placeholder="Email Address" id="">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <select name="gender" id="" class="form-control" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Matric Year</label>
                                    <input type="text" placeholder="Matric Year" class="form-control" required name="matric_year" id="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" name="phone_number" required placeholder="Phone Number" id="">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Faculty</label>
                                    <input type="text" class="form-control" required name="faculty" placeholder="Faculty" id="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <select name="department" required id="" class="form-control">
                                        <option value="" disabled selected>Select</option>
                                        <?php
                                            $sql = $db->query("SELECT * FROM department ORDER BY name");
                                            while ($rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                <option><?= ucwords($rs['name']) ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Program</label>
                                    <input type="text" class="form-control" required name="program" placeholder="Program" id="">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Admission</label>
                                    <input type="text" class="form-control" required name="admission" placeholder="Admission" id="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Level</label>
                                    <select name="level" required id="" class="form-control">
                                        <option value="" disabled selected>Select</option>
                                        <?php
                                        foreach (array('nd 1 ft','nd 2 ft','nd 1 dpt','nd 2 dpt','nd rpt yr1','nd rpt yr2','nd rpt yr3','hnd 1 ft','hnd 2 ft','hnd 1 dpt','hnd 2 dpt') as $value){
                                            ?>
                                            <option value="<?= strtoupper($value) ?>"><?= strtoupper($value) ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" class="form-control" required placeholder="Address" id=""></textarea>
                                </div>
                            </div>
                        </div>

                        <h5 class="page-header">Guardian Information</h5>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" placeholder="Name" class="form-control" required name="gname" id="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" placeholder="Phone Number" name="gphone" id="">
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="gaddress" class="form-control" id="" required placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <h5 class="page-header">Next Of Kin Information</h5>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="kname" class="form-control" required placeholder="Next Of Kin Name" id="">
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" placeholder="Phone Number" class="form-control" required name="kphone" id="">
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="kaddress" id="" class="form-control" required placeholder="Address"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Passport</label>
                            <input type="file" name="passport" accept="image/*" id="">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" name="add" value="Submit" id="">
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