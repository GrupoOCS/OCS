<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<div class="contenido_car">
	    <script src="http://code.jquery.com/jquery.js"></script>
      <script src="js/bootstrap.min.js"></script>

      <div id="container">
        <div id="myCarousel" class="carousel slide">
            <ol class="carousel-indicators">
              <?php
                $n=5;
                for ($i=0; $i<$n; $i++){
                  if ($i==0) printf ("<li data-target=\"#myCarousel\" data-slide-to=\"0\"  class=\"active\"></li>");
                  else printf ("<li data-target=\"#myCarousel\" data-slide-to=\"%s\"></li>", $i);
                }
              ?>
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">

                <?php
                  //include 'abrirConexion.php';
                  $db = Conectar();
                  $query = "select producto.id, imagen.nombre, producto.tag, producto.nombre from imagen, producto where imagen.id_producto=producto.id order by producto.tag desc limit ".$n.";";
                  $res = $db->query( $query );
                  $i=1;
                  foreach ($res-> fetchAll(PDO::FETCH_NUM) as $row ){
                      if ($i==1){
                          printf ("<div class=\"active item\"><center><br> <a href=\"DescripcionProducto.php?id=%s\"><img  src=\"%s\"  alt=\"banner1\" /></a> <br>%s</center></div>", $row[0], $row[1], $row[3]);
                      } else printf ("<div class=\"item\"><center><a href=\"DescripcionProducto.php?id=%s\"><img  src=\"%s\" alt=\"banner%s\" /></a> <br>%s </center></div>", $row[0], $row[1], $i, $row[3]);
                      
                      $i=$i+1;
                  }
                ?>
            </div>
            <!-- Carousel nav -->
            <a  class="carousel-control left car" href="#myCarousel" data-slide="prev"><!-- &lsaquo; --><img  src="Iconos/anterior.png"  alt=\"banner1\" /></a>
            <a class="carousel-control right car" href="#myCarousel" data-slide="next"><!-- &rsaquo; --><img  src="Iconos/siguiente.png"  alt=\"banner1\" /></a>
        </div>
      </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.myCarousel').carousel({
                interval: 500
            });
        });
    </script>
		
	</div>
	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>
