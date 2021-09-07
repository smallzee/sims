<div class="table-responsive">
	<table class="table table-bordered" id="tables">
		<thead>
			<th>Sn</th>
			<th>Name</th>
			<th>No of Students</th>
			<th>&nbsp;</th>
		</thead>
		<tfoot>
			<th>Sn</th>
			<th>Name</th>
			<th>No of Students</th>
			<th>&nbsp;</th>
		</tfoot>

		<tbody>
			<?php
				$sn = 0;
				$sql = $db->query("SELECT * FROM department ORDER BY `name` ASC");
				while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
					//no of students
					$dept = $rs['name'];
					$dept_id = $rs['id'];
					$students = $db->query("SELECT NULL FROM students WHERE department = '$dept'");
					$students_no = $students->rowCount();

					?>
					<tr>
						<td><?php echo ++$sn; ?></td>
						<td><?php echo $dept; ?></td>
						<td><?php echo $students_no ?></td>
						<td>
							<a href="department.php?act=edit&id=<?php echo $rs['id'];?>" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> Edit</a>
							||
							<a class="btn btn-danger btn-sm btn-delete-dept" data-toggle="modal" href='#modal-id' data-name="<?php echo $dept;?>"  data-id="<?php echo $dept_id;?>"><i class="fa fa-trash-o"></i> Delete</a>
						</td>
					</tr>
					<?php 
					$students->closeCursor();
				}

				$sql->closeCursor();
			?>
		</tbody>
	</table>
</div>



<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Delete Department</h4>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<p>Delete Department</p>

					<div class="form-group">
						<input type="hidden" name="id" id="dept-id">
						<label>Delete "<strong><span id="dept-name"></span></strong>" department and move all students to</label>
						<select name="department" class="form-control form2_single">
							<?php
								$sql = $db->query("SELECT * FROM department ORDER BY name ASC");
								while($rs = $sql->fetch(PDO::FETCH_ASSOC)){
									?>
									<option value="<?php echo $rs['id']; ?>"><?php echo $rs['name']; ?></option>
									<?php
								}
								$sql->closeCursor();
							?>
						</select>
					</div>


					<div class="form-group">
						<input type="submit" name="ok-delete" value="Delete" class="btn btn-sm btn-info">
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>				
			</div>
		</div>
	</div>
</div>