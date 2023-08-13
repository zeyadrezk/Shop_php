<?php  
    include 'inc/header.php';  
    include 'inc/navbar.php';   
    include 'inc/footer.php';
    require_once "core/functions.php";




if(($_SESSION['auth'][3] == 0)){
        redirect("index.php") ;
        die ;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online shop || متجر الكتروني</title>

</head>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-2">
    <div class="row d-flex justify-content-center align-items-center h-2">
      <div class="col col-lg-9 col-xl-10">
        <div class="card rounded-3">

        
        <?php 
                if(isset($_SESSION['errors'])):
                foreach($_SESSION['errors'] as $error ): ?>
                  <div class="alert alert-danger text-center">
                    <?php echo $error ; ?>
                  </div>
                  <?php endforeach;
                        unset($_SESSION['errors']);
                        endif;
                  ?>
                  <?php if(isset($_SESSION['success'])): ?>
                  <div class="alert alert-success" role="alert">
                  <?php echo $_SESSION['success'] ; ?>
                </div>
                <?php
                unset($_SESSION['success']);
                        endif;
                ?>
            <h4 class="text-center my-3 pb-3">Add Product || اضـافـة منــتـج</h4>

            
            <form action ="handeler/addProduct.php" method="POST" enctype ="multipart/form-data" class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2">
              <div class="col-12">
                <div class="form-outline">
                  <input name = "name" type="text" id="form1" class="form-control" />
                  <label class="form-label" for="form1">Name of product </label>
                </div>
                <div class="form-outline">
                  <input name = "price" type="number" id="form1" class="form-control" />
                  <label  class="form-label" for="form1">Price</label>
                </div>
                <div class="form-outline">
                  <input  name = "category" type="text" id="form1" class="form-control" />
                  <label  class="form-label" for="form1">Category</label>
                </div>
                <div class="form-outline">
                  <input  name = "quantity" type="number" id="form1" class="form-control" />
                  <label  class="form-label" for="form1">Quantity</label>
                </div>

                <div class="form-outline">
                  <input  name = "description" type="desciption" id="form1" class="form-control" />
                  <label  class="form-label" for="form1">Description</label>
                </div>
                <div class="form-outline">
                <input type="file"  name = "img" id="fileToUpload" class="form-control" />
                  <label  class="form-label" for="form1">image</label>

                </div>


              </div>
                
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>

            </form>

</body>
</html>
