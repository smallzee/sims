<?php
	require_once '../core/db.php';	
	if(login())
	{
		header("location:index.php");
		exit();
	}
	if(isset($_POST['ok']))
	{
        $sql = $db->prepare("SELECT matric,password FROM students WHERE matric = :matric and email= :email");
        $sql->execute(
            array(
                'matric' => $_POST['matric'],
                'email' => $_POST['email']
            )
        );
        $n = $sql->rowCount();

        if($n == 0){
            set_flash("Invalid details","danger");
            $sql->closeCursor();
        }else{
            $rs = $sql->fetch(PDO::FETCH_ASSOC);
            /*$id = $rs['matric'];
            $_SESSION['matric'] = $id;
            //$_SESSION['last_time'] = time();*/
            $sql->closeCursor();

            set_flash("Your password is ".$rs['password'].", you can now login to your portal","info");
            header("location:login.php");
            exit();
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
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">
	<title>Reset Password</title>
</head>
<body>

<?php

		//inlude login script

?>

<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">
            <img src="../img/logo.png" class="logo img-responsive" width="250px">
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">        
        
        <ul class="nav navbar-nav navbar-rights">
            <li><a href="../index.php">Home</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../contact.php">Contact Us</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 150px;">
                <div class="panel panel-info">
                    <div class="panel-heading">Reset Account Password</div>
                    <div class="panel-body">
                        <p>
                            Enter your details below
                        </p>
                        <form action="" method="post" role="form">
                            <?php flash();?>
                            <div class="form-group">
                                <label for="">Matric No</label>
                                <input type="text" name="matric" required placeholder="Matric No" class="form-control input-lg">
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" required placeholder="Email Address" class="form-control input-lg">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-lg" value="Reset" name="ok">
                            </div>

                        </form>


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