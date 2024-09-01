<?php
    if (isset($_POST["btnIniciarSesion"])) {

        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once "db_conn.php";
        require_once "functions.php";

        if (emptyInputLogin($email, $password) !== false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        if (invalidEmail($email) !== false) {
            header("location: ../login.php?error=invalidemail");
            exit();
        }

        loginUser($conn, $email, $password);
    }
    else {
        header("location: ../login.php");
        exit();
    }
?>