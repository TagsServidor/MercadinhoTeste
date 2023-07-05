<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO OS PRODUTOS

$sql = "SELECT * FROM centrais where id_central = '$id' ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);

$sqlpu = "SELECT * FROM produtos_central pc INNER JOIN produtos p ON pc.central_produto = p.id_produto where pc.central_produto_central = $id  and p.produto_lixeira = '1'   order by  pc.central_produto_estoque asc ";
$resultadopu = mysqli_query($conn, $sqlpu);
$totalopu = mysqli_num_rows($resultadopu);	
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





		 
	 

					<div id="dvConteudo" >

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Estoque &gt; <?php echo $linha['central_nome'] ?></h4> 

                                    <div class="page-title-right">
										 
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
               
					
					
					
					
					
					
                <div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">&nbsp;</h4><br>
                    <table class="table table-borderless table-centered table-nowrap">
                      <tbody>
                        <tr>                        
                        <tr>
                          <th>Estoque</th>
                          <th>Produto</th>
                          <th>Min.</th>
                          <th>Max.</th>
                          <th>Ações</th>
						<th>Detalhess</th>
                        </tr>
                      <tbody>
                        <tr>
                          <?php 
	while ($linhapu = mysqli_fetch_array($resultadopu)) {

															?>
							
              <input type="hidden" value="<?php echo $linhapu['central_produto'] ?>" name="produto[<?php echo $linhapu['id_produto_central'] ?>]">
		
  <!-- Center Modal example -->
                                                <div class="modal fade modaleditar<?php echo $linhapu['id_produto_central'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Editar</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																<form action="editar_estoque_central" method="post"> 
																<div class="row">
																	
																	
																	
																	<div class="col-4">
																		<label><strong> Estoque Atual</strong></label>
																<input type="text" class="form-control" required name="qtd" value="<?php echo $linhapu['central_produto_estoque'] ?>">
																	</div>
																	
																  <div class="col-4">
																	<label><strong> Estoque Minimo.</strong></label>
																<input name="min" type="text" class="form-control" id="min" value="<?php echo $linhapu['central_produto_qtd_minima'] ?>">
																	</div>
																	
																  <div class="col-4">
																	<label><strong> Estoque Maximo</strong></label>
																<input name="max" type="text" class="form-control" id="max" value="<?php echo $linhapu['central_produto_qtd_maxima'] ?>">
																	</div>
																	
																	</div>
																
																<div class="row">
																  <div class="col-4">
																	<label><strong>Lote</strong></label>
																<input name="lote" type="text" class="form-control" id="lote" value="<?php echo $linhapu['central_produto_lote'] ?>">
																	</div>
																	
                                  <div class="col-4">
																	<label><strong>Vencimento</strong></label>
																<input name="vencimento" type="date" class="form-control" id="lote" value="<?php echo $linhapu['central_produto_validade']; ?>">
																	</div>
																	
																	
																	<div class="col-12"> <br>
																		
																		<input type="hidden" name="id" value="<?php echo $linhapu['id_produto_central'] ?>" >
																	<button class="btn btn-info"> SALVAR </button> 
																	</div>
</form>
																</div>
																
																	
																	
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
																						
							
							
							
							
							
							
	    <!-- MODAL DETALHES -->
						
							
      <div class="modal fade bs-example-modal-xl" id="exampleModalScrollable<?php echo $linhapu['id_produto_central'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">Detalhes de Entradas</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																
																
																<?php 
$x=0;																
$sqlpup = "SELECT * FROM entrada_produtos WHERE entrada_produto = $linhapu[central_produto] and entrada_status ='2' and entrada_central =  $linhapu[central_produto_central]   ";
$resultadopup = mysqli_query($conn, $sqlpup);
while($totalopup = mysqli_fetch_array($resultadopup)){	 
$x++;	
?>
								<strong> Entrada - <?php echo $x ?> </strong> Data: <?php echo date('d/m/Y', strtotime($totalopup['entrada_data'])); ?>  <br>
									<strong>QTD:</strong> <?php echo $totalopup['entrada_qtd'] ?>  <strong>Lote:</strong> <?php echo $totalopup['entrada_lote'] ?>  <strong>Vencimento: </strong> 	<?php echo date('d/m/Y', strtotime($totalopup['entrada_vencimento'])); ?> <br>
																
										<strong>Fornecedor:</strong> <?php echo $totalopup['entrada_qtd'] ?> <br>
																
										<strong>Nota:</strong> <?php echo $totalopup['entrada_nota'] ?>  <strong>Valor Pago Un.: </strong> 	<?php echo $totalopup['entrada_unitario'] ?>						<strong>Valor Venda Un.: </strong> 	<?php echo $totalopup['entrada_venda'] ?>			
																
																<hr>
																<?php } ?>
																
																
                                                                
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                                                                
                                                                </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
																
																
                                                                
                                                    
							
							
							
							
							
							
							
							
							
							
							
                          <td >
                          <input type="text"  class="form-control" name="estoque[<?php echo $linhaos['id_produto_central'] ?>]" id="textfield" value=" <?php echo $linhapu['central_produto_estoque'] ?> ">

                          
                        </td>


                          <td><h6 class="font-size-15 mb-1 fw-normal">  <a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhapu['id_produto_central'] ?>"><?php echo $linhapu['produto_nome'] ?></a>

							  </h6>
              
                <strong> Ativo: </strong> 
<?php if($linhapu['produto_status'] == '1' ) { ?>
<input type="radio" checked name="desativar[<?php echo $linhapu['id_produto_central'] ?>]" value="1"> Sim
<input type="radio"  name="desativar[<?php echo $linhapu['id_produto_central'] ?>]" value="2"> Não
<?php } ?>

<?php if($linhapu['produto_status'] == '2' ) { ?>
  <input type="radio"  name="desativar[<?php echo $linhapu['id_produto_central'] ?>]" value="1"> Sim
<input type="radio" checked name="desativar[<?php echo $linhapu['id_produto_central'] ?>]" value="2"> Não
<?php } ?>


<span class="badge bg-danger">                    
  <input class="form-check-input" type="checkbox" name="excluir[<?php echo $linhapu['id_produto_central'] ?>]" value="2" id="flexRadioDefault2<?php echo $linhaos['id_produto_central'] ?>">
  <label class="form-check-label" for="flexRadioDefault2<?php echo $linhapu['id_produto_central'] ?>">
   Excluir 
  </label> 
</span>
              </td>
                          <td><input type="text"  class="form-control" name="minima[<?php echo $linhaos['id_produto'] ?>]" id="textfield" value=" <?php echo $linhapu['central_produto_qtd_minima'] ?> ">
</td>
                        
                        
                        
                          <td><input type="text"  class="form-control" name="maxima[<?php echo $linhaos['id_produto'] ?>]" id="textfield" value=" <?php echo $linhapu['central_produto_qtd_maxima'] ?> ">  </td>
                          <td >                       <?php if ($linhapu['central_produto_estoque'] <=  $linhapu['central_produto_qtd_minima']) { ?>  <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: $fff"></i>  Estoque Baixo</button> <?php } ?> <?php if ($linhapu['central_produto_estoque'] >  $linhapu['central_produto_qtd_minima']) { ?>  <button type="button" class="btn btn-success btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: $fff"></i>  Estoque ok </button> <?php } ?>
															 
</td><td> <button class="btn btn-success btn-sm waves-effect waves-light" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalScrollable<?php echo $linhapu['id_produto_central'] ?>"> <i class="fa fa-plus" aria-hidden="true" style="color: $fff"></i>  Ver </button>
							
							
							</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>

                </div>
                </div>   </div>   </div>   </div>   </div>
					
				<div id="results"></div>
					
			

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