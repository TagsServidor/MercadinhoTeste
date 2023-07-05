 <?php @session_start();
include "bd/conexao.php";

// ALTERANDO NAS UNIDADES

// ALTERANDO NAS ENTRADAS
@$conn->query("update entrada_produtos set entrada_unitario =  '$_POST[valorcusto]' where entrada_produto  = '$_POST[produto]'  order by id_entrada DESC ");



	
?>


