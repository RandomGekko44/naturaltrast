<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Articulos</title>
    <link rel="stylesheet" href="css/article_panel.css">

    <style>
        #article_container {
            margin: 80px 100px;
        }
    </style>
</head>
<body>
    <?php
        include_once "includes/header.php";
        include_once "scripts/db_conn.php";

        if (isset($_POST["btnCancelar"])) {
            $id = $_POST["order_id"];
            $conn->query("delete from user_orders where id='$id'");
        }
    ?>

    <section id="article_container">
        <h1 id="page_title">Pedidos realizados</h1>


        <?php
            $userid = getUserID($conn);
            $result = $conn->query("select * from user_orders where user_id='$userid'");

            if (mysqli_num_rows($result) > 0) {

            
        ?>
        <form action="post">
            

            <table>
                <tr>
                    <th>Num. <br> pedido</th>
                    <th>Pedido</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Envio</th>
                    <th>Metodo <br> envio</th>
                    <th>Opciones</th>
                    <th></th>
                </tr>


                <?php
                    

                    while($row = mysqli_fetch_assoc($result)){
                        $db_users_orders[] = $row;
                    }

                    for ($i=0; $i < count($db_users_orders); $i++) {
                ?>

                <tr id="table-article-row">
                    <td><?php echo $i + 1 ?></td>

                    <td>
                        <div class="table-article">
                            <div>
                                <?php
                                    $products_array =  json_decode($db_users_orders[$i]['productos'], true);

                                    for ($j=0; $j < count($products_array)-1; $j++) { 
                                        $product_id = $products_array[$j]["product_id"];
                                ?>
                                
                                <p style="line-height: 10px;"><?php echo getProductData($conn, $product_id, 'name'); ?> (x<?php echo $products_array[$j]["amount"]; ?>)</p>

                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </td>

                    <td>$<?php echo $products_array["total"] ?></td>

                    <td>
                        <?php echo $db_users_orders[$i]["fecha"] ?>
                    </td>
                    <td>
                        <div id="stock_display_container">
                            <?php echo $db_users_orders[$i]["envio"] ?>
                        </div>
                    </td>

                    <td><?php echo $db_users_orders[$i]["metodo_envio"] ?></td>

                    <td>
                        <form action="bill_form.php" method="post">
                            <input type="hidden" name="user_id" value=<?php echo $userid ?>>
                            <input type="hidden" name="order_id" value=<?php echo $db_users_orders[$i]["id"]?>>
                            <input type="submit" class="edit_btn" name="btnRevisarFactura" value="Revisar Factura">
                        </form>
                    </td>

                    <td>
                        <form method="post">
                            <input type="hidden" name="order_id" value=<?php echo $db_users_orders[$i]["id"]?>>
                            <input type="submit" class="delete_btn" name="btnCancelar" value="Cancelar">
                        </form>
                    </td>

                    <?php
                        }
                    ?>
                </tr>
            </table>

            
        </form>

        <?php
            }
            else {
                echo '<h2 style="font-weight: normal; margin-left: 3rem; font-size: 30px;">Actualmente no hay pedidos.</h2>';
            }
        ?>
    </section>
</body>
</html>