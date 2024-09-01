<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/address.css">
    <link rel="stylesheet" href="css/payment.css">
</head>
<body>
    <?php
        include_once "includes/header.php";
        include_once "scripts/db_conn.php";
    ?>

    

    <?php
        if (isset($_POST["btnSiguiente"])) {
            if (isset($_POST["delivery-method-radio"]) && isset($_POST["payment-method-radio"])) {
                $_SESSION["delivery_method"] = $_POST["delivery-method-radio"];
                $_SESSION["payment_method"] = $_POST["payment-method-radio"];

                header("location: confirm.php");
            }
            else {
                echo '<div style="width:600px; margin: auto; margin-top: 50px; text-align: center; padding:10px; background-color:rgb(204, 0, 0); font-size:25px; color: white; border-radius:10px; margin-bottom:40px;">Elija un metodo de envio y pago</div>';
            }
        }
    ?>

    <section class="container">
        <h1 id="page_title">Carrito</h1>
        <h1 id="page_second_title">Envio y pago</h1>

        <div class="inner_container">
            <div id="delivery_container">
                <h2>Forma de envio</h2>

                <form method="post" >
                    <table>
                        <tr class="delivery-table-row">
                            <td><input type="radio" name="delivery-method-radio" value="Estafeta"></td>
                            <td>Estafeta</td>
                            <td><img src="img/estafeta_logo.png" ></td>
                            <td>$120</td>
                        </tr>
                        <tr class="delivery-table-row">
                            <td><input type="radio" name="delivery-method-radio" value="Fedex"></td>
                            <td>FedEx</td>
                            <td><img src="img/fedex_logo.png" ></td>
                            <td>$150</td>
                        </tr>
                        <tr class="delivery-table-row">
                            <td><input type="radio" name="delivery-method-radio" value="DHL"></td>
                            <td>DHL</td>
                            <td><img src="img/dhl_logo.png" ></td>
                            <td>$200</td>
                        </tr>
                        <tr class="delivery-table-row">
                            <td><input type="radio" name="delivery-method-radio" value="Paquetexpress"></td>
                            <td>Paquetexpress</td>
                            <td><img src="img/paquetexpress_logo.png" ></td>
                            <td>$220</td>
                        </tr>
                    </table>

                    <div>
                        <br><br>
                        <h2>Forma de pago</h2>

                        <table>
                            <tr class="payment-table-row">
                                <td><input type="radio" name="payment-method-radio" value="Paypal"></td>
                                <td>Paypal</td>
                                <td><img src="img/paypal_logo.png" ></td>
                            </tr>
                            <tr class="payment-table-row">
                                <td><input type="radio" name="payment-method-radio" value="OXXO"></td>
                                <td>OXXO</td>
                                <td><img src="img/oxxo_logo.png" ></td>
                            </tr>
                            <tr class="payment-table-row">
                                <td><input type="radio" name="payment-method-radio" value="Tarjeta"></td>
                                <td>Tarjeta de Debito/Credito</td>
                                <td><img src="img/visa_logo.png"></td>
                            </tr>
                        </table>
                    </div>

                    <div id="next_btn_container">
                        <input type="submit" id="next-btn" value='Siguiente' name="btnSiguiente">
                    </div>
                </form>

                
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
    </section>

    
</body>
</html>