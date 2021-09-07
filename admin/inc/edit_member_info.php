<h3 class="page-header">Edit Member Info</h3>
<?php
	if(!isset($_GET['id'])){
		echo "<div class='alert alert-info'>Invalid Request!</div>";
	}else{
		$sql = $db->prepare('SELECT * FROM users WHERE id = :id');
		$sql->execute(array('id' => $_GET['id']));
		$rs = $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		
		$name = explode(" ", $rs['name']);
		$fname = $name[0];
		$lname = $name[1];

		?>

		<form action="" method="post" role="form">	
			<div class="form-group row">
				<div class="col-sm-6">
					<label>First Name</label>
					<input type="text" name="fname" required="" placeholder="First Name" class="form-control" value="<?php echo $fname; ?>">
				</div>

				<div class="col-sm-6">
					<label>Last Name</label>
					<input type="text" name="lname" required="" placeholder="Last Name" class="form-control" value="<?php echo $lname; ?>">
				</div>
			</div>

			<div class="form-group">
				<label>Phone Number</label>
				<input type="text" name="phone" required="" class="form-control" placeholder="Phone Number" value="<?php echo $rs['phone']; ?>">
			</div>

			<div class="form-group">
				<label>Email Address</label>
				<input type="email" name="email" required="" class="form-control" placeholder="Email Address" value="<?php echo $rs['email']; ?>">
			</div>							

			<div class="form-group row">
				<div class="col-sm-6">
					<label>State</label>
					<select name="state" required="" class="form-control">
						<option><?php echo $rs['state']; ?></option>				
					</select>
				</div>

				<div class="col-sm-6">
					<label>LGA</label>
					<select name="lga" required="" class="form-control" id="lga">
						<option><?php echo $rs['lga']; ?></option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label>Contact Address</label>
				<textarea class="form-control" readonly="" required="" placeholder="Contact Address" name="address"><?php echo $rs['address']; ?></textarea>
			</div>							

			<div class="form-group">
				<input type="submit" name="ok-update" class="btn btn-success" value="Update">								
			</div>							
		</form>

		<?php
	}
?>