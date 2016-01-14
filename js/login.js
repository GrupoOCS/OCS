$(document).ready(function(){


    $('#login').submit(function(){
     
       var datos= {
			"correo" : $('#correo').val(),
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

    $('#registrarse').submit(function(){
     
       var valores= {
			"nombre" : $('#nombre').val()+" "+$('#apellidoP').val()+" "+$('#apellidoM').val(),
			"correo" : $('#correo').val(),
			"contrasena" : $('#pass').val(),
			"calle" : $('#calle').val()+" "+ $('#numero').val(),
			"colonia" : $('#colonia').val(),
			"estado" : $('#estado').val(),
			"ciudad" : $('#ciudad').val(),
			"municipio" : $('#municipio').val(),
			"codigo" : $('#cp').val(),
			"telefono" : $('#telefono').val(),
				};

			$.ajax({
			data:  valores, //aqui mando  la  varible
	    	url:   'js/agregausu.php',
	        type:  'post', //metodo  como acceder a  la  variable
	 
	        success:  function (response) {
		    	$('#adduser').html(response);    		  
	        }

		});

		return false;
	});

});


//===============FUNCION QUE  REALIZA  LA  VERIFICACION  DEL  CODIGO=============================
function verificacodigo(id_cliente){
       var codificacion= {
			"idcliente" : id_cliente,
			"codigo" : $('#codigo').val()
		};
		
			$.ajax({
				data:   codificacion, //aqui mando  la  varible
		    	url:   'js/codigoverificacion.php',
		        type:  'post', //metodo  como acceder a  la  variable
		 
		        success:  function (response) {
		        	if(response=="true"){
		        		alert("Tu  codigo  es  correcto");	
		        		location.href = "ventas.php";
		        	}
		        	else
		        		$('#error').html(response); 
		        }
			});

		return false;
	}

     