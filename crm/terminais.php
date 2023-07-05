<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO OS TERMINAIS

$sql = "SELECT * FROM terminais t INNER JOIN unidades u ON t.id_unidade = u.id_unidade where u.unidade_status = '1' and u.unidade_lixeira ='1' ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	

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
dsdsd
                <div class="page-content">
                    <div class="container-fluid">

                    

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                            


                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Terminais &gt; Listar</h4>

                                    <?php if ($id <>'') { ?>
                             
                             <div class="col-sm-6">
                                 <div class="alert alert-success alert-dismissible fade show mt-4 px-4 mb-0 text-center" role="alert">
                                     <i class="uil uil-check-circle d-block display-4 mt-2 mb-3 text-success"></i>
                                     <h5 class="text-success">ANOTE O TERMINAL ID</h5>
                                     <p style="font-size: 64px"><?php echo $id ?></p>
                                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        
                                     </button>
                                 </div></div>
                            
                   <?PHP } ?>

                                    <div class="page-title-right">
										<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"> <i class="fa fa-plus" aria-hidden="true"></i>
 Cadastrar Terminal</button
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
										
										<!-- Center Modal example -->
                                                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Cadastrar Novo Terminal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                               
																
																<form id="cadterminal" method="post" action="inserir_terminal">
																  <span class="mb-3">
																  <?php // listando em um box os instrutores

			  echo "<SELECT NAME='unidade' SIZE='1' class='form-control' required id='departamento'>

<OPTION VALUE='' SELECTED> Informe o unidade de instalação ";
$sqlu = "SELECT * FROM unidades where unidade_status ='1'  ORDER BY unidade_nome";
$resultadou = mysqli_query($conn, $sqlu);
while ($linhau=mysqli_fetch_array($resultadou)) {
echo "<OPTION VALUE='".$linhau['id_unidade']."'>".($linhau['unidade_nome']);
}
echo "</SELECT>";

?>
																  </span><br>
																	
																<input class="form-control" name="maquina" required placeholder="Informe o id da maquina"><br>
																
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
                    <h4 class="card-title">Temos um total de (<?php echo $total ?>) terminais cadastrados </h4><br>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>Unidade</th>
                          <th>Terminal id</th>
                          <th>Maquina ID</th>
                         <th>Anydesk ID</th>
                          
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
							
							
							<?php // LISTANDO OS EM ABERTO
														
while($linha = mysqli_fetch_array($resultado)){

	
	?>
							
							
							
	<!-- Center Modal example -->
                                                <div class="modal fade modaleditar<?php echo $linha['id_terminal'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Editar</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																<form action="editar_terminal" method="post"> 
																<div class="row">
																	
																	
																	
																	<div class="col-6">
																		<label><strong> ID Maquina</strong></label>
																<input type="text" class="form-control" required name="maquina" value="<?php echo $linha['t_maquina'] ?>">
																	</div>
																	
																  <div class="col-6">
																	<label><strong> ID Anydesk</strong></label>
																<input name="anydesk" type="text" class="form-control" id="min" value="<?php echo $linha['id_anydesk'] ?>">
																	</div>
																	
																
																
																	
																	<div class="col-12"> <br>
																	

																		<input type="hidden" name="id" value="<?php echo $linha['id_terminal'] ?>" >
																	<button class="btn btn-info"> SALVAR </button> 
																	</div>
</form>
																</div>
																
																	
																	
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->								
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
                          <td><?php echo $linha['unidade_nome'] ?> </td>
                          <td><?php echo $linha['id_terminal'] ?></td>
                          <td><?php echo $linha['t_maquina'] ?></td>
							   <td><?php echo $linha['id_anydesk'] ?></td>
                          
                          <td> 
															<input name="id" type="hidden" id="id" value="<?php echo $linha['id_terminal'] ?>">	
							  
							  <a href="deletar_terminal/<?php echo $linha['id_terminal'] ?>" onclick="return confirm('Deseja mesmo deletar esse Terminal?');">

															<button class="btn btn-outline-danger btn-sm edit">
                                                               <i class="fa fa-trash" aria-hidden="true"></i>

                                                            </button></a>
														
							  
							  <a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linha['id_terminal'] ?>"><button class="btn btn-outline-warning btn-sm edit">
                                                               <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </button></a>
							  
<?php if ($linha['id_anydesk'] =='') {} else { ?>
							    <a href="anydesk:<?php echo $linha['id_anydesk'] ?>" ><button class="btn btn-outline-success btn-sm edit">
                                                               <i class="fa fa-desktop" aria-hidden="true"></i>
                                                            </button></a>
							  
							  <?php  } ?>
														</td>
                          
							
							
							
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