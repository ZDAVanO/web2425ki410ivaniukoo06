<?php include('./includes/header.php'); ?>

<main class="container">

  <div class="container col-10 col-md-8 col-lg-6 col-xl-5">

      <form method="post" action="">
        <h1 class="h3 mb-3 fw-normal">Login</h1>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
      </form>



      <?php

      // session_start();

      // Include database connection
      include('./mysql-connection.php');

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Retrieve form data
          $email = $_POST['email'];
          $password = $_POST['password'];

          // Prepare and execute the query to fetch user data
          $stmt = $conn->prepare("SELECT id, name, password_hash, password_encrypted, open_password FROM users WHERE email = ?");
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $stmt->store_result();

          if ($stmt->num_rows > 0) {
              $stmt->bind_result($id, $name, $password_hash, $password_encrypted, $open_password);
              $stmt->fetch();

              function login_success($id, $name)
              {
                  $_SESSION['user_id'] = $id;
                  $_SESSION['username'] = $name;
                  header("Location: index.php");
                  // exit();
              }


              // Verify using open password (for educational purposes)
              // if ($password === $open_password) {
              //     echo "<p>Login successful using open password! Welcome back.</p>";
              //     login_success($id, $name);
              // } else {
              //     echo "<p>Invalid open password. Please try again.</p>";
              // }

              // Verify the password using hash
              if (password_verify($password, $password_hash)) {
                  echo "<p>Login successful using hash password! Welcome back.</p>";
                  login_success($id, $name);
              } else {
                  echo "<p>Invalid hash password. Please try again.</p>";
              }


              // Verify using encrypted password
              // $encryption_key = 'your_secret_key'; // Replace with the same key used during encryption
              // $decrypted_password = openssl_decrypt($password_encrypted, 'AES-128-CTR', $encryption_key, 0, '1234567891011121');
              // if ($password === $decrypted_password) {
              //     echo "<p>Login successful using encrypted password! Welcome back.</p>";
              //     login_success($id, $name);
              // } else {
              //     echo "<p>Invalid encrypted password. Please try again.</p>";
              // }


          } else {
              echo "<p>No account found with that email address.</p>";
          }

          $stmt->close();
      }
      ?>


      <div class="fb-login-button" 
        data-width="400" 
        data-size="" 
        data-button-type="" 
        data-layout="" 
        data-auto-logout-link="false" 
        data-use-continue-as="false">

    </div>

  </div>

</main>

<?php include('./includes/footer.php'); ?>