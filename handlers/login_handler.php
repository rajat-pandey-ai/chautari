<?php
session_start();

require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    $conn = pg_connect("host=" . DB_HOST . " dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASS);

    if (!$conn) {
        die("Sorry, something went wrong. Please try again later.");
    }

    $query = "SELECT user_id, password_hash FROM Users WHERE email = $1";
    $result = pg_query_params($conn, $query, array($email));

    if ($result) {
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            $user_id = $row['user_id'];
            $password_hash = $row['password_hash'];

            if (password_verify($password, $password_hash)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $email;
                header("Location: ../pages/explore.php");
                exit();
            } else {
                echo "Username or password is incorrect.";
            }
        } else {
            echo "Username or password is incorrect";
        }
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }

    pg_close($conn);
} else {
    echo "Invalid request method.";
}
