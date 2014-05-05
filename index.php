<?php
	session_start();
?>
<!doctype html>
<html lang="en">
<head>
<title>Tic Tac Toe</title>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>
	var checkboxes = document.getElementsByTagName('input');
	for(var i=0; i<checkboxes.length; i++) {
    	checkboxes[i].indeterminate = true;
	}


    $(document).ready(function(){
        $("#slot1").one("click", function(){
            $('#slot1').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" : "1"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
        $("#slot2").one("click", function(){
            $('#slot2').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" : "2"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot3").one("click", function(){
            $('#slot3').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" : "3"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot4").one("click", function(){
            $('#slot4').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" : "4"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
			});
        });
        
         $("#slot5").one("click", function(){
            $('#slot5').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" : "5"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
			});
        });
        
         $("#slot6").one("click", function(){
            $('#slot6').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" :"6"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
			});
        });
        
         $("#slot7").one("click", function(){
            $('#slot7').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" : "7"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
			});
        });
        
         $("#slot8").one("click", function(){
            $('#slot8').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" : "8"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
			});
        });
        
         $("#slot9").one("click", function(){
            $('#slot9').prepend('<img id="theImg" src="img/x-image.png" />');
            $.post( "controller.php", {"slot" : "9"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
			});
        });
        
        
        
        
    });
</script>
</head>


<div classid="slot1">1</div>|
<div id="slot2">2</div>|
<div id="slot3">3</div><br/>
<div id="slot4">4</div>|
<div id="slot5">5</div>|
<div id="slot6">6</div><br/>
<div id="slot7">7</div>|
<div id="slot8">8</div>|
<div id="slot9">9</div>


</body>
</html>
