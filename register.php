<?php include('./includes/header.php'); ?>





<main class="container">

  <div class="container col-10 col-md-8 col-lg-6 col-xl-5">

      <form method="post" action="" onsubmit="submit_reg_form(event, 'floatingPassword', 'hashedPassword', 'encryptedPassword')">
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
          <input type="tel" class="form-control" id="floatingPhone" placeholder="Phone Number" name="phone" required>
          <label for="floatingPhone">Phone Number</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
          <label for="floatingPassword">Password</label>
        </div>
        
        <input type="hidden" id="hashedPassword" name="password_hash">
        <input type="hidden" id="encryptedPassword" name="password_encrypted">

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
      </form>
      

      <?php

      // Include database connection
      include('./mysql-connection.php');

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Retrieve form data
          $name = $_POST['name'];
          $email = $_POST['email'];

          $open_password = $_POST['password']; // Original password
          $password_hash = $_POST['password_hash']; // Hashed password
          $password_encrypted = $_POST['password_encrypted']; // Encrypted password


          // Check if email already exists
          $email_check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
          $email_check_stmt->bind_param("s", $email);
          $email_check_stmt->execute();
          $email_check_stmt->store_result();

          if ($email_check_stmt->num_rows > 0) {
              echo "<p>Email is already registered. Please <a href='login.php'>log in</a> or use a different email.</p>";
          } else {
              // Insert data into the database
              $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash, password_encrypted, open_password) VALUES (?, ?, ?, ?, ?)"); 
              // prepare() – використовується для підготовки SQL-запиту (захищає від SQL-ін'єкцій).
              $stmt->bind_param("sssss", $name, $email, $password_hash, $password_encrypted, $open_password);
              // bind_param("sssss", ...) прив’язує значення до ? у SQL-запиті.
              // "sssss" означає типи даних:
              // s – string (рядок).
              // Тут 5 рядків (name, email, password_hash, password_encrypted, open_password).


              if ($stmt->execute()) {
                  echo "<p>Registration successful! Please <a href='login.php'>log in</a> to continue.</p>";
                  
              } else {
                  echo "Error: " . $stmt->error;
              }

              $stmt->close();
          }

          $email_check_stmt->close();
          $conn->close();
      }
      ?>




  </div>

</main>

<?php include('./includes/footer.php'); ?>
