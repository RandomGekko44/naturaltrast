<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Carrito</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/shopcart.css">
</head>
<body>
    
    <?php
        include_once "includes/header.php";
        include_once "scripts/db_conn.php";
        include_once "scripts/shopcart_driver.php";
    ?>

    <section id="cart_container">
        <h1 id="page_title">Carrito</h1>
        

        <?php
            if (isset($_SESSION["cart_items"])) {
        ?>
        
        <table>
            <tr>
                <th>Articulo</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>

            
            <?php
                $subtotal = 0;

                if (isset($_SESSION["cart_items"])) {

                    for ($i=0; $i < count($_SESSION["cart_items"]); $i++) {
                        $productid = $_SESSION["cart_items"][$i]['product_id'];
                        $price = getProductData($conn, $productid, 'price');
                        $amount = $_SESSION["cart_items"][$i]['amount'];
                        $subtotal += $price * $amount;
            ?>

            <tr id="cart-article-row">
                <td>
                    <div class="cart-article">
                        <img src=<?php echo getProductData($conn, $productid, 'prod_img') ?>>
                        <div>
                            <p><?php echo getProductData($conn, $productid, 'name'); ?></p>
                            <small>Precio: <?php echo getProductData($conn, $productid, 'price'); ?>$</small>
                        </div>
                    </div>
                </td>
                <td>
                    <p ><?php echo getProductData($conn, $productid, 'prod_desc'); ?></p>
                </td>
                <td>
                    <form method="post">
                        <div id="amount_display_container">
                            <input type="submit" value="-" name="btnRemover" id="modify_btn">
                            <input type="text" id="amount_display" value=<?php echo $_SESSION["cart_items"][$i]['amount'] ?> disabled>
                            <input type="submit" value="+" name="btnAgregar" id="modify_btn">
                        </div>

                        <input type="submit" value="Eliminar" name="btnEliminar" id="delete_btn">
                        <input type="hidden" name="product_id" value=<?php echo $productid ?>>
                    </form>
                </td>
                <td>$<?php echo $price * $amount ?></td>
            </tr>

            <?php
                    }
                }
            ?>
        </table>

        <div class="total_price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$<?php echo $subtotal ?></td>
                </tr>
                <tr>
                    <td>Impuestos</td>
                    <td>$<?php echo $tax = $subtotal*0.16 ?></td>
                </tr>
                <tr>
                    <td><b>Total</b></td>
                    <td><b>$<?php echo ($subtotal + $tax)?></b></td>
                </tr>
            </table>
        </div>

        <div>
            <a href="address.php" id="btnPagar">Pagar</a>
        </div>

        <?php
            }
            else {
                echo '<h2 style="font-weight: normal; margin-left: 3rem; font-size: 30px;">El carrito de compras esta vacio.</h2>';
            }
        ?>
    </section>
</body>
</html>