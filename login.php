<?php

require "db.inc.php";
require "validation.inc.php";

session_start();
// isset($_POST["email"]) && isset($_POST["password"])

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["email"] == "admin@gmail.com" && ($_POST["password"]) == "iamadmin") {

        $_SESSION['role'] = "admin";
        header("location: admindash.php");
    } else if (isset($_POST["email"]) && isset($_POST["password"])) {

            $email = setup_input($_POST["email"]);
            $password = md5(setup_input($_POST["password"]));
            $_SESSION['role'] == 'User';
            // if (isset($_POST['role']) && ($_POST['role'] == 'User')) {

                $sql = "SELECT email FROM user_table WHERE email = '" . $email . "' and u_password = '" . $password . "'";
                $result = $conn->query($sql);

                $result_count = $result->num_rows;

                if ($result_count > 0) {
                    $_SESSION['role'] = "user";
                    echo "Logged In";
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['isloggedin'] = true;
                    header("location: index.php");
                } else {
                    // echo "Incorrect password";
                    header("location: login.php?logincheck=1");
                }
            // } elseif (isset($_POST['role']) && ($_POST['role'] == 'Organization')) {
            //     $sql = "SELECT o_email FROM orgs WHERE o_email = '" . $email . "' and o_password = '" . $password . "'";
            //     $result = $conn->query($sql);

            //     $result_count = $result->num_rows;

            //     if ($result_count > 0) {
            //         $_SESSION['role'] = "biguser";
            //         // echo "Logged In";
            //         $_SESSION['email'] = $_POST['email'];
            //         header("location: ../html/orgdash.php");
            //     } else {
            //         // echo "Incorrect password";
            //         header("location: ../../Resources/html/login.php?logincheck=2");
            //     }
            // } else {
            //     echo $_POST['email'];
            //     echo $_POST['password'];
            //     // header("location: ../../Resources/html/login.php?logincheck=1");
            // }
        }
        else if (isset($_POST["cemail"]) && isset($_POST["cpassword"])) {

            $email = setup_input($_POST["cemail"]);
            $password = md5(setup_input($_POST["cpassword"]));
            $_SESSION['role'] == 'User';
            // if (isset($_POST['role']) && ($_POST['role'] == 'User')) {

                $sql = "SELECT email FROM user_table WHERE email = '" . $email . "' and u_password = '" . $password . "'";
                $result = $conn->query($sql);

                $result_count = $result->num_rows;

                if ($result_count > 0) {
                    $_SESSION['role'] = "user";
                    echo "Logged In";
                    $_SESSION['email'] = $_POST['cemail'];
                    $_SESSION['isloggedin'] = true;
                    header("location: checkout.php");
                } else {
                    // echo "Incorrect password";
                    header("location: chechout.php?logincheck=1");
                }
        } else {
            header("location:   login.php?logincheck=1");
        }
    }

