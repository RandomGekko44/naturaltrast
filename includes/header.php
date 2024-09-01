<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>

    <link rel="stylesheet" href="css/header.css">
</head>
<body>

    <?php
        include_once "scripts/functions.php";
        include_once "scripts/db_conn.php";

        if (checkTime() >= '23') {
            echo
            '<style> 
                * {color: white;}
                body {background-color: #2c2c2c;}
                input {color: white; background-color: #232323;}
                select, option {color: white; background-color: #232323;}
            </style>';
        }
    ?>

    <header>
        <nav>
            <div class="head_title_container">
                <img src="img/naturaltrast_logo2-removebg-preview.png" id="img_title">
                <span id="shop_name">NATURAL TRAST</span>
            </div>

            <ul class="head_menu">
                <li><a href="index.php" class="head_link">Inicio</a></li>
                <li><a href="index.php" class="head_link">Articulos</a></li>

                <li id="head_list_user">
                    
                    <?php
                        if (isset($_SESSION["id"])) {
                            echo '<a href="#" class="head_link" id="usermenu_btn">Usuario</a>';
                        } 
                        else {
                            echo '<a href="#" class="head_link" id="usermenu_btn">Ingresar</a>';
                        }
                    ?>

                    <ul class="dropdown_menu">
                        <?php
                            if (isset($_SESSION["id"])) {
                                echo '<li><a href="scripts/logout_driver.php">Cerrar Sesion</a></li>';
                                echo '<li><a href="userconfig.php">Configuracion</a></li>';
                                echo '<li><a href="orders.php">Pedidos</a></li>';
                                echo '<style>#dropdown_menu {width: 159px;}</style>';
                            }
                            else {
                                echo '<li><a href="signup.php">Registrarse</a></li>';
                                echo '<li><a href="login.php">Iniciar Sesion</a></li>';
                                echo '<style>#dropdown_menu {width: 500px;}</style>';
                            }
                        ?>
                    </ul>
                </li>

                <li id="head_list_panel">
                    
                    <?php
                        if (isset($_SESSION["id"]) && getUserID($conn) == 1) {
                            echo '<a href="#" class="head_link" id="controlpanel_btn">Panel de control</a>';
                        }
                    ?>

                    <ul class="dropdown_menu" id="dropdown_menu_panel">
                        <?php
                            if (isset($_SESSION["id"]) && getUserID($conn) == 1) {
                                echo '<li><a href="article_panel.php">Control de Inventario</a></li>';
                                echo '<li><a href="user_panel.php">Control de Usuarios</a></li>';
                            }
                        ?>
                    </ul>
                </li>

                <?php
                    if (isset($_SESSION["id"])) {
                        echo '<li><a href="shopcart.php"><img id="head_cart_img" src="img/carrito.png"></a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>
</body>
</html>