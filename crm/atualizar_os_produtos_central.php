<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";



/// CONECTANDO AO ESTOQUE DA CENTRAL
$sqlpu = "SELECT * FROM produtos_central where central_produto = $_POST[produto] and central_produto_central = $_POST[central]  ";
$resultadopu = mysqli_query($conn, $sqlpu);
$totalopu = mysqli_num_rows($resultadopu);	
$linhapc = mysqli_num_rows($resultadopu);

if($totalopu == '0') {
 @$conn->query($insert = "INSERT INTO produtos_central (produtos_central_entrada, central_produto, central_produto_central, central_produto_validade, central_produto_lote, central_produto_estoque, 	central_produto_qtd_minima,	central_produto_qtd_maxima ) VALUES ('$_POST[id]', '$_POST[produto]', '$_POST[central]', '$_POST[validade]',  '$_POST[lote]', '$_POST[estoque]' , '$_POST[minima]', '$_POST[maxima]'  )");

	@$conn->query("update entrada_produtos set entrada_status =  '2'  where id_entrada = '$_POST[id]' ");

} else { 

	@$conn->query("update produtos_central set central_produto_estoque =  central_produto_estoque + '$_POST[estoque]' ,	central_produto_qtd_minima = '$_POST[minima]' ,	central_produto_qtd_maxima = '$_POST[maxima]' where central_produto ='$_POST[produto]' and central_produto_central = '$_POST[central]' ");

	@$conn->query("update entrada_produtos set entrada_status =  '2'  where id_entrada = '$_POST[id]' ");

}

?>
