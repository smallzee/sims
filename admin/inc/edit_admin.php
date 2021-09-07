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
						<a href='admin.php?act=edit_admin&id=<?php echo $rs['id'];?>' class='btn btn-sm btn-info' title='Edit' data-toggle='tooltip'><i class='glyphicon glyphicon-pencil'></i></a>
					</td>
				</tr>
				<?php
			}

			$sql->closeCursor();
		?>
	</tbody>
</table>