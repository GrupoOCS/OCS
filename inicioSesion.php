<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<div class="contenido">

	 	<div class="wholeSesion">
	 		<table class="carrito">
                <tr>
                	<td colspan="2" align="center"><h3 align="center">Iniciar Sesión</h3></td>
                </tr>
                	<form action="" method="post" autocomplete="off">
                <tr>             
                    <td align="right"><span class="icon_s"><img class="icono_sesion" src="Iconos/Correo2.png"></span></td>
                    <td><input name="usuario" class="form-control" type="text"  placeholder="Correo Electronico" autofocus="" required=""></td>
                </tr>
                <tr>
                    <td align="right"><span class="icon_s"><img class="icono_sesion" src="Iconos/candado.png"></span></td>
                    <td><input name="contrasenia" class="form-control" type="password"  placeholder="Contraseña" required=""></td>
                </tr>
                <tr>
                    <td></td><td align="right"><input type="submit" class="btn" name="submit" value="Ingresar" ></td>
                </tr>
                	</form>
            </table>
        </div><!--fin cuerpo-->
	</div>
	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>