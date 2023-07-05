<?php

include "bd/conexao.php";

$registro_apagar = rtrim($_GET['pedido']);


@$conn->query("update p_apagar_pix set pago = '2'   where registro_apagar = $registro_apagar ");


	
?>

