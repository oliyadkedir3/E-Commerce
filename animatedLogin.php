

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css">

  </head>
  <body>
    <section>
      <div class="form-box">
        <div class="form-value">
          <form action="login.php" method="POST">
            <h2>User Account Login</h2>
            <div class="inputbox">
              <ion-icon name="mail-outline"></ion-icon>
              <input type="Email" id="email" name="email" placeholder="Email" required>
              <label for="email">Email</label>
            </div>
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <input type="password" id="password" name="password" placeholder="Password" required>
              <label for="password">Password</label>
            </div>
            <div class="forget">
              <label for=""><input type="checkbox">Remember me <a href="#">Forget Password</a></label>
            </div>
            <button>Log in</button>
            <div class="register">
              <p>Don't have an account</p><a href="animatedsignup.php">Register</a>
            </div>
          </form>
        </div>
      </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>