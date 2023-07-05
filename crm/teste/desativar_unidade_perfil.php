<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";


$sql= "UPDATE unidades SET unidade_status = '$id2' WHERE id_unidade = '$id'";
mysqli_query($conn, $sql);
echo($conn->error);



?>

<script>

alert("Desativada com sucesso!");
window.location.href = "perfil_unidade/<?php echo $id ?>";

</script>