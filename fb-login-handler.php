<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['email'])) {
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['username'] = $data['name'];
    $_SESSION['email'] = $data['email'];

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>