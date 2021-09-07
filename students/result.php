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

$page_title = "FPE Portal - Semester Result";

	include_once 'head.php';
	include_once 'sidebar.php';
	
?>

<div class="blank">
	<div class="blank-pages">
        <h3 class="page-header">Print Semester Result</h3>

        <?php flash();?>

        <form action="print_re.php" method="get" target="_blank">
            <div class="form-group">
                <label for="">Session</label>
                <select name="session" required class="form-control">
                    <option value="">Session</option>
                    <?php
                        $matric = user('matric');
                        $s = $db->query("SELECT DISTINCT(session) AS s FROM result WHERE matric = '$matric'");
                        while($s_rs = $s->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <option><?php echo $s_rs['s'];?></option>
                            <?php

                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="">Semester</label>
                <select name="semester" id="" required class="form-control">
                    <option value="">Select</option>
                    <option>First</option>
                    <option>Second</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" name="ok-p" class="btn btn-info" value="Print">
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