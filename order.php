<?php   include './inc/header.php';  
require_once "./data/migration.php";
require_once "./core/functions.php";
?>
<?php   include './inc/navbar.php';   ?>
<?php   include './inc/footer.php'; ?>
<?php include './data/conn.php'; 
require "data/database.php";
use data\database\DB;
?>

<?php 
    if(!isset($_SESSION['auth'])){
        redirect("login.php") ;
        die ;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order</title>
</head>
<body>
<?php   
                        $user_id = $_SESSION['auth']['0'] ;    
                        $DB = new DB();
                        $row = $DB ->viewData("*","orders","user_id=$user_id AND status=0");
                        $order_id = $row['id'];
                        $row4 = $DB ->viewData("*","users","id=$user_id");
                        
                        
                        // order
                        // $query = " SELECT * FROM order_products where `order_id` ='$order_id' ";
                        // $result = mysqli_query($conn, $query);
                        // $row1 = mysqli_fetch_assoc($result);
                        // $query = " SELECT * FROM users where `id` ='$user_id' ";
                        // $result = mysqli_query($conn, $query);
                        // $row4 = mysqli_fetch_assoc($result);
       

                        ?>
<section class="h-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0">Thanks for your Order, <span style="color: #a8729a;"><?php echo $row4['name']  ?></span>!</h5>
          </div>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
              <p class="small text-muted mb-0">Receipt Voucher : 1KAU9-84UIL</p>
            </div>
            
            <div class="card shadow-0 border mb-4">
            <?php
                       $row0 = $DB ->viewAllData("*","order_products","order_id=$order_id");
                       foreach ($row0 as $row1):
                        $product_id = $row1['product_id'];
                        $row2=$DB->viewData("*","products","`id` ='$product_id'");
                        $row3=$DB->viewData("*","orders","`id` ='$order_id'");


 


                     //products
                //  $query = " SELECT * FROM products where `id` ='$product_id' ";
                //  $result = mysqli_query($conn, $query);
                //  $row2 = mysqli_fetch_assoc($result);
                //  $query = " SELECT * FROM orders where `id` ='$order_id' ";
                //  $result = mysqli_query($conn, $query);
                //  $row3 = mysqli_fetch_assoc($result);



                          ?>
              <div class="card-body">
                <div class="row">
                 
                  <div class="col-md-2">
                    <img src="images/<?php echo $row2['image']  ?>"
                      class="img-fluid" alt="Phone">
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0"><?php echo $row2['name']  ?></p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small"><?php echo $row2['description']  ?></p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small"><?php echo $row1['quantity']  ?> peice</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="text-muted mb-0 small"><?php echo $row2['price']  ?>LE</p>
                  </div>
                  <?php
                  echo "<br>";
                    endforeach ;
                        ?>

                </div>
                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                <div class="row d-flex align-items-center">
                  <div class="col-md-2">
                    <p class="text-muted mb-0 small">Track Order</p>
                  </div>
                  <div class="col-md-10">
                    <div class="progress" style="height: 6px; border-radius: 16px;">
                      <div class="progress-bar" role="progressbar"
                        style="width: 65%; border-radius: 16px; background-color: #a8729a;" aria-valuenow="65"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex justify-content-around mb-1">
                      <p class="text-muted mt-1 mb-0 small ms-xl-5">Out for delivary</p>
                      <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-between pt-2">
              <p class="fw-bold mb-0">Order Details</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> <?php echo $row3['total']  ?></p>
            </div>

            <div class="d-flex justify-content-between pt-2">
              <p class="text-muted mb-0">Invoice Number : <?php echo $row3['order_code']  ?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Discount</span>0</p>
            </div>

            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0">Invoice Date : <?php echo $row3['order_date']  ?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> 123</p>
            </div>

            <div class="d-flex justify-content-between mb-5">
              <p class="text-muted mb-0">Recepits Voucher : 18KU-62IIK</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
            </div>
          </div>
          <div class="card-footer border-0 px-4 py-5"
            style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
              paid: <span class="h2 mb-0 ms-2"> <?php echo $row3['total']  ?></span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>



</section>
</body>
</html>


