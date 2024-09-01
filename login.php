<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar</title>

    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
    <?php
        include_once "includes/header.php";
        include_once "scripts/functions.php";

        if (checkTime() >= '18') {
            echo
            '<style> 
                .form_container {background-color: #3f3f3f;}
                #form_head_title {color: white;};
            </style>';
        }
    ?>

    <section class="account_page">
        <div class="container">
            <div class="row">
                <div class="col_2">

                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:40px;">Introduzca sus datos para poder iniciar sesion</div>';
                            }
                            else if ($_GET["error"] == "invalidemail") {
                                echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:40px;">El email es invalido</div>';
                            }
                            else if ($_GET["error"] == "wrongdata") {
                                echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:40px;">Los datos son incorrectos</div>';
                            }
                        }
                    ?>

                    <div class="form_container">
                        <div id="form_header">
                            <h2 id="form_head_title">Inicio de Sesion</h2>
                            <hr id="title_underline">
                            
                            <img id="user_img" src="img/user2.png">
                        </div>

                        <form action="scripts/login_driver.php" id="LoginForm" method="post">
                            <input type="email" placeholder="Email" name="email">
                            <input type="password" placeholder="Contraseña" name="password">
                            <input type="submit" value="Iniciar Sesion" class="btn" name="btnIniciarSesion">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>