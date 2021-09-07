<h3 class="page-header">Edit Member</h3>
<div class="responsive-table">
	<table class="table table-bordered" id="tables">
		<thead>
			<tr>
				<th>Sn</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Location</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$user = $db->prepare('SELECT * FROM users ORDER BY id DESC');
			$user->execute();

			$sn = 0;
			while($rs = $user->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<tr>
					<td><?php echo ++$sn;?></td>
					<td><?php echo $rs['name'];?></td>
					<td><?php echo $rs['phone'];?></td>
					<td><?php echo $rs['lga'].", ".$rs['state'];?></td>
					<td>
						<a href='member.php?act=edit_member&id=<?php echo $rs['id'];?>' class='btn btn-sm btn-info' title='Edit' data-toggle='tooltip'><i class='glyphicon glyphicon-pencil'></i></a>
					</td>
				</tr>
				<?php
			}

			$user->closeCursor();
		?>
	</tbody>
	</table>
</div>