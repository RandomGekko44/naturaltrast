<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ecotienda</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    
    <?php
        include_once "includes/header.php";
        include_once "scripts/functions.php";
        include_once "scripts/db_conn.php";

        if (checkTime() >= '18') {
            echo
            '<style> 
                .article_container {background-color: #3f3f3f;}
            </style>';
        }
    ?>


    <h1 id="section_title">Articulos</h1>

    <section>
        <?php
            $result = $conn->query("select * from products");

            while($row = mysqli_fetch_assoc($result)){
                $productdata[] = $row;
            }

            $conn->close();
        ?>

        <div class="container">
            <?php
                for ($i=0; $i < count($productdata); $i++) {

                    $img = $productdata[$i]["prod_img"];
                    $name = $productdata[$i]["name"];
                    $desc = $productdata[$i]["prod_desc"];
                    $price = $productdata[$i]["price"];
                    $id = $productdata[$i]["id"];
            ?>
        
            <article class="article_container">
                <form action="scripts/addcart_driver.php" method="post" id="article_form">
                    <img src=<?php echo $img ?> class="img_product">

                    <h2 class="article_title"><?php echo $name ?></h2>
                    <p><?php echo $desc ?></p>
                    <p class="article_price" style="text-decoration: line-through; font-weight: lighter;"><?php echo (($price*0.3) + $price) ?>$</p>
                    <p class="article_price"><span style="font-weight: lighter; color: green;">-30%</span> <?php echo $price ?>$</p>
                    
                    <input type="submit" name="btnAgregarCarrito" value="Agregar al Carrito" class="btnAddCart">
                    <input type="hidden" name="product_id" value=<?php echo $id ?>>
                </form>
            </article>

            <?php
                }
            ?>
        </div>
    </section>


    <?php
        include_once "includes/footer.php";
    ?>

</body>
</html>