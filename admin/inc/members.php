<h3 class="page-header">All Member</h3>
<div class="responsive-table">
	<table class="table table-bordered" id="tables">
		<thead>
			<tr>
				<th>Sn</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Location</th>				
				<th>&nbsp;</th>
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
						<a href='?act=view&id=<?php echo $rs['id'];?>' class='btn btn-sm btn-primary' title='Select'><i class='fa fa-search'></i></a>
					</td>
				</tr>
				<?php
			}

			$user->closeCursor();
		?>
	</tbody>
	</table>
</div>