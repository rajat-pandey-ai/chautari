<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $conn = pg_connect("host=" . DB_HOST . " dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS);

    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    $query = "INSERT INTO Users (name, email, password_hash) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($name, $email, $password_hash));

    if ($result) {
        header("Location: ../pages/login.php?signup=success");
        exit();
    } else {
        echo "Error: " . pg_last_error($conn);
    }

    pg_close($conn);
} else {
    echo "Invalid request method.";
}
