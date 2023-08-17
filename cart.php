<?php  
    // include 'data/conn.php'; 
    include 'inc/header.php';  
    require_once "data/migration.php";
    require_once "core/functions.php";

    include 'inc/navbar.php';   
    include 'inc/footer.php'; 

    include 'data/database.php';
    use  data\database\DB;

    $DB = new DB();


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
  <title>Cart</title>
</head>
<body>
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-7">
                <h5 class="mb-3"><a href="#!" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Shopping cart</p>
                  </div>
                  <div>
                    <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                        class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                  </div>
                </div>

                <?php   
                        $user_id = $_SESSION['auth']['0'] ; 
                        $row= $DB->viewData("*","carts","`user_id` ='$user_id' and `status`= '0'"); //select cart of user
                        if(!empty($row)):
                        $total = $row['total'];
                        $cart_id = $row['id'];
                        $rows = $DB->viewAllData("*","cart_products","`cart_id`= '$row[id]'"); // select products of cart 
          
                        foreach($rows as $rowProduct):
                        $row = $DB->viewData("*", "products", " `id` = $rowProduct[product_id] "); // select every product
                        // $query = " SELECT * FROM carts where `user_id` ='$user_id' and `status`= '0'";
                        // $result = mysqli_query($conn, $query);
                        // $row = mysqli_fetch_assoc($result);

                        // $query = " SELECT * FROM cart_products where `cart_id`= '$row[id]'";
                        // $result = mysqli_query($conn, $query);
                        // $rows = mysqli_fetch_assoc($result);
                        // while($rows = mysqli_fetch_assoc($result)):

                        // $query = " SELECT * FROM products where `id` = $rowProduct[product_id]";
                        // $result = mysqli_query($conn, $query);  
                        // $row = mysqli_fetch_assoc($result);

                        ?>
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img
                            src="images/<?php echo $row['image']?>"
                            class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                        </div>



                      
                        <div class="ms-3">
                          <h5><?php echo $row['name']?></h5>
                          <p class="small mb-0"><?= $row['description']?></p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                          <h5 class="fw-normal mb-0"><?= $rowProduct['quantity']?></h5>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0"><?php echo $row['price'] ?></h5>
                        </div>

                        <a href="#!" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
                 endforeach; 
                endif;
                ?>
              </div>

              <div class="col-lg-5">

                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Card details</h5>
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                        class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                    </div>

                    <p class="small mb-2">Card type</p>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-visa fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i
                        class="fab fa-cc-amex fa-2x me-2"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                    <form class="mt-4">
                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                          placeholder="Cardholder's Name" />
                        <label class="form-label" for="typeName">Cardholder's Name</label>
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                          placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                        <label class="form-label" for="typeText">Card Number</label>
                      </div>

                      <div class="row mb-4">
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                              placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Expiration</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="password" id="typeText" class="form-control form-control-lg"
                              placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                          </div>
                        </div>
                      </div>

                    </form>
                    <?php
                    if(!empty($row)):
?>
                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2"><?= $total ?> $</p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Shipping is Free (offer of the summer ) :) </p>
                      <p class="mb-2">0.00$</p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total(Incl. taxes)</p>
                      <p class="mb-2"><?= $total ?> </p>
                    </div>

                    <button type="button"  class="btn btn-info btn-block btn-lg" onclick="window.location.href='handeler/ordersproducts.php?id=<?php echo $cart_id  ?>'">
                      <div class="d-flex justify-content-between">
                       
                        <span> <?= $total ?> $</span>
                        <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button>
<?php endif; ?>
                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
