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
$sqlvp = "SELECT produto_unidade_codigobarras , produto_unidade_produto, id_produto_unidades, produto_unidade_valor FROM produtos_unidades where produto_unidade_codigobarras = '$_POST[produto]' and  produto_unidade_unidade = $unidade and produto_unidade_status ='1'  ";
$resultadovp  = mysqli_query($conn, $sqlvp);
$totalvp = mysqli_num_rows($resultadovp);
$produtovp = mysqli_fetch_array($resultadovp);



$sqlos2a = "SELECT * FROM entrada_produtos where entrada_produto = $produtovp[produto_unidade_produto] order by id_entrada desc   ";
$resultadoos2a = mysqli_query($conn, $sqlos2a);	
$produtoa = mysqli_fetch_array($resultadoos2a);	




if ($totalvp =='0') {
	
echo  "";
	
?>
<SCRIPT>

window.location.href = "inicio.php";

</SCRIPT>
<?php
}


// VERIFICANDO SE JA EXISTE PRODUTO NA SACOLA

$sqlvps = "SELECT * FROM carrinho where produto_carrinho = $produtovp[produto_unidade_produto] and status_carrinho ='1' and session_carrinho = $registro_apagar and cliente_carrinho = $id_cliente ";
$resultadovps  = mysqli_query($conn, $sqlvps);
$totalvps = mysqli_num_rows($resultadovps);
$produtovps = mysqli_fetch_array($resultadovps);
if ($totalvps =='0') {

$conn->query($insert = "INSERT INTO carrinho (session_carrinho, unidade_carrinho, produto_carrinho, qtd_carrinho, unidade_produto_unidade, cliente_carrinho, preco_uni, preco_pago, preco_custo ) VALUES ('$registro_apagar','$_SESSION[unidade]','$produtovp[produto_unidade_produto]','1','$produtovp[id_produto_unidades]','$id_cliente', '$produtovp[produto_unidade_valor]', '$produtovp[produto_unidade_valor]', '$produtoa[entrada_unitario]')");

} else {
	
	@$conn->query("update carrinho set qtd_carrinho  = qtd_carrinho + '1' ,  preco_uni = '$produtovp[produto_unidade_valor]', preco_pago = '$produtovp[produto_unidade_valor]' , preco_custo = '$produtoa[entrada_unitario]'  where produto_carrinho = $produtovp[produto_unidade_produto] and status_carrinho ='1' and session_carrinho = $registro_apagar  ");

}

header("Location:sacola.php?$totalvp");
die();
?>
