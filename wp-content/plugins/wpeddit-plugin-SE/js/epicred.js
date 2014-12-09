jQuery(document).ready(function ($) {
	
   $(".logged-in-only").bind("click", function () { 
	   //alert('You must be logged in to vote');
      $.colorbox({
        width:450, 
        initialWidth:450, 
        initialHeight: 90, 
        height: 90, 
        html: "<h3> Para votar necesitas ingresar al sistema </h3>",
        transition: "none",
        closeButton: false
      });
	});
	      
   $(".arrow").bind("click", function () { 
   	
   	var logged = window.loggedin;

   	if(logged == 'false'){
   		return false;
   	}
   	
   	var like = $(this).attr("data-red-like");
   	var id = $(this).attr("data-red-id");
   	var curr = $(this).attr("data-red-current");
   	
   	  	
   	if(like == 'up'){
   		$(this).removeClass("up").addClass("upmod");
   		$(".arrow-down-" + id).removeClass("downmod").addClass("down");
   		$(".score-" + id).removeClass("unvoted").addClass("likes");
   		$(".score-" + id).removeClass("dislikes").addClass("likes");
   		var vote = 1;
   	}
   	if(like == 'down'){
   		$(this).removeClass("down").addClass("downmod");
   		$(".arrow-up-" + id).removeClass("upmod").addClass("up");
   		$(".score-" + id).removeClass("unvoted").addClass("dislikes");
   		$(".score-" + id).removeClass("likes").addClass("dislikes");
   		var vote = -1;
   	}

        
        var j = {
            action: "epicred_vote",
            poll: id,
            option: vote,
            current: curr,
        };
        
        var l = $.ajax({
            url: EpicAjax.ajaxurl,
            type: "POST",
            data: j,
            dataType: "json",
        });
        
        l.done(function (c) {
            var id = c.poll;
			$(".score-" + id).html(c.vote);
        });
        
        l.fail(function (d, c) {
            alert("Request failed: " + c)
        });
        
        return true
    });
    
    
   $(".arrowc").bind("click", function () { 
   	
   	var logged = window.loggedin;

   	if(logged == 'false'){
   		return false;
   	}
   	
   	var like = $(this).attr("data-red-like");
   	var id = $(this).attr("data-red-id");
   	var curr = $(this).attr("data-red-current");
   	
   	  	
   	if(like == 'up'){
   		$(this).removeClass("up").addClass("upmod");
   		$(".arrowc-down-" + id).removeClass("downmod").addClass("down");
   		$(".scorec-" + id).removeClass("unvoted").addClass("likes");
   		$(".scorec-" + id).removeClass("dislikes").addClass("likes");
   		var vote = 1;
   	}
   	if(like == 'down'){
   		$(this).removeClass("down").addClass("downmod");
   		$(".arrowc-up-" + id).removeClass("upmod").addClass("up");
   		$(".scorec-" + id).removeClass("unvoted").addClass("dislikes");
   		$(".scorec-" + id).removeClass("likes").addClass("dislikes");
   		var vote = -1;
   	}

        
        var j = {
            action: "epicred_vote_comment",
            poll: id,
            option: vote,
            current: curr,
        };
        
        var l = $.ajax({
            url: EpicAjax.ajaxurl,
            type: "POST",
            data: j,
            dataType: "json",
        });
        
        l.done(function (c) {
            var id = c.poll;
			$(".scorec-" + id).html(c.vote);
        });
        
        l.fail(function (d, c) {
            alert("Request failed: " + c)
        });
        
        return true
    });
    
    
    
     $('#thumbnail').change(function() {
     var thumb = $('#thumbnail').val();
	 $('#thumbprev').html("<img src = " + thumb + ">");
	 });


    
    

});