<?php
  if(!isset($_SESSION)) 
  session_start();
  
  if(!isset($_SESSION['admin']) || !$_SESSION['admin'] ) {
  header ("Location: convidados.php");
  die(); }
  
if(isset($_POST['confirmar'])) {

    include("conexao.php");
    $id = intval($_GET['id']);
    $sql_code = "DELETE FROM lista_convidados WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if($sql_query) { ?>
       
        <?php
            header("Location: convidados.php");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" />

    <title>Deletar Convidado</title>
</head>
<body>

<form class="deletar" action="" method="post">
    <h3>Tem certeza que deseja deletar o convidado?</h3>
    
    <a href="convidados.php">Não</a>

    <div class="sim">
    <button name="confirmar" value="1" type="submit">Sim</button>
    </div>

</form>

</body>
</html>