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
                  $query = "select imagen.nombre, producto.tag, producto.nombre from imagen, producto where imagen.id_producto=producto.id order by producto.tag desc limit ".$n.";";
                  $res = $db->query( $query );
                  $i=1;
                  foreach ($res-> fetchAll(PDO::FETCH_NUM) as $row ){
                      if ($i==1){
                          printf ("<div class=\"active item\"><center><br><img  src=\"%s\" width='500' height='300' alt=\"banner1\" /> <br>%s </center></div>", $row[0], $row[2]);
                      } else printf ("<div class=\"item\"><center><img  src=\"%s\" width='500' height='300' alt=\"banner%s\" /> <br>%s </center></div>", $row[0], $i, $row[2]);
                      
                      $i=$i+1;
                  }
                ?>
            </div>
            <!-- Carousel nav -->
            <a  class="carousel-control left car" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right car" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
      </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.myCarousel').carousel({
                interval: 3000
            });
        });
    </script>
		
	</div>
	<!--................................................................. -->
<?php include('pie_pagina.php'); ?>
