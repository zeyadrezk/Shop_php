   
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Eraasoft</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <?php
            if(!isset($_SESSION['auth'])):
            ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
            <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>
            <?php   if(($_SESSION['auth'][3] == 1)):  ?>

            <li class="nav-item">
              <a class="nav-link" href="StoreProduct.php">Add Product</a>
            </li> 
            <?php endif ?>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">Cart</a>
            </li> 

            <?php endif; ?>

            <li class="nav-item">
              <a class="nav-link" href="order.php">Orders</a>
            </li> 

          </ul>
          <ul>
          <?php
            if(isset($_SESSION['auth'])):
            ?>
          <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item">
              <a class="nav-link " aria-current="page" href="logout.php">Logout</a>
            </li>
            <?php endif; ?>



          </ul>

        </div>
      </div>
    </nav>
    