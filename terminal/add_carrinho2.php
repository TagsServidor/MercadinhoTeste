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

// VERIFICANDO SE PRODUTO EXISTE
$sqlvp = "SELECT produto_unidade_codigobarras , produto_unidade_produto, id_produto_unidades FROM produtos_unidades where produto_unidade_produto = $_POST[produto] and  produto_unidade_unidade = $_POST[unidade]  ";
$resultadovp  = mysqli_query($conn, $sqlvp);
$totalvp = mysqli_num_rows($resultadovp);
$produtovp = mysqli_fetch_array($resultadovp);
if ($totalvp =='0') {
	
echo  "<script>$('#myAlert').modal('show');</script>";
	
header("Location:salvar.php?msg=naoencontrado");
	die();
}


// VERIFICANDO SE JA EXISTE PRODUTO NA SACOLA

$sqlvps = "SELECT * FROM carrinho where produto_carrinho = $produtovp[produto_unidade_produto] and status_carrinho ='1' and session_carrinho = $registro_apagar and cliente_carrinho = $id_cliente ";
$resultadovps  = mysqli_query($conn, $sqlvps);
$totalvps = mysqli_num_rows($resultadovps);
$produtovps = mysqli_fetch_array($resultadovps);
if ($totalvps =='0') {

$conn->query($insert = "INSERT INTO carrinho (session_carrinho, unidade_carrinho, produto_carrinho, qtd_carrinho, unidade_produto_unidade, cliente_carrinho ) VALUES ('$registro_apagar','$_SESSION[unidade]','$produtovp[produto_unidade_produto]','1','$produtovp[id_produto_unidades]','$id_cliente')");

} else {
	
	@$conn->query("update carrinho set qtd_carrinho  = qtd_carrinho + '1'  where produto_carrinho = $produtovp[produto_unidade_produto] and status_carrinho ='1' and session_carrinho = $registro_apagar  ");

}

header("Location:sacola.php");
die();
?>

<div class="modal fade" tabindex="-1" id="myAlert" role="dialog" >
	<div class="modal-dialog modal-sm">
	<div class="modal-content">
		<h5>Produto não encontrado!</h5>
	</div>
	</div>
</div>