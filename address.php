<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" href="css/address.css">
</head>
<body>
    <?php
        include_once "includes/header.php";
        include_once "scripts/db_conn.php";
    ?>

    <section class="container">
        <h1 id="page_title">Carrito</h1>
        <h1 id="page_second_title">Elegir direccion</h1>

        <div class="inner_container">
            <div id="address_container">
                <h2>Direccion de envio</h2>
                

                <p>Por favor verifica tu direccion de envio</p>
                <div id="user-address">
                    <p><b><?php echo recoverUserData($conn, 'user', 'name') ?> <?php echo recoverUserData($conn, 'user', 'last_name') ?></b></p>
                    <p><?php echo recoverUserData($conn, 'address', 'calle') ?> <?php echo recoverUserData($conn, 'address', 'num') ?></p>
                    <p><?php echo recoverUserData($conn, 'address', 'codigo_pos') ?></p>
                    <p><?php echo recoverUserData($conn, 'address', 'colonia') ?></p>
                    <p><?php echo recoverUserData($conn, 'address', 'estado') ?></p>
                    <p><?php echo recoverUserData($conn, 'address', 'ciudad') ?></p>
                    <p>Tel. <?php echo recoverUserData($conn, 'address', 'telefono') ?></p>
                </div>
                
                <br>
                <a href="userconfig.php">Editar direccion</a>
            </div>

            <div id="item_list_container">
                <h2>Lista de articulos</h2>

                <div id="item-list">
                    <table>

                        <tr>
                            <th>Articulo</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>

                        <?php
                            $subtotal = 0;

                            for ($i=0; $i < count($_SESSION["cart_items"]); $i++) {
                                $productid = $_SESSION["cart_items"][$i]['product_id'];
                                $price = getProductData($conn, $productid, 'price');
                                $amount = $_SESSION["cart_items"][$i]['amount'];
                                $subtotal += $price * $amount;

                        ?>

                        <tr>
                            <td><?php echo getProductData($conn, $productid, 'name'); ?></td>
                            <td><?php echo getProductData($conn, $productid, 'prod_desc'); ?></td>
                            <td><?php echo $_SESSION["cart_items"][$i]['amount'] ?></td>
                            <td>$<?php echo $price * $amount ?></td>
                        </tr>

                        <?php
                            }
                        ?>

                    </table>
                </div>
                
                <br>
                <p id="total-price-display">Subtotal: $<?php echo $subtotal ?></p>
                <p id="total-price-display"><b>Total (Con Impuestos): $<?php echo ($subtotal + ($subtotal*0.16)) ?></b></p>
            </div>
        </div>
        
        <div id="next_btn_container">
            <a href="payment.php" id="next-btn">Siguiente</a>
        </div>
        
    </section>
</body>
</html>