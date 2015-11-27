<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
    <head>
        <meta charset="UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="js/login.js"></script>
        <script languaje="JavaScript"> 
            <!--FUNCION QUE VALIDA  LA  EXPRESON REGULAR-->

            function direccionEmail(theElement, nombre_del_elemento )
            {
                var evaluar = theElement.value;
                var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
                if (evaluar.length == 0 ) 
                    return true;
                if (filter.test(evaluar))
                    return true;
                else
                    alert("E-mail incorrecto");
                        theElement.focus();
                    return false;
        }
        </script> 
        
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
                    <td><input id="correo" class="form-control" type="email"  placeholder="Correo Electronico" autofocus="" required=""></td>
                </tr>
                <tr>
                    <td align="right"><span class="icon_s"><img class="icono_sesion" src="Iconos/candado.png"></span></td>
                    <td><input id="contrasena" class="form-control" type="password"  placeholder="Contraseña" required=""></td>
                </tr>
                <tr>
                    <td></td><td align="right"><input type="submit" class="btn" id="boton" value="Ingresar"  ></td>
                </tr>
                	</form>
            </table>
        </div><!--fin cuerpo-->
    </form>
	</div>
	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>