<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

/// CONECTANDO AOS DADOS DA CENTRAL
$sql = "SELECT *FROM unidades u INNER JOIN condominios c on u.unidade_condominio = c.id_condominio  where id_unidade = $id ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	
$linha = mysqli_fetch_array($resultado);

/// CONECTANDO AS VENDAS DA UNIDADE


$sqlv = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
 INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_unidade = $id and p.pedido_data <>'0000-00-00' order by p.pedido_data desc limit 10 ";
$resultadov = mysqli_query($conn, $sqlv);
$totalv = mysqli_num_rows($resultadov);	


/// CONECTANDO AO ESTOQUE DA UNIDADE PARA PEGAR TOTAL VALOR DE PRODUTOS
$totalestoque = '0';
$totalvalor = '0';
$sqlpu2 = "SELECT * FROM produtos_unidades pu where pu.produto_unidade_unidade = $id   ";
$resultadopu2 = mysqli_query($conn, $sqlpu2);
while($linhapu2 = mysqli_fetch_array($resultadopu2)) {
$totalestoque = $linhapu2[qtd_estoque];
$totalvalor = $linhapu2[totalvalor];
$totalestoque3 = $linhapu2[produto_unidade_estoque];


$sqlpu2a = "SELECT * FROM entrada_produtos  where entrada_produto = $linhapu2[produto_unidade_produto]  ";
$resultadopu2a = mysqli_query($conn, $sqlpu2a);
$linhapu2a = mysqli_fetch_array($resultadopu2a);

$valortotalestoque1 = $linhapu2a[entrada_unitario] * $totalestoque3 ;
$valortotalestoque += $valortotalestoque1;

}





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
$saldo = $linhavc['totalvalor'] + $valortotalestoque - $totaldespesas ;

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
                                    <h4 class="mb-0">Relatórios &gt; Unidades</h4> 

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
</div> 
               
					
                <div class="container-fluid">
					
					<a href="vendas_unidades/<?php echo $id ?>"><button class="btn btn-success" style="padding: 5px">  <i class="fa fa-shopping-bag" aria-hidden="true"></i> Relatório de Vendas </button> </a>					
					<a href="ver_estoque_unidade/<?php echo $id ?>"> <button class="btn btn-info" style="padding: 5px">  <i class="fa fa-list" aria-hidden="true"></i> Relatório de Estoque </button>	</a>				
	                <a href="produtos_vendidos_unidade/<?php echo $id ?>"><button class="btn btn-secondary" style="padding: 5px">  <i class="fa fa-arrow-down" aria-hidden="true"></i> Relatório de Saida Produtos </button> </a>
					<a href="entrada_produtos_unidades/<?php echo $id ?>"><button class="btn btn-warning" style="padding: 5px">  <i class="fa fa-arrow-up" aria-hidden="true"></i> Relatório de Entradas Produtos </button></a>
					<a href="listar_clientes_unidades/<?php echo $id ?>"><button class="btn btn-primary" style="padding: 5px">  <i class="fa fa-users" aria-hidden="true"></i> Lista de Clientes </button> </a>	
                    
<?php if( $linha['unidade_status'] =='1') { ?>
<a href="desativar_unidade_perfil/<?php echo $id ?>/2" onclick="return confirm('Tem certeza que deseja desativar esta unidade?')"><button class="btn btn-danger" style="padding: 5px">  <i class="fa fa-minus" aria-hidden="true"></i> Desativar Unidade</button> </a>	<br><br>
<?php } ?>
					
<?php if( $linha['unidade_status'] =='2') { ?>
<a href="desativar_unidade_perfil/<?php echo $id ?>/1" onclick="return confirm('Tem certeza que ativar desativar esta unidade?')"><button class="btn btn-success" style="padding: 5px">  <i class="fa fa-check" aria-hidden="true"></i> Ativar Unidade</button> </a>	<br><br>
<?php } ?>					
					
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

<?php echo $totalestoque; ?> <br>


										<div align="center"><h5 class="mt-3 mb-1"> <strong>Resumo Financeiro </strong></h5></div> <br>
										+ Total de receitas R$<?php echo number_format($linhavc['totalvalor'], 2, ',', '.')  ?><BR>
                                        + Valor do estoque R$<?php echo number_format($valortotalestoque, 2, ',', '.')  ?><BR>
										- Total de despesas gerais R$0.00<br> 
										- Total de despesas produtos R$<?php echo number_format($linhacp['totalcustoos'], 2, ',', '.')  ?><br> 
                                        
										= Saldo R$ <?php echo number_format($saldo,2,",",".");  ?>
										
									
										  <hr class="my-4">
										<div align="center"><h5 class="mt-3 mb-1"> <strong>Equipamentos </strong></h5></div> <br>
										
										<div id="equipamentos" style="display: block"> 
										
											
											<div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
												
												<table class="table table-borderless table-centered table-nowrap">
												  <tbody>
												    <tr>                                                
												    <tr>
												      <th>Equipamento</th>
												      <th>Estado</th>
												      <th>Valor</th>
												      
											        </tr>
											      <tbody>
												      <tr>
											
											<?php
											///LISTANDO EQUIPAMENTOS 
$sqleq = "SELECT * FROM controle_equipamentos where equipamentos_unidade = $id order by equipamentos_id desc";
$resultadoeq = mysqli_query($conn, $sqleq);
while ($linhaeq = mysqli_fetch_array($resultadoeq)) {
	
	?>
											<td ><span style="width: 15px;"> <?php echo $linhaeq['equipamentos_nome'] ?> </span></td>
												        <td><?php if ($linhaeq['equipamentos_situacao'] =='1') {  ?><span class="badge bg-soft-success">Ativo </span><?php } ?><?php if ($linhaeq['equipamentos_situacao'] =='2') { ?><span class="badge bg-soft-warning">Manuntenção </span> <?php } ?></td>
												        <td>R$<?php echo $linhaeq['equipamentos_valor'] ?> </td>
												      
											        </tr>
											
											<?php } ?>
											
											
											   </tbody>
											    </table>
												</div></div>
												
											
											
										</div>
											<div id="dvConteudo3a"> 
										
										
										
										</div>
										
										
										<br>
										<div align="right"> <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"> Adicionar </button></div>
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
                                                <a class=" dropdown-toggle" href="vendas_unidades/<?php echo $id ?>" id="dropdownMenuButton2"
                                                     aria-expanded="false">
                                                 <span class="text-muted">Ver todas <i class="fa fa-plus" aria-hidden="true"></i></span>
                                                </a>

                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Últimas Vendas</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
														
                        <tr>
                          <th>Local</th>
                          <th>Data</th>
                          <th>Pedido</th>
						 <th>Valor</th>
							 <th>Status</th>
                          
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
							<td><h6 class="font-size-15 mb-1 fw-normal"><?php if ($linhav['pedido_status'] =='2') { ?> <button class="btn btn-success"> PAGO </button> <?php } ?> <?php if ($linhav['pedido_status'] =='1') { ?> <button class="btn btn-info"> REALIZADO </button><?php } ?> <?php if ($linhav['pedido_status'] =='3') { ?> <button class="btn btn-danger"> CANCELADO </button><?php } ?></h6></td>
							
                                                            
                                                        </tr>
						  
						  
						  
														
														<?php } ?>
														
                                                    </tbody>
                                                </table>
                                            </div> 
                                            <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> 
					  
						 
						  <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <form id="verestoqueunidade" action="ver_estoque_unidade" method="post">
													<input type="hidden" name="id" value="<?php echo $id ?>">
													<a class=" dropdown-toggle" href="vendas_unidades"  aria-haspopup="true" aria-expanded="false" onClick="document.getElementById('verestoqueunidade').submit();">
                                                 <span class="text-muted"><a class=" dropdown-toggle" href="ver_estoque_unidade/<?php echo $id ?>" id="dropdownMenuButton2"
                                                     aria-expanded="false">
                                                 <span class="text-muted">Ver todas <i class="fa fa-plus" aria-hidden="true"></i></span>
                                                </a></span>
                                                </form>
                                              

                                                            

                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Estoque</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
														
                        <tr>
                          <th>Estoque</th>
                          <th>Produto</th>
                          <th>Min.</th>
						 <th>Max.</th>
							
                         
                        </tr>
                     
                      <tbody>
                        <tr>
								
															
														 <?php 
	while ($linhapu = mysqli_fetch_array($resultadopu)) {
															
			
															
															?>
															
                                                            <td ><span style="width: 15px;">
                                                              <?php echo $linhapu['produto_unidade_estoque'] ?>
                                                            </span></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"> <?php echo $linhapu['produto_nome'] ?></h6>
                                                               
                                                            </td>
                                                            <td> <?php echo $linhapu['produto_unidade_minimo'] ?></td>
							
							<td><?php echo $linhapu['produto_unidade_maximo'] ?></td>
							
							
                                                           
                                                        </tr>
														
														<?php } ?>
														
                                                    </tbody>
                                                </table>
                                            </div> 
                                            <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> 
						 
				<div class="col-xl-12">
					
					
					
					
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