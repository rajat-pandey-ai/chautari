<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $name = htmlspecialchars(trim($_POST['name']));
    if (strlen($name) < 2) {
        die("Name must be at least 2 characters long.");
    }

    $password = $_POST['password'];
    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long.");
    }

    $confirm_password = $_POST['confirm_password'];
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $conn = pg_connect("host=" . DB_HOST . " dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS);

    if (!$conn) {
        die("Sorry, something went wrong. Please try again later.");
    }

    $email_check_query = "SELECT 1 FROM Users WHERE email = $1";
    $email_check_result = pg_query_params($conn, $email_check_query, array($email));

    if (pg_num_rows($email_check_result) > 0) {
        die("This email is already registered. Please use a different email.");
    }

    $query = "INSERT INTO Users (name, email, password_hash) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $query, array($name, $email, $password_hash));

    if ($result) {
        header("Location: ../pages/login.php?signup=success");
        exit();
    } else {
        die("Sorry, something went wrong. Please try again later.");
    }

    pg_close($conn);
} else {
    die("Invalid request method.");
}
