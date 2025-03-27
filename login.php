<?php
include('./includes/header.php');
include('./mysql-connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login_type = $_POST['login_type'];

    $stmt = $conn->prepare("SELECT id, name, password_hash, open_password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $password_hash, $open_password);
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
        } elseif ($login_type === 'hash' && $password === $password_hash) {
            login_success($id, $name, $email, $password, $password_hash, $login_type);

            // // Хешуємо відкритий пароль з бази даних для порівняння
            // $hashed_open_password = hash('sha256', $open_password);
            // // Порівнюємо хеш з клієнта з хешем відкритого пароля
            // if ($password === $hashed_open_password) {
            //     login_success($id, $name, $email, $password, $open_password, "open");
            // } else {
            //     $error_message = "Invalid credentials. Please try again.";
            // }
        } elseif ($login_type === 'encrypted') {

            $encryption_key = "12345678901234567890123456789012"; 
            $iv = "1234567891011121";

            $decrypted_password = openssl_decrypt(
                base64_decode($password), // Ensure the input is base64-decoded
                'AES-256-CBC',
                $encryption_key,
                OPENSSL_RAW_DATA,
                $iv
            );
            if ($decrypted_password === $open_password) {
                login_success($id, $name, $email, $password, $open_password, "open");
            } else {
                $error_message = "Invalid credentials. Please try again." . " password: " . $password . ", password_hash: " . $password_hash . ", open_password: " . $open_password . ", decrypted_password: " . $decrypted_password;
            }
        } else {
            $error_message = "Invalid credentials. Please try again." . " password: " . $password . ", password_hash: " . $password_hash . ", open_password: " . $open_password;
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
              <form method="post" action="" onsubmit="hashPassword(event, 'floatingPasswordHash')">
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
              <form method="post" action="" onsubmit="encryptPassword(event, 'floatingPasswordEncrypt')">
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


      <div class="fb-login-button mt-5" 
            data-width="" 
            data-size="large" 
            data-button-type="continue_with" 
            data-layout="default" 
            data-auto-logout-link="false" 
            data-use-continue-as="false" 
            onlogin="checkLoginState();">
        </div>


        
<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>


  </div>

</main>

<?php include('./includes/footer.php'); ?>