<?php include('encabezado.php'); ?>
	<!--.............................TERMINA NAVEGACIÓN...............................-->
	<div class="contenido">
			<script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
     <div id="container">
      <div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
          <li data-target="#myCarousel" data-slide-to="4"></li>
          <li data-target="#myCarousel" data-slide-to="5"></li>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
          <div class="active item"><center><img  src="img/img1.jpg" alt="banner1" /></center></div>
          <div class="item"><center><img  src="img/img2.jpg" alt="banner2" /></center></div>
          <div class="item"><center><img  src="img/img3.jpg" alt="banner3" /></center></div>
          <div class="item"><center><img  src="img/img4.jpg" alt="banner4" /></center></div>
          <div class="item"><center><img  src="img/img5.jpg" alt="banner5" /></center></div>
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