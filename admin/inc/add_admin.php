<h3 class="page-header">Add New Admin</h3>
<form action="" method="post" role='form'>
	<div class="form-group">
		<label>Username</label>
		<input type="text" name="username" required="" class="form-control">
	</div>
	
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" required="" class="form-control">
	</div>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" required="" class="form-control">
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" required="" class="form-control">
	</div>

	

	<div class="form-group">
		<label>Role</label>
		<select class="form-control" name="role" required="">
			<option value="0">Moderator</option>
			<option value="1">Admin</option>
		</select>
	</div>

	<div class="form-group">
		<input type="submit" name="ok-add" class="btn btn-sm btn-success" value="Add">
	</div>
</form>