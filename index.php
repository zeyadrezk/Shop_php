<?php 
      // include 'data/conn.php'   ;
      include 'inc/header.php';  
      require_once "data/migration.php";
      require_once "core/functions.php";
      include 'inc/navbar.php';   
      include 'inc/footer.php'; 
      include "data/database.php";
use data\database\DB;


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
    <title>home page</title>
</head>
<body>
<section style="background-color: #eee;">
<?php 
// $query = "SELECT * FROM products";
// $result = mysqli_query($conn, $query);
// while($row = mysqli_fetch_array($result)):
$rows = $DB->viewAllData("*","products");
foreach($rows as $row):
  
$srcImg="images/". $row['image'];
?>
  <div class="container py-5">
    <div class="row justify-content-center mb-3">
      <div class="col-md-12 col-xl-10">
        <div class="card shadow-0 border rounded-3">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                <div class="bg-image hover-zoom ripple rounded ripple-surface">
                  <img src="images/<?php echo $row['image']  ?>"
                    class="w-100" />
                  <a href="#!">
                    <div class="hover-overlay">
                      <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                    </div>
                  </a>
                </div>
              </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                <h5><?php echo $row['name']?></h5>
                <div class="d-flex flex-row">
                  <div class="text-danger mb-1 me-2">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                  </div>
                </div>
                <div class="mt-1 mb-0 text-muted small">
                  <span><?php echo $row['description']?></span>
                </div>
                <div class="mb-2 text-muted small">
                  <span>Unique design</span>
                  <span class="text-primary"> • </span>
                  <span>For men</span>
                  <span class="text-primary"> • </span>
                  <span>Casual<br /></span>
                </div>
              </div>
              <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                <div class="d-flex flex-row align-items-center mb-1">
                  <h4 class="mb-1 me-1"><?php echo $row['price']?></h4>
                  <span class="text-danger"><s><?php echo $row['price'] + 20 ?></s></span>
                </div>
                <h6 class="text-success">Free shipping</h6>
                <div class="d-flex flex-column mt-4">
                  <button class="btn btn-primary btn-sm" type="button">Details</button>
                  <button  onclick="window.location.href='handeler/cartproducts.php?id=<?php echo $_SESSION['auth']['0'];?>&product_id=<?=$row['id']?>'" class="btn btn-outline-primary btn-sm mt-2" type="button" method= "GET">
                    Add to wishlist
                  </button>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php

endforeach;
?>

          </div>
        </div>
      </div>
    </div>
  </div>

</section> 
</body>
</html>




