<?php
session_start();
if (isset($_SESSION['role'])) {
    echo $_SESSION['role'];
    header("location: ../../Resources/html/admindash.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account : Login</title>
    <link rel="shortcut icon" href="Resources/logo.png">
    <link href='https://fonts.googleapis.com/css?family=Bree Serif' rel='stylesheet'>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/signup.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="/js/vendor/signup.js"></script>
</head>

<body>
    <section>
        <div id="container">
            <div id="left-card" class="card">
                <img src="../images/leftcard.jpg" alt="">
            </div>
            <div id="right-card" class="card">
                <div>
                    <h1>User Account Login</h1>
                    <p>Welcome back fellow surveyee! </p>
                </div>
                <div>
                    <form method="POST" action="./login.php">
                        <label for="email">E-mail</label>
                        <div class="btn">
                            <input type="email" name="email" id="email" class="textbox" placeholder="username@domain.com" required> <br>  
                        </div>
                        <label for="password">Password</label>
                        <div class="btn">
                            <input type="password" name="password" id="password" class="textbox" placeholder="Password" required> <br>  
                        </div>
                        <input type="checkbox" onclick="toggle()" id="showpassword"> Show Password
                        <div>
                            <input type="submit" name="login" value="Login" class="btn">

                        </div>
                    </form>
                    <p>
                        Don't have an account?
                        <a href="./usersignup">
                            Sign Up
                        </a> 
                    </p>
                </div>
            </div>
        </div>    
    </section>

</body>

</html>