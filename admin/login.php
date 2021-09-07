<?php
	require_once '../core/db.php';

	if(isset($_SESSION['admin']))
	{
		header("location:index.php");
		exit();
	}
	if(isset($_POST['ok'])){

		$sql = $db->prepare("SELECT id,name,role FROM admin WHERE username = :username and password= :password");
		$sql->execute(
			array(
				'username' => $_POST['username'],
				'password' => md5($_POST['password'])
				)
			);
		$n = $sql->rowCount();
		//var_dump(md5($_POST['password']."@#$"));
		//exit();

		if($n == 0){
			set_flash("Invalid login details","danger");
			$sql->closeCursor();
		}else{
			$rs = $sql->fetch(PDO::FETCH_ASSOC);
			$id = $rs['id'];
			$_SESSION['admin'] = $id;
			$_SESSION['admin_name'] = $rs['name'];
			$_SESSION['admin_role'] = admin_role($rs['role']);			
			$sql->closeCursor();
			header("location:index.php");
			exit();
		}		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=Edge"/> 	
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="../lib/font-awesome/font-awesome.min.css">	
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="css/skins/_all-skins.min.css">
  	
  	</head>
	<body>
		<!-- Site wrapper -->
		<div class="container" style='margin-top: 75px;'>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
				<div class="main-bg panel panel-warning">
					<div class="panel-heading">
						<i class="fa fa-lock fa-stack"></i> Admin Login
					</div>
					<div class="panel-body">
						<form action="" method="post" role='form' class="has-success">
							<h3 class="page-header">FPE Admin Login</h3>
							<?php flash(); ?>
							<div class="form-group">
								<label>Username</label>
								<div class="input-group">
									<input type="text" name="username" required="" class="form-control" placeholder="Username" value="<?php echo @$_POST['username']; ?>">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
								</div>
							</div>

							<div class="form-group">
								<label>Password</label>
								<div class="input-group">
									<input type="password" name="password" required="" class="form-control" placeholder="Password">
									<span class="input-group-addon"><i class="fa fa-key"></i></span>
								</div>
							</div>							

							<div class="form-group">
								<input type="submit" name="ok" class="btn btn-success" value="Login">
							</div>
						</form>				
					</div>
					<div class="panel-footer">&nbsp;</div>
				</div>
			</div>
			</div>
		</div>


		<script type="text/javascript" src="../lib/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="..//lib/bootstrap/js/bootstrap.min.js"></script>
	</body>	
</html>