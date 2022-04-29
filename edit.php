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
    <title>Celke - Editar</title>
</head>

<body>

    <a href="index.php">Listar</a><br>
    <a href="create.php">Cadastrar</a><br>

    <h1>Editar o Usuário</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    //Incluir os arquivos
    require './Conn.php';
    require './User.php';

    //Receber os dados do formulario
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //Verificar se o usuario clicou no botao
    if (!empty($formData['SendEditUser'])) {
        //var_dump($formData);
        $editUser = new User();
        $editUser->formData = $formData;
        $value = $editUser->edit();
        if($value){
            $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
            header("Location: index.php");
        }else{
            echo "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
        }
    }

    //Verificar se o id possui valor
    if (!empty($id)) {

        //Instanciar a classe e criar o objeto
        $viewUser = new User();

        //Enviando o id para o atributo id da classe User
        $viewUser->id = $id;

        //Instanciando o metodo visualizar
        $valueUser = $viewUser->view();

        //var_dump($valueUser);
        extract($valueUser);

    ?>
        <form name="EditUser" method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />

            <label>Nome: </label>
            <input type="text" name="name" placeholder="Nome completo" value="<?php echo $name; ?>" required /><br><br>

            <label>E-mail: </label>
            <input type="email" name="email" placeholder="Melhor e-mail" value="<?php echo $email; ?>" required /><br><br>

            <input type="submit" value="Editar" name="SendEditUser" />
        </form>
    <?php


    } else {
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
        header("Location: index.php");
    }
    ?>

</body>

</html>