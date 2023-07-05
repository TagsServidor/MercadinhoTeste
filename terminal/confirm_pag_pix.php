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


$sqlc = "SELECT * FROM p_apagar_pix where registro_apagar = $registro_apagar and pago ='2'  ";
$resultadoc = mysqli_query($conn, $sqlc);
$totalc = mysqli_num_rows($resultadoc);
$linhae=mysqli_fetch_array($resultadoc);


	
	
if ($totalc >='1') { 
	

	
//// BAIXA NO ESTOQUE
$codigo = $_POST["produto"]; 

for($i=0; $i< sizeof($codigo); $i++) 
{ 
$data = date('Y-m-d'); 
$qtd = $_POST["qtd"][$i]; 
	
@$conn->query("update produtos_unidades set produto_unidade_estoque =  produto_unidade_estoque - '$qtd'  where produto_unidade_produto ='$codigo[$i]' and produto_unidade_unidade = '$_POST[unidade]' ");
	

} 	
	
	
//// INSERINDO PEDIDO NO BANCO DE DADOS
	
$conn->query($insert = "INSERT INTO pedidos (pedido_cliente, pedido_valor, pedido_status, pedido_pagamento, pedido_unidade, pedido_local, pedido_session, pedido_data, pedido_hora ) VALUES ('$id_cliente','$_POST[valor]','2','Pix','$_POST[unidade]','1','$registro_apagar','$data1', '$hora2')");	

$ultimo_id = $conn->insert_id;
	
	
@$conn->query("update carrinho set status_carrinho = '2' , carrinho_pedido ='$ultimo_id' where status_carrinho ='1' and session_carrinho = $registro_apagar");
	
	
	
?>
<script>

    window.location.href = "payment_ok.php";


</script>
<?php } ?>