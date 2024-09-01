<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>

    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    
    <?php
        include_once "includes/header.php";
        include_once "scripts/functions.php";

    ?>

    <section class="account_page">
        <div class="container">
            <div class="row">

                <div class="col_2">

                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:40px;">Introduzca sus Datos para Poder Registrarse</div>';
                            }
                            else if ($_GET["error"] == "invalidusername") {
                                echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:40px;">El nombre de usuario es invalido</div>';
                            }
                            else if ($_GET["error"] == "invalidemail") {
                                echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:40px;">El email es invalido</div>';
                            }
                            else if ($_GET["error"] == "useralreadyexist") {
                                echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:40px;">Ya existe un usuario con el mismo nombre de usuario e email</div>';
                            }
                        }
                    ?>

                    <div class="form_container">
                        <div id="form_header">
                            <h2 id="form_head_title">Registrarse</h2>
                            <hr id="title_underline">
                            
                            <img id="user_img" src="img/user2.png">
                        </div>

                        <form action="scripts/signup_driver.php" method="post">
                            <input type="text" placeholder="Nombre" name="name">
                            <input type="text" placeholder="Apellido" name="last_name">
                            <input type="text" placeholder="Nombre de Usuario" name="username">
                            <input type="email" placeholder="Correo Electronico" name="email">
                            <input type="password" placeholder="Contraseña" name="password">
                            <input type="submit" class="btn" value="Registrarse" name="btnReg">
                        </form>    
                    </div>

                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>