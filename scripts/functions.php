<?php
    function emptyInputSignup($name, $last_name, $username, $password, $email) {
        $result = null;

        if (empty($name) || empty($last_name) || empty($username) || empty($password) || empty($email)) {
            $result = true;
        }
        else {
            $result = false;
        }

        return $result;
    }

    function invalidUserName($username) {
        $result = null;

        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $result = true;
        }
        else {
            $result = false;
        }

        return $result;
    }

    function invalidEmail($email) {
        $result = null;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        }
        else {
            $result = false;
        }

        return $result;
    }

    function userExist($conn, $id, $username, $email) {
        $result = $conn->query("select * from user where id='$id' or username='$username' or email='$email';");

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
        else {
            $result = false;
            return $result;
        }

        $conn->close();
    }

    function createUser($conn, $name, $last_name, $username, $password, $email) {
        $conn->query("insert into user (name, last_name, username, password, email) values ('$name', '$last_name', '$username', '$password', '$email')");
        header("location: ../login.php?error=none");
        $conn->close();
        exit();
    }

    function emptyInputLogin($email, $password) {
        $result = null;

        if (empty($email) || empty($password)) {
            $result = true;
        }
        else {
            $result = false;
        }

        return $result;
    }

    function loginUser($conn, $email, $password) {
        $userExist = userExist($conn, null, null, $email);

        if ($userExist == false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }

        $result = $conn->query("select * from user where password='$password';");

        if ($result) {

            if ($result && mysqli_num_rows($result) > 0) {
                $userdata = mysqli_fetch_assoc($result);

                if ($userdata['password'] === $password) {
                    session_start();

                    $_SESSION["id"] = $conn->query("select id from user where email='$email';");
                    $_SESSION["email"] = $email;

                    header("location: ../index.php");
                    exit();
                }
            }
            else {
                header("location: ../login.php?error=wrongdata");
                exit();
            }
        }
    }

    function recoverUserData($conn, $table, $data_requested) {
        $userid = getUserID($conn);

        switch ($table) {
            case 'user': 
                $result = $conn->query("select * from user where id='$userid';"); break;
            case 'address':
                $result = $conn->query("select * from address where user_id='$userid';"); break;
        }

        while($row = mysqli_fetch_assoc($result)){
            return $row[$data_requested];
        }
    }

    function getUserData($conn, $userid, $table, $data_requested) {
        switch ($table) {
            case 'user': 
                $result = $conn->query("select * from user where id='$userid';"); break;
            case 'address':
                $result = $conn->query("select * from address where user_id='$userid';"); break;
            case 'user_card_data':
                $result = $conn->query("select * from user_card_data where user_id='$userid';"); break;
            case 'user_orders':
                $result = $conn->query("select * from user_orders where user_id='$userid';"); break;
        }

        while($row = mysqli_fetch_assoc($result)){
            return $row[$data_requested];
        }
    }
    
    function emptyInputUserconfig($calle, $num, $codigo_pos, $colonia, $estado, $ciudad, $telefono) {
        if (empty($calle) || empty($num) || empty($codigo_pos) || empty($colonia) || empty($estado) || empty($ciudad) || empty($telefono)) {
            return true;
        }
        else {
            return false;
        }
    }

    function userAddressExist($conn, $id) {
        $result = $conn->query("select * from address where user_id='$id';");

        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        else {
            return false;
        }

        $conn->close();
    }

    function userCardDataExist($conn, $id) {
        $result = $conn->query("select * from user_card_data where user_id='$id';");

        if (mysqli_num_rows($result) > 0) {
            return true;
        }
        else {
            return false;
        }

        $conn->close();
    }

    function getUserID($conn) {
        $query = $conn->query("select id from user where email='".$_SESSION["email"]."';");
        $query = mysqli_fetch_assoc($query);
        $userid = $query["id"];

        return $userid;
    }

    function storeAddressData($conn, $calle, $num, $codigo_pos, $colonia, $estado, $ciudad, $telefono) {
        session_start();

        $userid = getUserID($conn);

        if (!userAddressExist($conn, $userid)) {
            $conn->query("insert into address (calle, num, codigo_pos, colonia, estado, ciudad, telefono, user_id) values ('$calle', '$num', '$codigo_pos', '$colonia', '$estado', '$ciudad', '$telefono', '$userid');");
        }
        else {
            $conn->query("update address set calle='$calle', num='$num', codigo_pos='$codigo_pos', colonia='$colonia', estado='$estado', ciudad='$ciudad', telefono='$telefono' where user_id='$userid';");
        }

        header("location: ../userconfig.php?error=none");
        $conn->close();
        session_abort();
        exit();
    }

    function storeUserCardData($conn, $titulo, $num, $exp, $codigo) {
        session_start();

        $userid = getUserID($conn);

        if (userCardDataExist($conn, $userid) == false) {
            $conn->query("insert into user_card_data (user_id, titulo, num, exp, codigo) values ('$userid', '$titulo', '$num', '$exp', '$codigo');");
        }
        else {
            $conn->query("update user_card_data set titulo='$titulo', num='$num', exp='$exp', codigo='$codigo' where user_id='$userid';");
        }

        header("location: ../bill_form.php");
        $conn->close();
        session_abort();
        exit();
    }

    function checkTime() {
        date_default_timezone_set('America/Mexico_City');
        $current_time = date("H");
        return $current_time;
    }

    function getProductData($conn, $id, $data_requested) {
        $result = $conn->query("select * from products where id='$id'");

        while($row = mysqli_fetch_assoc($result)){
            return $row[$data_requested];
        }
    }

    function getProductIndex($product_id) {
        $item_array_id = array_column($_SESSION["cart_items"], "product_id");
        $pos = array_search($product_id, $item_array_id);
        return $pos;
    }

    function emptyProductData($name, $prod_desc, $stock, $price, $prod_img) {
        $result = null;

        if (empty($name) || empty($prod_desc) || empty($stock) || empty($price) || empty($prod_img)) {
            $result = true;
        }
        else {
            $result = false;
        }

        return $result;
    }
?>