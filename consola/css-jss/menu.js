$(document).ready(function(){
	$("a[id=categorias]").click(function(){
		$.ajax({
			data: null,
	    	url:   'categorias.php',
	        type:  'post',
	        beforeSend: function () {
           		$("#titulo").html("<span>Categorias</span><a href='' id='addcategoria'><img class='ico-acciones' src='img/agregar.png'/>Agregar Categoria</a>");
	        },
	        success:  function (response) {
           		if(response=="true")
	            	$("#contenido").html("<p>Tabla de datos de Categorias</p>");
	        }
	    });
        return false;
 
    });
});

$(document).ready(function(){
	$("a[id=productos]").click(function(){
		$.ajax({
			data: null,
	    	url:   'productos.php',
	        type:  'post',
	        beforeSend: function () {
           		$("#titulo").html("<span>Productos</span><a href='' id='addcategoria'><img class='ico-acciones' src='img/agregar.png'/>Agregar Productos</a>");
	        },
	        success:  function (response) {
           		if(response=="true")
	            	$("#contenido").html("<p>Tabla de datos de Productos</p>");
	        }
	    });
        return false;
 
    });
});

$(document).ready(function(){
	$("a[id=usuarios]").click(function(){
		$.ajax({
			data: null,
	    	url:   'usuarios.php',
	        type:  'post',
	        beforeSend: function () {
           		$("#titulo").html("<span>Usuarios</span>");
	        },
	        success:  function (response) {
           		if(response=="true")
	            	$("#contenido").html("<p>Tabla de datos de Usuarios</p>");
	        }
	    });
        return false;
 
    });
});

$(document).ready(function(){
	$("a[id=pedidos]").click(function(){
		$.ajax({
			data: null,
	    	url:   'pedidos.php',
	        type:  'post',
	        beforeSend: function () {
           		$("#titulo").html("<span>Pedidos</span>");
	        },
	        success:  function (response) {
           		if(response=="true")
	            	$("#contenido").html("<p>Tabla de datos de Pdidos</p>");
	        }
	    });
        return false;
 
    });
});