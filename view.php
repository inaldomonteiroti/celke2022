<?php
session_start();

ob_start();

//Receber o id do usuario
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Celke - Visualizar</title>
</head>

<body>

    <a href="index.php">Listar</a><br>
    <a href="create.php">Cadastrar</a><br>

    <h1>Detalhes do Usuário</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    //Verificar se o id possui valor
    if (!empty($id)) {
        //Incluir os arquivos
        require './Conn.php';
        require './User.php';

        //Instanciar a classe e criar o objeto
        $viewUser = new User();
        
        //Enviando o id para o atributo id da classe User
        $viewUser->id = $id;

        //Instanciando o metodo visualizar
        $valueUser = $viewUser->view();
        
        //var_dump($valueUser);
        extract($valueUser);
        echo "Id do usuário: $id <br>";
        echo "Nome do usuário: $name <br>";
        echo "Email do usuário: $email <br>";
        echo "Cadastrado: " . date('d/m/Y H:i:s', strtotime($created)) . " <br>";

        echo "Editado: ";
        if(!empty($modified)){
            echo date('d/m/Y H:i:s', strtotime($modified));
        }
        echo " <br>";

    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
        header("Location: index.php");
    }



    ?>

</body>

</html>