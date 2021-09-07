<?php
	require_once '../core/db.php';
	if(!login())
	{
		header("location:login.php");
		exit();
	}


if(isset($_POST['ok']))
{
    $a = array();
    $a['gender'] = $_POST['gender'];
    $a['phone'] = $_POST['phone'];
    $a['level'] = $_POST['level'];
    $a['email'] = $_POST['email'];
    $a['matric'] = $_SESSION['matric'];

    $up = $db->prepare("UPDATE students SET `level` = :level, email = :email, gender = :gender, phone = :phone WHERE matric = :matric");
    $up->execute($a);
    $up->closeCursor();

    if(isset($_POST['password']) && $_POST['password'] !== "")
    {
        if($_POST['password'] == $_POST['password2'])
        {
            $up2 = $db->prepare("UPDATE students SET password = :password WHERE matric = :id");
            $up2->execute(array(
                'password' => md5($_POST['password']),
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

    header("location:account.php");
    exit();
}


	$page_title = "FPE::SET - User Account";

	include_once 'head.php';
	include_once 'sidebar.php';
	
?>

<h3 class="site-color">Update Profile</h3>
<br><br>
<?php flash(); ?>


<form action="" method="post">
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
        <label for="">Department</label>
        <input type="text" class="form-control" readonly value="<?php echo dept(user('department'));?>">
    </div>

    <div class="form-group">
        <label for="">Level</label>
        <select name="level" id="" required class="form-control">
            <option value="<?php echo user('level');?>"><?php echo user('level');?></option>
            <option value="ND 1 FT">ND 1 FT</option>
            <option value="ND 1 DPT">ND 1 DPT</option>
            <option value="ND 1 PT">PT YR 1</option>
            <option value="ND 2 PT">PT YR 2</option>
            <option value="ND 2 FT">ND 2 FT</option>
            <option value="ND 2 DPT">ND 2 DPT</option>
            <option value="ND 3 PT">PT YR 3</option>
            <option value="HND 1 FT">HND 1 FT</option>
            <option value="HND 1 DPT">HND 1 DPT</option>
            <option value="HND 2 FT">HND 1 FT</option>
            <option value="HND 2 DPT">HND 2 DPT</option>
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