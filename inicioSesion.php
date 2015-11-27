<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
    <head>
        <meta charset="UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="js/login.js"></script>
        
    </head>
	<div class="contenido">
    <form id="login">

	 	<div class="wholeSesion">
            <div id="error"></div>
	 		<table class="carrito">
                <tr>
                	<td colspan="2" align="center"><h3 align="center">Iniciar Sesión</h3></td>
                </tr>
                	<form action="" method="post" autocomplete="off">
                <tr>             
                    <td align="right"><span class="icon_s"><img class="icono_sesion" src="Iconos/Correo2.png"></span></td>
                    <td><input id="usuario" class="form-control" type="text"  placeholder="Correo Electronico" autofocus="" required=""></td>
                </tr>
                <tr>
                    <td align="right"><span class="icon_s"><img class="icono_sesion" src="Iconos/candado.png"></span></td>
                    <td><input id="contrasenia" class="form-control" type="password"  placeholder="Contraseña" required=""></td>
                </tr>
                <tr>
                    <td></td><td align="right"><input type="submit" class="btn" id="boton" value="Ingresar" ></td>
                </tr>
                	</form>
            </table>
        </div><!--fin cuerpo-->
    </form>
	</div>
	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>