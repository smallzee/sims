<?php
	require_once '../core/db.php';
	if(!login())
	{
		header("location:login.php");
		exit();
	}

	$status = user('status');

	if($status > 0){
		set_flash("You have already pay school fees for this semester!","info");
		header("location:index.php");
		exit();
	}

	$level = user('level');
	$fees = strtolower(str_replace(" ", "_", $level));

	//die($fees);

	$amount = settings($fees."_school_fees");

	if(isset($_POST['ok'])){
		$matric = user('matric');
		$session = settings('session');
		$payment_type = "School Fees";
		$amount = $amount;
		$date_added = time();
		$pay = $db->query("INSERT INTO payments(matric,session,payment_type,amount,date_added) VALUES('$matric','$session','$payment_type', '$amount', '$date_added')");

		$pay->closeCursor();

		$up = $db->query("UPDATE students SET status = '1' WHERE matric = '$matric'");
		$up->closeCursor();

		set_flash("Payment made successfully, you can now proceed with your registration","success");
		header("location:index.php");
		exit();
	}

	
	//exit();


	$page_title = "FPE - School Fees Payment";

	include_once 'head.php';
	include_once 'sidebar.php';
	
?>

<div class="blank">
	<div class="blank-page">
		<h3>School Fees Payment</h3>
		<br>
		<div class="row">
			<div class="col-md-6">
				<form action="" method="post" class="pay-account">
				<div class="row">
				
					<div class="payment-account">&#8358; <?php echo number_format($amount); ?></div>
		      		<div class="col-sm-12 col-xs-12">
		      			<label class="control-form">Card Number</label>
		        		<div class="form-group">
		        				<div class="input-icon input-credit-card">
		        					<input type="text" id="card_no" name="card_number"  value="<?php echo @$_POST['card_number']; ?>" required="" class="form-control" placeholder="Card Number">
		        				</div>
		        		</div>
		        	</div>

		        	<div class="col-sm-4 col-xs-12">
		        		<div class="form-group">
		        			<label class="control-form">CVV2</label>
		        			<div class="input-icon input-credit-card">
		        				<input type="text" name="security" style="height: 45px; " value="<?php echo @$_POST['security']; ?>"  class="form-control" required=""
		        				 placeholder="CVV2">
		        			</div>	        				        				        		
		        		</div>
		        	</div>

		        	<div class="col-sm-4 col-xs-12">
		        		<div class="form-group">
		        			<label class="control-form" >Expiration Month</label>
		        			<div class="input-icon input-calendar input-icon-right">
		        				<select class="form-control custom-select" required=""  name="date" style="display: block;  width: 100%; height: 45px;">
		        				<option value="0"> Month</option>
		        				<?php 
		        					$a = array("Jan","Feb","Apr","Mar","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		        					foreach ($a as $value) 
		        					{
		        						echo '<option>'.$value.'</option>';
		        					}
		        				 ?>
		        				 
		        			</select>
		        			</div>
		        		</div>
		        	</div>

		        	<div class="col-sm-4 col-xs-12">
		        		<div class="form-group">
		        			<label class="control-form">Expiration Year</label>
		        			<div class="input-icon input-calendar input-icon-right">
		        				<select class="form-control custom-select" required="" name="date" style="display: block; width: 100%; height: 45px; ">
		        				<option value="0"> Year </option>
		        				<?php 
		        					$a = range(date("Y"),date("Y") + 3);
		        					foreach ($a as  $value)
		        					 {
		        						echo '<option>'.$value.'</option>';
		        					}
		        				 ?>
		        			</select>
		        			</div>
		        		</div>
		        	</div>

		        	<div class="col-sm-12 col-xs-12">
		        		<div class="form-group">
		        			<label class="control-form">Payment Type</label>
		        			<select class="form-control custom-select" style="display: block; width: 100%; height: 45px;" required="" name="pay_option">
		        				<option value="0">--------------------------- Please select your payment option ---------------------------</option>
		        				<option>Visa&trade;</option>
		        				<option>VerveCard&trade;</option>
		        				<option>MasterCard&trade;</option>
		        			</select>
		        		</div>
		        	</div>
	        		<p class="col-sm-12" style="color: #555; font-size: 14px;">
	        			By Clicking Pay. I have agreed to this service <span><a href="#" style="color: #003366;">Terms and Conditions</a></span>
	        		</p>
		        	<div class="col-sm-6 col-xs-12">
		        		<div class="form-group">
		        			<input type="submit" name="ok" class="btn btn-danger btn-md btn-block" value="Pay">
		        		</div>
		        	</div>	        	
	        	</div>
	        </form>

	        	<img src="img/payments-icons.png"  >
			</div>
		</div>			      
	</div>
</div>

</div>
</div>
</div>

<?php include_once 'foot.php'; ?>


<script type="text/javascript">
	var luhnChk = (function (arr) {
	    return function (ccNum) {
	        var 
	            len = ccNum.length,
	            bit = 1,
	            sum = 0,
	            val;

	        while (len) {
	            val = parseInt(ccNum.charAt(--len), 10);
	            sum += (bit ^= 1) ? arr[val] : val;
	        }

	        return sum && sum % 10 === 0;
	    };
	}([0, 2, 4, 6, 8, 1, 3, 5, 7, 9]));


	$(document).ready(function(){
		$(".pay-account").on("submit",function(event) {
			var n = $("#card_no").val();
			var a = luhnChk(n);

			if(a == false){
				$("#card_no").addClass('has-error');
				alert("Please enter correct card details");
				event.preventDefault();
				return false;
			}else{
				$("#card_no").addClass('has-success');
			}
		});
	});
</script>
</body>
</html>