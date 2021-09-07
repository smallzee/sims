$(document).ready(function() {
	var t = 2;
	/*$('.start_date').datetimepicker(
		{
			format: 'dd-mm-yyyy',
			weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
		}
	);


	$('.end_date').datetimepicker(
		{
			format: 'dd-mm-yyyy',
			weekStart: 1,
	        todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0
		}
	);*/

	$(".game_form").submit(function(event) {
		/* Act on the event */
		var a = confirm("Are you sure you want to save and submit the form?");
		if(a == false){
			event.preventDefault();
			return false;
		}
	});

	$("#btn-add-game").click(function(event) {
		/* Act on the event */
		event.preventDefault();

		var a = confirm("Are you sure you want to add more question?");
		if(a == false){
			return false;
		}
		t++;
		var q = t+1;

		var qq = $(".content-game").html();
		var res = qq.replace("GAME_NO", q);
		res = res.replace("GAME_NO", q);
		res = res.replace("GAME_NO_ID",t);
		res = res.replace("GAME_NO_ID",t);
		res = res.replace("GAME_NO_ID",t);
		res = res.replace("GAME_NO_ID",t);

		res = res.replace("aa","");
		res = res.replace("aa","");
		res = res.replace("aa","");
		res = res.replace("aa","");
		res = res.replace("aa","");
		res = res.replace("aa","");
		$(".more").append(res);
		//add_question(q);

	});




	function add_question(q) {
		var text = '<div class="form-group game-box"><div class="row">';
		text += '<div class="col-xs-6">Q'+q+'</div><div class="col-xs-6">';
		text += '<input type="text" name="points[]" required="" placeholder="Points" class="form-control"></div></div>';
		text += '<textarea name="question[]" class="form-control trumbowyg_auto" required="" placeholder="Question '+q+'"></textarea>';
		text += '<div class="row"><div class="col-xs-6"><div class="input-group">';
		text += '<span class="input-group-addon"><strong>A)</strong></span>';
		text += '<span class="input-group-addon"><input type="radio" value="A" name="answer_'+t+'" checked=""></span>';
		text += '<input type="text" name="a[]" class="form-control" required="" placeholder="Option A"></div></div>';
		text += '<div class="col-xs-6"><div class="input-group">';

		text += '<span class="input-group-addon"><strong>B)</strong></span>';
		text += '<span class="input-group-addon"><input type="radio" name="answer_'+t+'" value="B"></span>';
		text += '<input type="text" name="b[]" class="form-control" required="" placeholder="Option B"></div></div></div>';
		text += '<div class="row"><div class="col-xs-6"><div class="input-group">';
		text += '<span class="input-group-addon"><strong>C)</strong></span>';
		text += '<span class="input-group-addon"><input type="radio" value="C" name="answer_'+t+'"></span>';
		text += '<input type="text" name="c[]" class="form-control" required="" placeholder="Option C"></div></div>';
		text += '<div class="col-xs-6"><div class="input-group">';
		text += '<span class="input-group-addon"><strong>D)</strong></span>';
		text += '<span class="input-group-addon"><input type="radio" name="answer_'+t+'" value="D"></span>';
		text += '<input type="text" name="d[]" class="form-control" required="" placeholder="Option D"></div></div></div></div>';


		//var $jqueryElement = $(text);
		$(".trumbowyg_auto").trumbowyg();

		$(".more").append(text);
	}
});



function evalGroup(group)
{
	//var group = document.game_form.;
	for (var i=0; i<group.length; i++) {
		if (group[i].checked){
			break;
		}
	}
	if (i==group.length){
		return alert("No Checkbox is checked");
	}
}