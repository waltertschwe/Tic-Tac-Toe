$(document).ready(function(){
	$('#board td').one("click", function(){
		cellId = $(this).attr('id');
		var result = cellId.split("t");
		var slot   = result[1];
			$('#'+ cellId).prepend('<div class="x-image"><img src="img/x-image.png" /></div>');
			 $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : slot}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<div class="o-image"><img  src="img/o.gif" /></div>');
	       			 $('#slot'+responseData.aiSelection).unbind("click");
	   			 	 var aiWinner = responseData.aiWinner;
	   			 	 var isDraw   = responseData.isDraw;
	   			 	 if(isDraw > 0) {
	   			 	 	alert("A DRAW!!! Clearing board...");
	   			 	 	location.reload();
	   			 	 }
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	location.reload();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
		    }); 
      }); 
});   
