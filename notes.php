<!--Advertisement code in registration_package-->


<div class="container" style="margin-bottom: 60px;">
  <div class="row">
			<h1>Adverisements</h1><hr>
        <!-- Advertsement Carousel-->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
              <?php 
                      $sql1="select Advertisement_img from advertisement";
                      $res1=$db->query($sql1);
                      if($res1->num_rows>0)
                      {
                        while($row1=$res1->fetch_assoc())
                       {
                      
                                    echo  '
                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="images/advertisement/'.$row1['Advertisement_img'].'" alt="First slide">
                                    </div>';
                                        
                       }             
                       
                      }
                ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

		
  </div>
</div>
