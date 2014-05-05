
<!doctype html>
<html lang="en">
<head>
<title>Tic Tac Toe</title>
<style>
	.square{
    width:100px;
    height:100px;
}

.v{
    border-left:1px solid #000;
    border-right:1px solid #000;
}

.h{
    border-top:1px solid #000;
    border-bottom:1px solid #000;
}
</style>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>

    $(document).ready(function(){
        $("#slot1").one("click", function(){
            $('#slot1').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" : "1"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
        $("#slot2").one("click", function(){
            $('#slot2').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" : "2"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot3").one("click", function(){
            $('#slot3').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" : "3"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot4").one("click", function(){
            $('#slot4').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" : "4"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot5").one("click", function(){
            $('#slot5').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" : "5"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot6").one("click", function(){
            $('#slot6').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" :"6"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot7").one("click", function(){
            $('#slot7').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" : "7"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot8").one("click", function(){
            $('#slot8').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" : "8"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
         $("#slot9").one("click", function(){
            $('#slot9').prepend('<img id="theImg" src="img/x-image.png" />');
            $.get( "controller.php", {"slot" : "9"}, function( data ) {
				$('#slot'+data).prepend('<img id="theImg" src="img/o.gif" />');
				alert(data);
			});
        });
        
        
        
        
    });
</script>
</head>

<!--
<div id="slot1">1</div>|
<div id="slot2">2</div>|
<div id="slot3">3</div><br/>
<div id="slot4">4</div>|
<div id="slot5">5</div>|
<div id="slot6">6</div><br/>
<div id="slot7">7</div>|
<div id="slot8">8</div>|
<div id="slot9">9</div>
-->
<div id="board">
    <table>
      <tr id="row1">
        <td id="slot1" class="square"></td>
        <td id="slot2" class="square v"></td>
        <td id="slot3" class="square"></td>
      </tr>
      <tr id="row2">
        <td id="slot4" class="square h"></td>
        <td id="slot5" class="square v h"></td>
        <td id="slot6" class="square h"></td>
      </tr>
      <tr id="row3">
        <td id="slot7" class="square"></td>
        <td id="slot8" class="square v"></td>
        <td id="slot9" class="square"></td>
      </tr>
    </table>
  </div>


</body>
</html>
