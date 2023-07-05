
<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>

<!-- Sweet Alert-->
<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<!-- Deixando Botão Transparente -->
<style>

.button {     
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;        
}

</style>


<?php 

$sql = "SELECT * FROM condominios where id_condominio ='$_POST[id]'  ";
$resultado = mysqli_query($conn, $sql);
$linha=mysqli_fetch_array($resultado);


/// CRIANDO LOG

@$conn->query($insert = "INSERT INTO logs_acoes	 (quem, tipo, id_acao, acao, nome) VALUES ('$user[id]','Deletar','$_POST[id]','Deletou um Condominio','$linha[condominio_nome]')");
/// REMOVENDO

@$conn->query("DELETE from condominios where id_condominio = '$_POST[id]' ");







?>

<script>
	
      alert("Removido com sucesso!");
    window.location.href = "listar_condominios";


</script>