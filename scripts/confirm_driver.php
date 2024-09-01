<?php
    session_start();

    if (isset($_POST["btnSiguiente"]) && $_SESSION["payment_method"] == "Tarjeta") {
        $titulo = $_POST["titulo"];
        $num = $_POST["num"];
        $exp = $_POST["exp"];
        $codigo = $_POST["codigo"];

        include_once "db_conn.php";
        require_once "functions.php";

        storeUserCardData($conn, $titulo, $num, $exp, $codigo);
    }

    if (isset($_POST["btnSiguiente"])) {   
        include_once "db_conn.php";
        require_once "functions.php";

        $user_id = getUserID($conn);
        $productos = json_encode($_SESSION["cart_items"]);
        $total = $_SESSION["cart_items"]["total"];
        $fecha = date("Y-m-d");
        $envio = "En proceso";
        $metodo_envio = $_SESSION["delivery_method"];
        $metodo_pago = $_SESSION["payment_method"];

        $conn->query("insert into user_orders (productos, total, fecha, envio, metodo_envio, metodo_pago, user_id) values ('$productos', '$total', '$fecha', '$envio', '$metodo_envio', '$metodo_pago', '$user_id');");
        unset($_SESSION["cart_items"]);

        header("location: ../index.php");
    }
?>