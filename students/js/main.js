$(document).ready(function() {
	$("#refresh_code").click(function(event) {
		/* Act on the event */
		event.preventDefault();
		var a = Math.random();

		//$("#captcha_code").attr('src', 'r_captcha.php?id='+a);
		

		$.ajax({
			url: 'r_captcha.php',
			type: 'GET',			
			data: {
				i : a
			},
			success:function(f){
				//alert(f);
				$("#captcha_code").html(f);
			}
		});		
		
	});
});