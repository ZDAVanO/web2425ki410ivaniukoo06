<?php
include('./includes/header.php');
include('./mysql-connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login_type = $_POST['login_type'];

    $stmt = $conn->prepare("SELECT id, name, password_hash, password_encrypted, open_password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $password_hash, $password_encrypted, $open_password);
        $stmt->fetch();

        function login_success($id, $name, $email, $password_received, $password_stored, $login_type)
        {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $name;

            $_SESSION['email'] = $email;
            $_SESSION['password_received'] = $password_received;
            $_SESSION['password_stored'] = $password_stored;
            $_SESSION['login_type'] = $login_type;

            header("Location: index.php");
            exit();
        }

        if ($login_type === 'open' && $password === $open_password) {
            login_success($id, $name, $email, $password, $open_password, $login_type);
        } elseif ($login_type === 'hash' && password_verify($password, $password_hash)) {
            login_success($id, $name, $email, $password, $password_hash, $login_type);
        } elseif ($login_type === 'encrypted') {
            $encryption_key = 'your_secret_key'; // Replace with the same key used during encryption
            $decrypted_password = openssl_decrypt($password_encrypted, 'AES-128-CTR', $encryption_key, 0, '1234567891011121');
            if ($password === $decrypted_password) {
                login_success($id, $name, $email, $password, $password_encrypted, $login_type);
            } else {
                $error_message = "Invalid encrypted password. Please try again.";
            }
        } else {
            $error_message = "Invalid credentials. Please try again.";
        }
    } else {
        $error_message = "No account found with that email address.";
    }

    $stmt->close();
}
?>



<main class="container">

  <div class="container col-10 col-md-12 col-lg-12 col-xl-10">

      <div class="row">
          <!-- Open Password Form -->
          <div class="col-md-4 mt-5">
              <form method="post" action="">
                  <h1 class="h5 mb-3 fw-normal">Login (Open Password)</h1>
                  <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="floatingInputOpen" placeholder="name@example.com" name="email" required>
                      <label for="floatingInputOpen">Email address</label>
                  </div>
                  <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="floatingPasswordOpen" placeholder="Password" name="password" required>
                      <label for="floatingPasswordOpen">Password</label>
                  </div>
                  <input type="hidden" name="login_type" value="open">
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
              </form>
          </div>

          <!-- Hashed Password Form -->
          <div class="col-md-4 mt-5">
              <form method="post" action="">
                  <h1 class="h5 mb-3 fw-normal">Login (Hashed Password)</h1>
                  <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="floatingInputHash" placeholder="name@example.com" name="email" required>
                      <label for="floatingInputHash">Email address</label>
                  </div>
                  <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="floatingPasswordHash" placeholder="Password" name="password" required>
                      <label for="floatingPasswordHash">Password</label>
                  </div>
                  <input type="hidden" name="login_type" value="hash">
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
              </form>
          </div>

          <!-- Encrypted Password Form -->
          <div class="col-md-4 mt-5">
              <form method="post" action="">
                  <h1 class="h5 mb-3 fw-normal">Login (Encrypted Password)</h1>
                  <div class="form-floating mb-3">
                      <input type="email" class="form-control" id="floatingInputEncrypt" placeholder="name@example.com" name="email" required>
                      <label for="floatingInputEncrypt">Email address</label>
                  </div>
                  <div class="form-floating mb-3">
                      <input type="password" class="form-control" id="floatingPasswordEncrypt" placeholder="Password" name="password" required>
                      <label for="floatingPasswordEncrypt">Password</label>
                  </div>
                  <input type="hidden" name="login_type" value="encrypted">
                  <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
              </form>
          </div>
      </div>

      <?php if (isset($error_message)): ?>
            <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error_message); ?></div>
      <?php endif; ?>

  </div>

</main>

<?php include('./includes/footer.php'); ?>