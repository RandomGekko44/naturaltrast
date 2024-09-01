<?php
    if (isset($_POST["btnGuardarCambios"])) {

        $calle = $_POST["calle"];
        $num = $_POST["num"];
        $codigo_pos = $_POST["codigo_pos"];
        $colonia = $_POST["colonia"];
        $estado = $_POST["estado"];
        $ciudad = $_POST["ciudad"];
        $telefono = $_POST["telefono"];

        require_once "db_conn.php";
        require_once "functions.php";

        if (emptyInputUserconfig($calle, $num, $codigo_pos, $colonia, $estado, $ciudad, $telefono) !== false) {
            header("location: ../userconfig.php?error=emptyinput");
            exit();
        }
        
        storeAddressData($conn, $calle, $num, $codigo_pos, $colonia, $estado, $ciudad, $telefono);
    }
?>