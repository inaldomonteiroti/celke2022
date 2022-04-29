<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Celke - Listar</title>
</head>

<body>

    <a href="index.php">Listar</a><br>
    <a href="create.php">Cadastrar</a><br>

    <h1>Listar Usuários</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    require './Conn.php';
    require './User.php';

    $listUsers = new User();
    $result_users = $listUsers->list();

    foreach ($result_users as $row_user) {
        //var_dump($row_user);
        extract($row_user);

        //echo "ID: " . $row_user['id'] . "<br>";
        echo "ID: $id <br>";

        //echo "Nome: " . $row_user['name'] . "<br>";
        echo "Nome: $name <br>";

        //echo "E-mail: " . $row_user['email'] . "<br>";
        echo "E-mail: $email <br>";

        echo "<a href='view.php?id=$id'>Visualizar</a><br>";
        echo "<a href='edit.php?id=$id'>Editar</a><br>";
        echo "<a href='delete.php?id=$id'>Apagar</a><br>";
        echo "<hr>";
    }

    ?>

</body>

</html>