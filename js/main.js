   $(document).ready(function(){
    	
        $("#slot1").one("click", function(){
            $('#slot1').prepend('<img class="x-image" src="img/x-image.png" />');
            $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "1"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img class="o-image" src="img/o.gif" />');
	   			 	 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			 }); 
        });
        
        $("#slot2").one("click", function(){
            $('#slot2').prepend('<img class="x-image" src="img/x-image.png" />');
            $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "2"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img class="o-image" src="img/o.gif" />');
	   			 	 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			});
        });
        
         $("#slot3").one("click", function(){
            $('#slot3').prepend('<img class="x-image" src="img/x-image.png" />');
            $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "3"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img class="o-image" src="img/o.gif" />');
	   			 	 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			});
        });
        
         $("#slot4").one("click", function(){
            $('#slot4').prepend('<img clsas="x-image" src="img/x-image.png" />');
             $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "4"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img class="o-image" src="img/o.gif" />');
	   			 	 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			});
        });
        
         $("#slot5").one("click", function(){
            $('#slot5').prepend('<img class="x-image" src="img/x-image.png" />');
             $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "5"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img class="o-image" src="img/o.gif" />');
	   			 	 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			});
        });
        
         $("#slot6").one("click", function(){
            $('#slot6').prepend('<img class="x-image" src="img/x-image.png" />');
            $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "6"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img class="o-image" src="img/o.gif" />');
	   			 	 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			});
        });
        
         $("#slot7").one("click", function(){
            $('#slot7').prepend('<img class="x-image" src="img/x-image.png" />');
             $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "7"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img clsas="o-image" src="img/o.gif" />');
	   			 	 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			});
        });
        
         $("#slot8").one("click", function(){
            $('#slot8').prepend('<img class="x-image" src="img/x-image.png" />');
             $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "8"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img clss="o-image" src="img/o.gif" />'); 
	   			 	 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			});
        });
        
         $("#slot9").one("click", function(){
            $('#slot9').prepend('<img class="x-image" src="img/x-image.png" />');
             $.ajax({
	   			 type: 'GET',
	      		 dataType:'json',
	    		 url: 'controller.php',
	   			 data: {"slot" : "9"}, 
	    		 success: function(responseData) {
	       			 $('#slot'+responseData.aiSelection).prepend('<img class="o-image" src="img/o.gif" />');
	   				 var aiWinner = responseData.aiWinner;
	       			 if(aiWinner > 0) {
	       			 	alert("AI WINS!!! Clearing board...");
	       			 	$( ".o-image" ).remove();
	       			 	$( ".x-image" ).remove();
	       			 }
	   			 },
	   			 error: function(XMLHttpRequest, textStatus, errorThrown) {
	      		  // TODO: log errorThrown to php log or other logger
	      		  
	   			 }
			});
        }); 
    });