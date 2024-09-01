<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>

    <link rel="stylesheet" href="css/userconfig.css">
</head>
<body>
    
    <?php
        include_once "includes/header.php";
        require_once "scripts/db_conn.php";
        require_once "scripts/functions.php";
    ?>

    <section>
        <?php
            if (!isset($_SESSION["id"])) {
                header("location: login.php");
            }
        ?>

        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(247, 97, 97); font-size:25px; border-radius:10px; margin-bottom:20px;">Los Campos Estan Vacios</div>';
                }
                else if ($_GET["error"] == "none") {
                    echo '<div style="width:600px; margin: auto; text-align: center; padding:10px; background-color:rgb(54, 172, 33); font-size:25px; border-radius:10px; margin-bottom:20px;">Cambios Guardados Correctamente</div>';
                }
            }
        ?>

        <div id="personalData_container">
            <h1>DATOS PERSONALES</h1>
            <div class="form_container">

                <label class="formLabel">Nombre <input type="text" class="formInput" placeholder="Nombre" value="<?php echo recoverUserData($conn, 'user', 'name') ?>" readonly></label> <br>
                <label class="formLabel">Apellido <input type="text" class="formInput" placeholder="Apellido" value="<?php echo recoverUserData($conn, 'user', 'last_name') ?>" readonly></label> <br>
                <label class="formLabel">Email <input type="email" class="formInput" placeholder="Email" value="<?php echo recoverUserData($conn, 'user', 'email') ?>" readonly></label>
            </div>
        </div>
        
        <div id="addressData_container">
            <h1>DATOS DE ENVIO</h1>
            <form action="scripts/userconfig_driver.php" class="form_container" id="address_form" method="post">
                <label class="formLabel">Calle <input type="text" class="formInput" placeholder="Calle" name="calle" value="<?php echo recoverUserData($conn, 'address', 'calle') ?>"></label> <br>
                <label class="formLabel">Numero <input type="text" class="formInput" placeholder="Numero" name="num" value="<?php echo recoverUserData($conn, 'address', 'num') ?>"></label> <br>
                <label class="formLabel">Codigo Postal <input type="text" class="formInput" placeholder="Codigo Postal" name="codigo_pos" value="<?php echo recoverUserData($conn, 'address', 'codigo_pos') ?>"></label> <br>
                <label class="formLabel">Colonia <input type="text" class="formInput" placeholder="Colonia" name="colonia" value="<?php echo recoverUserData($conn, 'address', 'colonia') ?>"></label> <br>
                
                <div>
                    <?php
                        $mexicoStates = array("Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas", 
                            "Chihuahua", "Coahuila", "Colima", "Durango", "Estado de México", "Guanajuato", "Guerrero", "Hidalgo", "Jalisco",
                            "Michoacán", "Morelos", "Nayarit", "Nuevo León", "Oaxaca", "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí", 
                            "Sinaloa", "Sonora", "Tabasco", "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
                        );

                        $userState = recoverUserData($conn, 'address', 'estado');
                    ?>

                    <label class="formLabel">Estado <select name="estado" id="formSelect">
                        <option value="">Elige un estado</option>

                        <?php
                            foreach ($mexicoStates as $state) {
                                echo '<option value="'.$state.'" '.($userState == $state ? 'selected' : '').'>'.$state.'</option>';
                            }
                        ?>
                    </select></label> <br>
                </div>
                
                <label class="formLabel">Ciudad <input type="text" class="formInput" placeholder="Ciudad" name="ciudad" value="<?php echo recoverUserData($conn, 'address', 'ciudad') ?>"></label> <br>
                <label class="formLabel">Telefono <input type="text" class="formInput" placeholder="Telefono" name="telefono" value="<?php echo recoverUserData($conn, 'address', 'telefono') ?>"></label>
                
                <input type="submit" value="Guardar Cambios" id="saveBtn" name="btnGuardarCambios">
            </form>

            
        </div>
    </section>
</body>
</html>