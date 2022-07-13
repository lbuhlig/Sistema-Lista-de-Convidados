<?php

$msg = false;
if(isset($_POST['email'])) {
    include('conexao.php');
    include('generateRandomString.php');
    include('enviarEmail.php');
    $email = $mysqli->escape_string($_POST['email']);
    $sql_query = $mysqli->query("SELECT id FROM cadastro_usuario WHERE email = '$email'");
    $result = $sql_query->fetch_assoc();

    if($result['id']) {

        $nova_senha = generateRandomString(6);
        $nova_senha_criptografada = password_hash($nova_senha, PASSWORD_DEFAULT);
        $id_usuario = $result['id'];
        $mysqli->query("UPDATE cadastro_usuario SET senha = '$nova_senha_criptografada' WHERE id = '$id_usuario'");
        enviarEmail($email, "Sua nova senha foi gerada", "
        <h1>Olá </h1>
        <p>Uma nova senha foi definida para a sua conta.</p>
        <p><b>Nova senha:</b> $nova_senha</p>
        ");
        $msg = "Se o seu e-mail existir no banco de dados, uma nova senha será enviada para ele.";

    } else { 
        $msg = "Se o seu e-mail existir no banco de dados, uma nova senha será enviada para ele.";
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

  <title>Convidados</title>


  <link href="css/style.css" rel="stylesheet" />

</head>

<body>

<!-- form -->

    <form class="recuperar_senha" action="" method="POST">

<h3>Recuperar Senha</h3> 
    <input type="text" placeholder="email" name="email"></input></br></br></br>
    <button type="submit">Recuperar Senha</button> </br></br>
    <a href="login.php">Voltar</a>
    

<!-- end form -->


</body>

</html>