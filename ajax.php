<?php

if (isset($_POST['ajaxPostData'])) {
    $postData = htmlspecialchars($_POST['ajaxPostData']);
    $currentTime = date('Y-m-d H:i:s');
    echo "You submitted (POST AJAX): " . $postData . " at " . $currentTime;
} elseif (isset($_GET['ajaxGetData'])) {
    $getData = htmlspecialchars($_GET['ajaxGetData']);
    $currentTime = date('Y-m-d H:i:s');
    echo "You submitted (GET AJAX): " . $getData . " at " . $currentTime;
}

?>
