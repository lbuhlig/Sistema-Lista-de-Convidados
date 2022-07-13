<?php
include('conexao.php');

if(!isset($_SESSION)) 
session_start();

if(!isset($_SESSION['admin']) || !$_SESSION['admin'] ) {
header ("Location: convidados.php");
die(); }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convidados </title>
    <link href="style.css" rel="stylesheet" />

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

<form class="form_admin" action="" method="POST">
   <h3>O que deseja fazer? <h3>  <br>

   <form class="convidados" action="convidados.php"> 
   <button>Lista de Convidados</button> <br><br>
   </form>

   <form class="cad_convi" action="cadastro_convidado.php"> 
   <button>Cadastrar Convidado</button> <br><br>
   </form>

   <form class="cad_usuario" action="cadastro_usuario.php"> 
   <button>Cadastrar Usuário</button> <br><br>
   </form>

   <form class="usuarios" action="usuarios.php"> 
   <button>Editar/Excluir Usuário</button>
   </form>

</form>

</body>
</html>