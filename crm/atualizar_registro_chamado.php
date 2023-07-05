<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";


$sql= "UPDATE chamados SET titulo_chamado = '$_POST[titulo]', data_chamado = '$_POST[data]', texto_chamado = '$_POST[texto]', status_chamado = '$_POST[status]' WHERE id_chamado = '$id'";
mysqli_query($conn, $sql);
echo($conn->error);

$sql= "INSERT INTO registro_chamados (rchamado_chamado, rchamado_quem, rchamado_status, rchamado_texto) VALUES ('$id','$iduser','$_POST[status]','$_POST[texto]')";
mysqli_query($conn, $sql);

?>

<script>

alert("Atualizado com sucesso!");
window.location.href = "listar_chamado";

</script>