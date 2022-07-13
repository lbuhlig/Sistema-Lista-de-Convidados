<?php
include('conexao.php');

if(!isset($_SESSION)) 
session_start();

if(!isset($_SESSION['admin']) || !$_SESSION['admin'] ) {
    header ("Location: convidados.php");
    die(); }
?>

<?php

function limpar_texto($str){ 
    return preg_replace("/[^0-9]/", "", $str); 
}

if(count($_POST) > 0) {

    
    $erro = false;

    $nome = $_POST['nome'];
    $nascimento = $_POST['nascimento'];
    $CPF = $_POST['CPF'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];


    if(empty($nome)) {
        $erro = "Preencha o nome";
    }
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o e-mail";
    }

    if(!empty($nascimento)) { 
        $pedacos = explode('/', $nascimento);
        if(count($pedacos) == 3) {
            $nascimento = implode ('-', array_reverse($pedacos));
        } else {
            $erro = "A data de nascimento deve seguir o padrão dia/mes/ano.";
        }
    }

    if(!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if(strlen($telefone) != 11)
            $erro = "O telefone deve ser preenchido no padrão (11) 98888-8888";
    }

    if($erro) {
        echo "<p><b>ERRO: $erro</b></p>";
    } else {
        $sql_code = "INSERT INTO lista_convidados (nome, nascimento, CPF, email, telefone, data) 
        VALUES ('$nome', '$nascimento', '$CPF','$email', '$telefone', NOW())";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo) {
            echo "<script> 
            alert('Convidado cadastrado com sucesso!');
            window.location.href='convidados.php';
            </script>";
            unset($_POST['nome'], $_POST['nascimento'], $_POST['CPF'], $_POST['telefone'], $_POST['email'], );

        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Convidado</title>
    <link href="style.css" rel="stylesheet" />

</head>
<body>
<header class="header">
        <a href="convidados.php">Lista de Convidados</a>
        <nav>
            <ul class="menu">
            <li>
                    <a href="cadastro_usuario.php">Cadastro usuário</a>
                </li>
                <li>
                    <a href="admin.php">Administrador</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>

    <form class="cad_convidado" method="POST" action="">
        <h3>Cadastre o convidado</h3>
        <p>
            <label></label>
            <input required placeholder="nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome']; ?>" name="nome" type="text">
        </p>

        <p>
            <label></label>
            <input  required placeholder="data de nascimento" value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento']; ?>"  name="nascimento" type="text">
        </p>

        <p>
            <label></label>
            <input  required placeholder="CPF" value="<?php if(isset($_POST['CPF'])) echo $_POST['CPF']; ?>" name="CPF" type="text">
        </p>

        <p>
            <label></label>
            <input  required placeholder="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" name="email" type="text">
        </p>
        <p>
            <label></label>
            <input  required placeholder="telefone" value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone']; ?>"  placeholder="(11) 98888-8888" name="telefone" type="text">
        </p>
       
        <p>
            <button type="submit">Salvar Convidado</button>
        </p>
    </form>
</body>
</html>