<?php
require_once 'header.php';
require 'dbcon.php';
?> 
<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        /* border: 1px solid #eee; */
        /* box-shadow: 0 0 10px rgba(0, 0, 0, .15); */
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>


<div class="col-lg-9">
  
  <!-- /.card -->

  <div class="card card-outline-secondary my-4">
    <div class="card-header">
     <h4>My order details </h4>
     <small>notic: the transaction will <b>not</b> by completed until you confirm and  ressive an email authorization</small>
    </div>   

    <div class="card-body">                           
           
            <?php

                // $sessions_id = $_GET['cart'];
                // echo $sessions_id;
                
                // $sql = 'SELECT orders.*,users.First_Name,users.Last_Name,users.Email,users.Notes,users.Street_Address,users.City,users.Zip_Code,users.Country ,carts.Quantity,carts.ProductID,carts.SessionsID,products.Title,products.SKU,products.Price,products.SalePrice,products.Description FROM orders INNER JOIN users ON users.ID = orders.userID INNER JOIN carts ON carts.SessionsID = orders.SessionsID INNER JOIN products ON products.ID = carts.ProductID WHERE orders.SessionsID ='."'$sessions_id'";

                $sql = 'SELECT orders.*,users.First_Name,users.Last_Name,users.Email,users.Notes,users.Street_Address,users.City,users.Zip_Code,users.Country ,carts.Quantity,carts.ProductID,carts.SessionsID,products.Title,products.SKU,products.Price,products.SalePrice,products.Description FROM orders INNER JOIN users ON users.ID = orders.userID INNER JOIN carts ON carts.SessionsID = orders.SessionsID INNER JOIN products ON products.ID = carts.ProductID WHERE orders.SessionsID = "tkhb1ciuo6qc474mon80b4fbkn"';

                $results = mysqli_query($conn, $sql); 
                $item = mysqli_fetch_assoc($results);                      
                                     
            ?>       
            
            <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="" style="width:100%; max-width:300px;">
                                logo 
                            </td>
                            
                            <td>
                                Invoice #: <?php echo $item['ID'];?><br>
                                 <?php echo date("d/m/y");?>                                         
                                                                    
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                company name<br>
                                company address<br>
                                state location
                            </td>
                            
                            <td>
                            <?php echo $item['First_Name']." ".$item['Last_Name']?><br>
                            <?php echo $item['Country']." ".$item['City']." ".$item['Street_Address']." ".$item['Zip_Code']?><br>
                            <?php echo $item['Email'];?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
                   
            <tr class="heading">
                <td>
                    Item 
                </td>
                          
                <td>
                    Price per unit
                </td>
            </tr>
            
            <?php
              $total = 0;
                 foreach($results as $item){              
                        
                $quantity = $item['Quantity'];

                $price = $item['Price'];
                $saleprice = $item['SalePrice'];
                
                if ($saleprice != NULL) {
                    $final_price = $saleprice;
                } else {
                    $final_price = $price;
                };
                $total;
                $total = $total + ($final_price * $quantity);

            ?>

            <tr class="item">
                <td>
                   <?php echo $item['Title']." - x".$item['Quantity'];?>
                </td>
                
                <td>
                   $<?php echo $final_price;?>
                </td>
            </tr>

            <?php 
                };
            ?>
                   
           <tr class="total">
                <td></td>
                
                <td>
                   Total: $<?php echo number_format($total); ?>
                </td>
            </tr>
        </table>
    </div>
       
      <hr>
          <div class="d-flex justify-content-center">
            <a href="create_pdf.php" class="btn btn-success my-2" id="confirm"> confirm </a>
          </div>
       
    </div>
  </div>
 

</div>


<?php
   require_once 'footer.php'; 
?> 