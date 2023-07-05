		<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS

/// CONECTANDO AOS PEDIDOS
$sqlu = "SELECT * FROM unidades where id_unidade = $id  ";
$resultadou = mysqli_query($conn, $sqlu);
$linhau = mysqli_fetch_array($resultadou);

$sql = "SELECT SUM(qtd_carrinho) AS qtd_carrinho , SUM(qtd_carrinho*preco_pago) AS preco_pago2, SUM(qtd_carrinho*preco_custo) AS preco_custo2, preco_pago, preco_custo, produto_carrinho, data_carrinho, id_carrinho FROM carrinho WHERE status_carrinho ='2' and preco_pago <> '0.00' and unidade_carrinho = $id group by produto_carrinho    ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	


?>

<style>
	.esconderbarras {
		font-size: 0px;
	}

</style>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


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

				






				

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Produtos  &gt; Saidas > <a href="perfil_unidade/<?php echo $id ?>"> <?php echo $linhau['unidade_nome'] ?></a> </h4> 

                                    <div class="page-title-right">
										 
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                  
                <div class="container-fluid">
                 <form action="produtos_vendidos_unidade_periodo/<?php echo $id ?>" method="post">
											   
											   <div class="row"> 
												   
												<div class="col-4">    <label><strong>Inicio:</strong></label>
											<input type="datetime-local" class="form-control" required name="inicio"> 
												   </div>
												   
														<div class="col-4">  
															 <label><strong>Fim:</strong></label>
											<input type="datetime-local" class="form-control" required name="fim">
												   </div>
												   
												   
																 
																 <input type="hidden" name="unidade" value="<?php echo $id ?>">
																 
															 
															
												   
												   <div class="col-1">  
															 <label>&nbsp;<br></label><br>
											<button class="btn btn-info"> Listar </button>
												   </div>
												   
												   </div>
											
											</form>
                  
 </div> <br><br>
               
					
					
					
				<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Buttons example</h4>
                                      <p class="card-title-desc">
                                        </p>
        
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                               
                                                <th order-priority="2" >Produto</th>
                                                <th>Quantidade</th>
                                                <th>Valor Total</th>
                                                <th>Custo</th>
                                                <th>Lucro</th>
                                                <th>Relatório</th>
												
												
											
                                            </tr>
                                            </thead>
        
      	
                                            <tbody>
												
												
												
<?php while($linha = mysqli_fetch_array($resultado)){ 
$sqlp = "SELECT *  FROM produtos where id_produto = '$linha[produto_carrinho]' ";
$resultadop = mysqli_query($conn, $sqlp);
$linhap = mysqli_fetch_array($resultadop);
	
	
										
												$qtd = $linha['qtd_carrinho'];
												$valortotal = $linha['preco_pago2'];
	                                            $custo =  $linha['preco_custo2'];
	                                            $lucro = $valortotal - $custo ;
												?>
												
                                            <tr>
                                                <td><?php echo $linhap['produto_nome']; ?></td>
                                                <td><?php echo $linha['qtd_carrinho']; ?></td>
                                                <td>R$<?php echo number_format($valortotal, 2, ',', '.');  ?></td>
                                                <td>R$<?php echo number_format($custo, 2, ',', '.');  ?></td>
                                                <td>R$<?php echo number_format($lucro, 2, ',', '.');  ?> </td>
                                                <td><i class="fa fa-eye" aria-hidden="true" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalScrollable<?php echo $linha['id_carrinho']; ?>"</i></td>
                                               
												
                                            </tr>
                                   <?php } ?>
                                            </tbody>
											
											
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
	
	
	
	
	
	
	
	<?php
	$sql = "SELECT SUM(qtd_carrinho) AS qtd_carrinho , SUM(qtd_carrinho*preco_pago) AS preco_pago2, SUM(qtd_carrinho*preco_custo) AS preco_custo2, preco_pago, preco_custo, produto_carrinho, data_carrinho, id_carrinho FROM carrinho WHERE status_carrinho ='2' and preco_pago <> '0.00' and unidade_carrinho = $id group by produto_carrinho    ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	

	while($linha = mysqli_fetch_array($resultado)){ 
$sqlp = "SELECT *  FROM produtos where id_produto = '$linha[produto_carrinho]' ";
$resultadop = mysqli_query($conn, $sqlp);
$linhap = mysqli_fetch_array($resultadop);
		
	?>
	
	<!-- Scrollable modal example-->
                                                <div class="modal fade" id="exampleModalScrollable<?php echo $linha['id_carrinho']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Relatório Saida Produtos Estoque</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																<h3> <?php echo $linhap['produto_nome']?></h3> <br>
                                                                
																
																<div class="row"> 
																<div class="col-2" style="background-color: aliceblue; padding: 5px"> 
																	Data Saida</div>
																	
																	<div class="col-2" style="background-color: aliceblue; padding: 5px">  
																	Qtd</div>
																	
																	<div class="col-8" style="background-color: aliceblue; padding: 5px"> 
																	Cliente</div>
																	
																	
																	
																	</div>
																	
																<?php
		
$sqle = "SELECT *  FROM carrinho WHERE produto_carrinho ='$linha[produto_carrinho]' and unidade_carrinho = $id and status_carrinho ='2' order by data_carrinho desc   ";
$resultadoe = mysqli_query($conn, $sqle);
while($linhae = mysqli_fetch_array($resultadoe)){
	
$sqla = "SELECT *  FROM clientes where id_cliente  = '$linhae[cliente_carrinho]' ";
$resultadoa = mysqli_query($conn, $sqla);
$totalalertas = mysqli_num_rows($resultadoa )	;
$linhaa = mysqli_fetch_array($resultadoa);	
	
	
		?>
						<div class="row"  style="background-color:floralwhite; padding: 4px; border-bottom-color:#EBEBEB; border-bottom-width:1px; border-bottom-style: solid "> 
							
															
								<div class="col-2"> 
								<?php echo date('d/m/Y H:i:s', strtotime(@$linhae['data_carrinho'])); ?></div>
											
							
							<div class="col-2"> 
							<?php echo $linhae['qtd_carrinho'] ?></div>
							
							<div class="col-8"> 
							<?php echo $linhaa['cliente_nome'] ?></div>
																	
						
						
							
							
							
							
							</div>
							
																
								
							
																<?php } ?>
																  </div>
																
                                                           
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                                                                
                                                                </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
					
					<?php } ?>
					
       

        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
	
	
	<script>
	
	$(document).ready(function () {
	
    $('#datatable-buttons').DataTable({
		
		buttons: [
        'copy', 'excel', 'pdf',
			
    ],
        order: [1, 'desc'],

    });
})
	
		

		
	</script>
	
	
	
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>		
					
         <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>
        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
        <script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script>