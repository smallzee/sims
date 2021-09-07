<?php
	require_once '../core/db.php';
	if(!login())
	{
		header("location:login.php");
		exit();
	}

	if(user('status') == 0){
        set_flash("Kindly pay your school fees to continue!","warning");
        header("location:index.php");
        exit();
    }

    if(settings('biodata_update') == "No"){
    	set_flash("Registration has ended for this semester!","warning");
    	header("location:index.php");
    	exit();
    }

    if(isset($_POST['ok']))
	{
    $a = array();    
    $a['gender'] = $_POST['gender'];
    $a['phone'] = $_POST['phone'];    
    $a['email'] = $_POST['email'];
    $a['address'] = $_POST['address'];
    $a['guardian_name'] = $_POST['guardian_name'];
    $a['guardian_phone'] = $_POST['guardian_phone'];
    $a['guardian_address'] = $_POST['guardian_address'];
    $a['kin_name'] = $_POST['kin_name'];
    $a['kin_phone'] =  $_POST['kin_phone'];
    $a['kin_address'] = $_POST['kin_address'];
    $a['matric'] = user('matric');

    $up = $db->prepare("UPDATE students SET email = :email, gender = :gender, phone = :phone, address = :address, guardian_phone = :guardian_phone, guardian_name = :guardian_name, guardian_address = :guardian_address, kin_name = :kin_name, kin_phone = :kin_phone, kin_address = :kin_address  WHERE matric = :matric");
    $up->execute($a);
    $up->closeCursor();

    if(isset($_FILES['image']['name']) &&($_FILES['image']['name'] != "")){
    	$folder = "./img/students/";
    	$file_name = uniqid().strtolower($_FILES['image']['name']);
    	$destination = $folder.$file_name;

    	move_uploaded_file($_FILES['image']['tmp_name'], $destination);

    	$matric = user('matric');

    	$ups = $db->query("UPDATE students SET passport = '$file_name' WHERE matric = '$matric'");
    }

    if(isset($_POST['password']) && $_POST['password'] !== "")
    {
        if($_POST['password'] == $_POST['password2'])
        {
            $up2 = $db->prepare("UPDATE students SET password = :password WHERE matric = :id");
            $up2->execute(array(
                'password' => $_POST['password'],
                'id' => $_SESSION['matric']
            ));
            $up2->closeCursor();
            set_flash("Profile and password updated successfully","success");
        }else{
            set_flash("Profile updated successfully, but password does not match","warning");
        }
    }else{
        set_flash("Profile updated successfully","info");
    }

    header("location:biodata.php");
    exit();
}


	$page_title = "FPE Portal - Biodata Update";

	include_once 'head.php';
	include_once 'sidebar.php';
	
?>

<div class="blank">
	<div class="blank-page">
		<h3>Biodata Update</h3>
		<br><br>

		<form action="" method="post" enctype="multipart/form-data">
			<?php flash(); ?>
			<h3>Personal Details</h3>
			<br>
			<?php
				if(user('passport') == ""){
					?>
					<div class="form-group">
						<label>Kindly Upload Passport</label>
						<input type="file" name="image" required="" accept=".jpg">
					</div>
					<?php
				}
			?>
		    <div class="form-group">
		        <label for="">Full name</label>
		        <input type="text" class="form-control" required name="name" placeholder="Full name" readonly value="<?php echo user('name');?>">
		    </div>
		    <div class="form-group">
		        <label for="">Matric No</label>
		        <input type="text" name="matric" required placeholder="Matric No" class="form-control" readonly value="<?php echo user('matric');?>">
		    </div>


		    <div class="form-group">
		        <label for="">Gender</label>
		        <select name="gender" id="" required class="form-control">
		            <option><?php echo user('gender');?></option>
		            <option value="Male">Male</option>
		            <option value="Female">Female</option>
		        </select>
		    </div>


		    <div class="form-group">
		        <label for="">School</label>
		        <input type="text" readonly="" class="form-control" readonly value="<?php echo user('faculty');?>">
		    </div>

		    <div class="form-group">
		        <label for="">Department</label>
		        <input type="text" readonly="" class="form-control" readonly value="<?php echo user('department');?>">
		    </div>

		    <div class="form-group">
		        <label for="">Level</label>
		        <select name="level" id="" required class="form-control">
		            <option value="<?php echo user('level');?>"><?php echo user('level');?></option>		            
		        </select>
		    </div>


		    <div class="form-group">
		        <label>Phone Number</label>
		        <input type="text" name="phone" required placeholder="Phone Number" class="form-control" value="<?php echo user('phone');?>">
		    </div>

		    <div class="form-group">
		        <label for="">Email Address</label>
		        <input type="email" value="<?php echo user('email');?>" name="email" required placeholder="Email Address" class="form-control">
		    </div>

		    <div class="form-group">
		        <label for="">Contact Address</label>
		        <input type="text" value="<?php echo user('address');?>" name="address" required placeholder="Contact Address" class="form-control">
		    </div>

		    

		    <h3>Guardian / Next of Kin Information</h3>
		    <br>

		    <div class="form-group">
		    	<label>Guardian Name</label>
		    	<input type="text" value="<?php echo user('guardian_name');?>" name="guardian_name" required placeholder="Guardian Name" class="form-control">
		    </div>

		    <div class="form-group">
		    	<label>Guardian Phone Number</label>
		    	<input type="text" value="<?php echo user('guardian_phone');?>" name="guardian_phone" required placeholder="Guardian Phone" class="form-control">
		    </div>

		    <div class="form-group">
		    	<label>Guardian Contact Address</label>
		    	<input type="text" value="<?php echo user('guardian_address');?>" name="guardian_address" required placeholder="Guardian Contact Address" class="form-control">
		    </div>

		    <div class="form-group">
		    	<label>Next of Name</label>
		    	<input type="text" value="<?php echo user('kin_name');?>" name="kin_name" required placeholder="Next of Kin Name" class="form-control">
		    </div>

		    <div class="form-group">
		    	<label>Next of Kin Phone Number</label>
		    	<input type="text" value="<?php echo user('kin_phone');?>" name="kin_phone" required placeholder="Next of Kin Phone" class="form-control">
		    </div>

		    <div class="form-group">
		    	<label>Next of Kin Contact Address</label>
		    	<input type="text" value="<?php echo user('kin_address');?>" name="kin_address" required placeholder="Next of Kin Contact Address" class="form-control">
		    </div>


		    <h3>Update Password (Optional)</h3>
		    <br>

		    <div class="form-group">
		        <label>Password (<small style="font-size: 10px; color: #f00 !important;">Leave Password Blank to retain current password</small>)</label>
		        <input type="password" name="password" class="form-control" placeholder="Password">
		    </div>

		    <div class="form-group">
		        <label>Confirm Password</label>
		        <input type="password" name="password2" class="form-control"  placeholder="Confirm Password">
		    </div>

		    <div class="form-group">
		        <input type="submit" name="ok" class="btn btn-block btn-info" value="Update">
		    </div>
		    </div>
		</form>
	</div>
</div>

</div>
</div>
</div>

<?php include_once 'foot.php'; ?>
</body>
</html>