<?php include('encabezado.php'); ?>

<div id="wrapper">
  <div class="container">
  <div class="btn-group-vertical" role="group" aria-label="...">

  </div>
    <div class="row">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
        <ol class="carousel-indicators">
          <?php
            $n=5;
            for ($i=0; $i<$n; $i++){
              if ($i==0) printf ("<li data-target=\"#carousel-example-generic\" data-slide-to=\"0\"  class=\"active\"></li>");
              else printf ("<li data-target=\"#carousel-example-generic\" data-slide-to=\"%s\"></li>", $i);
            }
          ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

        <?php
          $db = Conectar();
          $query = "select producto.id, producto.tag, producto.nombre from producto order by producto.tag desc limit ".$n.";";
          $res = $db->query( $query );
          $i=1;
          foreach ($res-> fetchAll(PDO::FETCH_NUM) as $row ){
            $prodimg = $db->query( "select imagen.nombre from imagen where imagen.id_producto=".$row[0]." limit 1;" );
            if ($i==1){
              print('<div class="item active">');
              foreach ($prodimg-> fetchAll(PDO::FETCH_NUM) as $r) {
                printf('<center><a href="DescripcionProducto.php?id=%s"><img  src="%s" /></a></center>', $row[0],$r[0]);
              }
              // printf('<center><a href="DescripcionProducto.php?id=%s"><img  src="%s" /></a></center>', $row[0],$row[1]);
              printf('<div class="carousel-caption">%s</div></div>',$row[2]);
            } else {
              print('<div class="item">');
              foreach ($prodimg-> fetchAll(PDO::FETCH_NUM) as $r) {
                printf('<center><a href="DescripcionProducto.php?id=%s"><img  src="%s"/></a></center>',$row[0],$r[0]);
              }
              printf('<div class="carousel-caption">%s</div></div>',$row[2]);
            }
            
            $i=$i+1;
          }
        ?>

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Prev</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
  </div>
  </div>	
</div>
	
<?php include('pie_pagina.php'); ?>
