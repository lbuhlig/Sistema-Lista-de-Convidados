<?php
include('conexao.php');

if(!isset($_SESSION)) 
session_start();


if(!isset($_SESSION))
echo "<script> 
alert('Você não está logado. Faça login para ter acesso.');
window.location.href='login.php';
</script>";

?>

<?php 

$sql_clientes = "SELECT * FROM lista_convidados";
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

    
<?php if($_SESSION['admin']) { ?> <a href="cadastro_convidado.php">Cadastro de Convidados</a> <?php } ?>    
        <nav>
            <ul class="menu">
            <?php if($_SESSION['admin']) { ?>

                <li> <a href="cadastro_usuario.php">Cadastro usuário</a>  <?php } ?>          
                </li>  

                <li>
                <?php if($_SESSION['admin']) { ?>

                    <a href="admin.php">Administrador</a> <?php } ?>    
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
    <th>Nome</th>
    <th>Data de Nacimento</th>
    <th>CPF</th>
    <th>E-mail</th>
    <th>Telefone</th>

</tr>

</div>

<?php
if(!isset($_GET['busca'])) {
?>


<?php

} else {



$pesquisa= $mysqli->real_escape_string($_GET['busca']);
$sql_code= "SELECT *
FROM lista_convidados
WHERE nome LIKE '%$pesquisa%'
OR nascimento LIKE '%$pesquisa%'
or CPF LIKE '%$pesquisa%'
OR email LIKE '%$pesquisa%'
OR telefone LIKE '%$pesquisa%'";


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
    <td><?php echo $dados['nome'];?></td>
    <td><?php echo $dados['nascimento'];?></td>
    <td><?php echo $dados['CPF'];?></td>
    <td><?php echo $dados['email'];?></td>
    <td><?php echo $dados['telefone'];?></td>
    <td><?php echo $dados['data'];?></td>


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
    <h2>Lista de Convidados</h2>

    <p>Estes são os convidados cadastrados no seu sistema:</p>
    <table border="1" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Data de Cadastro</th>
            <?php if($_SESSION['admin']) { ?>
            <th>Ações</th> <?php }?>
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
                
                $telefone = "Não informado";
                if(!empty($cliente['telefone'])) {
                    $telefone = formatar_telefone($cliente['telefone']);
                }
                $nascimento = "Não informada";
                if(!empty($cliente['nascimento'])) {
                    $nascimento = formatar_data($cliente['nascimento']);
                }
                $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data']));
                ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $nascimento; ?></td>
                    <td><?php echo $cliente['CPF']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $telefone; ?></td>
                    <td><?php echo $data_cadastro; ?></td>

                    <?php if($_SESSION['admin']) { ?>
                    <div class="acoes">

                    <td>
                    <a href="editar_convidado.php?id=<?php echo $cliente['id']; ?>"><img src="editar.png" width="20px" height="20px" alt="Editar"/></a>
                    <a href="deletar_convidado.php?id=<?php echo $cliente['id']; ?>"><img src="lixo.png" width="20px" height="20px" alt="Editar"/></a>                 

                    </td>
                    </div>
                    <?php }
                    ?>

                </tr>

                <?php
                }
            } ?>
        </tbody>
  </body>

</html>

