<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Natan Mekebib">
    <meta name="description" content="Fill out surveys get rewards">
    <meta name="keywords" content="Survey Form Research meteyik mtk Rewards user signup">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account : Sign Up</title>
    <link rel="shortcut icon" href="Resources/logo.png">
    <link href='https://fonts.googleapis.com/css?family=Bree Serif' rel='stylesheet'>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/signup.css">
    <script src="js/signup.js"></script>
    <base href="./../index.php" target="_self">
</head>

<body>
    <section>
        <div id="container">
            <div id="right-card" class="card">
                <div>
                    <h1>User Account Sign Up</h1>
                    <p>Welcome to our community fellow surveyee! </p>
                </div>
                <div>
                    <form method="POST" action="Resources/php/auth.php">
                        <label for="firstname">First Name</label> <br>
                        <input type="textarea" name="firstname" id="firstname" class="textbox" placeholder=" First Name" required> <br>
                        <label for="lastname">Last Name</label> <br>
                        <input type="textarea" name="lastname" id="lastname" class="textbox" placeholder=" Last Name" required> <br>
                        <label for="email">E-mail</label>
                        <div class="btn">
                            <input type="email" name="email" id="email" class="textbox" placeholder=" username@domain.com" required> <br>
                        </div>
                        <label for="password">Password</label>
                        <div class="btn">
                            <input type="password" name="password" id="password" class="textbox" placeholder=" Password" required> <br>
                        </div>
                        <label for="confirm">Confirm Password</label>
                        <div class="btn">
                            <input type="password" name="password" id="confirm" class="textbox" placeholder=" Confirm Password" required> <br>
                        </div>
                        <input type="checkbox" onclick="toggle()" id="showpassword"> Show Password
                        <div>
                            <input type="submit" name="signup" value="Sign Up" class="btn">

                        </div>
                    </form>
                    <?php
                    if (isset($_GET['logincheck'])) {
                        echo "<div class='error'>Invalid information entered</div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>

</body>

</html>