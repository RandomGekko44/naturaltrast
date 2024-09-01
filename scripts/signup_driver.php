<?php
    if (isset($_POST["btnReg"])) {
        
        $name = $_POST["name"];
        $last_name = $_POST["last_name"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        require_once "db_conn.php";
        require_once "functions.php";

        if (emptyInputSignup($name, $last_name, $username, $password, $email) !== false) {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }

        if (invalidUserName($username) !== false) {
            header("location: ../signup.php?error=invalidusername");
            exit(); 
        }

        if (invalidEmail($email) !== false) {
            header("location: ../signup.php?error=invalidemail");
            exit();
        } 

        if (userExist($conn, null, $username, $email) !== false) {
            header("location: ../signup.php?error=useralreadyexist");
            exit(); 
        }

        createUser($conn, $name, $last_name, $username, $password, $email);
    }
    else {
        header("location: ../signup.php");
        exit();
    }
?>