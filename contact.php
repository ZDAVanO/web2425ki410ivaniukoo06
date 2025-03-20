<?php include('./includes/header.php'); ?>

<main class="container">

    <h1>Contact Me</h1>

    <div class="container mt-5 col-10 col-md-8 col-lg-6 col-xl-5">

        <form method="POST" action="contact.php">
            <input id="name" name="name" type="text" class="feedback-input" placeholder="Name"/>
            <input id="email" name="email" type="text" class="feedback-input" placeholder="Email" />
            <textarea id="message" name="message" class="feedback-input" placeholder="Comment"></textarea>
            <input type="submit" value="SUBMIT" />
        </form>

    </div>

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
    <div class="container mt-3 col-10 col-md-8 col-lg-6 col-xl-5">
        <div class="alert alert-success" role="alert">
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Обробка форми
                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];

                // Просте виведення
                echo "<h3>Your message sended!</h3>";
                echo "<p>Name: $name</p>";
                echo "<p>Email: $email</p>";
                echo "<p>Comment: $message</p>";
            }
            ?>

        </div>
    </div>
    <?php endif; ?>

</main>

<?php include('./includes/footer.php'); ?>
