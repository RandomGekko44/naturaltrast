<?php
    if (isset($_POST["btnRemover"])) {
        $pos = getProductIndex($_POST["product_id"]);
        
        if(isset($_SESSION["cart_items"][$pos]['amount'])) {

            if (($_SESSION["cart_items"][$pos]['amount']) > 1) {

                $_SESSION["cart_items"][$pos]['amount']--;
            }
        }
    }


    if (isset($_POST["btnAgregar"])) {
        $pos = getProductIndex($_POST["product_id"]);
        $productid = $_POST["product_id"];

        if(isset($_SESSION["cart_items"][$pos]['amount'])) {
            include_once "scripts/db_conn.php";

            $result = $conn->query("select stock from products where id='$productid'");
                
            while($row = mysqli_fetch_assoc($result)){
                $product_stock = $row['stock'];
            }

            if ($_SESSION["cart_items"][$pos]['amount'] < $product_stock) {

                $_SESSION["cart_items"][$pos]['amount']++;
            }
        }
    }


    if (isset($_POST["btnEliminar"])) {
        $pos = getProductIndex($_POST["product_id"]);
        array_splice($_SESSION["cart_items"], $pos, 1);

        if (count($_SESSION["cart_items"]) == 0) {
            unset($_SESSION["cart_items"]);
        }   
    }
?>