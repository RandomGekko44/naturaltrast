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

        if (isset($_POST["btnRevisarDireccion"])) {
            $userid = $_POST["user_id"];
        }
    ?>

    <section>
        
        <?php
            if (isset($userid)) {
        ?>

        <h2>Direccion del usuario</h2>

        <form>
            <div class="form-group">
                <p>Nombre: <?php echo getUserData($conn, $userid, 'user', 'name'); ?> <?php echo getUserData($conn, $userid, 'user', 'last_name'); ?></p>
            </div>
            
            <div class="form-group">
                <br>
                <label><b>Direccion</b></label>
                
                <div style="border: 2px solid #ccc; width: 50%; border-radius: 10px;">
                    <div style="margin: 10px;">
                        <?php echo getUserData($conn, $userid, 'address', 'calle'); ?> <br>
                        <?php echo getUserData($conn, $userid, 'address', 'codigo_pos'); ?> <br>
                        <?php echo getUserData($conn, $userid, 'address', 'colonia'); ?> <br>
                        <?php echo getUserData($conn, $userid, 'address', 'estado'); ?> <br>
                        <?php echo getUserData($conn, $userid, 'address', 'ciudad'); ?> <br>
                        <?php echo getUserData($conn, $userid, 'address', 'telefono'); ?>
                    </div> 
                </div>
            </div>

            <div class="form-group">
                <br>
                <a href="user_panel.php" id="saveBtn" style="padding: 10px; text-decoration: none;">Retroceder</a>
            </div>
        </form>

        <?php
            }
        ?>
    </section>
</body>
</html>