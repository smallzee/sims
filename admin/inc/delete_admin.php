<h3 class="page-header">Edit Admin</h3>
<table class="table table-bordered" id="tables">
	<thead>
		<tr>
			<th>Sn</th>
			<th>Username</th>
			<th>Name</th>
			<th>Role</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sql = $db->prepare('SELECT id,name,username,role FROM admin ORDER BY id DESC');
			$sql->execute();
			$sn = 0;
			while($rs = $sql->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<tr>
					<td><?php echo ++$sn;?></td>
					<td><?php echo $rs['username'];?></td>
					<td><?php echo $rs['name'];?></td>
					<td><?php echo admin_role($rs['role']);?></td>
					<td>
						<form action="" method="post" class='delete-admin'>
							<button type="submit" name='ok-delete' value='<?php echo $rs['id'];?>' class='btn btn-sm btn-danger' title='Delete' data-toggle='tooltip'>
								<i class='glyphicon glyphicon-trash'></i>
							</button>
						</form>
					</td>
				</tr>
				<?php
			}

			$sql->closeCursor();
		?>
	</tbody>
</table>