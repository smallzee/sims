<h3 class="page-header">All Students</h3>
<div class="table-responsive">
	<table class="table table-bordered" id="tables">
		<thead>
			<tr>
				<th>Sn</th>
				<th>Matric No</th>
				<th>Name</th>
                <th>Dept</th>
                <th>Level</th>
                <th>Phone</th>
				<th>Email</th>
				<th>Gender</th>
				<th class="hide">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$user = $db->prepare('SELECT * FROM students ORDER BY id DESC');
			$user->execute();

			$sn = 0;
			while($rs = $user->fetch(PDO::FETCH_ASSOC))
			{
				?>
				<tr>
					<td><?php echo ++$sn;?></td>
					<td><?php echo $rs['matric']; ?></td>
					<td><?php echo $rs['name'];?></td>
                    <td><?php echo $rs['department'];?></td>
                    <td><?php echo $rs['level'];?></td>
                    <td><?php echo $rs['phone'];?></td>
					<td><?php echo $rs['email'];?></td>
					<td><?php echo $rs['gender'];?></td>

					<td class="hide">
						<a href='?act=view&id=<?php echo $rs['id'];?>' class='btn btn-sm btn-primary' title='View'><i class='fa fa-search'></i></a>
					</td>
				</tr>
				<?php
			}

			$user->closeCursor();
		?>
	</tbody>
	</table>
</div>