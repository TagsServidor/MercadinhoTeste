<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS

?>



<?php 
$pagina = (isset($id)? $id : 1);
echo $pagina;
//Selecionar todos os cursos da tabela
$sql_venda = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
 INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_status ='2' order by p.id_pedido  desc ";
$resultado_venda = mysqli_query($conn, $sql_venda);

//Contar o total de cursos
$total_vendas = mysqli_num_rows($resultado_venda);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 30;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_vendas/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os cursos a serem apresentado na página

$result_vendas = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_status ='2' order by p.id_pedido  desc limit $incio, $quantidade_pg";
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
                                    <h4 class="mb-0">Financeiro &gt; Vendas &gt; Local</h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
                <div class="container-fluid">
                 <form action="vendas_periodo_local" method="post">
											   
											   <div class="row"> 
												   
												<div class="col-3">    <label><strong>Inicio:</strong></label>
											<input type="date" class="form-control" required name="inicio"> 
												   </div>
												   
														<div class="col-3">  
															 <label><strong>Fim:</strong></label>
											<input type="date" class="form-control" required name="fim">
												   </div>
												   
												   <div class="col-3">  
													 <label><strong>Local:</strong></label>
															 <span class="mb-3">
															<select class="form-control" name="local" required>
															  <option>Informe</option>
															  <option value="1">Terminal</option>
															  <option value="2">APP Cartão</option>
															  
															  <option value="3">APP Pix</option>
                                                            </select>
															 </span></div>
												   
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
							 <th>Local</th>
                          <th>Ações</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        <tr>



<?php while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)){ ?>


	<td><?php echo date('d/m/Y', strtotime($rows_vendas['pedido_data'])); ?> - <?php echo date('H:i', strtotime($rows_vendas['pedido_hora'])); ?> </td>
					   <td><?php echo $rows_vendas['unidade_nome'] ?></td>
							 <td><?php  if ($rows_vendas['cliente_nome']  == '') { ?> Não informado <?php } ?> <?php echo $rows_vendas['cliente_nome'] ?></td>
                          <td>R$ <?php echo $rows_vendas['pedido_valor'] ?></td>
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






												<nav aria-label="Page navigation example">
				<ul class="pagination">
					<li class="page-item">
						<?php
						if($pagina_anterior != 0){ ?>
							<a href="vendas/<?php echo $pagina_anterior; ?>"  class="page-link" aria-label="Previous">
								<span aria-hidden="true" >&laquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true"  class="page-link">&laquo;</span>
					<?php }  ?>
					</li>
					<?php 
					//Apresentar a paginacao
					for($i = 1; $i < $num_pagina + 1; $i++){ ?>
						<li><a href="vendas/<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
					<?php } ?>
					<li>
						<?php
						if($pagina_posterior <= $num_pagina){ ?>
							<a href="vendas/<?php echo $pagina_posterior; ?>" class="page-link" aria-label="Previous">
								<span aria-hidden="true" >&raquo;</span>
							</a>
						<?php }else{ ?>
							<span aria-hidden="true"  class="page-link">&raquo;</span>
					<?php }  ?>
					</li>
				</ul>
			</nav>





                  </div>
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