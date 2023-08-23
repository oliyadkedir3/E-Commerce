<?php
session_start();
if(isset($_SESSION['role'])){
  unset($_SESSION['role']);
  unset($_SESSION['email']);
  $_SESSION['isloggedin'] = false;
  header("location: animatedLogin.php");
}
?>