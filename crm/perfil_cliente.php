<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

/// CONECTANDO AOS DADOS DA CENTRAL
$sql = "SELECT * FROM clientes   where id_cliente = $id ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	
$linha = mysqli_fetch_array($resultado);



/// INICIO RESUMO DO CLIENTE

/// ULTIMO PEDIDO
$sqlup = "SELECT pedido_cliente, pedido_data, pedido_status FROM pedidos  where pedido_cliente = $id and pedido_status = 2 order by pedido_data desc  ";
$resultadoup = mysqli_query($conn, $sqlup);
$totalup = mysqli_num_rows($resultadoup);	
$linhaup = mysqli_fetch_array($resultadoup);

/// PEGANDO DIAS
$date1=date_create($linhaup['pedido_data']);
$date2=date_create($data2);
$diff=date_diff($date1,$date2);

/// TOTAL DE COMPRAS 
$sqltc = "SELECT SUM(pedido_valor) AS pedido_valor  FROM pedidos  where pedido_cliente = $id and pedido_status = 2   ";
$resultadotc = mysqli_query($conn, $sqltc);
$linhatc = mysqli_fetch_array($resultadotc);


//// COMPRAS TERMINAl
$sqlpt = "SELECT pedido_cliente , pedido_status, pedido_local FROM pedidos  where pedido_cliente = $id and pedido_status = 2 and pedido_local = 1  ";
$resultadopt = mysqli_query($conn, $sqlpt);
$totalpt = mysqli_num_rows($resultadopt);	

//// COMPRAS APP
$sqlpapp = "SELECT pedido_cliente , pedido_status, pedido_local FROM pedidos  where pedido_cliente = $id and pedido_status = 2 and pedido_local = 2  ";
$resultadopapp = mysqli_query($conn, $sqlpapp);
$totalpapp = mysqli_num_rows($resultadopapp);	


/// CONECTANDO AS VENDAS DA UNIDADE


$sqlv = "SELECT * FROM pedidos p INNER JOIN unidades u ON p.pedido_unidade = u.id_unidade where p.pedido_cliente = $id and p.pedido_status = 2 order by pedido_data desc limit 10 ";
$resultadov = mysqli_query($conn, $sqlv);
$totalv = mysqli_num_rows($resultadov);	


/// CONECTANDO AO ESTOQUE DA UNIDADE
$sqlpu = "SELECT * FROM produtos_unidades pu INNER JOIN produtos p ON pu.produto_unidade_produto = p.id_produto where pu.produto_unidade_unidade = $id order by produto_unidade_estoque asc ";
$resultadopu = mysqli_query($conn, $sqlpu);
$totalopu = mysqli_num_rows($resultadopu);



///SOMANDO TOTAL DE VENDAS CONCLUIDAS
$sqlvc = "SELECT SUM(pedido_valor) AS totalvalor FROM pedidos where pedido_unidade = $id and pedido_status = '2'  ";
$resultadovc = mysqli_query($conn, $sqlvc);
$linhavc = mysqli_fetch_array($resultadovc);

///SOMANDO TOTAL SAIDAS EM CONTAS PAGAS
$sqlsp = "SELECT SUM(valor_apagar) AS totalpagas FROM apagar where unidade_apagar = $id and status_apagar = '2'  ";
$resultadosp = mysqli_query($conn, $sqlsp);
$linhasp = mysqli_fetch_array($resultadosp);


///SOMANDO TOTAL CUSTO PRODUTOS OS
$sqlcp = "SELECT SUM(os_custo_total) AS totalcustoos FROM os_produtos where os_produtos_unidade = $id and os_produtos_status = '2'  ";
$resultadocp = mysqli_query($conn, $sqlcp);
$linhacp = mysqli_fetch_array($resultadocp);


$totaldespesas = $linhasp['totalpagas'] + $linhacp['totalcustoos'];
$saldo = $linhavc['totalvalor'] - $totaldespesas ;

/// LOGICA DO SALDO
/// PEGA TOTAL DE VENDAS - TOTAL DE SAIDAS EM CONTAS PAGAS - TOTAL DE DESPESAS DOS PRODUTOS ENVIADOS (PEGA NA OS)


?>

<style>
	.esconderbarras {
		font-size: 0px;
	}

</style>
<script src="assets/js/jquery.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


  <!-- Responsive Table css -->
        <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

<!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

       
					
				

<div class="main-content">

                <div class="page-content">
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> Relatórios &gt; Clientes >  <?php echo $linha['cliente_nome'] ?></h4> 

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
</div> 
               
					
                <div class="container-fluid">
					
					<a href="compras_clientes/<?php echo $id ?>"><button class="btn btn-success" style="padding: 5px">  <i class="fa fa-shopping-bag" aria-hidden="true"></i> Relatório de Compras </button> </a>					
					<button class="btn btn-info" style="padding: 5px" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center2"> <i class="fa fa-list" aria-hidden="true"></i> Adicionar Créditos </button>	</a>				
          <br><br>
					 <!-- Center Modal example -->
                     <div class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Adicionar Créditos</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="inserir_credito_cliente" method="post">
                                                                <div class="row"> 

                                                                    <div class="col-6"> 
                                                                <label>Valor a Creditar</label>
                                                                <input type="text" required class="form-control money" name="valor" id="textfield" value="<?php echo $linhaose['entrada_venda'] ?>">
</div>                                                                   
<br><br>
<br><br>

</div> 
<input type="hidden" name="cliente" value="<?php echo $id ?>">
<input type="submit" class="btn btn-success" value="Creditar" onclick="return confirm('Tem certeza que deseja mesmo creditar esse valor?')"> 
                                                            </form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
					
					
					
				  <div class="row mb-4">
<div class="col-xl-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="dropdown float-end">
                                                <a class="text-body dropdown-toggle font-size-18" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                  <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                              
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                            <div>
                                               <!-- <img src="foto" alt="" class="avatar-xl rounded-circle "> -->
                                            </div>
                                            <h5 class="mt-3 mb-1"> <strong><?php echo $linha['unidade_nome'] ?></strong></h5>
											
                                             
											<?php echo $linha['condominio_rua'] ?> <?php echo $linha['condominio_numero'] ?> <?php echo $linha['condominio_bairro'] ?>
											<?php echo $linha['condominio_complemento'] ?> <?php echo $linha['condominio_cep'] ?> <?php echo $linha['condominio_uf'] ?>
											<?php echo $linha['condominio_cidade'] ?>
                                           
                                        </div>

                                        <hr class="my-4">
										<div align="center"><h5 class="mt-3 mb-1"> <strong>Financeiro </strong></h5></div> <br>
										+ Total em compras R$ <?php echo $linhatc['pedido_valor'] ?><BR>
										- Créditos R$  <?php echo $linha['cliente_credito'] ?><br> 
										
										<hr class="my-4">
										<div align="center"><h5 class="mt-3 mb-1"> <strong>Comportamento </strong></h5></div> <br>
										Último pedido: <?php echo date('d/m/Y', strtotime($linhaup['pedido_data'])); ?> à <?php echo $diff->format("%a"); ?> dias
                    
                   
                    <BR>



										Total pedidos terminal:  <?php echo $totalpt ?><br> 
                    Total pedidos app: <?php echo $totalpapp  ?><br> 

										  <hr class="my-4">
										<div align="center"><h5 class="mt-3 mb-1"> <strong>Produtos que mais compra </strong></h5></div> <br>
										
										<div id="equipamentos" style="display: block"> 
										
											
											<div data-simplebar style="max-height: 600px;">
                                            <div class="table-responsive">
												
												<table class="table table-borderless table-centered table-nowrap">
												  <tbody>
												    <tr>                                                
												    <tr>
												      <th>QTD</th>
												      <th>Produto</th>
												      
												      
											        </tr>
											      <tbody>
												      <tr>
											
											<?php
											///PRODUTOS

$sqlmc = "SELECT  SUM(c.qtd_carrinho) AS qtd, p.produto_nome  FROM carrinho c INNER JOIN produtos p ON c.produto_carrinho = p.id_produto where c.cliente_carrinho = $id and c.status_carrinho = 2 GROUP BY c.produto_carrinho  order by qtd desc limit 7  ";
$resultadoeq = mysqli_query($conn, $sqlmc);
while ($linhaeq = mysqli_fetch_array($resultadoeq)) {
	
	?>
											<td ><span style="width: 15px;"> <?php echo $linhaeq['qtd'] ?> </span></td>
												        <td> <?php echo $linhaeq['produto_nome'] ?></td>
												        
												      
											        </tr>
											
											<?php } ?>
											
											
											   </tbody>
											    </table>
												</div></div>
												
											
											
										</div>
											<div id="dvConteudo3a"> 
										
										
										
										</div>
										
										
										<br>
										<div align="right"> </div>
                                        <div class="text-muted">
                                           
                                                

                                           
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8">
<div class="row"><!-- end card--><!-- end col -->
	 
	
	
	
	
	
					 <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
										
										
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <a class=" dropdown-toggle" href="compras_clientes/<?php echo $id ?>" id="dropdownMenuButton2"
                                                     aria-expanded="false">
                                                 <span class="text-muted">Ver todas <i class="fa fa-plus" aria-hidden="true"></i></span>
                                                </a>

                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Últimas Compras</h4>

                                        <div data-simplebar style="max-height: 1336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
														
                        <tr>
                          <th>Local</th>
                          <th>Data</th>
                          <th>Pedido</th>
						 <th>Valor</th>
							 <th>Unidade</th>
                          
                        </tr>
                     
                      <tbody>
                        <tr>
								
															
														 <?php 
	while ($linhav = mysqli_fetch_array($resultadov)) {
															?> 
							
															
                            <td ><span style="width: 15px;">
                                                              <?php if ($linhav['pedido_local'] =='1') { ?>
                                                              <img src="assets/images/avatar_toten.jpg" class="avatar-xs rounded-circle " alt="...">
                                                              <?php } ?>
                                                              <?php if ($linhav['pedido_local'] =='2') { ?>
                                                              <img src="assets/images/avatar_app.jpg" class="avatar-xs rounded-circle " alt="...">
                                                              <?php } ?>
                                                            </span></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><span style="width: 15px;"><?php echo date('d/m/Y', strtotime($linhav['pedido_data'])); ?></span></h6>
                                                               
                                                            </td>
                                                            <td><h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhav['id_pedido'] ?></h6></td>
							
							<td><h6 class="font-size-15 mb-1 fw-normal">R$ <?php echo $linhav['pedido_valor'] ?></h6></td>
							<td><h6 class="font-size-15 mb-1 fw-normal">   <?php echo $linhav['unidade_nome'] ?> </h6></td>
							
                                                            
                                                        </tr>
						  
						  
						  
														
														<?php } ?>
														
                                                    </tbody>
                                                </table>
                                            </div> 
                                            <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> 
					  
						 
						 
					
					
					
					
					<!-- Center Modal Add Equipamentos--></a>
                                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
													
													
													
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Adicionar Equipamento</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																
								
																<form id="formequipamentos" action="#" method="post"> 
																	
																	<div class="row"> 
																		
																		<div id="dvConteudo3">      
																		
																			
																	<div class="col-md-12">
																		<div class="mb-1">
																			<label>Equipamento:</label>
                                                    <input type="text" class="form-control" placeholder="Informe o nome, exemplo: Geladeira"   required name="equipamento">

                                                    </div> </div>
																			
																			
																			
																					<div class="col-md-12">
																		<div class="mb-1">
																			<label>Valor:</label>
                                                    <input type="text" class="form-control money" name="valor" placeholder="Informe o valor do equipamento"  >
                                                    </div> </div>
																	
																		<div class="col-md-12">
																		<div class="mb-1">
																			<label>Estado do equipamento:</label>
                                                   
																			<select name="situacao" id="select"  class="form-control">
  <option value="1">Em funcionamento</option>
  <option value="2">Em Manuntenção</option>
</select>
                                                    </div> </div>
																
																	
													<input type="hidden" name="unidade" class="form-control" placeholder="Produto" required value="<?php echo $_POST['id'] ?>" >
	                                               			
													
													
	
																	
																	
                                                </div>	 </div>		
																	
																	
																                                              
																		<br>
																			
																<div align="right"><button type="submit" class="btn btn-success" data-bs-dismiss="modal"   ><i class="glyphicon glyphicon-ok"></i> Salvar</button>	</div>

																	</div>
																	
																		
																	
																	
																	</div>
																				
																			
                                                            
																
							
																
																
																
																
										
																		</form>				
																
																
			<script>
	 $(document).ready(function() {
 
	 $("#formequipamentos").submit(function(){
		 
		 
		 
		    var formData = new FormData(this);

		 
		$.ajax({
			url: 'inserir_equipamento.php',
			cache: false,
			data: formData,
			type: "POST",  
			enctype: 'multipart/form-data',
			processData: false, // impedir que o jQuery tranforma a "data" em querystring
            contentType: false, // desabilitar o cabeçalho "Content-Type"


			success: function(msg){
				
				$("#dvConteudo3a").empty();
				$("#dvConteudo3a").append(msg);
				document.getElementById("equipamentos").style.display = "none";

			}
			
		});
		 
		 return false;
	 });
 
 });

</script>														
														
														
														
																
																
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
                                            <!-- end col -->
                                                                      
                                                                </div>
                                                            </div>


                                                        </div>

                                                       
                                                  

                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
			
							
					
					

		 <!-- JAVASCRIPT -->
 <!-- Varying Modal Content js -->
       <script src="assets/js/pages/modal.init.js"></script>
<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>			


        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>


        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>