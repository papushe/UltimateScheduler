$("document").ready(function () {
    var notificationCounter = 0;
    $(".dashboard .dropdown-menu>li:nth-child(2)").on("click", function(){
        $('.table-hover').tableExport({type:'pdf',escape:'false'});
    });

    $("td span").click(function () {
        $( this ).toggleClass("glyphicon-ok-circle");
        $( this ).toggleClass("glyphicon-ban-circle");
        $( this ).removeData("status");
        if ($( this ).data("status")===0) {
            $( this ).attr('data-status',1);
        }
        if ($( this ).data("status")===1) {
            
            $( this ).attr('data-status',0);
        }
    });

    days = [];
    days[0]="Sunday";
    days[1]="Monday";
    days[2]="Tuesday";
    days[3]="Wednesday";
    days[4]="Thursday";
    days[5]="Friday";
    days[6]="Saturday";
    var date = new Date();
    date.setDate((date.getDate() + 7) - date.getDay());
    for(var i=0;i<=6;i++){
        $('th:nth-child('+(i+2)+')').text(moment(date).format('DD/MM')).css({"font-weight":"bold"});
        $('tr:nth-child(1) td:nth-child('+(i+2)+')').text(days[i]).css({"font-weight":"bold"});
        date.setDate(date.getDate() +1);
    }

    $(window).on("scroll touchmove", function () {
        $('header').toggleClass('tiny', $(document).scrollTop() > 0);
        $('a#logo').toggleClass('tiny', $(document).scrollTop() > 0);
        $('header div').toggleClass('tiny', $(document).scrollTop() > 0);
        $('header span').toggleClass('tiny', $(document).scrollTop() > 0);
        $('header img').toggleClass('tiny', $(document).scrollTop() > 0);
    });

    //Handling success alerts
    $(".approve").click(function showAlert() {
        $(".alert-success").alert().fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
        $(this).parent().parent().children().eq(0).removeClass("glyphicon-question-sign").addClass("glyphicon-ok-sign");
        $(this).parent().css({"display" :"none"});
        $(this).parent().parent().children().eq(1).css({"display" :"block"});
    });

    $(".decline").click(function(){
        $("#myModal").modal();
        $(".modal-title").text("You are about to decline Moshe Cohen's constrains.");
        $(this).parent().parent().children().eq(0).removeClass("glyphicon-ok-sign").addClass("glyphicon-question-sign");
            week = $(".decline").data("week");
            user = $(".decline").data("user");
            // Here you can make validations about the limits of shifts
            $.post("actions/decline.php",
            {
                user: user,
                week: week
            },
            function(data, status){
                console.log(data);
                $(".decline").fadeOut(300, function() { 
                    $(".decline").parent().parent().children().first().removeClass("glyphicon-question-sign").addClass("glyphicon-ok-sign");
                    $(".decline").remove(); 
                });
            });
    });
    $('.glyphicon-pencil').click(function () {
        $(this).css({"display":"none"});
        $(this).siblings().eq(0).removeClass("glyphicon-ok-sign").toggleClass("glyphicon-question-sign");
        $(this).next().css({"display":"block"});
    });

    $(".send").click(function showAlert() {
        $(".alert-success").alert();
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
            $(".buttonBadge").css("visibility", "visible");
            notificationCounter++;
            $(".buttonBadge").text(notificationCounter);
            $('.dropdown-menu-right li:last').remove();
            $('.dropdown-menu-right').prepend('<li><a href="constrains.php" class="newLi">Moshe cohen sent new constrains<div class="clear"></div><small>3 min ago</small></a></li>');
        });
    });

    $(".publish").click(function () {
        $(".alert-success > p").text("Next week shifts have been published");
        $(".alert-success").alert();
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert-success").slideUp(500);
            $(".buttonBadge").css("visibility", "visible");
            notificationCounter++;
            $(".buttonBadge").text(notificationCounter);
            $('.dropdown-menu-right li:last').remove();
            $('.dropdown-menu-right').prepend('<li><a href="index.php" class="newLi">Next week shifts have been published<div class="clear"></div><small>1 min ago</small></a></li>');
        });
        window.location.reload();
    });
    $('.glyphicon').tooltip({show: {effect:"none", delay:0}});


    $("#automaticAlgo").bind("click",function showAlert() {
        week = $(".start").data("week");
        $("#automaticAlgo").addClass("disabled");
        $.post("actions/automatic.php",
        {
            week: week
        },
        function(data, status){
           $(this).prop( "disabled", true ).text("Running");
            console.log(data);
            $(".progress").css("visibility", "visible");
            var width = 10;
            var id = setInterval(frame, 100);
            function frame() {
                if (width >= 100) {
                    clearInterval(id);
                } else {
                    width++;
                    $("#myBar").css({"width":width + '%'});
                    $('#currentProgress').text(width * 1  + '%');
                }
            }

            setTimeout(function() {
                $(".alert-success").alert();
                $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
                    $(".alert-success").slideUp(500);
                    $(".progress").css("visibility", "hidden");
                    $("#automaticAlgo").text("Done");
                });
            }, 10000);
            });
        });
        
    });

    $("#notification").click(function () {
        $(".buttonBadge").css("visibility", "hidden");
        notificationCounter = 0;
    });

    // configuration page
    $(".settings").click(function () {
        $(".alert-success").alert();
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert-success").slideUp(500);
        });
    });

    var addEventDeleteShift = function (count) {
        $(".remove").click(function () {
            $(".remove").parent().parent().empty();
        });
    };

    $(".add").click(function () {
        $("#shifts").append("<div><a href='#' <span class='glyphicon glyphicon-minus remove'></span></a>" +
            " <input type='text' placeholder='Shift name'>" + "Start: <input type='time'>" +
            "End: <input type='time'>" + "</div>");
        var count = $("#shifts").children().length;
        $("#shifts:last-child").click(addEventDeleteShift(count));
    });

    $(".reset").click(function () {
        $("#shifts").empty();
    });

// Change slot
    $("td #status").bind('click',function(){
        user= $(this).data("user");
        week = $(this).data("week");
        day = $(this).data("day");
        shift = $(this).data("shift");
        status = $(this).data("status");
        if (status==0) {
            status=1;
        }else{
            status=0;
        }
        console.log(status);
        $.post("actions/post.php",
        {
            user: user,
            week: week,
            day: day,
            shift: shift,
            status: status
        },
        function(data, status){
           console.log(data);
        });
    });
// Send apply to manager
    $("#sendRequest").bind('click',function(){
        week = $(this).data("week");
        user = $(this).data("user");
        console.log(week+"--"+user);
        // Here you can make validations about the limits of shifts
        $.post("actions/post.php",
        {
            user: user,
            week: week
        },
        function(data, status){
            if (data === false) {
                $('#sendRequest').addClass('disabled');
                $('#sendRequest').removeAttr('approve');
            }
            $(".alert-success > p").text(data);
            $(".alert-success").alert();
            $(".alert-success").fadeTo(2000, 500).slideUp(500, function () {
                $(".alert-success").slideUp(500);
            });
            
            $('#sendRequest').addClass('disabled');
            $('#sendRequest').removeAttr('approve');
            window.location.reload();
        });
    });

        $(".approve").bind('click',function(){
            var currentDom = $(this);
            week = $(this).data("week");
            user = $(this).data("user");
            console.log(week+"--"+user);
            // Here you can make validations about the limits of shifts
            $.post("actions/approve.php",
            {
                user: user,
                week: week
            },
            function(data, status){
                currentDom.fadeOut(300, function() { 
                    currentDom.parent().parent().children().first().removeClass("glyphicon-question-sign").addClass("glyphicon-ok-sign");
                    currentDom.remove(); 
                    currentDom = '';
                    return;
                });

            });
        });
    // });
// Check notifications for user
setInterval(ajaxCall, 5000); //300000 MS == 5 minutes

function ajaxCall() {
    //do your AJAX stuff here
    $.post("actions/notification.php",
            {
                user: userID
            },
            function(data, status){
                if (data) {
                    console.log(data);
                    $(".buttonBadge").css("visibility", "visible");
                    notificationCounter++;
                    $(".buttonBadge").text(notificationCounter);
                    $('.dropdown-menu-right li:last').remove();
                    $('.dropdown-menu-right').prepend('<li><a href="constrains.php" class="newLi">'+data+'<div class="clear"></div><small>now</small></a></li>');
                    return;
                }
                else{
                    return;
                }
            });
}
    $("button[id=sendFinalShifts]").each(function(){
        var currentDom = $(this);
        $(this).bind('click',function(){
            week = $(this).data("week");
            user = $(this).data("user");
            console.log(week+"--"+user);
            // Here you can make validations about the limits of shifts
            $.post("actions/approve.php",
            {
                user: user,
                week: week
            },
            function(data, status){
                currentDom.fadeOut(300, function() { 
                    currentDom.parent().parent().children().first().removeClass("glyphicon-question-sign").addClass("glyphicon-ok-sign");
                    currentDom.remove(); 
                });

            });
        });
    });