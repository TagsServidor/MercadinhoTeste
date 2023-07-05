<?php 
include "bd/conexao.php";

$sql = "SELECT  * FROM unidades where id_unidade = $_GET[unidade] ";
$resultadosql = mysqli_query($conn, $sql);
$linhaunidade = mysqli_fetch_assoc($resultadosql);

	
$result_vendas = "SELECT  SUM(alerta_valor) AS qtd , alerta_valor,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_GET[inicio]' AND ' $_GET[fim]' and alerta_unidade = $_GET[unidade] and alerta_motivo = '1' and alerta_valor <> '0'  group by alerta_produto ";

$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)) { 
										
$sqlva = "SELECT *  FROM os_produtos where os_produtos_id = $rows_vendas[alerta_produto_unidade]  ";
$sqlpva= mysqli_query($conn, $sqlva);
$produtou = mysqli_fetch_array($sqlpva);
$totalitem = $rows_vendas['qtd'] * $produtou['os_produtos_valor'];	
$totalprejuizo += $totalitem;			
	}

$sqltv = "SELECT SUM(pedido_valor) AS total_vendas  FROM pedidos WHERE pedido_status ='2' and pedido_unidade = $_GET[unidade] and pedido_data  BETWEEN '$_GET[inicio]' AND ' $_GET[fim]'      ";
$resultadotv = mysqli_query($conn, $sqltv);
$totaltv = mysqli_num_rows($resultadotv);	
$totalvendas = mysqli_fetch_array($resultadotv);

$valor_base = $totalvendas[total_vendas];
$valor = $totalprejuizo;
$resultado2 = ($valor / $valor_base) * 100;


$honestidade2  = substr($resultado2, 0, 2); 


if($resultado2 > '100') {
$honestidade  = 0 ;
} 
else {
    
 $honestidade  = 100 - $honestidade2 ;
   
}

//echo $valor;
//echo $valor_base;
//echo $resultado2;

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Indice de Honestidade</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
</head>

<body>
	
		<div style="background:#fd754b; padding: 10px" align="center"><img src="https://mercadinho.top/terminal/assets/img/logo.png" alt="logo"/>
	<br>	<br>
			<h3 class="text-white"> RELATÓRIO DE EXTRAVIOS </h3>  <h4 class="text-white"><?php echo $linhaunidade['unidade_nome'] ?> <br><?php echo date('d/m/Y', strtotime($_GET['inicio'])); ?> à <?php echo date('d/m/Y', strtotime($_GET['fim'])); ?> <br><br> Prejuizo Total: R$<?php echo  number_format($totalprejuizo, 2, ',', '.');  ?> </h4>
	
    </div>
	<br>
<div class="container" align="center"> 
	
	
	 <div class="col-6" align="center">

                <h5 class="text-dark">Indice de honestidade</h5>

								
								<div style="background-color: #fff; border-radius: 5px; padding: 5px"> 
									
									
									<div class="row"> 
										
										
										<div class="col-2">
											
											<?php if ($honestidade >= 94 && $honestidade < 100) { ?>
											<img src="../terminal/icones/alegre.jpg" style="height: 50px"  alt=""/> 
											<?php } ?>
											
											<?php if ($honestidade > 50 && $honestidade < 93) { ?>
											<img src="../terminal/icones/medio.jpg" style="height: 50px"  alt=""/> 
											<?php } ?>
											
											<?php if ($honestidade > 25 && $honestidade < 51) { ?>
											<img src="../terminal/icones/triste2.jpg" style="height: 50px"  alt=""/> 
											<?php } ?>
											
											<?php if ($honestidade >= 0 && $honestidade < 26) { ?>
											<img src="../terminal/icones/triste.jpg" style="height: 50px"  alt=""/> 
											<?php } ?>
											
											
										</div>
										<div class="col-10">
											
											<?php if ($honestidade >= 94 && $honestidade < 100) { ?>
											<div class="progress col-10" style="height: 50px">
  <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $honestidade ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
</div></div>
										<?php } ?>
										
										
										<?php if ($honestidade > 50 && $honestidade < 93) { ?>
											<div class="progress col-10" style="height: 50px">
  <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $honestidade ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
</div></div>
										<?php } ?>
										
											<?php if ($honestidade > 25 && $honestidade < 51) { ?>
											<div class="progress col-10" style="height: 50px">
  <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $honestidade ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
</div></div>
										<?php } ?>
									
									<?php if ($honestidade > 0 && $honestidade < 26) { ?>
											<div class="progress col-10" style="height: 50px">
  <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $honestidade ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
</div></div>

										<?php } ?>
										
											<?php if ($honestidade == '0') { ?>
											<div class="progress col-10" style="height: 50px">
  <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
</div></div>

										<?php } ?>
									
									</div></div></div>
								
	
	
	
	
<div class="row text-white" style="background-color:#fd754b; padding: 10px " > 
	<div class="col-8">Produto </div>
	<div class="col-2" align="center">QTD </div>
	<div class="col-2" align="center">Total </div>
	</div>	</div>	</div>
	
	
		<div class="container"> 
		  <div class="row text-dark" style="background-color:aliceblue; padding: 10px " > 

	<?php
		$result_vendas = "SELECT  SUM(alerta_valor) AS qtd , alerta_valor,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where  alerta_data BETWEEN '$_GET[inicio]' AND ' $_GET[fim]' and alerta_motivo = '1' and alerta_unidade = $_GET[unidade]  and alerta_valor <> '0' group by alerta_produto ORDER BY qtd desc ";
	$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
 while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)){ 	

	 
$sqlproduto = "SELECT *  FROM produtos where id_produto = $rows_vendas[alerta_produto]  ";
$sqlprodutos = mysqli_query($conn, $sqlproduto);
$produto = mysqli_fetch_array($sqlprodutos );
	
$sqlva = "SELECT *  FROM os_produtos where os_produtos_id = $rows_vendas[alerta_produto_unidade]  ";
$sqlpva= mysqli_query($conn, $sqlva);
$produtou = mysqli_fetch_array($sqlpva);
$totalitem = $rows_vendas['qtd'] * $produtou['os_produtos_valor'];	
$totalprejuizo += $totalitem;	
	?>
	
	

	
	<div class="col-8"><?php echo $produto['produto_nome'] ?></div>
	<div class="col-2" align="center"><?php echo $rows_vendas[qtd] ?></div>
	<div class="col-2" align="center">R$<?php echo $totalitem ?></div>

			  <hr>
	<?php } ?>
	</div>

	
	
	

	
</div>	
	
	
	
	
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</html>