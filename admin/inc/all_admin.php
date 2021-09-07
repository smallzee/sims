<h3 class="page-header">All Admin</h3>
<table class="table table-bordered" id="tables">
	<thead>
		<tr>
			<th>Sn</th>
			<th>Username</th>
			<th>Name</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sql = $db->prepare('SELECT id,name,username,role,email FROM admin ORDER BY id DESC');
			$sql->execute();
			$sn = 0;
			while($rs = $sql->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<tr>
					<td><?php echo ++$sn;?></td>
					<td><?php echo $rs['username'];?></td>
					<td><?php echo $rs['name'];?></td>
					<td><?php echo $rs['email'];?></td>
					<td><?php echo admin_role($rs['role']);?></td>
				</tr>
				<?php
			}

			$sql->closeCursor();
		?>
	</tbody>
</table>