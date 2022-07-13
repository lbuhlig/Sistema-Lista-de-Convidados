<?php

include('conexao.php');

if(!isset($_SESSION)) 
session_start();

if(!isset($_SESSION['admin']) || !$_SESSION['admin'] ) {
header ("Location: convidados.php");
die(); }

$id = intval($_GET['id']);
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
        $sql_code = "UPDATE lista_convidados
        SET nome = '$nome', 
        nascimento = '$nascimento',
        CPF = '$CPF', 
        email = '$email', 
        telefone = '$telefone'
        WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo) {
            header("Location: convidados.php");
        }
    }

}

$sql_cliente = "SELECT * FROM lista_convidados WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" />
    <title>Cadastrar Cliente</title>
</head>
<body>
<header class="header">
        <a href="convidados.php">Lista de Convidados</a>
        <nav>
            <ul class="menu">
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>

<div class="editar_convidado">

    <form method="POST" action="">
        <p>
            <label>Nome:</label>
            <input value="<?php echo $cliente['nome']; ?>" name="nome" type="text">
        </p>

        <p>
            <label>Data de Nascimento:</label>
            <input value="<?php if(!empty($cliente['nascimento'])) echo formatar_data($cliente['nascimento']); ?>"  name="nascimento" type="text">
        </p>

        <p>
            <label>CPF:</label>
            <input value="<?php echo $cliente['CPF']; ?>" name="CPF" type="text">
        </p>

        <p>
            <label>E-mail:</label>
            <input value="<?php echo $cliente['email']; ?>" name="email" type="text">
        </p>

        <p>
            <label>Telefone:</label>
            <input value="<?php if(!empty($cliente['telefone'])) echo formatar_telefone($cliente['telefone']); ?>"  placeholder="(11) 98888-8888" name="telefone" type="text">
        </p>
    <div class="btn_editar">
        <p>
            <button type="submit">Salvar Convidado</button>
        </p>
        <div class="voltar">

        <p>
            <button type="submit"><a href="convidados.php">Voltar</a></button>
        <p>
        </div>
    </div>
    </form>
</div>
</body>
</html>