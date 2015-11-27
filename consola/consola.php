<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css-jss/estilos.css">
<title>Inicio Sesion :: Administrador</title>
</head>
<body>
	<div class="encabezado">
		<table class="encabezado-table"  ALIGN="RIGHT">
			<tr>					
				<td>
					<img class="encabezado-ico" src="img/l_usuario.png"/>
				</td>
				<td>
					<label>Administrador</label>
				</td>
		   	</tr>
		   	<tr>
				<td></td><td>
					<a href="">Cerrar sesión</a>
				</td>
		   	</tr>
		  </table>
	</div>
	<div class="menu">
		<label>MENÚ</label>
		<a href="">Categorias</a>
		<a href="">Productos</a>
		<a href="">Usuarios</a>
	</div>
	<div class="lista">
		<div class="titulo">
			<span>Categorias</span>
			<a href="">
				<img class="ico-acciones" src="img/agregar.png"/>Agregar Categoria
			</a>
		</div>
		<div class="contenido">
			<form action="" method="post" enctype="multipart/form-data">
				<table >
					<tr>					
						<td>
							<span>Nombre: </span>
						</td>
						<td>
							<input class="entrada-texto" name="nombre" id="nombre" type="text" placeholder="Nombre del producto" autofocus required />
						</td>
				   	</tr>
				   	<tr>					
						<td>
							<span>Marca: </span>
						</td>
						<td>
							<input class="entrada-texto" name="nombre" id="nombre" type="text" placeholder="Marca" autofocus required />
						</td>
				   	</tr>
				   	<tr>					
						<td>
							<span>Precio: </span>
						</td>
						<td>
							<input class="entrada-texto" name="nombre" id="nombre" type="number" placeholder="Precio" autofocus required />
						</td>
				   	</tr>
				   	<tr>					
						<td>
							<span>Descripcion: </span>
						</td>
						<td>
							<textarea rows="5"></textarea>
						</td>
				   	</tr>
				   	<tr>					
						<td>
							<span>Categoria: </span>
						</td>
						<td>
							<select>
								<option value="volvo">Volvo</option>
								<option value="saab">Saab</option>
								<option value="mercedes">Mercedes</option>
								<option value="audi">Audi</option>
							</select>
						</td>
				   	</tr>
				   	<tr>					
						<td>
							<span>Imagen: </span>
						</td>
						<td>
							<input class="entrada-texto" type="file" name="file"  multiple="" accept="image/jpeg, image/png" required>
						</td>
				   	</tr>
				</table>
			</form>
		</div>
		

	</div>
</body>


</html>
