<?php
include('conexao.php');

if(!isset($_SESSION)) 
session_start();

if(!isset($_SESSION['admin']) || !$_SESSION['admin'] ) {
    header ("Location: convidados.php");
    die(); }

?>

<?php 

$sql_clientes = "SELECT * FROM cadastro_usuario";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" />

    <title>Lista de Convidados</title>
</head>
<body>
<header class="header">
        <a href="cadastro_convidado.php">Cadastro de Convidados</a>
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

</table>
<br><br>
<div class="pesquisa">
<form action="">
<input name="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']?>" placeholder="Digite os termos da pesquisa" type="text">
<button type="submit">Pesquisar</button>
</form>

</br>

<table while="600px" border="1">
<tr>

    <th>E-mail</th>
    <th>Admin</th>

</tr>

</div>

<?php
if(!isset($_GET['busca'])) {
?>


<?php

} else {



$pesquisa= $mysqli->real_escape_string($_GET['busca']);
$sql_code= "SELECT *
FROM cadastro_usuario
WHERE email LIKE '%$pesquisa%'
OR admin LIKE '%$pesquisa%'";


$sql_query = $mysqli-> query($sql_code) or die ("Erro ao consultar!" . $mysqli-> error);
if ($sql_query -> num_rows ==0) {

?>

<tr>
<td>Nenum resultado encontrado...</td>
</tr>

<?php
} else {
while ($dados = $sql_query -> fetch_assoc()) {;
?>

<tr>
    <td><?php echo $dados['email'];?></td>
    <td><?php echo $dados['admin'];?></td>
    
</tr>

<?php
}
}
?>

<?php
}
?>

</table>
<div clas="tabela">
    <h2>Lista de Usuários</h2>

    <p>Estes são os usuários cadastrados no seu sistema:</p>
    <table border="1" cellpadding="10">
        <thead>
            <th>E-mail</th>
            <th>Admin</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
        </thead>
        <tbody>
</div>

            <?php if($num_clientes == 0) { ?>
                <tr>
                    <td colspan="7">Nenhum convidado foi cadastrado</td>
                </tr>
            <?php 
            } else {
                while ($cliente = $query_clientes->fetch_assoc()) {
                    $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data']));
                    
                ?>
                <tr>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php if($cliente['admin']) echo "Sim"; else echo 'Não';?></td>
                    <td><?php echo $data_cadastro; ?></td>
                   
                    <div class="acoes">
                    <td>
                        <a href="editar_usuario.php?id=<?php echo $cliente['id']; ?>"><img src="editar.png" width="20px" height="20px" alt="Editar"/></a>
                        <a href="excluir_usuario.php?id=<?php echo $cliente['id']; ?>"><img src="lixo.png" width="20px" height="20px" alt="Editar"/></a>
                    </td>
                    </div>
                </tr>
                <?php
                }
            } ?>
        </tbody>
    
  </body>

</html>
