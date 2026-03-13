<?php

return [
    'db' => [
        'dsn'      => 'mysql:host=localhost;dbname=lab1;charset=utf8mb4',
        'username' => 'root',
        'password' => '',
    ],
    'app' => [
        'upload_dir'   => __DIR__ . '/../uploads/',
        'max_file_size' => 2 * 1024 * 1024,
    ],
];
