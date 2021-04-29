<?php
require_once 'header.php';
require 'dbcon.php';

$session_id = $_GET['cart'];
?> 

<style>
    .order-form .container {
      color: #4c4c4c;
      padding: 20px;
      box-shadow: 0 0 10px 0 rgba(0, 0, 0, .1);
    }

    .order-form-label {
      margin: 8px 0 0 0;
      font-size: 14px;
      font-weight: bold;
    }

    .order-form-input {
      width: 100%;
      padding: 8px 8px;
      border-width: 1px !important;
      border-style: solid !important;
      border-radius: 3px !important;
      font-family: 'Open Sans', sans-serif;
      font-size: 14px;
      font-weight: normal;
      font-style: normal;
      line-height: 1.2em;
      background-color: transparent;
      border-color: #cccccc;
    }

    .btn-submit:hover {
      background-color: #090909 !important;
    }
</style>


<div class="col-lg-9">
  
  <!-- /.card -->

  <div class="card card-outline-secondary my-4">
    <div class="card-header">
        my info
    </div>
    

    <div class="card-body">                           
           
                <div class="col-12">               
                  <span>type in your personal infomation for your order</span>               
                </div>

            <form id="userInfo" class="col-12">

              <div class="row mx-4">
                  <div class="col-12 mb-2">
                  <label class="order-form-label">Name</label>
                  </div>
                  <div class="col-12 col-sm-6">
                  <input class="order-form-input" type="text" name="First_Name" placeholder="First">
                  </div>
                  <div class="col-12 col-sm-6 mt-2 mt-sm-0">
                  <input class="order-form-input" type="text" name="Last_Name" placeholder="Last">
                  </div>
              </div>

              <div class="row mt-3 mx-4">
                  <div class="col-12">
                  <label class="order-form-label">Email</label>
                  </div>
                  <div class="col-12">
                  <input type="email" name="Email" class="order-form-input" placeholder="name@example.com">
                  </div>
              </div>

              <div class="row mt-3 mx-4">
                  <div class="col-12">
                  <label class="order-form-label">any notes?</label>
                  </div>
                  <div class="col-12">
                  <input class="order-form-input" type="text" name="Notes" placeholder="type in youe note... ">
                  </div>
              </div>               

              <div class="row mt-3 mx-4">
                  <div class="col-12">
                  <label class="order-form-label">Adress</label>
                  </div>
                  <div class="col-12">
                  <input class="order-form-input" type="text" name="Street_Address" placeholder="Street Address">
                  </div>                   
                  <div class="col-12 col-sm-6 mt-2 pr-sm-2">
                  <input class="order-form-input" type="text" name="City" placeholder="City">
                  </div>
                  <div class="col-12 col-sm-6 mt-2 pl-sm-0">
                  <!-- <input class="order-form-input" placeholder="Region"> -->
                  </div>
                  <div class="col-12 col-sm-6 mt-2 pr-sm-2">
                  <input class="order-form-input" type="text" name="Zip_Code" placeholder="Postal / Zip Code">
                  </div>
                  <div class="col-12 col-sm-6 mt-2 pl-sm-0">
                  <input class="order-form-input" type="text" name="Country" placeholder="Country">
                  </div>
              </div>

              <div class="row mt-3 mx-4">
                  <div class="col-12">
                  <div class="form-check">
                      <input type="checkbox" class="form-check-input"  id="validation" required>
                      <label for="validation" class="form-check-label ml-5"> i read the terms and agree</label>
                  </div>
                  </div>
              </div>

              <div class="row mt-3">
                  <div class="col-12">
                  <button type="submit" id="btnSubmit" class="btn btn-dark d-block mx-auto btn-submit">Submit</button>
                  </div>
              </div>

            </form>     
         
               
    </div>
  </div>
 <input id="session_id" class="hide" value="<?php echo $session_id ?>"></input>

</div>

<script>
 $(document).ready(function() {

  $('#btnSubmit').on('click', function(evt) {
    // evt.preventDefault()
      var session_id = $("#session_id").val();
      var all_fields = $('#userInfo').serializeArray();
      console.log(all_fields);
        // alert("work")
        $.ajax({
        url: 'save_user_info.php',
        type: 'post',
        data: {        
          fields: all_fields,
          session_id: session_id
        },
        success: function(res) {
          console.log(res);
          // alert("thank`s") 
          // location.replace("order_details.php?cart=<?php echo $session_id; ?>");         
        }
      });
     
    });

 });
</script>


<?php
   require_once 'footer.php'; 
?> 
