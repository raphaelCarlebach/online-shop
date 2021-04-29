<?php require 'header.php'; ?>
<style>
    table img {
        width: 30px;
        margin-right: 10px;
    }
</style>

<div class="col-lg-9">
  <div class="card mt-4">
    <div class="card-body">
      <h3 class="card-title">Checkout</h3>
      <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (isset($_SESSION['cart'])) {
              if (isset($_GET['del'])) {
                unset($_SESSION['cart'][$_GET['del']]);
              }

              $cart = $_SESSION['cart'];
            } else {
              $cart = [];
            }
            $total = 0;
            foreach ($cart as $index => $item) {
                $sql = 'SELECT products.*, images.Title AS ImageTitle, images.Filename FROM products INNER JOIN images ON products.ID = images.ProductID WHERE products.ID = ' . $item['product'];
                $query = mysqli_query($conn, $sql);
                $product = mysqli_fetch_assoc($query);
                $quantity = $item['quantity'];

                $price = $product['Price'];
                $saleprice = $product['SalePrice'];
                
                if ($saleprice != NULL) {
                    $final_price = $saleprice;
                } else {
                    $final_price = $price;
                }

                $total = $total + ($final_price * $quantity);

                $session_id = session_id();
                // echo $session_id;
                // echo ("<pre>");
                //   print_r($item);                
                //   print_r($product);                
                // echo ("</pre>");
              
               
              ?>
                <tr class="cart_info">
                    <td>      
                            <input type="hidden" class="product" value="<?php echo $item['product']; ?>"/>
                            <input type="hidden" class="quantity" value="<?php echo $item['quantity']; ?>"/>
                            <input type="hidden" class="session_id" value="<?php echo $session_id; ?>"/>

                           <img src="images/<?php echo $product['Filename']; ?>" /><?php echo $product['Title']; ?>
                    </td>
                    <td><?php echo $quantity; ?></td>
                    <td>$<?php echo number_format($final_price); ?></td>
                   
                    <td><a href="?del=<?php echo $index; ?>" class="delete btn btn-danger">X</a></td>                    
                   
                </tr>
                
        <?php       
            }
        ?>
        <tfoot>
            <tr>
                <td><a id="order_now" href="#" class="btn btn-success">Order now</a></td>
                <td> </td>
                <td>$<?php echo number_format($total); ?></td>
            </tr>
        </tfoot>
        </tbody>
      </table>
  </div>
  <!-- /.card -->
</div>
<!-- /.col-lg-9 -->

<script>
  $(document).ready(function() {     
       
    $('#order_now').on('click', function(){ 

      $("tr.cart_info").each(function(){
        let session_id = $(this).find(".session_id").val();
        let product = $(this).find(".product").val();
        let quantity = $(this).find(".quantity").val();  

        console.log(session_id);    
        console.log(product);    
        console.log(quantity);    
    
        console.log("work");  

        $.ajax({
          url: 'save_order.php',
          type: 'post',
          data: {
            session_id: session_id,
            product: product,
            quantity: quantity  
          },
          success: function(res) {
            console.log(res)
            location.replace("order.php?cart=<?php echo $session_id; ?>");
          }
        });
      });  
    });   
        
  });
</script>

<?php require_once 'footer.php'; ?>