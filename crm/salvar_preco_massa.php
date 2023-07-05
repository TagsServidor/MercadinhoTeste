 <?php @session_start();
include "bd/conexao.php";

// ALTERANDO NAS UNIDADES
@$conn->query("update produtos_unidades set produto_unidade_valor =  '$_POST[valor]', produto_unidade_codigobarras =  '$_POST[barras]' where produto_unidade_produto  = '$_POST[produto]' ");



// ALTERANDO NAS ENTRADAS
@$conn->query("update entrada_produtos set entrada_venda =  '$_POST[valor]', entrada_unitario =  '$_POST[valorcusto]' where entrada_produto  = '$_POST[produto]'  order by id_entrada DESC ");

@$conn->query("update produtos set produto_codigobarras =  '$_POST[barras]' where id_produto  = '$_POST[produto]' ");


	
?>


