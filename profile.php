<?php  
    // include 'data/conn.php'; 
    
    include 'inc/header.php'; 
    require_once "core/functions.php";
    include 'inc/navbar.php';   


    if(!isset($_SESSION['auth'])){
        redirect("login.php") ;
        die ;
    }
        $id = $_SESSION['auth']['0'];
    $query = "SELECT * FROM `users` where `id` = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
      ?>

   
     <section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-xl-4">

      <?php if(isset($_SESSION['success'])): ?>
                  <div class="alert alert-success" role="alert">
                  <?php echo $_SESSION['success'] ; ?>
                </div>
                <?php
                unset($_SESSION['success']);
                        endif;
                ?>

        <div class="card" style="border-radius: 15px;">
          <div class="card-body text-center">
            <div class="mt-3 mb-4">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
                class="rounded-circle img-fluid" style="width: 100px;" />
            </div>
            <h4 class="mb-2"> <?php echo $row['name']; ?></h4>
            <p class="text-muted mb-4"><?php echo $row['email']; ?> <span class="mx-2">|</span> <a
                href="#!"> <?php echo $_SESSION['auth'][1]; ?></a></p>
            <div class="mb-4 pb-2">
              <button type="button" class="btn btn-outline-primary btn-floating">
                <i class="fab fa-facebook-f fa-lg"></i>
              </button>
              <button type="button" class="btn btn-outline-primary btn-floating">
                <i class="fab fa-twitter fa-lg"></i>
              </button>
              <button type="button" class="btn btn-outline-primary btn-floating">
                <i class="fab fa-skype fa-lg"></i>
              </button>
            </div>
            <button type="button" class="btn btn-primary btn-rounded btn-lg">Message now </button>
            <div class="d-flex justify-content-between text-center mt-5 mb-2">
              <div>
                <p class="mb-2 h5">8471</p>
                <p class="text-muted mb-0">Wallets Balance</p>
              </div>
              <div class="px-3">
                <p class="mb-2 h5">8512</p>
                <p class="text-muted mb-0">Income amounts</p>
              </div>
              <div>
                <p class="mb-2 h5">4751</p>
                <p class="text-muted mb-0">Total Transactions</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php   include 'inc/footer.php';   ?>




