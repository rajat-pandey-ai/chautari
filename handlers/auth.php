<?php
session_start();

function redirect_if_logged_in()
{
    if (isset($_SESSION['user_id'])) {
        header('Location: explore.php');
        exit();
    }
}

function redirect_if_not_logged_in()
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}
