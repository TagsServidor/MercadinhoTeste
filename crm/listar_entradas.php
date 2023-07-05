<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>


<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<style>



</style>

 <!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Estoque &gt; Centrais &gt; Entradas</h4>

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
                                        <h4 class="card-title">Relação de produtos a baixar</h4>
                                        
										 
										 
										 
										 
										 
										    <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0">
                                                <table id="tech-companies-1" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Produto</th>
                                                        <th data-priority="1">QTD</th>
                                                        <th data-priority="3">Min.</th>
                                                        <th data-priority="3">Max.</th>
                                                        <th data-priority="3">Lote</th>
                                                       
                                                        <th data-priority="3">Ação</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
														
														<?php // LISTANDO OS EM ABERTO
														
$sqlosp = "SELECT * FROM entrada_produtos ep inner join produtos p on ep.entrada_produto = p.id_produto  where ep.entrada_status ='1'  ";
$resultadoosp  = mysqli_query($conn, $sqlosp);
$totalosp  = mysqli_num_rows($resultadoosp);
if ($totalosp == 0) { 
?> <br>
																Sem produtos a baixar
																
																
																<?php 

} else {  ?>
																
																

                                                
														
														
													<?php

while($linhaos  = mysqli_fetch_array($resultadoosp )){
	
 ?>                  
   


   
</div>
													
													
													<script>
			
$( "clique" ).click(function() {
    document.getElementById("escondido").style.display = "block";
});														
														
														
var i = setInterval(function () {
    clearInterval(i);

    
    document.getElementById("loading<?php echo $linhaos['id_entrada'] ?>").style.display = "none";
    document.getElementById("content<?php echo $linhaos['id_entrada'] ?>").style.display = "block";
   
}, 2000);
			

														
</script>		
													
								
														
                                                        <tr>
                                                          <th> <?php echo $linhaos['produto_nome'] ?>  <span class="co-name"> </span></th>
                                                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['id_entrada'] ?>"> <?php echo $linhaos['entrada_qtd'] ?> </a>
															
															
                                               
                                                <!-- Center Modal example -->
                                                <div class="modal fade modaleditar<?php echo $linhaos['id_entrada'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Editar</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																<form action="editar_entrada" method="post"> 
																<div class="row">
																	
																	
																	
																	<div class="col-4">
																		<label><strong> Quantidade</strong></label>
																<input type="text" class="form-control" required name="qtd" value="<?php echo $linhaos['entrada_qtd'] ?>">
																	</div>
																	
																  <div class="col-4">
																	<label><strong> Estoque Minimo.</strong></label>
																<input name="min" type="text" class="form-control" id="min" value="<?php echo $linhaos['entrada_qtd_minima'] ?>">
																	</div>
																	
																  <div class="col-4">
																	<label><strong> Estoque Maximo</strong></label>
																<input name="max" type="text" class="form-control" id="max" value="<?php echo $linhaos['entrada_qtd_maxima'] ?>">
																	</div>
																	
																	</div>
																
																<div class="row">
																  <div class="col-4">
																	<label><strong>Lote</strong></label>
																<input name="lote" type="text" class="form-control" id="lote" value="<?php echo $linhaos['entrada_lote'] ?>">
																	</div>
																	
																  <div class="col-4">
																	<label><strong>Valor Venda</strong></label>
																<input name="valor" type="text" required class="form-control money form-control" id="valor" value="<?php echo $linhaos['entrada_venda'] ?>">
																	</div>
																	
																	
																	<div class="col-12"> <br>
																		
																		<input type="hidden" name="id" value="<?php echo $linhaos['id_entrada'] ?>" >
																	<button class="btn btn-info"> SALVAR </button> <a href="remover_entrada/<?php echo $linhaos['id_entrada'] ?>" link class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar essa entrada?')"> REMOVER ENTRADA </a>
																	</div>
</form>
																</div>
																
																	
																	
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
															
															
															</td>
                                                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['id_entrada'] ?>"><?php echo $linhaos['entrada_qtd_minima'] ?></a></td>
                                                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['id_entrada'] ?>"><?php echo $linhaos['entrada_qtd_maxima'] ?></a></td>
                                                        <td><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['id_entrada'] ?>"><?php echo $linhaos['entrada_lote'] ?></a></td>
                                                        
                                                        <td>
															
															<div id="dvConteudo2<?php echo $linhaos['id_entrada'] ?>">
															
															<form id="formos2<?php echo $linhaos['id_entrada'] ?>"  method="post">
																 
															<button class="btn btn-outline-warning btn-sm edit">
                                                                <i class="fas fa-check"></i>
                                                            </button>
																 
																 
																<input type="hidden" value="<?php echo $linhaos['id_entrada'] ?>" name="id"> 
																 <input type="hidden" value="<?php echo $linhaos['entrada_produto'] ?>" name="produto">
																 <input type="hidden" value="<?php echo $linhaos['entrada_lote'] ?>" name="lote">
																<input type="hidden" value="<?php echo $linhaos['entrada_vencimento'] ?>" name="validade">
																<input type="hidden" value="<?php echo $linhaos['entrada_qtd'] ?>" name="estoque">
																<input type="hidden" value="<?php echo $linhaos['entrada_central'] ?>" name="central">
																<input type="hidden" value="<?php echo $linhaos['entrada_qtd_minima'] ?>" name="minima">
																<input type="hidden" value="<?php echo $linhaos['entrada_qtd_maxima'] ?>" name="maxima">
																 
															</form>
														 </div>
															
															
															<div id="dvConteudo3<?php echo $linhaos['id_entrada'] ?>" class="spinner" style="display: none">
																
																
																<!-- <div id="results2<?php echo $linhaos['id_entrada'] ?>"> </div> -->
																
																	 
															
                                                               <img src="assets/images/checkp.gif" /> 
                                                            
															</div>
														</td>
														
														
														
													
                                                      </tr>
													
														
														
														
				<script>
															
															 $(document).ready(function() {
 
	 $("#formos2<?php echo $linhaos['id_entrada'] ?>").submit(function(){
		 
		 
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'atualizar_os_produtos_central.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#results2<?php echo $linhaos['id_entrada'] ?>").empty();
				$("#results2<?php echo $linhaos['id_entrada'] ?>").append(msg);
				document.getElementById("dvConteudo2<?php echo $linhaos['id_entrada'] ?>").style.display = "none";
				document.getElementById("dvConteudo3<?php echo $linhaos['id_entrada'] ?>").style.display = "block";


				
				
				
			}
			
		});
		 
		 return false;
	 });
 
 });
														</script>											
														
														
														
														<?php }} ?>
														
														  <!-- Fim lista os aberto  -->
                                                                                           
                                                    </tbody>
                                                </table>
                                            </div>
        
                                 
										 </div>
										
										  

                                  </div> </div> </div> </div> <div align="center"></div>
					<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>	