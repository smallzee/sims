<form action="" method="post" role='form'>
	<div class="form-group">
		<label>Department Name</label>
		<input type="text" name="name" placeholder="Department Name" required="" class="form-control" value="<?php echo @$_POST['name']; ?>">
	</div>


	<div class="form-group">
		<label>School</label>
		<input type="text" name="faculty" class="form-control" placeholder="School" required="" value="<?php echo @$_POST['faculty']; ?>">
	</div>
	

	<div class="form-group">
		<input type="submit" name="ok-add" class="btn btn-sm btn-success" value="Add">
	</div>
</form>