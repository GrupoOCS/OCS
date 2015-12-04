
<?php include('encabezado.php'); ?>
 
<div class="contenido">
	<div class="desc-imagen">
		<img style="width:100%; height:100%;" src="Productos/1lap.jpg">

	</div>
	<div class="desc-texto">
		<h3><center>Laptop- Nombre del producto</center></h3>
		<div style="color:green; text-align:center;"> Disponible  : 50</div>
		<p class="texto-descripcion">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>
		<table class="describe">
			<tr>
				<td>Marca:</td><td> ASUS </td>
			</tr>
			<tr>
				<td>Modelo:</td><td> 75337 </td>
			</tr>
			<tr>
				<td>Capacidad:</td><td> 1tb </td>
			</tr>
			<tr>
				<td>RAM:</td><td> 500MB </td>
			</tr>
		</table>

	</div>
	<div class="desc-agregar">
		<div class="d-cantidad">
			<fieldset class="field">
			<form>
			<label style="position:relative; height:25%; padding:4%; float:left; width:42%;">
				Cantidad:</label>
			<input name="cantidad" value="1" style=" position:relative; float:left; width:50%" type="number" class="form-control" min="1">
			
				
				<input type="submit" class="btn grande desc-carrito" value="Agregar al Carrito">

		</form>
		</fieldset>
		</div>

	</div>

</div>
<?php include('pie_pagina.php'); ?>


