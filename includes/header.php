<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Business Card</title>
  <link rel="icon" href="./public/favicon.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <link rel="stylesheet" href="./public/styles/styles.css">

  <!-- <link rel="stylesheet" href="./public/styles/style.css"> -->

  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2370564043324590', // Замініть на ваш App ID
      cookie     : true,
      xfbml      : true,
      version    : 'v22.0' // Використовуйте актуальну версію API
    });
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

</head>
<body class="d-flex flex-column h-100">

<div id="fb-root"></div>
<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v22.0&appId=2370564043324590"></script> -->



<div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
      <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <span class="fs-4">Business Card</span>
      </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="./index.php" class="nav-link px-2 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'link-secondary' : ''; ?>">Home</a></li>
      <li><a href="./about.php" class="nav-link px-2 <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'link-secondary' : ''; ?>">About</a></li>
      <li><a href="./contact.php" class="nav-link px-2 <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'link-secondary' : ''; ?>">Contact</a></li>
    </ul>

    <div class="col-md-3 text-end">
      <?php if (isset($_SESSION['user_id'])): ?>
        <span class="me-2">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <a href="./logout.php" class="btn btn-outline-danger">Logout</a>
      <?php else: ?>
        <a href="./login.php" class="btn btn-outline-primary me-2">Login</a>
        <a href="./register.php" class="btn btn-primary">Register</a>
      <?php endif; ?>
    </div>
  </header>
</div>

