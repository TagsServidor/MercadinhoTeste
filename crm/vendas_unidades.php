<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$sqlu = "SELECT * FROM unidades where id_unidade = $id  ";
$resultadou = mysqli_query($conn, $sqlu);
$linhau = mysqli_fetch_array($resultadou);

?>



<?php 
$pagina = (isset($id2)? $id2 : 1);

//Selecionar todos os cursos da tabela
$sql_venda = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
 INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_status ='2' and p.pedido_unidade = $id order by p.id_pedido  desc ";
$resultado_venda = mysqli_query($conn, $sql_venda);

//Contar o total de cursos
$total_vendas = mysqli_num_rows($resultado_venda);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 100;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_vendas/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os cursos a serem apresentado na página

$result_vendas = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_status ='2' and p.pedido_unidade = $id  order by p.id_pedido  desc limit $incio, $quantidade_pg";
$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
?>


<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
 
   <!-- Bootstrap Css -->
   <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

				


					


                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Financeiro &gt; Vendas > <a href="perfil_unidade/<?php echo $id ?>"> <?php echo $linhau['unidade_nome'] ?></a></h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
                <div class="container-fluid">
                 <form action="vendas_periodo_unidade" method="post">
											   
											   <div class="row"> 
												   
												<div class="col-3">    <label><strong>Inicio:</strong></label>
											<input type="date" class="form-control" required name="inicio"> 
												   </div>
												   
														<div class="col-3">  
															 <label><strong>Fim:</strong></label>
											<input type="date" class="form-control" required name="fim">
												   </div>
												   
												   
																 
																 <input type="hidden" name="unidade" value="<?php echo $id ?>">
																 
															 
															
												   
												   <div class="col-3">  
															 <label>&nbsp;<br></label><br>
											<button class="btn btn-info"> Listar </button>
												   </div>
												   
												   </div>
											
											</form>
                  
 </div> <br><br>
					<div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Temos um total de (<?php echo $total_vendas ?>) vendas  registradas </h4><br>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>Data</th>
							 <th>Unidade</th>
							 <th>Cliente</th>
                          <th>Valor</th>
							<th>Forma</th>
							 <th>Local</th>
                          <th>Ações</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        <tr>



<?php while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)){ ?>

							
							
<!--  Extra Large modal example -->
                                                <div class="modal fade bs-example-modal-xl<?php echo $rows_vendas['id_pedido']; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myExtraLargeModalLabel">Id venda: #<?php echo $rows_vendas['id_pedido']; ?> - Controle: <?php echo $rows_vendas['pedido_session']; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																
																<div align="center"> <?php if ($rows_vendas['pedido_status'] =='2') { ?> <button class="btn btn-success"> PAGO </button> <?php } ?> <?php if ($rows_vendas['pedido_status'] =='1') { ?> <button class="btn btn-info"> REALIZADO </button><?php } ?> <?php if ($rows_vendas['pedido_status'] =='3') { ?> <button class="btn btn-danger"> CANCELADO </button><?php } ?></div>
																<hr>
                                                                <strong>Data:</strong> <?php echo date('d/m/Y', strtotime($rows_vendas['pedido_data'])); ?>  <?php echo $rows_vendas['pedido_hora']; ?> - <strong>Unidade:</strong> <?php echo $rows_vendas['unidade_nome'] ?> <strong>Local:</strong> <?php if ($rows_vendas['pedido_local'] =='1') { ?> Terminal <?php } ?> <?php if ($rows_vendas['pedido_local'] =='2') { ?> APP <?php } ?> <br>
																 <strong>Cliente:</strong> <?php $rows_vendas['cliente_nome']  ?>  - <strong>CPF:</strong> <?php $rows_vendas['cliente_cpf']  ?> <strong>Telefone:</strong> <?php $rows_vendas['cliente_telefone']  ?> E-mail <?php $rows_vendas['cliente_email']  ?><br>
																
																
																
																
																<hr>
                                                             
																<?php
$sqli = "SELECT * FROM carrinho c INNER JOIN produtos p ON c.produto_carrinho = p.id_produto where c.session_carrinho = '$rows_vendas[pedido_session]' and c.qtd_carrinho <>'0' ";
$resultadoi = mysqli_query($conn, $sqli);
$totali = mysqli_num_rows($resultadoi);	

	?>
	   <h5>Pedido</h5>											
																
																<div class="row" style="background: #F2F2F2; padding: 5px"> 
																
																<div class="col-1"> <strong> QTD</strong> </div>
																<div class="col-5"> <strong>Item</strong> </div>
																<div class="col-3"> <strong>Valor Un. </strong></div>
																<div class="col-3"> <strong>Total</strong> </div>
																
																</div>
																
																<?php while($item = mysqli_fetch_array($resultadoi)){ ?>
															
																
															<div class="row"> 
																
																<div class="col-2"> <?php echo $item['qtd_carrinho'] ?> </div>
																<div class="col-4" ><?php echo $item['produto_nome'] ?>  </div>
																<div class="col-3"> <?php echo $item['preco_uni'] ?> </div>
																<div class="col-3"> <?php $vtotal =  $item['qtd_carrinho'] *  $item['preco_uni']; echo $vtotal; ?>  </div>
																<hr>
																</div>
																
																<?php } ?>
	
																
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->						
							
						</div>
													
							
							
							
							
							
							
							
							
							
							
							
							

	<td><?php echo date('d/m/Y', strtotime($rows_vendas['pedido_data'])); ?> - <?php echo date('H:i', strtotime($rows_vendas['pedido_hora'])); ?> </td>
					   <td><?php echo $rows_vendas['unidade_nome'] ?></td>
							 <td><?php  if ($rows_vendas['cliente_nome']  == '') { ?> Não informado <?php } ?> <?php echo $rows_vendas['cliente_nome'] ?></td>
                          <td>R$ <?php echo $rows_vendas['pedido_valor'] ?></td>
						
						
						<td>
							
							<?php if (($rows_vendas['pedido_pagamento'] =='Cartão de Credito') or ($rows_vendas['pedido_pagamento'] =='CreditCard')) { ?>
<i class="fa fa-credit-card" aria-hidden="true" style="color: chocolate"></i>
 Crédito 
<?php } ?>
<?php if ($rows_vendas['pedido_pagamento'] =='Cartão de Debito')  { ?>
<i class="fa fa-credit-card" aria-hidden="true" style="color: darkkhaki"></i>
 Débito
<?php } ?>
<?php if (($rows_vendas['pedido_pagamento'] =='Pix') or ($rows_vendas['pedido_pagamento'] =='PIXAPP'))  { ?>
<i class="fa fa-qrcode" aria-hidden="true" style="color: cadetblue"></i>
 Pix
<?php } ?>	
							
							</td>
						
						
							<td> <span style="width: 15px;">
<?php if ($rows_vendas['pedido_local'] =='1') { ?>
<img src="assets/images/avatar_toten.jpg" class="avatar-xs rounded-circle " alt="...">
<?php } ?>
<?php if ($rows_vendas['pedido_local'] =='2') { ?>
<img src="assets/images/avatar_app.jpg" class="avatar-xs rounded-circle " alt="...">
<?php } ?>
</span> </td>
	 <td><a href="#"  data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl<?php echo $rows_vendas['id_pedido']; ?>"> + Detalhes</a></td>					
							
                         
                          
							
							
							
                        </tr>                    
                                               
        


	<?php } ?>
	
	</tbody>
                    </table>


<?php
				//Verificar a pagina anterior e posterior
				$pagina_anterior = $pagina - 1;
				$pagina_posterior = $pagina + 1;
			?>



					

	
	<nav class=" navbar-collapse">
				<ul class="pagination">
					<li class="page-item">
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="vendas_unidades/<?php echo $id ?>/<?php echo $pagina_anterior; ?>"  class="page-link" aria-label="Previous">
								<span aria-hidden="true" >&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true"  class="page-link">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li class="nav-item"><a href="vendas_unidades/<?php echo $id ?>/<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
					<?php } ?>
					<li class="page-item">
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="vendas_unidades/<?php echo $id ?>/<?php echo $pagina_posterior; ?>" class="page-link" aria-label="Previous">
								<span aria-hidden="true" >&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true"  class="page-link">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>



</div></div>
								

                  

                   
		  <!-- JAVASCRIPT -->
		  <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>