$(document).ready(function() {
	//$('#tables').DataTable();
	

	$(".delete-member").submit(function(event) {
		/* Act on the event */
		var a  = confirm("Are you sure you want to delete this user?");
		if(a == false){
			event.preventDefault();
			return false;
		}
	});

	$(".delete-admin").submit(function(event) {
		/* Act on the event */
		var a  = confirm("Are you sure you want to delete this admin?");
		if(a == false){
			event.preventDefault();
			return false;
		}
	});

    //
	
	

    $(".btn-delete-dept").click(function(){
        var id = $(this).data("id");
        var name = $(this).data("name");

        $("#dept-id").val(id);
        $("#dept-name").html(name);
    });

    $(".c-0").on("change",function () {
		var course = $(this).val();
		var ids = $(this).attr("data-course");
		$.ajax({
           url: 'admin-ajax.php',
           type: 'get',
           data: {
               'c-0': '',
               'id': course
           },
            success: function (f) {
               //console.log(f);
                $("[data-caps="+ids+"]").val(f);
            }
        });
    });

    $("#btn-add-course").click(function (e) {
        e.preventDefault();
        var c = confirm("Are you sure you want to add new course?\nNote that this action is irreversible you might need to start again!");
        if(c == true){
            var fc = $(".f-c").html();
            console.log(fc);
            $(".courses").append(fc);
        }
    })


   
});