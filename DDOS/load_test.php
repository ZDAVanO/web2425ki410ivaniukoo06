<?php
$url = "http://127.0.0.1:8000/server.php"; // Цільовий сервер
$num_threads = 100; // Кількість потоків

$multiCurl = [];
$mh = curl_multi_init();

// Створюємо запити
for ($i = 0; $i < $num_threads; $i++) {
    $multiCurl[$i] = curl_init();
    curl_setopt($multiCurl[$i], CURLOPT_URL, $url);
    curl_setopt($multiCurl[$i], CURLOPT_RETURNTRANSFER, true);
    curl_multi_add_handle($mh, $multiCurl[$i]);
}

// Виконуємо всі запити одночасно
$running = null;
do {
    curl_multi_exec($mh, $running);
} while ($running > 0);

// Закриваємо всі запити
foreach ($multiCurl as $ch) {
    curl_multi_remove_handle($mh, $ch);
    curl_close($ch);
}

curl_multi_close($mh);

echo "end!";
