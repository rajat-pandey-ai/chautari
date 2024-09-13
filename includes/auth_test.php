<?php
session_start();

// NOTE: use redirectIfNotAuthenticated to protect pages that require auth
// NOTE: use redirectIfAuthnticated to redirect logged-in users away from auth phase

function redirectIfNotAuthenticated() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login.php');
        exit();
    }
}

function redirectIfAuthenticated() {
    if (isset($_SESSION['user_id'])) {
        header('Location: /explore.php');
        exit();
    }
}
