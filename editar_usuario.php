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

    $email = $_POST['email'];
    $admin = $_POST['admin'];

        $sql_code = "UPDATE cadastro_usuario
        SET email = '$email', 
        admin= '$admin',
        WHERE id = '$id'";
        $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
        if($deu_certo) {
            header("Location: usuarios.php");
        }
    }



$sql_cliente = "SELECT * FROM cadastro_usuario WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" />
    <title>Excluir Usuário</title>
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

    <form class="cad_user" action="" method="POST">
   <h3>Editar usuário <h3> 

        <input value="<?php echo $cliente['email']; ?>" name="email" type="text"></input> </br> </br>
      
<div class="nivel">
      <select value="<?php echo $cliente['admin']; ?>" name="admin" required name= "admin"id="select">
            <option  name="admin" value="" selected="">Qual o nível de acesso do usuário?</option>
            <option  name="admin" value="1">Administrador</option>
            <option  name="admin" value="0">Usuário Comum</option>
    
          </select> </br></br>
</div>

      <button  type="submit">Salvar</button>

</form>


</div>
</body>
</html>