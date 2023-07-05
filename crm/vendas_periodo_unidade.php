<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS



?>

 <!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>

  <!-- Responsive Table css -->
        <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

<!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />   

<?php 


$sqlu = "SELECT * FROM unidades where id_unidade ='$_POST[unidade]'  ";
$resultadou = mysqli_query($conn, $sqlu);
$linhau=mysqli_fetch_array($resultadou);	
	
// SOMANDA VALORES DE TOTTEM	debito e credito
$sqltv = "SELECT SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_unidade = '$_POST[unidade]'   and pedido_status ='2' and pedido_local ='1' and pedido_pagamento <> 'Pix'    ";
$resultadotv = mysqli_query($conn, $sqltv);
$linhatv = mysqli_fetch_array($resultadotv);
	

$sqltvp = "SELECT SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_unidade = '$_POST[unidade]'   and pedido_status ='2' and pedido_local ='1' and pedido_pagamento = 'Pix'    ";
$resultadotvp = mysqli_query($conn, $sqltvp);
$linhatvp = mysqli_fetch_array($resultadotvp);	
	
// SOMANDA VALORES DE APP	
$sqltva = "SELECT SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_unidade = '$_POST[unidade]'   and pedido_status ='2' and pedido_local ='2' and pedido_pagamento <> 'PIXAPP'    ";
$resultadotva = mysqli_query($conn, $sqltva);
$linhatva = mysqli_fetch_array($resultadotva);

// SOMANDA VALORES DE APP PIX
$sqltvap = "SELECT SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_unidade = '$_POST[unidade]'   and pedido_status ='2' and pedido_local ='2' and pedido_pagamento = 'PIXAPP'    ";
$resultadotvap = mysqli_query($conn, $sqltvap);
$linhatvap = mysqli_fetch_array($resultadotvap);
	
	
$result_vendas = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_unidade = '$_POST[unidade]' and   p.pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'   and p.pedido_status ='2' order by p.id_pedido  desc ";	

	
	
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
                                    <h4 class="mb-0">Financeiro &gt; Vendas > <a href="perfil_unidade/<?php echo $linhau['id_unidade'] ?>"> <?php echo $linhau['unidade_nome'] ?></a></h4>

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
												   
												   																 <input type="hidden" name="unidade" value="<?php echo $_POST['unidade'] ?>">

												   
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
                    <h4 class="card-title">Temos um total de (<?php echo $total_vendas2 ?>) vendas  registradas no periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> à <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> <?php if ($_POST['unidade'] =='') { } else { ?> - Unidade: <?php echo $linhau['unidade_nome'] ?> <?php } ?>  </h4><br>
                    
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



<?php 

$x=0;
while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)){ 
$x++;
?>
			
							
							
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
							
							
							
							
							
							
							
							
							
							
							
							
							


	<td><?php echo $x ?> - <?php echo date('d/m/Y', strtotime($rows_vendas['pedido_data'])); ?> - <?php echo date('H:i', strtotime($rows_vendas['pedido_hora'])); ?> </td>
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
<?php if (($rows_vendas['pedido_pagamento'] =='Pix') or ($rows_vendas['pedido_pagamento'] =='PIXAPP'))   { ?>
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
                    <span class="card-body"> <strong>Total das vendas Totem Débito e Crédito </strong> R$<?php echo $linhatv['pedido_valor'] ?> (<?php echo $total_vendastt ?>)  - <strong>Total das vendas Totem Pix</strong> </strong> R$<?php echo $linhatvp['pedido_valor'] ?> (<?php echo $total_vendastt ?>)  - <strong> Total das vendas APP Crédito </strong> R$<?php echo $linhatva['pedido_valor'] ?> (<?php echo $total_vendasapp ?>) </span><span class="card-body"><strong>Total das vendas APP Pix </strong> R$<?php echo $linhatvap['pedido_valor'] ?></span></div>
                </div>   </div>   </div>   </div>   </div>
                                   
<div>
	
	

                   
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