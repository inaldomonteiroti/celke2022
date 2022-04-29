<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Celke - Cadastrar</title>
</head>

<body>

    <a href="index.php">Listar</a><br>
    <a href="create.php">Cadastrar</a><br>

    <h1>Cadastrar Usuário</h1>

    <?php
    require './Conn.php';
    require './User.php';

    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);    

    if(!empty($formData['SendAddUser'])){
        //var_dump($formData);
        $createUser = new User();
        $createUser->formData = $formData;
        $value = $createUser->create();

        if($value){
            $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
            header("Location: index.php");
        }else{
            echo "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
        }

    }

    ?>

    <form name="CreateUser" method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="name" placeholder="Nome completo" required /><br><br>

        <label>E-mail: </label>
        <input type="email" name="email" placeholder="Melhor e-mail" required /><br><br>

        <input type="submit" value="Cadastrar" name="SendAddUser" />
    </form>

</body>

</html>