<?php // listando em um box os instrutores
include "bd/conexao.php";

error_reporting(0);
ini_set(“display_errors”, 0 );

// GERANDO OS

 @$conn->query($insert = "INSERT INTO os_reposicao (os_unidade, os_reposicao_tipo) VALUES ('$_POST[unidade]','2')");


$ultimo_id = $conn->insert_id;

/// INSERINDO PRODUTOS NA OS
$x=0;
$produto  = $_POST['produto'];
$qtd  = $_POST['repor'];
$atual  = $_POST['atual'];
$qtd3  = $_POST['repor2'];
$lote  = $_POST['lote'];
$vencimento  = $_POST['vencimento'];
$valor  = $_POST['valor'];
$custo  = $_POST['custo'];
$minimo  = $_POST['minimo'];
$maximo  = $_POST['maximo'];
$amenos  = $_POST['amenos'];
$qtdamenos  = $_POST['qtdamenos'];


$quant_linhas = count($produto);
for ($i=0; $i<$quant_linhas; $i++) {
$x++;  
	
	
$totalcusto[$i] = $custo[$i]  * $qtd[$i] ;	
	
	
@$conn->query($insert = "INSERT INTO os_produtos (os_produtos_produto,os_produtos_unidade,os_produtos_os,os_produtos_qtd,os_produtos_lote,os_produtos_vencimento,os_produtos_valor, os_custo_total, os_produtos_minima, os_produtos_maxima, os_produtos_central,os_produtos_tipo, os_produtos_amenos, os_produtos_qtdamenos,os_produtos_arepor,os_produtos_estoqueatual	 ) VALUES ('$produto[$i]','$_POST[unidade]','$ultimo_id','$qtd[$i]','$lote[$i]','$vencimento[$i]','$valor[$i]','$totalcusto[$i]','$minimo[$i]', '$maximo[$i]','$_POST[central]','2','$amenos[$i]','$qtdamenos[$i]' ,'$qtd3[$i]','$atual[$i]')"); 
 
  }


///// ATUALIZANDO ESTOQUE NA CENTRAL

$x2=0;
$produto2  = $_POST['idprodutocentral'];
$qdt2  = $_POST['repor'];
$quant_linhas2 = count($produto2);
for ($i2=0; $i2<$quant_linhas2; $i2++) {
	

$x++;  
	
	@$conn->query("update produtos_central set central_produto_estoque =  central_produto_estoque - $qdt2[$i2]  where id_produto_central = $produto2[$i2] ");	
	
}
?>
<script>

alert("Lista gerada com sucesso!");
	window.location.href = "os_abertas";


</script>
