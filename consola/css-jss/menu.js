$(document).ready(function(){
	$("a[id=categorias]").click(function(){
		$.ajax({
			data: null,
	    	url:   'categorias.php',
	        type:  'post',
	        beforeSend: function () {
	        	$("#titulo").html("<span>Categorias</span>");
	        	var newlink = document.createElement('a');
				newlink.setAttribute('id', 'addcategoria');
				newlink.setAttribute('href', ' ');
				newlink.innerHTML = "<img class='ico-acciones' src='img/agregar.png'/>Agregar Categoria";
				newlink.onclick = addcategoria;
       			document.getElementById('titulo').appendChild(newlink);
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
           		$("#titulo").html("<span>Productos</span>");
           		var newlink = document.createElement('a');
				newlink.setAttribute('id', 'addproducto');
				newlink.setAttribute('href', ' ');
				newlink.innerHTML = "<img class='ico-acciones' src='img/agregar.png'/>Agregar Producto";
				newlink.onclick = addproducto;
       			document.getElementById('titulo').appendChild(newlink);
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

function addcategoria(){
	//alert("addcategoria");
	$("#titulo").html("<span>Agregar Categorias</span>");
	$("#contenido").html("<form id='formcategoria' action='' method='post' enctype='multipart/form-data'><table ><tr><td>"+
				"<span>Nombre: </span></td><td>	<input class='entrada-texto' name='nombre' id='nombre' type='text' placeholder='Nombre de la categoria' autofocus required />"+
				"</td></tr></table></form>");
	return false;
}

function addproducto(){
	//alert("addprocto");
	$("#titulo").html("<span>Agregar Producto</span>");
	$("#contenido").html("<form action='' method='post' enctype='multipart/form-data'><table><tr><td><span>Nombre: </span>"
						+"</td><td><input class='entrada-texto' name='nombre' id='nombre' type='text' placeholder='Nombre del producto' autofocus required />"
						+"</td></tr><tr><td><span>Marca: </span></td><td><input class='entrada-texto' name='nombre' id='nombre' type='text' placeholder='Marca' autofocus required />"
						+"</td></tr><tr><td><span>Precio: </span></td><td><input class='entrada-texto' name='nombre' id='nombre' type='number' placeholder='Precio' autofocus required />"
						+"</td></tr><tr><td><span>Descripcion: </span></td><td><textarea rows='5'></textarea></td></tr><tr><td><span>Categoria: </span>"
						+"</td><td><select><option value='volvo'>Volvo</option><option value='saab'>Saab</option><option value='mercedes'>Mercedes</option><option value='audi'>Audi</option>"
						+"</select></td></tr><tr><td><span>Imagen: </span></td><td>"
						+"<input class='entrada-texto' type='file' name='file'  multiple='' accept='image/jpeg, image/png' required>"
						+"</td></tr></table></form>");
	return false;
}