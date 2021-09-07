<?php
	require_once '../core/db.php';
	if(!login())
	{
		header("location:login.php");
		exit();
	}


	$page_title = "PSMI - User Dashbaord";

	include_once 'head.php';
	include_once 'sidebar.php';
	
?>

<div class="blank">
	<div class="blank-page">
		
	</div>
</div>

</div>
</div>
</div>

<?php include_once 'foot.php'; ?>
</body>
</html>