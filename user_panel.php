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
    ?>

    <section id="article_container">
        <h1 id="page_title">Control de Usuarios</h1>
        
        <form action="post">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Nombre de usuario</th>
                    <th>Email</th>
                    <th>Numero telefonico</th>
                    <th>Direccion</th>
                </tr>


                <?php
                    $result = $conn->query("select id from user");

                    while($row = mysqli_fetch_assoc($result)){
                        $db_users_id[] = $row;
                    }

                    for ($i=1; $i < count($db_users_id); $i++) {
                        $userid = $db_users_id[$i]['id'];
                ?>

                <tr id="table-article-row">
                    <td>
                        <?php echo $userid ?>
                    </td>
                    <td>
                        <div class="table-article">
                            <div>
                                <p><?php echo getUserData($conn, $userid, 'user', 'name'); ?> <?php echo getUserData($conn, $userid, 'user', 'last_name'); ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p><?php echo getUserData($conn, $userid, 'user', 'username'); ?></p>
                    </td>
                    <td>
                        <div id="stock_display_container">
                            <p><?php echo getUserData($conn, $userid, 'user', 'email'); ?></p>
                        </div>
                    </td>

                    <td><div><?php echo getUserData($conn, $userid, 'address', 'telefono'); ?></div></td>

                    <td>
                        <form action="show_user_address.php" method="post">
                            <input type="hidden" name="user_id" value=<?php echo $userid ?>>
                            <input type="submit" class="edit_btn" name="btnRevisarDireccion" value="Revisar Direccion">
                        </form>
                    </td>
                </tr>

                <?php
                    }
                ?>
            </table>
        </form>
    </section>
</body>
</html>