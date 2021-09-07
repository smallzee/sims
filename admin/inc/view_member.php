<h3 class="page-header">View Member Profile</h3>
<?php
	if(!isset($_GET['id'])){
		echo "<div class='alert alert-info'>Invalid Request!</div>";
	}else{
		$sql = $db->prepare('SELECT * FROM users WHERE id = :id');
		$sql->execute(array('id' => $_GET['id']));
		$rs = $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();

		//var_dump($rs);
		//exit();

		?>

		<table class="table table-bordered">
			<tr>
				<th>Name</th>
				<td><?php echo $rs['name']; ?></td>
			</tr>
			<tr>
				<th>Email Address</th>
				<td><?php echo $rs['email']; ?></td>
			</tr>
			<tr>
				<th>Phone Number</th>
				<td><?php echo $rs['phone']; ?></td>
			</tr>
			<tr>
				<th>Address</th>
				<td><?php echo $rs['address']; ?></td>
			</tr>
			<tr>
				<th>Location</th>
				<td><?php echo $rs['location']; ?></td>
			</tr>
			<tr>
				<th>Account Status</th>
				<td><?php echo m_status($rs['status']); ?></td>
			</tr>

			<?php $sql->closeCursor(); ?>
		</table>


		

		<form action='' method='post'>
			<div class='form-group'>
				<label>Change Account Status</label>
				<select name='status' class='form-control'>
					<option value='1'>Active</option>
					<option value='2'>Suspended</option>
					<option value='0'>Banned</option>
				</select>
			</div>

			<div class='form-group'>
				<input type='submit' name='ok-status' value='Update' class='btn btn-success'>
			</div>
		</form>

		<h3 class='page-header'>Wallet</h3>
		<table class="table table-bordered" id='tables'>
			<thead>
				<tr>
					<th>ID</th>
					<th>Type</th>
					<th>Creation Date</th>
					<th>Release Date</th>
					<th>Initial Payment</th>
					<th>Status</th>
					<th>On Current Date</th>
					<th></th>						
				</tr>
			</thead>
			<tbody>
				<?php
					$w = $db->prepare('SELECT * FROM wallet WHERE user_id = :user_id and status2 <= :status3 ORDER BY id ASC');
						$w->execute(
							array('user_id' => $_GET['id'], 'status3' => 2));
						$num = $w->rowCount();
						if($num == 0)
						{
							echo "<tr><td colspan='9'>Wallet is empty!</td></tr>";
						}
						while($rs = $w->fetch(PDO::FETCH_ASSOC))
						{							
							?>
							<tr>
								<td><?php echo $rs['wallet_id'];?></td>
								<td><?php echo $rs['wallet_type'];?></td>
								<td><?php echo date("h-i a, d/m/Y",$rs['date_added']);?></td>
								<td><?php echo date("h-i a, d/m/Y",$rs['released_date']);?></td>
								<td>&#8358; <?php echo number_format($rs['amount1']);?></td>
								<td><?php echo wallet_status($rs['status']);?></td>
								<td class='w-class-<?php echo $rs['status2'];?>'>&#8358; 
								<?php
									if($rs['w_type'] == 0){
										echo $rs['amount1'];
									}elseif ($rs['w_type'] == 1) {
										echo $rs['amount3'];
									}elseif ($rs['w_type'] == 2) {
										echo $rs['amount2'];
									}
								?>
								</td>
								<td>
									<form action='' method='post' class='btn-delete-wallet'>
										<button name='ok-del-wallet' value='<?php echo $rs['id'];?>' class='btn btn-sm btn-danger' type='submit' title='Delete'>
											<i class='fa fa-trash-o'></i>
										</button>
									</form>
								</td>
							</tr>
							<?php
						}
					$w->closeCursor();
				?>
			</tbody>
		</table>
			
		<?php

	}
?>