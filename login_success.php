<?php include('./includes/header.php'); ?>

<main class="container">

  <div class="container col-10 col-md-8 col-lg-6 col-xl-5">
    <h1 class="h3 mb-3 fw-normal">Login Successful</h1>
    <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $email = htmlspecialchars($_POST['email']);
          echo '<div class="alert alert-success mt-4" role="alert">';
          echo "Welcome back, " . $email . "!";
          echo '</div>';
      }
    ?>
  </div>

    <div class="mt-3">
      <a href="index.php" class="btn btn-primary">Go to Home Page</a>
    </div>

</main>

<?php include('./includes/footer.php'); ?>
