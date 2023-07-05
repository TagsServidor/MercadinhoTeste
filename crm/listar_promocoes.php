<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS

?>



<?php 


$result_vendas = "SELECT * FROM promocoes p left JOIN unidades u on p.promo_unidade = u.id_unidade inner join produtos pr on p.promo_produto = pr.id_produto where p.promo_status = '1'";
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
                                    <h4 class="mb-0">Promoções &gt; Listando Promoções</h4> 

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
                    <h4 class="card-title">Temos um total de (<?php echo $total_vendas2 ?>) promoções  registradas </h4><br>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>Promoção</th>
                          <th>Datas</th>

							 <th>Unidade</th>
							 <th>Produto</th>
                          <th>Valores</th>
							 <th>Local</th>
                          <th>Ações</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        <tr>



<?php while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)){ 
							
							
				
	
							
							?>


	<td><?php echo $rows_vendas['promo_nome'] ?>  </td>
    <td>Inicio: <?php echo date('d/m/Y H:i:s', strtotime($rows_vendas[promo_inicio])); ?> <br>
Fim:   <?php echo date('d/m/Y H:i:s', strtotime($rows_vendas[promo_fim])); ?></td>
					   <td><?php  if ($rows_vendas['unidade_nome']  == '') { ?> Todas <?php } else { ?><?php echo $rows_vendas['unidade_nome'] ?> <?php  } ?></td>
							 <td> <?php echo $rows_vendas['produto_nome'] ?></td>
                          <td>
                          DE R$ <?php echo $rows_vendas['valor_original'] ?><BR>
                          POR R$ <?php echo $rows_vendas['promo_valor'] ?></td>
							<td> <span style="width: 15px;">
<?php echo $rows_vendas['promo_local'] ?>
</span> </td>
	 <td> 
		
		 
		<a href="cancelar_promocao/<?php echo $rows_vendas['promo_id'] ?>" onclick="return confirm('Deseja mesmo deletar essa promocao?');">  <button class="btn btn-danger btn-sm waves-effect" type="button">
                                                    Cancelar 
                                                </button></a>
                                                <a href="vendas_promo/<?php echo $rows_vendas['promo_id'] ?>" >  <button class="btn btn-info btn-sm waves-effect" type="button">
                                                    Vendas 
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