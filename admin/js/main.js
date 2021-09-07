$(document).ready(function() {
	$("#show_pass_btn").change(function(event) {
		/* Act on the event */
		var a = $(this).prop('checked');
		//console.log(a);
		//
		if(a == true){
			$("#password").attr('type', 'text');
		}else{
			$("#password").attr('type', 'password');
		}
	});

	/*$("#later").countdown(time_rem, function(event) {
	    $(this).html(
	      event.strftime('<div class=\'the-day\'>%D <span>Days</span></div><div class=\'the-day\'>%H <span>Hours</span></div><div class=\'the-day\'> %M <span>Minutes</span></div><div class=\'the-day\'> %S <span>Seconds</span></div>')
	    );
	  });
	  */
});
