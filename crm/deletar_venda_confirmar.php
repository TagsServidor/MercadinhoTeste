
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

$sql = "SELECT * FROM p_apagar where id_apagar ='$id'  ";
$resultado = mysqli_query($conn, $sql);
$linha=mysqli_fetch_array($resultado);


/// CRIANDO LOG

@$conn->query($insert = "INSERT INTO logs_acoes	 (quem, tipo, id_acao, acao, nome) VALUES ('$user[id]','Deletar','$id','Deletou uma venda a confirmar','$linha[valor] Terminal: $linha[id_terminal]')");
/// REMOVENDO

@$conn->query("DELETE from p_apagar where id_apagar = '$id' ");







?>

<script>
	
      alert("Removido com sucesso!");
    window.location.href = "vendas_a_confirmar";


</script>