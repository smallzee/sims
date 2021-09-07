<h3 class="page-header">Edit Admin</h3>
<?php
	if(!isset($_GET['id'])){
		echo "<div class='alert alert-info'>Invalid Request!</div>";
	}else{
		$sql = $db->prepare('SELECT * FROM admin WHERE id = :id');
		$sql->execute(array('id' => $_GET['id']));
		$rs = $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();

		?>
			<form action="" method="post" role='form'>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" required="" class="form-control" value="<?php echo $rs['username']; ?>">
				</div>

				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" required="" class="form-control" value="<?php echo $rs['name']; ?>">
				</div>

				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" required="" class="form-control" value="<?php echo $rs['email']; ?>">
				</div>	

				<div class="form-group">
					<label>Role</label>
					<select class="form-control" name="role" required="">
						<option value="0" <?php if($rs['role'] == 0){echo 'selected';} ?>>Moderator</option>
						<option value="1" <?php if($rs['role'] == 1){echo 'selected';} ?>>Admin</option>
					</select>
				</div>

				<div class="form-group">
					<input type="submit" name="ok-edit" class="btn btn-sm btn-success" value="Update">
				</div>
			</form>

		<?php
	}
?>