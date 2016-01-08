$(document).ready(function(){
	var xmlhttp;
	if(window.XMLHttpRequest)
		xmlhttp=new XMLHttpRequest();
	else
		xmlhttp=new ActiveObject("Microsoft.XMLHTTP");

	$("a[id=subcategorias]").click(function(){
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200 && xmlhttp.responseText=="true")//400 que no lo pudo encontrar //500 no pudo formar la pagina
				subcategorias();
			else
				if(xmlhttp.responseText=="false")
					window.location="index.html";
		}
		xmlhttp.open("GET","verifica.php",true);
		xmlhttp.send();
		return false;
    });

    $("a[id=productos]").click(function(){
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200 && xmlhttp.responseText=="true")//400 que no lo pudo encontrar //500 no pudo formar la pagina
				productos();
			else
				if(xmlhttp.responseText=="false")
					window.location="index.html";
		}
		xmlhttp.open("GET","verifica.php",true);
		xmlhttp.send();
		return false;
    });

    $("a[id=usuarios]").click(function(){
		 xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200 && xmlhttp.responseText=="true")//400 que no lo pudo encontrar //500 no pudo formar la pagina
				usuarios();
			else
				if(xmlhttp.responseText=="false")
					window.location="index.html";
		}
		xmlhttp.open("GET","verifica.php",true);
		xmlhttp.send();
		return false;
    });

    $("a[id=pedidos]").click(function(){
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200 && xmlhttp.responseText=="true")//400 que no lo pudo encontrar //500 no pudo formar la pagina
				pedidos();
			else
				if(xmlhttp.responseText=="false")
					window.location="index.html";
		}
		xmlhttp.open("GET","verifica.php",true);
		xmlhttp.send();
		return false;
    });

    $("a[id=reportes]").click(function(){
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200 && xmlhttp.responseText=="true")//400 que no lo pudo encontrar //500 no pudo formar la pagina
				reportes();
			else
				if(xmlhttp.responseText=="false")
					window.location="index.html";
		}
		xmlhttp.open("GET","verifica.php",true);
		xmlhttp.send();
		return false;
    });
});

function pedidos()
{
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
}

function usuarios()
{
	$.ajax({
		data: null,
    	url:   'usuarios.php',
        type:  'POST',
        beforeSend: function () {
       		$("#titulo").html("<span>Usuarios</span>");
        },
        success:  function (response) {
       		if(response=="true")
	           	$("#contenido").html("<p>Tabla de datos de Usuarios</p>");
	    }
	});
}

function productos()
{
	$.ajax({
		data: null,
    	url:   'producto/consulta.php',
	    type:  'post',
        beforeSend: function () {
       		$("#titulo").html("<span>Productos</span>");
       		var newlink = document.createElement('a');
			newlink.setAttribute('id', 'addproducto');
			newlink.setAttribute('href', ' ');
			newlink.innerHTML = "<img class='ico-acciones' src='img/agregar.png'/>Agregar Producto";
			newlink.onclick = formaddproducto;
    		document.getElementById('titulo').appendChild(newlink);
		},
	    success:  function (response) {
	    	$("#contenido").html(response);
	    }
	});
}

function agrproducto()
{
	var datos= {
		"nombre" :  $("#nombre").val(),
		"marca":  $("#marca").val(),
		"precio":  $("#precio").val(),
		"descripcion":  $("#descripcion").val(),
		"idsubcategoria" : $("#idsubcategoria").val()
	};
	$.ajax({
		data: datos,
	  	url:   'producto/agregar.php',
	    type:  'POST',
	    beforeSend: function () {
	   		$("#titulo").html("<span>Agregar Producto</span>");
	    },
	    success:  function (response) {
		   $("#contenido").html(response+"<center><input type='submit' value='Aceptar' onclick='productos();' class='aceptar'/></center>");
		}
	});
	return false;
}

function verproductos(id,sub)
{
	var datos= {
		"id" : id,
		"sub":sub
	};
	$.ajax({
		data: datos,
	  	url:   'producto/ver.php',
	    type:  'post',
	     beforeSend: function () {
	   	$("#titulo").html("<span>Ver Producto</span>");
	    	var newlink = document.createElement('a');
			newlink.setAttribute('id', 'addcategoria');
			newlink.setAttribute('href', ' ');
			newlink.innerHTML = "<img class='ico-acciones' src='img/agregar.png'/>Agregar Subategoria";
			newlink.onclick = formaddcategoria;
	   		document.getElementById('titulo').appendChild(newlink);
	    },
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}
function verProductosSubcategoria(id)
{
	var datos= {
		"id" : id
	};
	$.ajax({
		data: datos,
    	url:   'producto/consultaporcategoria.php',
	    type:  'post',
        beforeSend: function () {
       		$("#titulo").html("<span>Productos por Subcategoria</span>");
		},
	    success:  function (response) {
	    	$("#contenido").html(response);
	    }
	});
	return false;
}

function eliproductos(id,sub)
{
	var datos= {
		"id" : id,
		"sub":sub,
		"acc": "eli"
	};
	$.ajax({
		data: datos,
	  	url:   'producto/eliminar.php',
	    type:  'post',
	    beforeSend: function () {
	   		$("#titulo").html("<span>Eliminar Producto</span>");
	    },
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}
function delproductos(id,sub)
{
	var datos= {
		"id" : id,
		"sub": sub,
		"acc": "del"
	};
	$.ajax({
		data: datos,
	  	url:   'producto/eliminar.php',
	    type:  'post',
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}

function modproductos(id,sub)
{
	var datos= {
		"id" : id,
		"sub":sub,
		"acc": "mod"
	};
	$.ajax({
		data: datos,
	  	url:   'producto/modificar.php',
	    type:  'post',
	   	beforeSend: function () {
	   		$("#titulo").html("<span>Modificar Producto</span>");
	    },
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}

function updproductos(id,sub)
{
	var datos= {
		"acc": "upd",
		"id": id,
		"nombre" :  $("#nombre").val(),
		"marca":  $("#marca").val(),
		"precio":  $("#precio").val(),
		"descripcion":  $("#descripcion").val(),
		"idsubcategoria" : $("#idsubcategoria").val(),
		"sub" : sub	};
	$.ajax({
		data: datos,
	  	url:   'producto/modificar.php',
	    type:  'post',
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}

function subcategorias()
{
	$.ajax({
		data: null,
	  	url:   'subcategoria/consulta.php',
	    type:  'post',
	    beforeSend: function () {
	   	$("#titulo").html("<span>Subcategorias</span>");
	    	var newlink = document.createElement('a');
			newlink.setAttribute('id', 'addcategoria');
			newlink.setAttribute('href', ' ');
			newlink.innerHTML = "<img class='ico-acciones' src='img/agregar.png'/>Agregar Subategoria";
			newlink.onclick = formaddcategoria;
	   		document.getElementById('titulo').appendChild(newlink);
	    },
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
}

function agrsubcategoria()
{
	var datos= {
		"nombre" :  $("#nombre").val(),
		"idcategoria" : $("#idcategoria").val()
	};
	$.ajax({
		data: datos,
	  	url:   'subcategoria/agregar.php',
	    type:  'post',
	    beforeSend: function () {
	   		$("#titulo").html("<span>Agregar Subcategorias</span>");
	    },
	    success:  function (response) {
	    	$("#contenido").html(response+"<center><input type='submit' value='Aceptar' onclick='subcategorias();' class='aceptar'/></center>");
		}
	});
	return false;
}

function versubcategoria(id)
{
	var datos= {
		"id" : id
	};
	$.ajax({
		data: datos,
	  	url:   'subcategoria/ver.php',
	    type:  'post',
	     beforeSend: function () {
	   	$("#titulo").html("<span>Ver Subcategoria</span>");
	    	var newlink = document.createElement('a');
			newlink.setAttribute('id', 'addcategoria');
			newlink.setAttribute('href', ' ');
			newlink.innerHTML = "<img class='ico-acciones' src='img/agregar.png'/>Agregar Subategoria";
			newlink.onclick = formaddcategoria;
	   		document.getElementById('titulo').appendChild(newlink);
	    },
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}

function elisubcategoria(id)
{
	var datos= {
		"id" : id,
		"acc": "eli"
	};
	$.ajax({
		data: datos,
	  	url:   'subcategoria/eliminar.php',
	    type:  'post',
	    beforeSend: function () {
	   		$("#titulo").html("<span>Eliminar Subcategoria</span>");
	    },
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}
function delsubcategoria(id)
{
	var datos= {
		"id" : id,
		"acc": "del"	
	};
	$.ajax({
		data: datos,
	  	url:   'subcategoria/eliminar.php',
	    type:  'post',
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}

function modsubcategoria(id)
{
	var datos= {
		"id" : id,
		"acc": "mod"
	};
	$.ajax({
		data: datos,
	  	url:   'subcategoria/modificar.php',
	    type:  'post',
	   	beforeSend: function () {
	   		$("#titulo").html("<span>Modificar Subcategorias</span>");
	    },
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}

function updsubcategoria(id)
{
	var datos= {
		"id" : id,
		"acc": "upd",
		"nombre" :  $("#nombre").val(),
		"idcategoria" : $("#idcategoria").val()
	};
	$.ajax({
		data: datos,
	  	url:   'subcategoria/modificar.php',
	    type:  'post',
	    success:  function (response) {
		   	$("#contenido").html(response);
		}
	});
	return false;
}

function formaddcategoria(){
	$.ajax({
		data: null,
    	url:   'categoria/consulta.php',
        type:  'post',
         beforeSend: function () {
       		$("#titulo").html("<span>Agregar Subcategorias</span>");
        },
        success:  function (response) 
        {
			$("#contenido").html("<form onSubmit='return agrsubcategoria();'><table>"+
				"<tr><td><span class='r'>Nombre: </span></td><td><input class='entrada-texto' name='nombre' id='nombre' type='text' placeholder='Nombre de la categoria' autofocus required /></td><td>"+
				"<tr><td><span class='r'>Categoria: </span></td><td>"+response+"</td></tr></table>"+
				"<center><input type='submit' value='Aceptar' class='aceptar'/> "+
				"<input type='button' value='Cancelar' onclick='subcategorias()' class='cancelar'/></center></form>");
	    }
	});
	
	return false;
}

function formaddproducto(){
	$.ajax({
		data: null,
    	url:   'subcategoria/select.php',
        type:  'post',
         beforeSend: function () {
       		$("#titulo").html("<span>Agregar Producto</span>");
        },
        success:  function (response) 
        {
			$("#contenido").html(" <form enctype='multipart/form-data' id='formuploadajax' method='post' onSubmit='return agrproducto();' ><table><tr><td><span class='r'>Nombre: </span>"
				+"</td><td><input class='entrada-texto' id='nombre' type='text' placeholder='Nombre del producto' autofocus required />"
				+"</td></tr><tr><td><span class='r'>Marca: </span></td><td><input class='entrada-texto' id='marca' type='text' placeholder='Marca' autofocus required />"
				+"</td></tr><tr><td><span class='r'>Precio: </span></td><td><input class='entrada-texto' id='precio' min='1' type='number' placeholder='Precio' autofocus required />"
				+"</td></tr><tr><td><span class='r'>Descripcion: </span></td><td><textarea rows='5' id='descripcion' required></textarea></td></tr><tr><td><span class='r'>Subcategoria: </span>"
				+"</td><td>"+response+"</td></tr>"
				//+"<tr><td><span class='r'>Imagen: </span></td><td><input class='entrada-texto' type='file' id='file'  multiple='' accept='image/jpeg, image/png' required>"
				+"</td></tr></table>"
				+"<center><input type='submit' value='Aceptar' class='aceptar'/> "
				+"<input type='button' value='Cancelar' onclick='productos();' class='cancelar'/></center></form>");
		}
	});
	return false;
}

function reportes()
{
	
       		$("#titulo").html("<span>Reportes</span>");
       
	        $("#contenido").html("<br><table><tr><td class= 'col'><span><label>Clientes</label></span></td>"
	        					+"<td class= 'col'><select><option value='1'>Juan Pérez</option><option value='2'>José López</option><option value='3'>Miguel Ponce</option><option value='4'>Omar Rodríguez</option>"
								+"</select><br><br></td><td></td><td><button onclick='genrep()'>Generar</button></td></tr>"
	        					+"<tr><td class= 'col'><span><label>Pedidos</label></span><br><br></td><td class= 'col'><input type='date' name='fecha'></td><td class= 'col'><input type='date' name='fecha'><td class= 'col'><button onclick='genrep()'>Generar</button></td></td></tr>"
	        					+"<tr><td class= 'col'><span><label>Productos</label></span><br><br></td><td class= 'col'><select><option value='1'>Asus</option><option value='2'>HP</option><option value='3'>Toshiba</option><option value='4'>Sony</option></select></td><td class= 'col'><select><option value='1'>Todo</option><option value='2'>Más vendidos</option></select><td class= 'col'><button onclick='genrep()'>Generar</button></td></td></tr>"
	        					+"<tr><td class= 'col'><span><label>Ventas</label></span><br><br><td class= 'col'><input type='date' name='fecha'></td><td class= 'col'><input type='date' name='fecha'></td><td class= 'col'><button onclick='genrep()'>Generar</button></td></tr></table>");
	
}

function genrep()
{
	window.open("pdf2.php");
}

