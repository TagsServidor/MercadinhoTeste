<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;


include "bd/conexao.php";

	@$conn->query("update carrinho set qtd_carrinho  = qtd_carrinho - 1   where id_carrinho = $_POST[id]  ");



$sqlsa = "SELECT * FROM carrinho where id_carrinho =  $_POST[id]   ";
$resultadosa = mysqli_query($conn, $sqlsa);
$linha = mysqli_fetch_array($resultadosa);

if ($linha['qtd_carrinho'] =='0') {
	
@$conn->query("DELETE from carrinho where id_carrinho = '$_POST[id]'   ");
	
}

?>
<script>
window.location.href = "sacola.php";
</script>