<?php include('./includes/header.php'); ?>

<main class="container">

    <h1>Home Page</h1>

    <div class="container mt-3 pt-3 pb-3 col-10 col-md-8 col-lg-6 col-xl-5 border rounded ">
        <!-- GET Form -->
        <h3>GET Request Form</h3>
        <form method="get" action="./index.php">
            <label for="getData" class="form-label">Enter Data:</label>
            <input type="text" class="form-control" name="getData" id="getData">
            <input type="submit" value="Submit GET" class="mt-2">
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['getData'])) {
                $currentTime = date('Y-m-d H:i:s');
                echo '<div class="alert alert-success mt-2" role="alert">';
                echo "You submitted (GET): " . htmlspecialchars($_GET['getData']) . " at " . $currentTime;
                echo '</div>';
            }
        ?>
    </div>

    <div class="container mt-3 pt-3 pb-3 col-10 col-md-8 col-lg-6 col-xl-5 border rounded ">
        <a href="./index.php?getData2=exampleData" class="btn btn-link mt-2">Submit GET via Link</a>

        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['getData2'])) {
                $currentTime = date('Y-m-d H:i:s');
                echo '<div class="alert alert-success mt-2" role="alert">';
                echo "You submitted (GET): " . htmlspecialchars($_GET['getData2']) . " at " . $currentTime;
                echo '</div>';
            }
        ?>
    </div>
    
    
    <div class="container mt-3 pt-3 pb-3 col-10 col-md-8 col-lg-6 col-xl-5 border rounded ">
        <!-- POST Form -->
        <h3>POST Request Form</h3>
        <form method="post" action="./index.php">
            <label for="postData" class="form-label">Enter Data:</label>
            <input type="text" class="form-control" name="postData" id="postData">
            <input type="submit" value="Submit POST" class="mt-2">
        </form>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['postData'])) {
                $currentTime = date('Y-m-d H:i:s');
                echo '<div class="alert alert-success mt-2" role="alert">';
                echo "You submitted (POST): " . htmlspecialchars($_POST['postData']) . " at " . $currentTime;
                echo '</div>';
            }
        ?>
    </div>

    <hr>

    <!-- POST AJAX Form -->
    <div class="container mt-3 pt-3 pb-3 col-10 col-md-8 col-lg-6 col-xl-5 border rounded ">

        <h3>POST AJAX Form</h3>
        <form id="postAjaxForm">
            <label for="ajaxPostData" class="form-label">Enter Data:</label>
            <input type="text" id="ajaxPostData" class="form-control" name="ajaxPostData" required>
            <input type="button" id="postAjaxSubmit" class="btn btn-primary mt-2" value="Submit via AJAX">
        </form>
        <div id="postAjaxResponse"></div>
    </div>

    <div class="container mt-3 mb-3 pt-3 pb-3 col-10 col-md-8 col-lg-6 col-xl-5 border rounded ">
        <!-- GET AJAX Form -->
        <h3>GET AJAX Form</h3>
        <form id="getAjaxForm">
            <label for="ajaxGetData" class="form-label">Enter Data:</label>
            <input type="text" id="ajaxGetData" class="form-control" name="ajaxGetData" required>
            <input type="button" id="getAjaxSubmit" class="btn btn-primary mt-2" value="Submit via AJAX">
        </form>
        <div id="getAjaxResponse"></div>
    </div>

    <script>
        // POST AJAX
        document.getElementById('postAjaxSubmit').addEventListener('click', function() {
            var postData = document.getElementById('ajaxPostData').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', './ajax.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('postAjaxResponse').innerHTML = '<div class="alert alert-success mt-2" role="alert">' + xhr.responseText + '</div>';
                }
            };
            xhr.send('ajaxPostData=' + encodeURIComponent(postData));
        });

        // GET AJAX
        document.getElementById('getAjaxSubmit').addEventListener('click', function() {
            var getData = document.getElementById('ajaxGetData').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', './ajax.php?ajaxGetData=' + encodeURIComponent(getData), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('getAjaxResponse').innerHTML = '<div class="alert alert-success mt-2" role="alert">' + xhr.responseText + '</div>';
                }
            };
            xhr.send();
        });
    </script>

</main>

<?php include('./includes/footer.php'); ?>
