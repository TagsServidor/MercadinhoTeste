<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

$sql= "INSERT INTO chamados (titulo_chamado, data_chamado, texto_chamado, status_chamado, quem_chamado) VALUES ('$_POST[titulo]','$_POST[data]','$_POST[texto]','$_POST[status]','$iduser')";
mysqli_query($conn, $sql);

?>

<script>

alert("Adicionado com sucesso!");
window.location.href = "listar_chamado";

</script>