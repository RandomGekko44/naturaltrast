<?php
    session_start();

    if (isset($_POST["btnAgregarCarrito"])) {
        $productid = $_POST["product_id"];

        if (isset($_SESSION["cart_items"])) {
            $item_array_id = array_column($_SESSION['cart_items'], "product_id");

            if (in_array($productid, $item_array_id)) {
                $pos = array_search($productid, $item_array_id);

                include_once "db_conn.php";

                $result = $conn->query("select stock from products where id='$productid'");
                
                while($row = mysqli_fetch_assoc($result)){
                    $product_stock = $row['stock'];
                }

                if ($_SESSION["cart_items"][$pos]['amount'] < $product_stock) {

                    $_SESSION["cart_items"][$pos]['amount']++;
                }
                
            }
            else {
                $arraycount = count($_SESSION["cart_items"]);
                $item = array('product_id'=>$productid, 'amount'=>1);
                $_SESSION["cart_items"][$arraycount] = $item;
            }
        }
        else {
            $item = array('product_id'=>$productid, 'amount'=>1);
            $_SESSION["cart_items"][0] = $item;
        }

        header("location: ../index.php");
        exit();
    }
?>