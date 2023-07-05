<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;

$registro_apagar = rtrim($session);


include "bd/conexao.php";

	
	@$conn->query("update clientes set cliente_nome  = '$_POST[nomec]' , cliente_nascimento  = '$_POST[nascimento]'    where id_cliente = '$id_cliente'  ");




?><head>

<form action="iniciar.php" name="t" method="post"> 
	<input type="hidden" name="cpf" value="<?php echo $cpf ?> ">
	<input type="hidden" name="unidade" value="<?php echo $unidade ?> ">
	<input type="hidden" name="condominio" value="<?php echo $condominio ?> ">
	<input type="hidden" name="registro" value="<?php echo $registro_apagar ?> ">
	
	
	</form>
<script type="text/javascript">
document.t.submit()
</script>