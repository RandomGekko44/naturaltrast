<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>

    <style>
        * {
            font-family: sans-serif;
        }

        html {
            margin: 50px;
        }

        header {
            text-align: center;
        }

        header b {
            font-size: 30px;
            color: #E47911;
        }

        div {
            font-size: 15px;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 3px solid;
        }

        th {
            font-size: 25px;
        }

        .container {
            margin: 10px;
        }

        #item-list, #item-price, #pay-info, #total-info {
            float: right;
        }

        #item-list, #pay-info {
            float: left;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        #total-info {
            text-align: right;
        }
    </style>
</head>
<body>

    <?php
        include_once "scripts/db_conn.php";
        include_once "scripts/functions.php";

        if (isset($_POST["btnRevisarFactura"])) {
            $userid = $_POST["user_id"];
            $order_id = $_POST["order_id"];

            $result = $conn->query("select * from user_orders where id='$order_id'");

            while($row = mysqli_fetch_assoc($result)){
                $db_user_order = $row;
            }
        }
    ?>

    <?php
        switch($_SESSION["delivery_method"]) {
            case "Estafeta":
                $deliveryprice = 120; break;
            case "Fedex":
                $deliveryprice = 150; break;
            case "DHL":
                $deliveryprice = 200; break;
            case "Paquetexpress":
                $deliveryprice = 220; break;
        }
    ?>
    
    <?php
        
    ?>

    <header>
        <b>Factura del pedido</b> <br><br>
        <a href="orders.php">Retroceder</a>
    </header>

    <div>
        <p>Fecha del pedido: <?php echo $db_user_order["fecha"]; ?></p>
    </div>

    <table>
        <tr>
            <th>Datos generales</th>
        </tr>
        <tr>
            <td>
                <div class="container" id="item-list">
                    <b>Productos comprados:</b> <br>
                    
                    <?php
                        $products_array =  json_decode($db_user_order['productos'], true);
                        $subtotal = 0;

                        for ($i=0; $i < count($products_array)-1; $i++) {
                            $productid = $products_array[$i]['product_id'];
                            $price = getProductData($conn, $productid, 'price');
                            $amount = $products_array[$i]['amount'];
                            $subtotal += $price * $amount;

                    ?>

                    <ul>
                        <li><?php echo $amount ?> de <?php echo getProductData($conn, $productid, 'prod_desc'); ?></li>
                    </ul>

                    <?php
                        }
                    ?>
                </div>
                <div class="container" id="item-price">
                    <b>Subtotal:</b> <br><br>
                    $<?php echo $subtotal ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="container">
                    <b>Direccion de envio:</b>
                    <ul>
                        <li><?php echo recoverUserData($conn, 'user', 'name') ?> <?php echo recoverUserData($conn, 'user', 'last_name') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'calle') ?> <?php echo recoverUserData($conn, 'address', 'num') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'codigo_pos') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'colonia') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'estado') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'ciudad') ?></li>
                        <li>Tel. <?php echo recoverUserData($conn, 'address', 'telefono') ?></li>
                    </ul>

                    <b>Metodo de envio:</b>
                    <?php echo $_SESSION["delivery_method"] ?>
                </div>
            </td>
        </tr>
    </table>

    <br><br>

    <table>
        <tr>
            <th>Informacion de pago</th>
        </tr>
        <tr>
            <td>
                <div class="container" id="pay-info">
                    <b>Metodo de pago:</b> <br>
                    <?php echo $_SESSION["payment_method"] ?>
                    
                    <br><br>
                    <b>Direccion de facturacion:</b>
                    <ul>
                        <li><?php echo recoverUserData($conn, 'user', 'name') ?> <?php echo recoverUserData($conn, 'user', 'last_name') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'calle') ?> <?php echo recoverUserData($conn, 'address', 'num') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'codigo_pos') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'colonia') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'estado') ?></li>
                        <li><?php echo recoverUserData($conn, 'address', 'ciudad') ?></li>
                        <li>Tel. <?php echo recoverUserData($conn, 'address', 'telefono') ?></li>
                    </ul>
                </div>
                <div class="container" id="total-info">
                    <ul>
                        <li>Productos: $<?php echo $subtotal?></li>
                        <li>Envio: $<?php echo $deliveryprice ?></li>
                        <li>-----------</li>
                        <li>Subtotal: $<?php echo ($subtotal) + $deliveryprice ?></li>
                        <li>-----------</li>
                        <li><b>Total (Impuestos incluidos): $<?php echo ($subtotal + ($subtotal*0.16) + $deliveryprice) ?></b></li>
                    </ul>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>