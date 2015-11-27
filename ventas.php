<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	
	<?php
		//AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA 
		if(isset($_GET['page']))
		{
		    $page= $_GET['page'];
		}
		else
		{
		    //SI NO DIGO Q ES LA PRIMERA PÁGINA
		    $page=1;
		}

		//ACA SE SELECCIONAN TODOS LOS DATOS DE LA TABLA
		/*$consulta="SELECT * FROM peliculas";
		$datos=mysql_query($consulta,$conn);*/
		  
		//MIRO CUANTOS DATOS FUERON DEVUELTOS
		//$num_rows=mysql_num_rows($datos);
		$num_rows=9;
		  
		//ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15
		//$rows_per_page= 15;
		$rows_per_page=9;
		  
		//CALCULO LA ULTIMA PÁGINA
		$lastpage= ceil($num_rows / $rows_per_page);
		  
		//COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA PÁGINA
		$page=(int)$page;
		 
		if($page > $lastpage){
		    $page= $lastpage;
		}
		 
		if($page < 1){
		    $page=1;
		}
		  
		//CREO LA SENTENCIA LIMIT PARA AÑADIR A LA CONSULTA QUE DEFINITIVA
		$limit= 'LIMIT '. ($page -1) * $rows_per_page . ',' .$rows_per_page;
		  
		//REALIZO LA CONSULTA QUE VA A MOSTRAR LOS DATOS (ES LA ANTERIO + EL $limit)
		$consulta .=" $limit";
		$peliculas=mysql_query($consulta,$conn);
		  
		if(!$peliculas)
		{
		        //SI FALLA LA CONSULTA MUESTRO ERROR
		        die('Invalid query: ' . mysql_error());
		}
		else
		{
		      //SI ES CORRECTA MUESTRO LOS DATOS 
		      ?> <table>
		            <thead>
		                <tr><th>Título</th><th>Director</th><th> A&ntilde;o de producci&oacute;n</th></tr>
		            </thead>
		            <tbody>
		    <?php while($row = mysql_fetch_assoc($peliculas))
		          {  ?>
		         
		            <tr><td><?php echo $row['nombre']; ?> </td><td> <?php echo $row['director']; ?> </td><td> <?php echo $row['anio']; ?> </td></tr>
		   <?php  } ?>
		            </tbody>
		        </table>
		<?php
		    //UNA VEZ Q MUESTRO LOS DATOS TENGO Q MOSTRAR EL BLOQUE DE PAGINACIÓN SIEMPRE Y CUANDO HAYA MÁS DE UNA PÁGINA
		      
		    if($numrows != 0)
		    {
		       $nextpage= $page +1;
		       $prevpage= $page -1;
		     
		       ?><ul id="pagination-digg"><?php
		           //SI ES LA PRIMERA PÁGINA DESHABILITO EL BOTON DE PREVIOUS, MUESTRO EL 1 COMO ACTIVO Y MUESTRO EL RESTO DE PÁGINAS
		           if ($page == 1) 
		           {
		            ?>
		              <li class="previous-off">&laquo; Previous</li>
		              <li class="active">1</li> 
		         <?php
		              for($i= $page+1; $i<= $lastpage ; $i++)
		              {?>
		                <li><a href="busquedas.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
		        <?php }
		           
		           //Y SI LA ULTIMA PÁGINA ES MAYOR QUE LA ACTUAL MUESTRO EL BOTON NEXT O LO DESHABILITO
		            if($lastpage >$page )
		            {?>      
		                <li class="next"><a href="busquedas.php?page=<?php echo $nextpage;?>" >Next &raquo;</a></li><?php
		            }
		            else
		            {?>
		                <li class="next-off">Next &raquo;</li>
		        <?php
		            }
		        } 
		        else
		        {
		     
		            //EN CAMBIO SI NO ESTAMOS EN LA PÁGINA UNO HABILITO EL BOTON DE PREVIUS Y MUESTRO LAS DEMÁS
		        ?>
		            <li class="previous"><a href="busquedas.php?page=<?php echo $prevpage;?>">&laquo; Previous</a></li><?php
		             for($i= 1; $i<= $lastpage ; $i++)
		             {
		                           //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO
		                if($page == $i)
		                {
		            ?>       <li class="active"><?php echo $i;?></li><?php
		                }
		                else
		                {
		            ?>       <li><a href="busquedas.php?page=<?php echo $i;?>" ><?php echo $i;?></a></li><?php
		                }
		            }
		             //Y SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT     
		            if($lastpage >$page )
		            {   ?>   
		                <li class="next"><a href="busquedas.php?page=<?php echo $nextpage;?>">Next &raquo;</a></li><?php
		            }
		            else
		            {
		        ?>       <li class="next-off">Next &raquo;</li><?php
		            }
		        }     
		    ?></ul></div><?php
		    } 
		}
	?>


	<div class="contenido">

		<div class="producto"><img class="producto" src="Productos/1comp.jpg"></div>
		<div class="producto"><img class="producto" src="Productos/2comp.jpg"></div>
		<div class="producto"><img class="producto" src="Productos/3comp.jpg"></div>
		<div class="producto"><img class="producto" src="Productos/4comp.jpg"></div>
		<div class="producto"><img class="producto" src="Productos/5comp.jpg"></div>
		<div class="producto"><img class="producto" src="Productos/6comp.jpg"></div>
		<div class="producto"><img class="producto" src="Productos/7comp.jpg"></div>
		<div class="producto"><img class="producto" src="Productos/9comp.jpg"></div>
		
	</div>

	<center>
		<ul id="pagination-digg">
			<li class="previous-off">«Previous</li>
			<li class="active">1</li>
			<li><a href="?page=2">2</a></li>
			<li><a href="?page=3">3</a></li>
			<li><a href="?page=4">4</a></li>
			<li><a href="?page=5">5</a></li>
			<li><a href="?page=6">6</a></li>
			<li><a href="?page=7">7</a></li>
			<li class="next"><a href="?page=8">Next »</a></li>
		</ul>
	</center>

	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>

