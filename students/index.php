<?php
	require_once '../core/db.php';
	if(!login())
	{
		header("location:login.php");
		exit();
	}

    $status = user('status');

    //if($status == 0)


	$page_title = "FPE - Student Dashbaord";

	include_once 'head.php';
	include_once 'sidebar.php';
	
?>
        
        <?php flash(); ?>

        <?php
            if($status == 0){
                alert("You have not pay school fees for this semester!","danger");
            }else{
        ?>
        
        <h3 class="site-color">User Account</h3>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>Registration No</th>
                <td><?php echo user('matric');?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo user('name'); ?></td>
            </tr>

            <tr>
                <th>Email Address</th>
                <td><?php echo user('email'); ?></td>
            </tr>

            <tr>
                <th>Phone Number</th>
                <td><?php echo user('phone'); ?></td>
            </tr>

            <tr>
                <th>Department</th>
                <td><?php echo user('department'); ?></td>
            </tr>

            <tr>
                <th>Level</th>
                <td>
                    <?php echo user('level');?>
                </td>
            </tr>
            <tr>
                <th>Admission Year</th>
                <td>
                    <?php echo user('matric_year'); ?>
                </td>
            </tr>
            <tr>
                <th>Mode</th>
                <td>
                    <?php echo user('admission'); ?>
                </td>
            </tr>
        </table>
        <?php 
    }
        ?>
	</div>
</div>

</div>
</div>
</div>

<?php include_once 'foot.php'; ?>
</body>
</html>