<?php
// Incluir aquivo de conexão
include("bd/conexao.php");
 
// Recebe o valor enviado
$valor = $_GET['valor'];
 
// Procura titulos no banco relacionados ao valor

$sql = "SELECT * FROM produtos where produto_nome LIKE '%".$valor."%'";
$resultadodp = mysqli_query($conn, $sql);

 
// Exibe todos os valores encontrados
while ($noticias = mysqli_fetch_object($resultadodp)) {
	echo "<a href=\"javascript:func()\" onclick=\"exibirConteudo('".$noticias->id_produto."')\">" . $noticias->produto_nome . "</a><br />";
}
 

?>