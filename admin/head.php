<!DOCTYPE html>
<html>
<head>
	<title><?php echo site_name(); ?> Admin - <?php echo $title; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="IE=Edge"/> 	
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'> -->
	<link rel="stylesheet" type="text/css" href="../lib/font-awesome/font-awesome.min.css">	
	<link rel="stylesheet" type="text/css" href="../lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/style.css">	
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" type="text/css" href="lib/DataTables/datatables.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="css/skins/_all-skins.min.css">
  	<link rel="stylesheet" href="lib/trumbowyg/dist/ui/trumbowyg.min.css">
  	<link rel="stylesheet" type="text/css" href="lib/datepicker/css/bootstrap-datetimepicker.min.css">
  	<link rel="stylesheet" type="text/css" href="css/fonts.css">
  	</head>
  	<?php
  		if(isset($_COOKIE['blac-skin'])){
  			$skin = $_COOKIE['blac-skin'];
  		}else{
  			$skin = 'yellow-light';
  		}
  	?>
	<body class="hold-transition skin-<?php echo $skin;?> sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">