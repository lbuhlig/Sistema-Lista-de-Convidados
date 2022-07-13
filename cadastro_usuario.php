<?php
include('conexao.php');

if(!isset($_SESSION))
session_start();

if(!isset($_SESSION['admin']) || !$_SESSION['admin'] ) {
    header ("Location: convidados.php");
    die(); }
?>

<?php

if(isset($_POST['email'])) {

    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $admin= $_POST['admin'];



    $mysqli->query("INSERT INTO cadastro_usuario (email, senha, admin) VALUES ('$email', '$senha', '$admin')");
    echo "<script> 
    alert('Cadastro feito com sucesso!');
    window.location.href='admin.php';
    </script>";

    }
   
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="style.css" rel="stylesheet" />

  <link rel="shortcut icon" href="C:\wamp\www\PetId\images\heading-img.png" type="image/png">
  <title>Convidados</title>

 
 <link href="css/style.css" rel="stylesheet" />

</head>

<body>
<header class="header">
        <a href="convidados.php">Lista de Convidados</a>
        <nav>
            <ul class="menu">
                <li>
                    <a href="cadastro_convidado.php">Cadastro convidado</a>
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
 
<form class="cad_user" action="" method="POST">
   <h3>Cadastre o usuário <h3> 

        <input required placeholder="email" type="text" name="email"></input> </br> </br>
      <input required placeholder="senha" type="password" name="senha"></input> </br></br>
      
<div class="nivel">
      <select required name= "admin"id="select">
            <option name="admin" value="" selected="">Qual o nível de acesso do usuário?</option>
            <option name="admin" value="1">Administrador</option>
            <option name="admin" value="0">Usuário Comum</option>
    
          </select> </br></br>
</div>

      <button  type="submit">Cadastrar</button>

</form>

</body>

</html>