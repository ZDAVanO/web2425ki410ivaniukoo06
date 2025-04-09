<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Налаштування для локального сервера XAMPP
    $servername = "localhost";
    $username = "root";
    $password = ""; // Порожній пароль за замовчуванням для локального сервера
    $dbname = "db_1_test_1"; // Назва вашої локальної бази даних
} else {
    // Налаштування для хостингу InfinityFree
    $config = include('config.php');
    $servername = $config['servername'];
    $username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname']; 
}

// Створення підключення
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "db Connected successfully";

// Ensure the `users` table exists
$table_sql = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    open_password VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    password_encrypted TEXT NOT NULL
)";
if ($conn->query($table_sql) === FALSE) {
    die("Error creating table: " . $conn->error);
}


// $conn->close();

?>


