<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO OS PRODUTOS

$sql = "SELECT * FROM apagar a LEFT JOIN centrais c on a.central_apagar = c.id_central LEFT JOIN fornecedores f on a.fornecedor_apagar = f.id_fornecedor 

LEFT JOIN condominios co on a.condominio_apagar = co.id_condominio 
LEFT JOIN unidades un on a.unidade_apagar = un.id_unidade


where a.status_apagar = '2'";
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

				


					<div id="dvConteudo" >

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Financeiro &gt; Contas Pagas</h4> 

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
                    <h4 class="card-title">Temos um total de (<?php echo $total ?>) contas pagas registradas </h4><br>
                    
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                        <tr>
                          <th>Vencimento</th>
							 <th>Pagamento</th>
                          <th>Incidencia</th>
							 <th>Parcela</th>
                          <th>Referente</th>
                          <th>Valor</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
							
							
							<?php // LISTANDO OS EM ABERTO
														
while($linha = mysqli_fetch_array($resultado)){

	
	?>
							
							
	<!-- MODAL INFORMAR PAGAMENTO -->
                                                    <div class="modal fade" id="exampleModal<?php echo $linha['id_apagar'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Informar Pagamento</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="informar_pagamento_conta" method="post">
                                                                        <div class="mb-3">
                                                                            <label for="recipient-name" class="col-form-label">Informe a data do pagamento:</label>
                                                                            <input type="date" class="form-control" id="data" name="data" required>
                                                                        </div>
                                                                        <input type="hidden" value="<?php echo $linha['id_apagar'] ?>" name="id">
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                                    <button type="submit" class="btn btn-primary">Salvar</button></form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 						
							
							
							
							
                          <td><?php echo date('d/m/Y', strtotime($linha['vencimento_apagar'])); ?> </td>
					   <td><?php echo date('d/m/Y', strtotime($linha['datapagamento_apagar'])); ?> </td>
                          <td>
							 <?php if($linha['central_nome'] =='') {} else { ?> <strong>Central:</strong> <?php echo $linha['central_nome'] ?> <br> <?php } ?> 
							 <?php if($linha['fornecedor_nome'] =='') {} else { ?>  <strong>Fornecedor:</strong> <?php echo $linha['fornecedor_nome'] ?> <br> <?php } ?> 
							  <?php if($linha['unidade_nome'] =='') {} else { ?>  <strong>Unidade:</strong> <?php echo $linha['unidade_nome'] ?> <br> <?php } ?>  
							<?php if($linha['condominio_nome'] =='') {} else { ?>  <strong>Condominio:</strong> <?php echo $linha['condominio_nome'] ?> <br> <?php } ?> 
							
						  </td>
							<td> <?php echo $linha['parcela_apagar'] ?>/<?php echo $linha['parcelas_apagar'] ?></td>
						  <td> <?php echo $linha['referente_apagar'] ?></td>
							<td> R$ <?php echo $linha['valor_apagar'] ?></td>
							
                         
                          
							
							
							
                        </tr>
						  
					<script>
															
															 $(document).ready(function() {
 
	 $("#formos<?php echo $linha['id_produto'] ?>").submit(function(){
		 
		 
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'perfil_produto.php',
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
					
					
			   <!-- JAVASCRIPT -->
       

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