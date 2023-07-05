<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$mesatual = date('m');
$anoatual = date('Y');
$mesanterior = $mesatual - 1;




/// TOTAL DE VENDAS MES ATUAL
$sqltv = "SELECT SUM(pedido_valor) AS total_vendas_mg  FROM pedidos WHERE pedido_status ='2' and pedido_data  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31'      ";
$resultadotv = mysqli_query($conn, $sqltv);
$totaltv = mysqli_num_rows($resultadotv);	
$totalvendasg = mysqli_fetch_array($resultadotv);



/// TOTAL DE VENDAS MES ANTERIOR
$sqltvag = "SELECT SUM(pedido_valor) AS total_vendas_ag   FROM pedidos WHERE  pedido_status ='2' and pedido_data  BETWEEN '$anoatual-$mesanterior-01' AND '$anoatual-$mesanterior-31'     ";
$resultadotvag = mysqli_query($conn, $sqltvag);
$totaltvag = mysqli_num_rows($resultadotvag);	
$totalvendasag = mysqli_fetch_array($resultadotvag);


$comparacaovendas = $totalvendasg['total_vendas_mg'] - $totalvendasag['total_vendas_ag'];

/// CUSTO MES ATUAL

$sqlcma = "SELECT SUM(qtd_carrinho * preco_custo) AS custo, SUM(qtd_carrinho * preco_pago) AS venda  FROM carrinho WHERE status_carrinho ='2' and data_carrinho  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31'      ";
$resultadocma = mysqli_query($conn, $sqlcma);
$linhacma = mysqli_fetch_array($resultadocma);

$lucro = $linhacma[venda] - $linhacma[custo];
$margem =  $lucro / $linhacma[venda] * 100;

/// TOTAL DE PEDIDOS MES ATUAL
$sqlp = "SELECT pedido_data, pedido_status   FROM pedidos WHERE pedido_status ='2' and pedido_data  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31'      ";
$resultadop = mysqli_query($conn, $sqlp);
$totalp = mysqli_num_rows($resultadop);	

$sqlpa = "SELECT pedido_data, pedido_status   FROM pedidos WHERE pedido_status ='2' and pedido_data  BETWEEN '$anoatual-$mesanterior-01' AND '$anoatual-$mesanterior-31'      ";
$resultadopa = mysqli_query($conn, $sqlpa);
$totalpa = mysqli_num_rows($resultadopa);	

$comparacaopedidos = $totalp - $totalpa;


/// TOTAL DE CLIENTES MES ATUAL
$sqlc = "SELECT clientes_date  FROM clientes WHERE cliente_status ='1' and clientes_date  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31'     ";
$resultadoc = mysqli_query($conn, $sqlc);
$totalc = mysqli_num_rows($resultadoc);	

$sqlca = "SELECT clientes_date  FROM clientes WHERE cliente_status ='1' and clientes_date  BETWEEN '$anoatual-$mesanterior-01' AND '$anoatual-$mesanterior-31' ";
$resultadoca = mysqli_query($conn, $sqlca);
$totalca = mysqli_num_rows($resultadoca);	

$comparacaocientes = $totalc - $totalca;


/// TOTAL DE VENDAS MES ATUAL APP
$sqltvapp = "SELECT SUM(pedido_valor) AS total_vendas_am  FROM pedidos WHERE pedido_status ='2' and pedido_local = '2' and pedido_data  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31'      ";
$resultadotapp = mysqli_query($conn, $sqltvapp);
$totalvendasapp = mysqli_fetch_array($resultadotapp);

/// TOTAL DE VENDAS MES ANTERIOR
$sqltvappa = "SELECT SUM(pedido_valor) AS total_vendas_aa   FROM pedidos WHERE  pedido_status ='2' and pedido_local = '2'  and pedido_data  BETWEEN '$anoatual-$mesanterior-01' AND '$anoatual-$mesanterior-31'    ";
$resultadotvappa = mysqli_query($conn, $sqltvappa);
$totalvendasappa = mysqli_fetch_array($resultadotvappa);

$comparacaovendasapp = $totalvendasapp['total_vendas_am'] - $totalvendasappa['total_vendas_aa'];

/// TOTAL DE VENDAS MES ATUAL TOTEN
$sqltvtotem = "SELECT SUM(pedido_valor) AS total_vendas_m  FROM pedidos WHERE pedido_status ='2' and pedido_local = '1' and pedido_data  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31'      ";
$resultadottotem = mysqli_query($conn, $sqltvtotem);
$totalvendastotem = mysqli_fetch_array($resultadottotem);

/// TOTAL DE VENDAS MES ANTERIOR
$sqltvatotema = "SELECT SUM(pedido_valor) AS total_vendas_a   FROM pedidos WHERE  pedido_status ='2' and pedido_local = '1'  and pedido_data  BETWEEN '$anoatual-$mesanterior-01' AND '$anoatual-$mesanterior-31'     ";
$resultadotvtotema  = mysqli_query($conn, $sqltvatotema);
$totalvendastotema = mysqli_fetch_array($resultadotvtotema);

$comparacaovendastotem = $totalvendastotem['total_vendas_m'] - $totalvendastotema['total_vendas_a'];



$ticketmeddio = $totalvendasg['total_vendas_mg'] / $totalp;






?>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script src="assets/js/jquery.js"></script>
    <script src="assets/js/form_central.js"></script>
  <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
 <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


                        
					
					
                <div class="container-fluid">
                            <div class="col-12">

                <div class="page-content">
                    
                      
               
					
								
								
										 <div class="row">


                                         <?php if($user[gerente] == 'sim') { ?> 
                                 <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Vendas do mês</h4>

<h5> <strong> Total: </strong> R$<span  ><?php echo number_format($totalvendasg['total_vendas_mg'],2,",",".");  ?></span></h5>




<canvas id="myChart"></canvas>

<script>
var xValues = ["Terminal - R$<?php echo number_format($totalvendastotem['total_vendas_m'], 2, ',', '.')  ?>", "App R$<?php echo number_format($totalvendasapp['total_vendas_am'], 2, ',', '.')  ?>"];
var yValues = [<?php echo number_format($totalvendastotem['total_vendas_m'], 2, '', '')  ?>, <?php echo number_format($totalvendasapp['total_vendas_am'], 2, '', '')  ?>];
var barColors = [
  "#1b458b",
  "#f80",

];

new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: false,
    }
  }
});
</script>
<BR>
<h5> <strong> Ticket médio: </strong>R$<?php echo number_format($ticketmeddio, 2, ',', '.')  ?></h5>
<hr>
<h5> <strong> Lucro: </strong>R$<?php echo number_format($lucro, 2, ',', '.')  ?></h5>
<hr>
<h5> <strong> Margem:</strong> <?php echo round($margem, 2) ?>%</h5>


                                        </div></div></div>

<?php } ?>


<?php if($user[gerente] == 'sim') { ?> 

                                        <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">10 unidades maior valor vendas neste mês
 </h4>

 <div data-simplebar style="max-height: 391px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
														
														
														<?php
$sql = "SELECT u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data,  SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2'  and pedido_data  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31' group by pedido_unidade order by total_valor  desc limit 10 ";

													
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);
while($linha = mysqli_fetch_array($resultado)){


?>
                                                        <tr>
                                                            
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><i class="fas fa-home" aria-hidden="true" style="color:rebeccapurple"></i> <?php echo $linha['unidade_nome'] ?>  </h6>
                                                                
                                                            </td>
															
															<td>
                                                              
                                                                
                                                            </td>
                                                            
                                                            <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>R$<?php echo $linha['total_valor'] ?></td>
                                                        </tr>
														
														<?php } ?>
														
                                                        
                                                        
                                                       
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div> <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                        </div></div></div>

<?php } ?>

<?php if($user[gerente] == 'sim') { ?> 
                                        <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">10 produtos mais vendidos neste mês
 </h4>
 <div data-simplebar style="max-height: 391px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
														
														
														<?php
														/// CONECTANDO AOS PEDIDOS

$sql = "SELECT SUM(qtd_carrinho) AS qtd_carrinho , SUM(qtd_carrinho*preco_pago) AS preco_pago2, SUM(qtd_carrinho*preco_custo) AS preco_custo2, preco_pago, preco_custo, produto_carrinho, data_carrinho FROM carrinho WHERE status_carrinho ='2' and preco_pago <> '0.00' and data_carrinho  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31'  group by produto_carrinho  order by qtd_carrinho desc limit 10 ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	
														
while($linha = mysqli_fetch_array($resultado)){ 
$sqlp = "SELECT *  FROM produtos where id_produto = '$linha[produto_carrinho]' ";
$resultadop = mysqli_query($conn, $sqlp);
$linhap = mysqli_fetch_array($resultadop);
	
	
										
												$qtd = $linha['qtd_carrinho'];
												$valortotal = $linha['preco_pago2'];
	                                            $custo =  $linha['preco_custo2'];
	                                            $lucro = $valortotal - $custo ;														
														
?>
                                                        <tr>
                                                            <td ><?php echo $linha['qtd_carrinho']; ?> -  
<?php echo $linhap['produto_nome']; ?>	</td>
                                                            
                                                        </tr>
														
														<?php } ?>
														
                                                        
                                                        
                                                       
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div> <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->

                                        </div></div></div>
                                    
                                    <?php } ?>
                                    
                                    </div>






                                        <div class="row">

<div class="col-xl-6">
<div class="card">
<div class="card-body">
<div class="float-end">
   <div class="dropdown">
       
   </div>
</div>
<h4 class="card-title mb-4">Produtos próximo do vencimento
 </h4>


<div class="row">
<div class="col-6">
<strong>Produto</strong>
</div>

<div class="col-4">
<strong>Unidade</strong>
</div>

<div class="col-2">
<strong>Vencimento</strong>
</div>

</div>
<br>
 <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
														
														
														<?php /// aqui
																											
$sql = "SELECT  * FROM produtos_unidades pu INNER JOIN unidades u ON pu.produto_unidade_unidade = u.id_unidade INNER JOIN produtos p ON pu.produto_unidade_produto = p.id_produto where pu.produto_unidade_vencimento <> '0000-00-00' and pu.produto_unidade_status = '1'  and pu.produto_unidade_lixeira = '1' and pu.produto_unidade_estoque > '0' and  pu.produto_unidade_vencimento > '$data1'     order by pu.produto_unidade_vencimento asc  ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	
while($linha = mysqli_fetch_array($resultado)){ 													
                                                                                                            
?>

<div class="row">
<div class="col-6">
<?php echo $linha[produto_nome]; ?>
</div>

<div class="col-4">
<?php echo $linha[unidade_nome]; ?>
    </div>

    <div class="col-2">
    <i class="fas fa-calendar"  style="color: red"></i> <?php echo date('d/m/Y', strtotime($linha[produto_unidade_vencimento])); ?>
    </div>

</div>
<hr class="style-one">
<?php } ?>
                                                        <tr>
                                                            <td >	</td>
                                                            
                                                        </tr>
												
                                                        
                                                        
                                                       
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div> <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->

 


</div></div></div>

<div class="col-xl-6">
<div class="card">
<div class="card-body">
<div class="float-end">
   <div class="dropdown">
       
   </div>
</div>
<h4 class="card-title mb-4">Unidades com estoque baixo
 </h4>





<div class="row">

<div class="col-10">
<strong>Unidade</strong>
</div>

<div class="col-2">
<strong>Itens</strong>
</div>

</div>
<style>
    .style-one {
    border: 0;
    height: 1px;
    background: #333;
    padding: -10px;

    background-image: linear-gradient(to right, #ccc, #333, #ccc);
}

</style>
<br>
 <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
														

														<?php /// aqui
																											
$sqluv = "SELECT count(*) AS total, unidade_nome FROM unidades u inner join produtos_unidades p ON u.id_unidade = p.produto_unidade_unidade where p.produto_unidade_estoque <= p.produto_unidade_minimo and p.produto_unidade_status = '1' and produto_unidade_lixeira = '1' group by produto_unidade_unidade  order by total desc";
$resultadouv = mysqli_query($conn, $sqluv);
while($linhauv = mysqli_fetch_array($resultadouv)){ 	
?>														
                                                                                                            


<div class="row">
<div class="col-10">
<h6 class="font-size-15 mb-1 fw-normal"><i class="fas fa-home" aria-hidden="true" style="color:rebeccapurple"></i> <?php echo $linhauv['unidade_nome'] ?>  </h6> 
</div>

<div class="col-2">
<strong> <?php echo $linhauv[total] ?></strong> 
</div>

</div>
<hr class="style-one">
<?php } ?>
                                                        <tr>
                                                            <td >	</td>
                                                            
                                                        </tr>
												
                                                        
                                                        
                                                       
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div> <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->

</div></div></div>







<div class="row">



<?php if($user[gerente] == 'sim') { ?> 

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Últimas 10 vendas </h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
														
														
														<?php
														$sql = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
 INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_status ='2' order by p.id_pedido  desc limit 10 ";

$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);
while($linha = mysqli_fetch_array($resultado)){
?>
                                                        <tr>
                                                            <td ><i class="fas fa-calendar"  style="color: blueviolet"></i>
<?php echo date('d/m', strtotime($linha['pedido_data'])); ?>	</td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><i class="fas fa-home"  style="color:burlywood"></i> 
																	<?php  echo mb_strimwidth($linha['unidade_nome'], 0, 18, "");    ?></h6>
                                                                
                                                            </td>
															
															<td>
                                                               <?php if ($linha['pedido_local'] =='2') { ?>
																
																<i class="fas fa-mobile"></i>

																<?php } ?>
																
																<?php if ($linha['pedido_local'] =='1') { ?>
																
																<i class="fas fa-desktop"></i>


																<?php } ?>
                                                                
                                                            </td>
                                                            
                                                            <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>R$<?php echo $linha['pedido_valor'] ?></td>
                                                        </tr>
														
														<?php } ?>
														
                                                        
                                                        
                                                       
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div> <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> <!-- end card-->
                            </div><!-- end col -->
 <?php } ?>

 <?php if($user[gerente] == 'sim') { ?> 

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">10 clientes mais compraram neste mês </h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
														
														
														<?php
$sql = "SELECT c.cliente_nome, p.pedido_valor, c.id_cliente, p.pedido_status, p.pedido_data,  SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN clientes c on p.pedido_cliente = c.id_cliente   where p.pedido_status ='2' and c.cliente_cpf <>'091.240.500-75' and c.cliente_nome <>'' and pedido_data  BETWEEN '$anoatual-$mesatual-01' AND '$anoatual-$mesatual-31'  group by pedido_cliente order by total_valor  desc limit 10 ";

$x=0;														
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);
while($linha = mysqli_fetch_array($resultado)){

$x++;
$partes = explode(' ', $linha['cliente_nome']);
$primeiroNome = array_shift($partes);
$ultimoNome = array_pop($partes);	
?>
                                                        <tr>
                                                            
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><i class="fas fa-user" aria-hidden="true" style="color:rebeccapurple"></i> <?php echo $primeiroNome ?> <?php echo $ultimoNome ?> </h6>
                                                                
                                                            </td>
															
															<td>
                                                              
                                                                
                                                            </td>
                                                            
                                                            <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>R$<?php echo $linha['total_valor'] ?></td>
                                                        </tr>
														
														<?php } ?>
														
                                                        
                                                        
                                                       
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div> <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> <!-- end card-->
                            </div><!-- end col -->
 
<?php } ?>

<?php if($user[gerente] == 'sim') { ?> 

<div class="col-4">
<div class="card">
<div class="card-body">

<?php
/// TOTAL ESTOQUE CENTRAL
$totalcentral = '';
$totalcentralv = '';
$sqltv33= "SELECT * FROM produtos_central pc WHERE pc.produto_status_central ='1' and pc.produto_lixeira_central = '1'   ";
$resultadotv33 = mysqli_query($conn, $sqltv33);
while($totalvendasg33 = mysqli_fetch_array($resultadotv33)) { 

$sqltv34 = "SELECT *  FROM  entrada_produtos ep WHERE ep.entrada_produto =  $totalvendasg33[central_produto] and ep.entrada_status = '2' order by ep.id_entrada desc    ";
$resultadotv34 = mysqli_query($conn, $sqltv34);
$totalvendasg34 = mysqli_fetch_array($resultadotv34);

$totalcentral1 = $totalvendasg33[central_produto_estoque] * $totalvendasg34[entrada_unitario];
$totalcentral += $totalcentral1;

$totalcentral1v = $totalvendasg33[central_produto_estoque] * $totalvendasg34[entrada_venda];
$totalcentralv += $totalcentral1v;

}
?>
<h4 class="card-title mb-4">Valor estoque central </h4>

<strong> R$ <?php echo number_format($totalcentral,2,",",".");?></strong>  - *Base de custo<br>
<strong>  R$ <?php echo number_format($totalcentralv,2,",",".");?></strong>  - *Base de venda<br><br>
<a href="valor_estoque_central_detalhado/8" ><buttom class="btn btn-primary btn-small">Ver Detalhado</buttom></a>
</div>
</div>
</div>
                        
<div class="col-4">
<div class="card">
<div class="card-body">
<?php
/// TOTAL ESTOQUE UNIDADES
$totalunidades = '';
$totalunidadesv = '';
$sqltv33b= "SELECT SUM(produto_unidade_estoque) as estoque, produto_unidade_produto, produto_unidade_status, produto_unidade_lixeira, produto_unidade_valor   FROM produtos_unidades pu WHERE pu.produto_unidade_status ='1' and pu.produto_unidade_lixeira = '1' group by pu.produto_unidade_produto   ";
$resultadotv33b = mysqli_query($conn, $sqltv33b);
while($totalvendasg33b = mysqli_fetch_array($resultadotv33b)) { 

$sqltv34b = "SELECT *  FROM  entrada_produtos ep WHERE ep.entrada_produto =  $totalvendasg33b[produto_unidade_produto] and ep.entrada_status = '2' order by ep.id_entrada desc    ";
$resultadotv34b = mysqli_query($conn, $sqltv34b);
$totalvendasg34b = mysqli_fetch_array($resultadotv34b);

$totalunidades1 = $totalvendasg33b[estoque] * $totalvendasg34b[entrada_unitario];
$totalunidades += $totalunidades1;

$totalunidade1v = $totalvendasg33b[estoque] * $totalvendasg34b[entrada_venda];
$totalunidadesv += $totalunidade1v;

}
?>
 <h4 class="card-title mb-4">Valor estoque unidades</h4>



<strong> R$ <?php echo number_format($totalunidades,2,",",".");?></strong>  - *Base de custo<br>
<strong>  R$ <?php echo number_format($totalunidadesv,2,",",".");?></strong>  - *Base de venda<br>

</div>
</div>
</div>

<div class="col-4">
<div class="card">
<div class="card-body">

<?php // SOMA ESTOQUE GERAL
$estoquegeral= $totalunidades + $totalcentral;
$estoquegeralv= $totalunidadesv + $totalcentralv;
?>
 <h4 class="card-title mb-4">Valor estoque geral </h4>
 <strong> R$ <?php echo number_format($estoquegeral,2,",",".");?></strong>  - *Base de custo<br>
<strong>  R$ <?php echo number_format($estoquegeralv,2,",",".");?></strong>  - *Base de venda<br>
</div>
</div>
</div>
	<?php } ?>										 
											 
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
					
					
	
	<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>					


	<script src="assets/js/pages/form-validation.init.js"></script>
						
	
					
					
     <!-- JAVASCRIPT -->
        

        <!-- ckeditor -->
        <script src="assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

       

        <script>
        ClassicEditor
        .create( document.querySelector( '#classic-editor' ) )
        .catch( error => {
            console.error( error );
        } );
        </script>
					
					
