<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
?>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


 <!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>

  <!-- Responsive Table css -->
        <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />


<div id="results"></div>
					
					<div id="dvConteudo" >

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Fornecedores &gt; Listar</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
               
					
                <div class="container-fluid">
					<div class="row">
                            <div class="col-12">
                                <div class="card">
					                 <div class="card-body">
                                      
                                        
										 
										 
										 
										 
										 
										    <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th data-priority="1">Endereço</th>
                                                        <th data-priority="3">Telefone</th>
                                                        <th data-priority="3">Celular</th>
                                                        <th data-priority="3">Email</th>                                                                                                                
                                                        <th data-priority="3">Status</th>
                                                        <th data-priority="3">Ação</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
														
														<?php // LISTANDO OS EM ABERTO
														
$sqlos = "SELECT * FROM fornecedores   ";
$resultadoos = mysqli_query($conn, $sqlos);
$totalos = mysqli_num_rows($resultadoos);	
while($linhaos = mysqli_fetch_array($resultadoos)){
	
	
	?>
														
														
                                                        <th><?php echo $linhaos['fornecedor_nome'] ?> <span class="co-name"> </span></th>
                                                        <td><?php echo $linhaos['fornecedor_rua'] ?> <?php echo $linhaos['fornecedor_numero'] ?>, <?php echo $linhaos['fornecedor_bairro'] ?>, <?php echo $linhaos['fornecedor_cidade'] ?>-<?php echo $linhaos['fornecedor_uf'] ?>  </td>
                                                        <td><?php echo $linhaos['fornecedor_telefone'] ?></td>
                                                        <td><?php echo $linhaos['fornecedor_celular'] ?></td>
                                                        <td><?php echo $linhaos['fornecedor_email'] ?></td>
                                                        <td align="center"><?php  if($linhaos['fornecedor_status'] == '1') { ?>  <span class="btn btn-success btn-sm"> Ativo</span><?php }   ?><?php  if($linhaos['fornecedor_status'] == '2') { ?> <span class="btn btn-danger btn-sm"> Inativo</span><?php }   ?> </td>
                                                        

                                                        
                                                        <td>
															
															
															
															 <form id="formos<?php echo $linhaos['id_fornecedor'] ?>" action="#" method="post">
															<input type="hidden" value="<?php echo $linhaos['id_fornecedor'] ?>" name="id">	 
															<button class="btn btn-outline-secondary btn-sm edit">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
														
															</form>
														
														</td>
														
														
														
														
														
														
													
                                                      </tr>
														 
														
														
														
			<script>
															
															 $(document).ready(function() {
 
	 $("#formos<?php echo $linhaos['id_fornecedor'] ?>").submit(function(){
		 
		 
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'editar_fornecedores.php',
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
														
														  <!-- Fim lista os aberto  -->
                                                                                           
                                                    </tbody>
                                                </table>
                                            </div>
        
                                 
										 </div>
										 
										 
									

                                  </div> </div> </div> </div>
        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
        <script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script>