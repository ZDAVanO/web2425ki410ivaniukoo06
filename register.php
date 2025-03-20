<?php include('./includes/header.php'); ?>

<main class="container">

  <div class="container col-10 col-md-8 col-lg-6 col-xl-5">

      <form method="post" action="register_success.php">
        <h1 class="h3 mb-3 fw-normal">Register</h1>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="floatingName" placeholder="Full Name" name="name" required>
          <label for="floatingName">Full Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
      </form>

  </div>

</main>

<?php include('./includes/footer.php'); ?>
