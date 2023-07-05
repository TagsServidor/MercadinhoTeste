<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO OS PRODUTOS

$sql = "SELECT * FROM p_apagar p INNER JOIN terminais t ON p.id_terminal = t.id_maquina INNER JOIN unidades u on t.id_unidade = u.id_unidade   where p.tentou_pagar ='0' ";
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
                                    <h4 class="mb-0">Logs e Erros &gt; Vendas em aberto</h4>

                                    

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
                    <h4 class="card-title">Temos um total de (<?php echo $total ?>) vendas em aberto </h4><br>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>Unidade</th>
                          <th>Terminal id</th>
                          <th>Maquina ID</th>
                         
                          
                          <th>Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
							
							
							<?php // LISTANDO OS EM ABERTO
														
while($linha = mysqli_fetch_array($resultado)){

	
	?>
                          <td><?php echo $linha['unidade_nome'] ?> </td>
                          <td><?php echo $linha['id_terminal'] ?></td>
                          <td><?php echo $linha['id_maquina'] ?></td>
                          
                          <td> 
															<input name="id" type="hidden" id="id" value="<?php echo $linha['id_apagar'] ?>">	
							  
							  <a href="liberar_terminal/<?php echo $linha['id_apagar'] ?>" onclick="return confirm('Deseja mesmo liberar esse Terminal?');">

															<button class="btn btn-outline-danger btn-sm edit">
                                                               <i class="fa fa-trash" aria-hidden="true"></i>

                                                            </button></a>
														
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