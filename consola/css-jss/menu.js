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
        type:  'post',
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
    	url:   'productos.php',
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
        	if(response=="true")
	          	$("#contenido").html("<p>Tabla de datos de Productos</p>");
	    }
	});
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
	//alert("addcategoria");
	var select;
	$.ajax({
		data: null,
    	url:   'categoria/consulta.php',
        type:  'post',
         beforeSend: function () {
       		$("#titulo").html("<span>Agregar Categorias</span>");
        },
        success:  function (response) 
        {
			$("#contenido").html("<table>"+
				"<tr><td><span class='r'>Nombre: </span></td><td><input class='entrada-texto' name='nombre' id='nombre' type='text' placeholder='Nombre de la categoria' autofocus required /></td><td>"+
				"<tr><td><span class='r'>Categoria: </span></td><td>"+response+"</td></tr></table>"+
				"<center><input type='submit' value='Aceptar' onclick='agrsubcategoria();' class='aceptar'/> "+
				"<input type='submit' value='Cancelar' onclick='subcategorias();' class='cancelar'/></center>");
	    }
	});
	
	return false;
}

function formaddproducto(){
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

function reportes()
{
	$.ajax({
		data: null,
    	url:   'usuarios.php',
        type:  'post',
        beforeSend: function () {
       		$("#titulo").html("<span>Reportes</span>");
        },
        success:  function (response) 
        {
	        $("#contenido").html("<br><table><tr><td class= 'col'><span class='r'><label>Clientes</label></span></td>"
	        					+"<td class= 'col'><select><option value='1'>Juan Pérez</option><option value='2'>José López</option><option value='3'>Miguel Ponce</option><option value='4'>Omar Rodríguez</option>"
								+"</select><br><br></td><td></td><td><button>Generar</button></td></tr>"
	        					+"<tr><td class= 'col'><span class='r'><label>Pedidos</label></span><br><br></td><td class= 'col'><input class='date' type='date' name='fecha'></td><td class= 'col'><input class='date' type='date' name='fecha'><td class= 'col'><button>Generar</button></td></td></tr>"
	        					+"<tr><td class= 'col'><span class='r'><label>Productos</label></span><br><br></td><td class= 'col'><select><option value='1'>Asus</option><option value='2'>HP</option><option value='3'>Toshiba</option><option value='4'>Sony</option></select></td><td class= 'col'><select><option value='1'>Todo</option><option value='2'>Más vendidos</option></select><td class= 'col'><button>Generar</button></td></td></tr>"
	        					+"<tr><td class= 'col'><span class='r'><label>Ventas</label></span><br><br><td class= 'col'><input class='date' type='date' name='fecha'></td><td class= 'col'><input class='date' type='date' name='fecha'></td><td class= 'col'><button>Generar</button></td></tr></table>");
	    }
	});
}

