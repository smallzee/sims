<?php
require_once '../core/db.php';
if(login())
{
    header("location:index.php");
    exit();
}
if(isset($_POST['ok']))
{
    $name = $_POST['name'];
    $matric = $_POST['matric'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $phone = $_POST['phone'];

    $error = array();

    if((strlen($name) < 5) || (strlen($name) > 75)){
        $error[] = "Invalid name, it must be between 5 and 75 characters!";
    }

    if(is_numeric(substr($matric,0,2))){
        $error[] = "Invalid matric number!";
    }

    $mat_c = $db->query("SELECT NULL FROM students WHERE matric = '$matric'");
    if($mat_c->rowCount() > 0){
        $error[] = "Matric number already exist!";
    }
    $mat_c->closeCursor();

    $mat_c = $db->query("SELECT NULL FROM students WHERE email = '$email'");
    if($mat_c->rowCount() > 0){
        $error[] = "Email address already exist!";
    }
    $mat_c->closeCursor();

    $mat_c = $db->query("SELECT NULL FROM students WHERE phone = '$phone'");
    if($mat_c->rowCount() > 0){
        $error[] = "Phone number already exist!";
    }
    $mat_c->closeCursor();

    if(!is_numeric($phone)){
        $error[] = "Invalid phone number";
    }

    if(count($error) == 0){
        //save
        $now = time();
        $save = $db->query("INSERT INTO students(name,matric,password,gender,department,phone,level,email,date_reg) VALUES('$name','$matric','$password','$gender','$department','$phone','$level','$email','$now')");
        $save->closeCursor();

        set_flash("Welcome $name, your registration was successful, you can login below","success");
        header("location:login.php");
        exit();
    }else{
        //error
        $error_msg = "<p>The following error(s) occur while processing your request!</p>";
        foreach ($error as $err) {
            $error_msg .= "<p style='color: #f00;'>$err</p>";
        }

        set_flash($error_msg,"warning");
    }

}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">
    <title>FPE::SIM - Register</title>
</head>
<body>

<?php

//inlude login script

?>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <div class="panel-body">
                        <h3>Student Registration</h3>
                        <form action="" method="post" role="form">
                            <?php flash();?>
                            <div class="form-group">
                                <label for="">Full name</label>
                                <input type="text" class="form-control" required name="name" placeholder="Full name">
                            </div>
                            <div class="form-group">
                                <label for="">Matric No</label>
                                <input type="text" name="matric" required placeholder="Matric No" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" required placeholder="Password" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Gender</label>
                                <select name="gender" id="" required class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Department</label>
                                <select name="department" id="" class="form-control" required>
                                    <option value="">Select Department</option>
                                    <?php
                                        $sql = $db->query("SELECT * FROM department ORDER BY name");
                                        while($sql_rs = $sql->fetch(PDO::FETCH_ASSOC)){
                                            ?>
                                            <option value="<?php echo $sql_rs['id']; ?>"><?php echo $sql_rs['name'];?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Level</label>
                                <select name="level" id="" required class="form-control">
                                    <option value="">Select</option>
                                    <option value="ND 1 FT">ND 1 FT</option>
                                    <option value="ND 1 DPT">ND 1 DPT</option>
                                    <option value="ND 1 PT">PT YR 1</option>
                                    <option value="ND 2 PT">PT YR 2</option>
                                    <option value="ND 2 FT">ND 2 FT</option>
                                    <option value="ND 2 DPT">ND 2 DPT</option>
                                    <option value="ND 3 PT">PT YR 3</option>
                                    <option value="HND 1 FT">HND 1 FT</option>
                                    <option value="HND 1 DPT">HND 1 DPT</option>
                                    <option value="HND 2 FT">HND 1 FT</option>
                                    <option value="HND 2 DPT">HND 2 DPT</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control" required placeholder="Email Address">
                            </div>

                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control" required placeholder="Phone Number">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Register" name="ok">
                            </div>

                        </form>

                        <p>
                            New student <a href="register.php">Sign up</a>
                        </p>
                    </div>

                    <div class="panel-footer">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</section>




<script type="text/javascript" src="lib/jquery/jquery.min.js"></script>
<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script>
    $(document).ready(function () {
        $("#btn-ref").click(function(event) {
            /* Act on the event */
            var a = Math.random();
            $("#code").attr('src', 'img/img.php?a='+a);
        });
    })
</script>
</body>
</html>