<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
$sqlu = "SELECT * FROM unidades where id_unidade = $id  ";
$resultadou = mysqli_query($conn, $sqlu);
$linhau = mysqli_fetch_array($resultadou);
/// CONECTANDO OS PRODUTOS

$sql = "SELECT * FROM unidades where id_unidade = '$id' ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);

$cat_prod_id = $id;



$query_produtos = "SELECT * 
                    FROM produtos_unidades 
                    WHERE produto_unidade_unidade=:cat_prod_id
                   order by produto_unidade_estoque ";
$result_produtos = $conn2->prepare($query_produtos);
$result_produtos->bindParam(':cat_prod_id', $cat_prod_id);
$result_produtos->execute();

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
                                    <h4 class="mb-0">Estoque &gt;  <a href="perfil_unidade/<?php echo $id ?>"> <?php echo $linhau['unidade_nome'] ?></a></h4> 

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
                          <th style="width:5%">Estoque</th>
                          <th style="width:15%" >Produto</th>
                   
                          <th style="width:5%">Min.</th>
                          <th style="width:5%" >Max.</th>
							 <th>Valor</th>
							
                          <th style="width:5%">Alertas</th>
                          <th style="width:5%">Ações</th>
                        </tr>
                      <tbody>
                        <tr>
                          <?php 
	 while($row_prod = $result_produtos->fetch(PDO::FETCH_ASSOC)){
                extract($row_prod);
				
				
				$sql = "SELECT * FROM produtos where id_produto = '$produto_unidade_produto' ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);    
															
															?>
							 <tr>
			
							
							
							
                         
                            <td style="width:5%"><?php echo $produto_unidade_estoque ?>
								
								</td>
                          <td style="width:15%; white-space: pre-wrap"><span style="font-size:14px"> <a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $id_produto_unidades ?>"><?php echo $linha['produto_nome'] ?> </span></td>
                          <td style="width:5%" ><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $id_produto_unidades ?>"><?php echo $produto_unidade_minimo ?></td>
                          <td style="width:5%"><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $id_produto_unidades ?>"><?php echo $produto_unidade_maximo ?></td>
							  
							 <td style="width:5%"><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $id_produto_unidades ?>"><?php echo $produto_unidade_valor ?></td>  
							  
								 
                          <td style="width:5%" ><?php if($produto_unidade_minimo > $produto_unidade_estoque) { ?>   <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: $fff"></i></button>
															 
<?php } ?></td>
                          <td ><a href="remover_produto_unidade/<?php echo $id_produto_unidades ?>/<?php echo $id ?>" onclick="return confirm('Deseja mesmo remover esse Produto?');">x remover</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
                </div>   </div>   </div>   </div>   </div>
					<input type="hidden" name="unidade" value="<?php echo $id ?>">
					
					
					


<?php
	$cat_prod_id = $id;



$query_produtos = "SELECT * 
                    FROM produtos_unidades 
                    WHERE produto_unidade_unidade=:cat_prod_id
                   order by produto_unidade_estoque ";
$result_produtos = $conn2->prepare($query_produtos);
$result_produtos->bindParam(':cat_prod_id', $cat_prod_id);
$result_produtos->execute();

while($row_prod = $result_produtos->fetch(PDO::FETCH_ASSOC)){
                extract($row_prod);
				
				
				$sql = "SELECT * FROM produtos where id_produto = '$produto_unidade_produto' ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);  
	?>
					
		<!-- Center Modal example -->
                                                <div class="modal fade modaleditar<?php echo $id_produto_unidades ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Editar</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																<form action="editar_estoque_unidade" method="post"> 
																<div class="row">
																	
																	
																	
																	<div class="col-4">
																		<label><strong> Estoque Atual</strong></label>
																<input type="text" class="form-control" required name="qtd" value="<?php echo $produto_unidade_estoque ?>">
																	</div>
																	
																  <div class="col-4">
																	<label><strong> Estoque Minimo.</strong></label>
																<input name="min" type="text" class="form-control" id="min" value="<?php echo $produto_unidade_minimo ?>">
																	</div>
																	
																  <div class="col-4">
																	<label><strong> Estoque Maximo</strong></label>
																<input name="max" type="text" class="form-control" id="max" value="<?php echo $produto_unidade_maximo ?>">
																	</div>
																	
																	</div>
																
																<div class="row">
																  <div class="col-4">
																	<label><strong>Lote</strong></label>
																<input name="lote" type="text" class="form-control" id="lote" value="<?php echo $produto_unidade_lote ?>">
																	</div>
																	
																  
																		
																
																  <div class="col-4">
																	<label><strong>Valor</strong></label>
																<input name="valor" type="text" class="form-control money" id="lote"  value="<?php echo $produto_unidade_valor ?>">
																	</div>
																	
																	
																	<div class="col-4">
																	<label><strong>Código de barras</strong></label>
																<input name="barras" type="text" class="form-control" id="lote" value="<?php echo $produto_unidade_codigobarras ?>">
																	</div>

                                  <div class="col-12">
																	<label><strong>Motivo do ajuste</strong> <a href="#" data-bs-toggle="modal" data-bs-target=".modalajuste"> + ADD Motivo </a> </label>

                                  <?php 
echo "<SELECT NAME='motivo' SIZE='1' class='form-control' required>

<OPTION VALUE='' SELECTED> Informe o motivo ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM aletar_motivos where alerta_status ='1'    ORDER BY alerta_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_alerta']."'>".($linha['alerta_nome']);
}
echo "</SELECT>";

?>



																	</div>
																	
																	<div class="col-12"> <br>
																	<input type="hidden" name="unidade" value="<?php echo $id ?>" >

																		<input type="hidden" name="id" value="<?php echo $id_produto_unidades ?>" >
																	<button class="btn btn-info"> SALVAR </button> 
																	</div>
</form>
																</div>
																
																	
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->				




<?php } ?>



<!-- Center Modal example -->
<div class="modal fade modalajuste" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Adicionar Motivo Ajuste</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																<form action="inserir_motivo" method="post"> 
																<div class="row">
																	
																	
																	
																	<div class="col-12">
																		<label><strong> Motivo</strong></label>
																<input type="text" class="form-control" required name="motivo" value="">
																	</div>
																	
																  
																	


																	</div>
																	
																	<div class="col-12"> <br>

																		<input type="hidden" name="retorno" value="ver_estoque_unidade/<?php echo $id ?>" >
																	<button class="btn btn-info"> SALVAR </button> 
																	</div>
</form>
																</div>
																
																	
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->				



			   <!-- JAVASCRIPT -->
       
 <script src="assets/js/pages/modal.init.js"></script>
<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>	
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