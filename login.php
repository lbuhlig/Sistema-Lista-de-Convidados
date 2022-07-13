<?php

if(isset($_POST['email'])) {

    include('conexao.php');
 
    $email = $_POST['email'];
    $senha = $_POST['senha'];


$sql_code = "SELECT * FROM cadastro_usuario WHERE email = '$email' LIMIT 1";
$sql_exec = $mysqli ->query($sql_code) or die($mysqli->error);

$usuario = $sql_exec->fetch_assoc();
if(password_verify($senha,$usuario['senha'])) {
    if(!isset($_SESSION))
    session_start();
    $_SESSION['usuario'] = $usuario['id'];
    $_SESSION['admin'] = $usuario['admin'];
    header("Location: admin.php");
} else{
    echo "<script> 
    alert('Email ou senha incorretos. Tente novamente!');
    window.location.href='login.php';
    </script>";
}
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
        <a href="convidados.php"></a>
        <nav>
            <ul class="menu">
                <li>
                    <a href="cadastro_convidado.php"></a>
                </li> 
            </ul>
        </nav>
    </header>
                   
<!-- form -->

    <form class="login" action="" method="POST">

<h3>Login</h3> 
    <input type="text" placeholder="email" name="email"></input></br></br>
    <input  type="password"  placeholder="senha" name="senha"></input></br></br>
    <button type="submit">Login</button> </br></br>
    <a href="recuperar_senha.php">Recuperar senha<a>

<!-- end form -->


</body>

</html>