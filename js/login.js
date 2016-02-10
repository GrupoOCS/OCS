var N;
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
     		
     	if($('#pass').val() != $('#repass').val()){
     		console.log("Las contras no son iguales");
     		$('#registro').html("Registrate<br><font color='red' size='3'>"+"La contraseña de verificación no coincide"+"</font>");
     		location.href="#top";
	        setInterval(function(){$('#registro').html("Registrate");},2500);
     		$('#repass').focus();
     		return false;
     	}
     	
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
		  $("input[type=submit]").attr("disabled", "disabled");
			$.ajax({
			data:  valores, //aqui mando  la  varible
	    	url:   'js/agregausu.php',
	        type:  'post', //metodo  como acceder a  la  variable
	 
	        success:  function (response) 
	        {
	        	
	        	if(response=="true"){
	        		N=5;
	        		setInterval(redirigir,1000);
	        	}
	        	else{
	        		//alert("Ya no :(");
	        		$('#registro').html("Registrate<br><font color='red' size='3'>"+response+"</font>");
	        		location.href="#top";
	        		setInterval(function(){$('#registro').html("Registrate");$("input[type=submit]").removeAttr("disabled");},4000);
	        		//$("input[type=submit]").removeAttr("disabled");
	        	}		  
	        }

		});

		return false;
	});

});

function redirigir(){
	if(N>0){
		$('#adduser').html("Tu cuenta ha sido registrada, sin embargo, esta requiere que la confirmes desde el correo  electronico  que ingresaste en el registro "+N);
	}else{
		location.href="index.php";
	}
	N--;
}


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

     