<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}




	
//// BAIXA NO ESTOQUE
$codigo = $_POST["produto"]; 

for($i=0; $i< sizeof($codigo); $i++) 
{ 
$data = date('Y-m-d'); 
$qtd = $_POST["qtd"][$i]; 
	
@$conn->query("update produtos_unidades set produto_unidade_estoque =  produto_unidade_estoque - '$qtd'  where produto_unidade_produto ='$codigo[$i]' and produto_unidade_unidade = '$_POST[unidade]' ");
	

} 	
	
	
//// INSERINDO PEDIDO NO BANCO DE DADOS
	
$conn->query($insert = "INSERT INTO pedidos (pedido_cliente, pedido_valor, pedido_status, pedido_pagamento, pedido_unidade, pedido_local, pedido_session, pedido_data, pedido_hora ) VALUES ('$_POST[cliente]','$_POST[valor]','2','$_POST[pagamento]','$_POST[unidade]','1','$_POST[registro]','$_POST[data]', '$_POST[hora]')");	

$ultimo_id = $conn->insert_id;
	
	
@$conn->query("update carrinho set status_carrinho = '2' , carrinho_pedido ='$ultimo_id' where status_carrinho ='1' and session_carrinho = $_POST[registro] ");
	
@$conn->query("update p_apagar set pago =  'sim' , retorno =''   where id_apagar = '$_POST[id]' ");
	
@$conn->query($insert = "INSERT INTO logs_acoes	 (quem, tipo, id_acao, acao, nome) VALUES ('$user[id]','Confirmar','$id','Confirmou uma venda a confirmar','$_POST[valor] Unidade: $linha[unidade]')");
	
?>
<script>
    alert("Venda registrada com sucesso!");
    window.location.href = "vendas_a_confirmar";


</script>
