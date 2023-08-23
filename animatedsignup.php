

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index2.css">
  </head>
  <body>
    <section>
      <div class="form-box">
        <div class="form-value">
          <form action="auth.php" method="POST">
            <h2>User Account Sign Up</h2>
            <div class="inputbox">
              <ion-icon name="person-circle-outline"></ion-icon>
              <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
              <label for="firstname">First Name</label>
            </div>
            <div class="inputbox">
              <ion-icon name="person-circle-outline"></ion-icon>
              <input type="text" id="lastname" name="lastname" placeholder="Last Name" required>
              <label for="lastname">Last Name</label>
            </div>
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
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <input type="password" id="confirm" name="confirm" placeholder="Confirm Password" required>
              <label for="confirm">Confirm Password</label>
            </div>
            <button>Sign Up</button>
            <div class="register">
              <p>have an account already?</p><a href="animatedLogin.php" id="atext">Login</a>
            </div>
          </form>
        </div>
      </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  </body>
</html>