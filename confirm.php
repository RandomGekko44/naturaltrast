<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/address.css">
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="css/confirm.css">
</head>
<body>
    <?php
        include_once "includes/header.php";
        include_once "scripts/db_conn.php";
    ?>

    <?php
        switch($_SESSION["delivery_method"]) {
            case "Estafeta":
                $deliveryprice = 120;
                $delivery_img = 'img/estafeta_logo.png'; break;
            case "Fedex":
                $deliveryprice = 150;
                $delivery_img = 'img/fedex_logo.png'; break;
            case "DHL":
                $deliveryprice = 200;
                $delivery_img = 'img/dhl_logo.png'; break;
            case "Paquetexpress":
                $deliveryprice = 220;
                $delivery_img = 'img/paquetexpress_logo.png'; break;
        }

        switch($_SESSION["payment_method"]) {
            case "Paypal":
                $payment_img = 'img/paypal_logo.png'; break;
            case "OXXO":
                $payment_img = 'img/oxxo_logo.png'; break;
            case "Tarjeta":
                $payment_img = 'img/visa_logo.png'; break;
        }
    ?>

    <section class="container">
        <h1 id="page_title">Carrito</h1>
        <h1 id="page_second_title">Confirmacion</h1>

        <div class="inner_container">
            <div id="delivery_container">
                <h2>Forma y datos de envio</h2>


                <div id="delivery-method">
                    <img src=<?php echo $delivery_img ?>>
                    <br>
                    <a href="payment.php">Modificar</a>
                </div>

                <br>
                <div id="user-address">
                    <p><b><?php echo recoverUserData($conn, 'user', 'name') ?> <?php echo recoverUserData($conn, 'user', 'last_name') ?></b></p>
                    <p><?php echo recoverUserData($conn, 'address', 'calle') ?> <?php echo recoverUserData($conn, 'address', 'num') ?></p>
                    <p><?php echo recoverUserData($conn, 'address', 'codigo_pos') ?></p>
                    <p><?php echo recoverUserData($conn, 'address', 'colonia') ?></p>
                    <p><?php echo recoverUserData($conn, 'address', 'estado') ?></p>
                    <p><?php echo recoverUserData($conn, 'address', 'ciudad') ?></p>
                    <p>Tel. <?php echo recoverUserData($conn, 'address', 'telefono') ?></p>
                </div>
                <a href="userconfig.php">Cambiar direccion de envio</a>
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
                <p id="total-price-display">Envio: $<?php echo $deliveryprice ?></p>
                <p id="total-price-display"><b>Total (Con Impuestos): $<?php echo ($subtotal + ($subtotal*0.16) + $deliveryprice) ?></b></p>
                <?php $_SESSION["cart_items"]["total"] =  ($subtotal + ($subtotal*0.16) + $deliveryprice); ?>
            </div>
        </div>
    </section>
    
    <form action="scripts/confirm_driver.php" method="post">
        <section class="container">

            <div class="inner_container">
                <div id="payment_container">
                    <h2>Forma de pago</h2>

                    <div id="payment-method">
                        <img src=<?php echo $payment_img ?>>
                        <br>
                        <a href="payment.php">Modificar</a>

                        <?php
                            if ($_SESSION["payment_method"] === 'Tarjeta') {
                                $user_id = getUserID($conn);

                                $result = $conn->query("select num from user_card_data where user_id='$user_id';");

                                if (mysqli_num_rows($result) == 0) {
                        ?>

                        <div id="card-form">
                            <div>
                                <table>
                                    <tr class="form-table-row">
                                        <td><label class="formLabel">Titulo de la tarjeta <input class="formInput" type="text" name="titulo"></label></td>
                                    </tr>
                                    <tr class="form-table-row">
                                        <td><label class="formLabel">Numero de tarjeta <input class="formInput" type="text" name="num"></label></td>
                                    </tr>
                                    <tr class="form-table-row">
                                        <td><label class="formLabel">Expiracion <input class="formInput" type="text" name="exp"></label></td>
                                    </tr>
                                    <tr class="form-table-row">
                                        <td><label class="formLabel">CVV / CVC <input class="formInput" type="text" name="codigo"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <?php
                                }
                                else {
                        ?>

                        <div id="card-form">
                            <div>
                                <table>
                                    <tr class="form-table-row">
                                        <td><label class="formLabel">Titulo de la tarjeta <input class="formInput" type="text" name="titulo" value="<?php echo getUserData($conn, $user_id, 'user_card_data', 'titulo') ?>"></label></td>
                                    </tr>
                                    <tr class="form-table-row">
                                        <td><label class="formLabel">Numero de tarjeta <input class="formInput" type="text" name="num" value="<?php echo getUserData($conn, $user_id, 'user_card_data', 'num') ?>"></label></td>
                                    </tr>
                                    <tr class="form-table-row">
                                        <td><label class="formLabel">Expiracion <input class="formInput" type="text" name="exp" value="<?php echo getUserData($conn, $user_id, 'user_card_data', 'exp') ?>"></label></td>
                                    </tr>
                                    <tr class="form-table-row">
                                        <td><label class="formLabel">CVV / CVC <input class="formInput" type="text" name="codigo" value="<?php echo getUserData($conn, $user_id, 'user_card_data', 'codigo') ?>"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div id="next_btn_container">
                <input type="submit" value="Realizar pedido y pagar" id="next-btn" name="btnSiguiente">
            </div>
        </section>
    </form>

    
</body>
</html>