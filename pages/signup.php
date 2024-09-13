<?php
include('../includes/auth_test.php');
redirectIfAuthenticated();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up - Chautari</title>
    <meta name="description" content="Struggling to discover fun and exciting events near you? Chautari brings the best local events tailored to you so you can join
            local happenings with ease.">
    <meta property="og:title" content="Chautari — Find out about events around you.">
    <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico" sizes="any">

    <link rel="stylesheet" href="../assets/css/default.css">
    <link rel="stylesheet" href="../assets/css/sign.css">
</head>

<body class="centerBody">

    <main class="formCenter">
        <a href="../index.php" target="_self"><img class="smallImageInForm" src="../assets/images/logo-32.svg" alt="" srcset=""></a>

        <h1>Sign up</h1>

        <p class="snippetSignInfo">Already have an account? <a href="./login.php">Log in</a></p>

        <div class="formbody">
            <form action="../handlers/signup_handler.php" method="post" onsubmit="return validateForm()">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required inputmode="text">
                <span id="nameError" class="error"></span>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required inputmode="email">
                <span id="emailError" class="error"></span>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required inputmode="password">
                <span id="passwordError" class="error"></span>


                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required inputmode="password">
                <span id="confirmPasswordError" class="error"></span>

                <span id="passNoMatch"></span>
                <style>
                    #passNoMatch,
                    .error {
                        color: #d42f2f;
                    }
                </style>

                <button type="submit">Sign up</button>
            </form>
        </div>
    </main>

    <script src="../assets/js/signup_validation.js"></script>
</body>

</html>