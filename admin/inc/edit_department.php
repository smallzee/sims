<?php
	$id = $_GET['id'];
	$sql = $db->query("SELECT * FROM department WHERE id = '$id'");
	$rs = $sql->fetch(PDO::FETCH_ASSOC);	
	$sql->closeCursor();
?>
<form action="" method="post" role='form'>
	<div class="form-group">
		<label>Department Name</label>
		<input type="text" name="name" placeholder="Department Name" required="" class="form-control" value="<?php echo $rs['name']; ?>">
	</div>
	

	<div class="form-group">
		<input type="submit" name="ok-edit" class="btn btn-sm btn-success" value="Update">
	</div>
</form>