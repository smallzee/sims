$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});


$(document).ready(function() {
    $(".btn-add-account").click(function(event) {
        /* Act on the event */
        event.preventDefault();
        $(".add-account").fadeIn('slow');
    });

    $("#close-add").click(function(event) {
        /* Act on the event */
        $(".add-account").slideUp('slow');
    });

    //Confirm add time
    $("[name=ok-time]").click(function(event) {
        /* Act on the event */
        var c = confirm("Are you sure you want to extend the order time?");
        if(c == false){
            event.preventDefault();
            return false;
        }
    });


    //confirm mark completed
    $("[name=mark-ok]").click(function(event) {
        /* Act on the event */
        var c = confirm("Are you sure you want to mark the order completed?");
        if(c == false){
            event.preventDefault();
            return false;
        }
    });

    //Decline pay
    $("[name='decline-pay']").click(function(event) {
        /* Act on the event */
        var c = confirm("Are you sure you want to proceed?.\nBy clicking Ok, your account will be temporary suspended and later get banned.");
        if(c == false){
            event.preventDefault();
            return false;
        }
    });
});

function readURL(input,link) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(link).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}