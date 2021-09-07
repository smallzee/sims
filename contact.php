<!DOCTYPE html>
<html>
<head>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="css/ken-burns.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/animate.min.css" type="text/css" media="all" />
	<!--css-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Computer Engineering- Fpe" />
	<title>Contact us - Nacomes FPE</title>
	<!--js-->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!--js-->
	<!--webfonts-->
	<link href='//fonts.googleapis.com/css?family=Cagliostro' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/custom.css">

</head>
<body>
	<?php
		$pn = 6;
		include_once 'nav.php';
	?>

	<div class="banner-w3agile">
		<div class="container">
			<h3><a href="index.php">Home</a> / <span>Contact</span></h3>
		</div>
	</div>


	<div class="content">
			<!--contact-->
			<div class="contact-w3l">
				<div class="container">
					
					<div class="col-md-4 contact-left">
						<div class="contct-info">
							<h4> Contact Information</h4>
							<p>Federal Polytechnic, Ede, Osun State</p>
							<ul>								

								<li><a href="#">info@federalpolyede.edu.ng</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-8 contact-left cont">
						<div class="contct-info">
							<h4>Contact Form</h4>
							<form action="#" method="post" id="ef">
								<div class="row">
									<div class="col-md-6 row-grid">
									<input type="text" name="name" id="name" placeholder="Your Name" required>
									</div>
										<div class="col-md-6 row-grid">
											<input type="text" name="email" id="email" placeholder="Email address" required>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="row">
									<div class="col-md-6 row-grid">
									<input type="text" name="subject" placeholder="Subject" required id="subject">
									</div>
										<div class="col-md-6 row-grid">
									<input type="text" name="phone" placeholder="Phone number" required id="phone">
									</div>
									<div class="clearfix"></div>
								</div>
								<textarea placeholder="Message" required="" name="msg" id="msg"></textarea>
								<input type="submit" value="Submit" >
								<input type="reset" value="Clear" >
								<br>
								<div id="notify"></div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!--contact-->
		</div>
	<?php include_once 'footer.php'; ?>


	<script type="text/javascript">
	$(document).ready(function() {
		$("#ef").submit(function(event) {
			event.preventDefault();
		/* Act on the event */
		$("#notify").html('<div class="alert alert-info">Please Wait</div>');
		//get variables
		var name = $("#name").val();
		var subject = $("#subject").val();
		var email = $("#email").val();
		var msg = $("#msg").val();
		var phone = $("#phone").val();

		if(name == ""){
			$("#notify").html('<div class="alert alert-warning">Please enter your name!</div>');
			return false;
		}

		if(email == ""){
			$("#notify").html('<div class="alert alert-warning">Please enter your email address!</div>');
			return false;
		}
		if(msg == ""){
			$("#notify").html('<div class="alert alert-warning">Please enter your message!</div>');
			return false;
		}

		$.ajax({
			url: 'message.php',
			type: 'POST',			
			data: {
				name: name,
				email: email,
				phone: phone,
				subject: subject,
				msg: msg
			},
			success:function(data){
				$("#notify").html(data);
			},
			error:function(err){
                $("#notify").html("Message sent successfully!");
			}
		});
		
		
	});
	});
</script>
</body>
</html>