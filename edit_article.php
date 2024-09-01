<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/edit_article.css">

    <title>Document</title>
</head>
<body>
    <?php
        include_once "includes/header.php";
        include_once "scripts/db_conn.php";

        if (isset($_POST["btnEditar"])) {
            $productid = $_POST["product_id"];
        }

        if (isset($_POST["btnGuardar"])) {
            $name = $_POST['name'];
            $prod_desc = $_POST['prod_desc'];
            $stock = $_POST['stock'];
            $price = $_POST['price'];
            $productid = $_POST["product_id"];

            if (!empty($_POST['prod_img'])) {
                $prod_img = $_POST['prod_img'];
                $conn->query("update products set name='$name', prod_desc='$prod_desc', stock='$stock', price='$price', prod_img='./img/$prod_img' where id='$productid'");
            }
            else {
                $conn->query("update products set name='$name', prod_desc='$prod_desc', stock='$stock', price='$price' where id='$productid'");
            }

            $conn->close();

            header("location: article_panel.php");
        }

        if(isset($_POST["btnAgregar"])) {

            if (!emptyProductData($_POST['name'], $_POST['prod_desc'], $_POST['stock'], $_POST['price'], $_POST['prod_img'])) {
                $name = $_POST['name'];
                $prod_desc = $_POST['prod_desc'];
                $stock = $_POST['stock'];
                $price = $_POST['price'];
                $prod_img = $_POST['prod_img'];
                
                $conn->query("insert into products (name, prod_desc, stock, price, prod_img) values ('$name', '$prod_desc', '$stock', '$price', './img/$prod_img');");
                $conn->close();

                header("location: article_panel.php");
            }
            else {
                echo '<div style="width:30%; margin: 30px auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:40px;">Completa todos los campos</div>';
            }
        }
    ?>

    <section>
        
        <?php
            if (isset($productid)) {
        ?>

        <h2>Editar los detalles del producto</h2>

        <form method="post">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" value="<?php echo getProductData($conn, $productid, 'name') ?>" name="name">
            </div>
            
            <div class="form-group">
                <label>Descripcion</label>
                <input type="text" value="<?php echo getProductData($conn, $productid, 'prod_desc') ?>" name="prod_desc">
            </div>
            
            <div class="form-group">
                <label>Cantidad</label>
                <input type="text" value="<?php echo getProductData($conn, $productid, 'stock') ?>" name="stock">
            </div>
            
            <div class="form-group">
                <label>Precio</label>
                <input type="text" value="<?php echo getProductData($conn, $productid, 'price') ?>" name="price">
            </div>
            
            <div class="form-group">
                <br>
                <img src="<?php echo getProductData($conn, $productid, 'prod_img') ?>"> <br><br>
                <label>Elegir una imagen:</label>
                <input type="file" name="prod_img">
            </div>

            <div class="form-group">
                <br>
                <input type="submit" value="Guardar Cambios" id="saveBtn" name="btnGuardar">
                <input type="hidden" name="product_id" value=<?php echo $productid ?>>
            </div>
        </form>

        <?php
            }
            else {
        ?>

        <h2>Agregar un producto</h2>

        <form method="post">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="name">
            </div>
            
            <div class="form-group">
                <label>Descripcion</label>
                <input type="text" name="prod_desc">
            </div>
            
            <div class="form-group">
                <label>Cantidad</label>
                <input type="text" name="stock">
            </div>
            
            <div class="form-group">
                <label>Precio</label>
                <input type="text" name="price">
            </div>
            
            <div class="form-group">
                <br>
                <img src="img/agregar_imagen_icono.png"> <br><br>
                <label>Elegir una imagen:</label>
                <input type="file" name="prod_img">
            </div>

            <div class="form-group">
                <br>
                <input type="submit" value="Agregar Producto" id="saveBtn" name="btnAgregar">
            </div>
        </form>

        <?php
            }
        ?>


    </section>
</body>
</html>