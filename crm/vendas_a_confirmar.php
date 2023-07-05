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
$sql_venda = "SELECT * FROM p_apagar where retorno ='-1019' and data_apagar > '2022-08-15' ";
$resultado_venda = mysqli_query($conn, $sql_venda);

//Contar o total de cursos
$total_vendas = mysqli_num_rows($resultado_venda);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 300;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_vendas/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os cursos a serem apresentado na página

$result_vendas = "SELECT * FROM p_apagar p inner join terminais t ON p.id_terminal = t.id_terminal inner join unidades u ON t.id_unidade = u.id_unidade inner join clientes c on p.cliente_apagar = c.id_cliente where p.retorno ='-1019' and  p.data_apagar > '2022-08-13' order by p.data_apagar desc limit $incio, $quantidade_pg";
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
                                    <h4 class="mb-0">Financeiro &gt; Vendas aguardando confirmação</h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div><br><br>
					</div>
                    </div>
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



<?php while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)){ 
							
							
				
	
							
							?>


	<td><?php echo date('d/m/Y', strtotime($rows_vendas['data_apagar'])); ?>  </td>
					   <td><?php echo $rows_vendas['unidade_nome'] ?></td>
							 <td><?php  if ($rows_vendas['cliente_nome']  == '') { ?> Não informado <?php } ?> <?php echo $rows_vendas['cliente_nome'] ?></td>
                          <td>R$ <?php echo $rows_vendas['valor'] ?></td>
							<td> <span style="width: 15px;">
<?php echo $rows_vendas['t_maquina'] ?>
</span> </td>
	 <td> 
		 <a href="confirmar_venda_confirmar/<?php echo $rows_vendas['id_apagar'] ?>">   
		 <button class="btn btn-success btn-sm waves-effect" type="button">
                                                 	  Confirmar
                                                </button></a>
		 
		<a href="deletar_venda_confirmar/<?php echo $rows_vendas['id_apagar'] ?>" onclick="return confirm('Deseja mesmo deletar esse registro?');">  <button class="btn btn-danger btn-sm waves-effect" type="button">
                                                    Cancelar 
                                                </button></a>
							
							</td>					
							
                         
                          
							
							
							
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