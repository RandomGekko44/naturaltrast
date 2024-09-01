<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Articulos</title>
    <link rel="stylesheet" href="css/article_panel.css">
</head>
<body>
    <?php
        include_once "includes/header.php";
        include_once "scripts/db_conn.php";

        if (isset($_POST["btnEliminar"])) {
            $id = $_POST["product_id"];
            $conn->query("delete from products where id='$id'");
        }
    ?>

    <section id="article_container">
        <h1 id="page_title">Control de Inventario</h1>
        
        <form action="post">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Articulo</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                    <th></th>
                </tr>


                <?php
                    $result = $conn->query("select id from products");

                    while($row = mysqli_fetch_assoc($result)){
                        $db_articles_id[] = $row;
                    }

                    for ($i=0; $i < count($db_articles_id); $i++) {
                        $productid = $db_articles_id[$i]['id'];
                        $price = getProductData($conn, $productid, 'price');
                        $stock = getProductData($conn, $productid, 'stock');
                ?>

                <tr id="table-article-row">
                    <td>
                        <?php echo $productid ?>
                    </td>
                    <td>
                        <div class="table-article">
                            <img src=<?php echo getProductData($conn, $productid, 'prod_img') ?>>
                            <div>
                                <p><?php echo getProductData($conn, $productid, 'name'); ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p><?php echo getProductData($conn, $productid, 'prod_desc'); ?></p>
                    </td>
                    <td>
                        <div id="stock_display_container">
                            <input type="text" id="stock_display" value=<?php echo $stock ?> disabled>
                        </div>
                    </td>

                    <td><div>$<?php echo $price ?></div></td>

                    <td>
                        <form action="edit_article.php" method="post">
                            <input type="hidden" name="product_id" value=<?php echo $productid ?>>
                            <input type="submit" class="edit_btn" name="btnEditar" value="Editar">
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="submit" class="delete_btn" name="btnEliminar" value="Eliminar">
                            <input type="hidden" name="product_id" value=<?php echo $productid ?>>
                        </form>
                    </td>
                </tr>

                <?php
                    }
                ?>
            </table>

            <div >
                <br><br>
                <a href="edit_article.php" id="btnGuardar">Agregar Producto</a>
            </div>

        </form>
    </section>
</body>
</html>