<?php require_once 'header.php'; ?>
<style>
    .animated {
    -webkit-transition: height 0.2s;
    -moz-transition: height 0.2s;
    transition: height 0.2s;
    }

    .stars
    {
        margin: 20px 0;
        font-size: 24px;
        color: #d17581;
    }
</style>
<div class="col-lg-9">
  <?php
      $product_id = $_GET['id'];
      $sql = 'SELECT products.*, images.Title AS ImageTitle, images.Filename FROM products INNER JOIN images ON products.ID = images.ProductID WHERE products.ID = ' . $product_id;

      $products = mysqli_query($conn, $sql);
      $product = mysqli_fetch_assoc($products);
  ?>
  <div class="card mt-4">
    <img class="card-img-top img-fluid" src="images/<?php echo $product['Filename']; ?>" alt="">
    <div class="card-body">
      <h3 class="card-title"><?php echo $product['Title']; ?></h3>
      <h4>
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
      </h4>
      <input type="number" class="quantity" value="1" />
      <button class="btn btn-primary atc" type="button" class="btn btn-primary">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>

        Add to cart
      </button>
      <p class="card-text"><?php echo $product['Description']; ?></p>

      <?php 
        $product_id = $_GET['id'];
        $sql = 'SELECT AVG(rating) FROM reviews WHERE productID = ' . $product_id;;
        $avg_rating = mysqli_query($conn, $sql);
        $stars = mysqli_fetch_assoc($avg_rating);
        // print_r($stars);             
      ?>

      
     
         <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
         <?php echo round($stars['AVG(rating)'])?> stars
      
      
    </div>
  </div>
  <!-- /.card -->

  <div class="card card-outline-secondary my-4">
    <div class="card-header">
      Product Reviews
    </div>
    

    <div class="card-body">
    <?php 
         $product_id = $_GET['id'];
        $sql = 'SELECT reviews.* ,products.ID FROM reviews 
        INNER JOIN products on reviews.productID = products.ID  WHERE reviews.productID ='. $product_id;
        $reviews = mysqli_query($conn, $sql);

       foreach($reviews as $review) {
        ?>          
          <p><?php echo $review['comment'] ?> </p>
          <small class="text-muted">Posted by <?php echo $review['user'] ?> on <?php echo $review['Date'] ?></small>
          <hr>

        <?php
       }
    ?>    
        <!-- <a href="leave_review.php?id=<?php echo $product_id?>" class="btn btn-success">Leave a Review</a> -->



        <div class="row" >
		<div class="col-12">
    	<div class="well well-sm">
            <div class="text-right">
                <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
            </div>
          <?php 

            // $sql = 'INSERT INTO reviews (productID, rating,comment) VALUES ( 1, 3, "aaa");';
            // $reviews = mysqli_query($conn, $sql);
          
          ?>
            <div class="row form-review" id="post-review-box"  style="display:none;">
                <div class="col-md-12">
                    <form id="form-review" accept-charset="UTF-8" action="" method="post">
                        <input id="ratings-hidden" name="rating" type="hidden"> 
                        <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
        
                        <div class="text-right">
                            <div class="stars starrr" data-rating="0"></div>
                            <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                            <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                            <button id="save" class="btn btn-success btn-lg" type="button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
         
		</div>
	</div>
    </div>
  </div>
  <!-- /.card -->

</div>
<!-- /.col-lg-9 -->
&#9733; &#9734;

<script>
  $(document).ready(function() {
   
    $(function(){
      var stars =  $(".text-warning");
      var rating = <?php echo round($stars['AVG(rating)'])?>; 
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
    
    $('.atc').on('click', function() {
      $.ajax({
        url: 'add_to_cart.php',
        type: 'post',
        data: {
          product: <?php echo $product_id; ?>,
          quantity: $('.quantity').val()
        },
        success: function(res) {
          alert('Added to cart!');
          
        }
      });
    });

    $('#save').on('click', function() {
      var all_fields = $('.form-review form').serializeArray();
      console.log(all_fields);
        // alert("work")
        $.ajax({
        url: 'review.php',
        type: 'post',
        data: {        
          fields: all_fields,
          product: <?php echo $product_id; ?>
        },
        success: function(res) {
          console.log(res);
          alert("thank`s")
          location.reload();
        }
      });
     
    });
  });
</script>

<?php require_once 'footer.php'; ?>