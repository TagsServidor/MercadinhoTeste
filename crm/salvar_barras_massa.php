 <?php @session_start();
include "bd/conexao.php";

// ALTERANDO NAS UNIDADES
@$conn->query("update produtos_unidades set produto_unidade_codigobarras =  '$_POST[barras]' where produto_unidade_produto  = '$_POST[produto]' ");

// ALTERANDO NAS ENTRADAS
@$conn->query("update produtos set produto_codigobarras =  '$_POST[barras]' where id_produto  = '$_POST[produto]' ");



?>


