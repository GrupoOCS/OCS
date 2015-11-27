$(document).ready(function(){
    $('#login').submit(function(){
     
       var datos= {
			"usuario" : $('#usuario').val(),
			"contrasena" : $('#contrasena').val(),
		};

		$.ajax({
			data:  datos,
	    	url:   'js/index.php',
	        type:  'post',
	        beforeSend: function () {
           		$('#boton').attr("disabled", true);
           		$('#boton').css("background", "#808080");
	        },
	        success:  function (response) {
	        	$('#boton').attr("disabled", false);
           		$('#boton').css("background", "#3498DB");
           		if(response=="true")
	            	location.href = "ventas.php";
	            else
	            	$("#error").html("<center><span class='texterror'>"+response+"</span></center>");
	            	setInterval(function(){$("#error").html("");},5000);
	        }
	    });
        return false;
 
    });
});