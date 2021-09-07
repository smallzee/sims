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

	if(isset($_POST['ok-reg'])){
	    $ids = $_POST['id'];
	    $c = count($ids);

        foreach ($ids as $id) {
            //save courses
            $in = $db->prepare("INSERT INTO course_reg(matric,course,`session`,semester,`level`) VALUES (:reg_no,:course,:session,:semester,:level)");
            $in->execute(array(
                'reg_no' => user('matric'),
                'course' => $id,
                'session' => settings('session'),
                'semester' => settings('semester'),
                'level' => course($id,"level")
            ));

            $in->closeCursor();
	    }

	    set_flash("$c courses registered successfully","success");
        header("location:course.php");
	    exit();
    }

    if(isset($_POST['ok-delete'])){
        $ids = $_POST['id'];
        $c = count($ids);

        foreach ($ids as $id) {
            //save courses
            $in = $db->prepare("DELETE FROM course_reg WHERE matric = :me AND semester = :semester AND session = :session AND course = :id");
            $in->execute(array(
                'me' => user('matric'),
                'id' => $id,
                'session' => settings('session'),
                'semester' => settings('semester')
            ));

            $in->closeCursor();
        }

        set_flash("$c courses deleted successfully","warning");
        header("location:course.php");
	    exit();
    }


	$page_title = "FPE Portal - Course Registration";

	include_once 'head.php';
	include_once 'sidebar.php';
	
?>

<div class="blanks">
	<div class="blank-pages">
		<h3 class="page-header">My Course</h3>

        <a class="btn btn-default" data-toggle="modal" href='#modal-id'>Register New Course</a>
        <br><br>
        <?php
            flash();
            //list all course by user
            $course_list = $db->prepare("SELECT * FROM course_reg WHERE matric = :me AND semester = :semester AND session = :session");

            $course_list->execute(array(
                'me' => user('matric'),
                'semester' => settings('semester'),
                'session' => settings('session')
            ));

            $course_list_no = $course_list->rowCount();

            if($course_list_no == 0){
                echo "<p>It seems that you have not register any course this semester</p>";
            }else{


                include_once "course_edit.php";
            }
        ?>
	</div>
</div>

</div>
</div>
</div>
<?php
    include_once "new_course.php";
    include_once "outstanding_course.php"
?>
<?php include_once 'foot.php'; ?>
</body>
</html>