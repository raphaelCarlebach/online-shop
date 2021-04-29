<?php require_once 'header.php'; ?>

<div class="col-lg-9">
  <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
      </div>
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

  <div class="row">
    <?php
    
    $cat_id = $_GET['cat'];
    $sql = 'SELECT products.* , products_categories.CategoryID, products_categories.ProductID , categories.ID AS catID, images.Title AS ImageTitle, images.Filename FROM products INNER JOIN images ON products.ID = images.ProductID INNER JOIN products_categories ON products.ID = products_categories.ProductID INNER JOIN categories ON categories.ID = products_categories.CategoryID WHERE categories.ID = ' . $cat_id; 
    

      $products = mysqli_query($conn, $sql);
      foreach($products as $product) {
    ?>
      <div class="col-lg-4 col-md-6 mb-4 product">
        <div class="card h-100">
          <a href="product.php?id=<?php echo $product['ID'];; ?>"><img class="card-img-top" src="images/<?php echo $product['Filename']; ?>" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="product.php?id=<?php echo $product['ID'];; ?>"><?php echo $product['Title']; ?></a>
            </h4>
            <h5>
            <?php
              $price = $product['Price'];
              $saleprice = $product['SalePrice'];
              
              if ($saleprice > 0) {
            ?>
              <del>$<?php echo $price; ?></del>
              <ins>$<?php echo $saleprice; ?></ins>
            <?php
              } else {
            ?>
              <ins>$<?php echo $price; ?></ins>
            <?php
              }
            ?>
              <div class="percentage">
              </div>
            </h5>
            <p class="card-text">
            <?php
              $description = $product['Description'];
              if (str_word_count($description) > 10) { //אם התיאור גדול מ-10 מילים
                $words = str_word_count($description, 2); //תייצר מערך לפי מיקומי המילים
                $position = array_keys($words); //תייצר מערך לפי מפתחות
                $final_desc = substr($description, 0, $position[10]) . '...';
              } else {
                $final_desc = $description;
              }

              echo $final_desc;
            ?>
            </p>
          </div>
          <div class="card-footer">
          <?php 
            //  inner join???
              $sql = 'SELECT AVG(rating) FROM reviews WHERE productID = ' . $product['ID'];
              $avg_rating = mysqli_query($conn, $sql);
              $stars = mysqli_fetch_assoc($avg_rating);
              // print_r($stars);
                           
            ?>      
     
         <span name=" <?php echo round($stars['AVG(rating)'])?>" class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
        
          </div>
        </div>
      </div>
    <?php
      }
    ?>
  </div>
  <!-- /.row -->

</div>
<!-- /.col-lg-9 -->

<script>

 $(document).ready(function(){
      $(".product").each(function() {        
      var stars =  $(this).find(".text-warning");
      var rating = $(this).find(".text-warning").attr("name"); 
      console.log (rating);
      if(rating <= 0){
        stars.html("&#9734; &#9734; &#9734; &#9734; &#9734;"); 
      } else if(rating == 1){
        stars.html("&#9733; &#9734; &#9734; &#9734; &#9734;"); 
      } else if(rating == 2){
        stars.html("&#9733; &#9733; &#9734; &#9734; &#9734;"); 
      } else if(rating == 3){
        stars.html("&#9733; &#9733; &#9733; &#9734; &#9734;"); 
      } else if(rating == 4){
        stars.html("&#9733; &#9733; &#9733; &#9733; &#9734;"); 
      } else if(rating >= 5){
        stars.html("&#9733; &#9733; &#9733; &#9733; &#9733;"); 
      }; 

      });    

    });  

</script>

<?php require_once 'footer.php'; ?>