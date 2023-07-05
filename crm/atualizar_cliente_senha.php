<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

$upass = strip_tags($_POST['senha']);
$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
   


if($_POST[senha] == '') {
$sql= "UPDATE clientes SET cliente_email = '$_POST[email]', cliente_telefone = '$_POST[telefone]' WHERE id_cliente = '$id'";
mysqli_query($conn, $sql);
echo($conn->error);
} else {
    
$sql= "UPDATE clientes SET cliente_email = '$_POST[email]', cliente_telefone = '$_POST[telefone]' , cliente_senha = '$hashed_password'  WHERE id_cliente = '$id'";
mysqli_query($conn, $sql);
echo($conn->error);    
}




?>

<script>

alert("Atualizado com sucesso!");
window.location.href = "home";

</script>