<?php

// Database configuration
$host = 'localhost';
$dbname = 'bookstore';
$user = 'root';
$pass = '';
$secret_key = "sk_test_51OhHEaCXHJ4JBkisBYkZjGc94UHjzppB7YMopiCA23brRvIPMpxQQQvkdDWKR1ATvRL47FK1dRQecjG3qU6VtZ2500pduLOpLJ";

// Establish a database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
