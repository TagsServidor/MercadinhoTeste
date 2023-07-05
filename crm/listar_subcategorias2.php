<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO OS PRODUTOS

$sqls = "SELECT * FROM produtos_subcategorias ps  INNER JOIN produtos_departamentos pd ON ps.subcategoria_departamento = pd.id_departamentos INNER JOIN produtos_categorias pc on ps.subcategoria_categoria = pc.id_categoria order by ps.subcategoria_nome asc ";
$resultados = mysqli_query($conn, $sqls);
$totals = mysqli_num_rows($resultados);	

?>
<script src="assets/js/jquery.js"></script>
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

<div id="results3"></div>
					
					<div id="dvConteudo" >

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Subcategorias &gt; Listar</h4>

                                    <div class="page-title-right">
										<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"> <i class="fa fa-plus" aria-hidden="true"></i>
 Cadastrar Subcategoria</button
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
										
										<!-- Center Modal example -->
                                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">Subcategoria</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               
																
																<form  method="post" action="inserir_subcategoria">
																	
																	<div class="col-md-12">
                                                    <div class="mb-3">
																	<?php // listando em um box os instrutores

			  echo "<SELECT NAME='departamento' SIZE='1' class='form-control' required id='departamento'>

<OPTION VALUE='' SELECTED> Informe o departamento ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos_departamentos where departamentos_status ='1'  ORDER BY departamentos_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_departamentos']."'>".($linha['departamentos_nome']);
}
echo "</SELECT>";

?>
																		</div>	</div>									
																	
																	
																	<div id="resultsd"> </div>
																	
																	
																	
																
																	
																
																	<div align="center"> <input type="submit" class="btn btn-success btn-sm" value="Cadastrar"></div>
																</form>
                                                                
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                           
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
               
				
                                      
            <div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Temos um total de (<?php echo $totals ?>) subcategorias cadastradas </h4><br>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>Subcategoria</th>
							<th>Categoria</th>
							<th>Departamento</th>
                          <th>Status</th>
                         
                          
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
							
							
							<?php // LISTANDO OS EM ABERTO
														
while($linhas = mysqli_fetch_array($resultados)){

	
	?>
                          <td><?php echo $linhas['subcategoria_nome'] ?> </td>
							<td><?php echo $linhas['categoria_nome'] ?> </td>
							  <td><?php echo $linhas['departamentos_nome'] ?> </td>
                          <td><?php if ($linhas['subcategoria_status'] =='1' ) { ?><span class="btn btn-success btn-sm">Ativo </span><?php } ?> <?php if ($linhas['subcategoria_status'] =='2' ) { ?><span class="btn btn-danger btn-sm">Inativo </span><?php } ?></td>
                          
                          <td> <form  action="inserir_subcategoria" method="post">
															<input name="id" type="hidden" id="id" value="<?php echo $linhas['id_subcategoria'] ?>">	 
															<button class="btn btn-outline-secondary btn-sm edit">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
														
															</form></td>
                          
							
							
							
                        </tr>
						  
					<script>
															
															 $(document).ready(function() {
 
	 $("#formos<?php echo $linha['id_central'] ?>").submit(function(){
		 
		 
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'perfil_central.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#results").empty();
				$("#results").append(msg);
				document.getElementById("dvConteudo").style.display = "none";
				

				
				
				
			}
			
		});
		 
		 return false;
	 });
 
 });
														</script>	  
						  	  
						  
						  
						  <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>   </div>   </div>   </div>   </div>
					
				<div id="results"></div>
					                        
											
									
											
			
	<script>
	
	 $(document).ready(function() {
    $('#departamento').on('change', function() {
	 
		 
	
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'listar_categorias3.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#resultsd").empty();
				$("#resultsd").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });



</script>			
		

														  <!-- Fim lista os aberto  -->
                                                                                           
                                                    </tbody>
                                                </table>
                                            </div>
        
                                 
										 </div>         </div>
        
        </div>
    </div>
</div> <!-- end col -->
</div> <!-- end row -->
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
										 
										 
									
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