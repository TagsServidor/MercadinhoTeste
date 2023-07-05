<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

$sql = "SELECT * FROM os_reposicao where os_unidade = '$_GET[unidade]' and os_status ='1'  ";
$resultado = mysqli_query($conn, $sql);
$totalos = mysqli_num_rows($resultado);	

if ($totalos =='0'){

 @$conn->query($insert = "INSERT INTO os_reposicao (os_unidade) VALUES ('$_GET[unidade]')");
}

$sqlos = "SELECT * FROM os_reposicao where os_unidade = '$_GET[unidade]' and os_status ='1'  ";
$resultadoos = mysqli_query($conn, $sqlos);
$linhaos = mysqli_fetch_array($resultadoos);
$totalos = mysqli_num_rows($resultadoos);	

?>




 <!-- Select com Busca-->
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_addreposicao.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

</div>


        
<br>
  <div class="">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="uil uil-user-circle me-2"></i>
                                              Atenção!! Todos produtos serão lançados na OS em aberto (#<?php echo $linhaos['id_os_reposicao'] ?>)
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                
                                                </button>
                                            </div>
	  


<?php 

$sqle = "SELECT * FROM produtos_central where central_produto ='$_POST[produto]' and central_produto_estoque <> '0'  ";
$resultadoe = mysqli_query($conn, $sqle);
$totalentrada = mysqli_num_rows($resultadoe);
while ($linhae=mysqli_fetch_array($resultadoe)) {

$sql = "SELECT * FROM produtos where id_produto ='$_POST[produto]'  ";
$resultado = mysqli_query($conn, $sql);
$linha=mysqli_fetch_array($resultado);

$sqld = "SELECT * FROM produtos_departamentos where id_departamentos ='$linha[produto_departamento]'  ";
$resultadod = mysqli_query($conn, $sqld);
$linhad=mysqli_fetch_array($resultadod);

$sqlc = "SELECT * FROM produtos_categorias where id_categoria ='$linha[produto_categoria]'  ";
$resultadoc = mysqli_query($conn, $sqlc);
$totalcategoria = mysqli_num_rows($resultadoc);
$linhac=mysqli_fetch_array($resultadoc);

$sqls = "SELECT * FROM produtos_subcategorias where id_subcategoria ='$linha[produto_subcategoria]'  ";
$resultados = mysqli_query($conn, $sqls);
$totalsubcategoria = mysqli_num_rows($resultados);
$linhas=mysqli_fetch_array($resultados);
	

$sqlsc = "SELECT * FROM entrada_produtos where id_entrada ='$linhae[produtos_central_entrada]'  ";
$resultadosc = mysqli_query($conn, $sqlsc);
$linhasc=mysqli_fetch_array($resultadosc);	
	
?>


                            <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-xl-2">
                                                <div class="product-detail">
                                                    <div class="row">
                                                        

                                                        <div class="col-12">
                                                            <div class="tab-content position-relative" id="v-pills-tabContent">

                                                                <div class="product-wishlist">
                                                                   
                                                                </div>
                                                                <div class="tab-pane fade show active" id="product-1" role="tabpanel">
                                                                    <div class="product-img">
                                                                        <img src="../produtos/<?php echo $linha['produto_foto'] ?>" alt="" width="100px" class="img-fluid mx-auto d-block" data-zoom="../produtos/<?php echo $linha['produto_foto'] ?>">
                                                                    </div>
                                                                </div>  </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
											
											
                                            <div class="col-10">
                                                <div class="mt-4 mt-xl-3 ps-xl-4">
                                                    
													   
													   
                                                    </div>
  
                                                 

                                                   

                                                    <div>
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="mt-3">
                                                                    
                                                                 
																	<h5 class="font-size-14"><a href="#" class="text-muted">Código de barras: <?php echo $linha['produto_codigobarras'] ?></a></h5>
                                                    <h4 class="font-size-20 mb-3"><?php echo $linha['produto_nome'] ?></h4>

                                                   <div class="text-muted">
                                                        <span class="badge bg-success font-size-14 me-1"><?php echo $linhad['departamentos_nome'] ?></span> 
													   
													   <?php if ($totalcategoria =='0') {} else { ?>
													   <span class="badge bg-info font-size-14 me-1"><?php echo $linhac['categoria_nome'] ?></span> 
													   <?php } ?>
													   
													   <?php if ($totalsubcategoria =='0') {} else { ?>
													   <span class="badge bg-warning font-size-14 me-1"><?php echo $linhas['subcategoria_nome'] ?></span> 
													   <?php } ?>
																 </div>	
																	
																	
                                                                      
                                                                </div>
                                                            </div>
															
															  <div class="col-md-5">
                                                                <div class="mt-3">
																	
                                                                <i class="fa fa-tag" aria-hidden="true"></i> Lote: <?php echo $linhae['central_produto_lote'] ?><br>
																	<i class="fa fa-clock" aria-hidden="true"></i> Vencimento: <?php echo date('d/m/Y', strtotime($linhae['central_produto_validade'])); ?>  <br>
																	
																	
																	<i class="fa fa-th" aria-hidden="true"></i> Estoque Central: <?php echo $linhae['central_produto_estoque'] ?> <br>
																	
																	
																	
																	
                                                                      
                                                                </div>
                                                            </div>
															
															
															  <div class="col-md-2">
                                                                <div class="mt-3">
                                                                    
																	<div id="dvConteudo<?php echo $linhae['id_produto_central'] ?>"> 
                                                                       <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center<?php echo $linhae['id_produto_central'] ?>">Distribuir Lote</button>
																	</div>
																	
																	<div id="dvConteudo2<?php echo $linhae['id_produto_central'] ?>" style="display:none">
																		
																		
																		
																		
														            <img src="assets/images/ok.gif" width="60" height="60" alt=""/> </div>
																	
																	
																	
												<!-- Center Modal example -->
                                                <div class="modal fade bs-example-modal-center<?php echo $linhae['id_produto_central'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
													
													
													
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Adicionar Lote a OS de distribuição</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
																
								
																<form id="formenviarentrada<?php echo $linhae['id_produto_central'] ?>" action="" method="post"> 
																	
																	<div class="row"> 
																		
																		<div id="dvConteudo3<?php echo $linhae['id_produto_central'] ?>">      
																		
																			
																	<div class="col-md-12">
																		<div class="mb-1">
																			<label>Quantidade:</label>
                                                    <input type="number" class="form-control" placeholder="Quantidade a enviar"  max="<?php echo $linhae['central_produto_estoque'] ?>" min="0" required name="qtd">

                                                    </div> </div>
																			
																			<div class="col-md-12">
																		<div class="mb-1">
																			<label>Quantidade Mínina no Estoque:</label>
                                                    <input type="number" class="form-control" placeholder="Quantidade mínima manter no estoque"  required name="minima">

                                                    </div> </div>
                                            
																			
																					<div class="col-md-12">
																		<div class="mb-1">
																			<label>Quantidade Maxima no Estoque:</label>
                                                    <input type="number" class="form-control" placeholder="Quantidade maxima a ter no estoque"  required name="maxima">
																			
                                                    <input type="hidden" name="custo" class="form-control" value=<?php echo $linhasc['entrada_unitario'] ?>  >
																			

                                                    </div> </div>
																	
															<div class="col-md-12">
																<div class="mb-1">
																	<label>Valor de venda:  </label>
                                                    <input type="text" class="form-control money" name="valor" placeholder="Valor de venda" required value="<?php echo $linhasc['entrada_venda'] ?>" >
																	
													<input type="hidden" name="produto" class="form-control" placeholder="Produto" required value="<?php echo $linhae['central_produto'] ?>" >
	                                                <input type="hidden" name="lote" class="form-control" placeholder="Lote" required value="<?php echo $linhae['central_produto_lote'] ?>" >
													 <input type="hidden" name="vencimento" class="form-control" placeholder="Lote" required value="<?php echo $linhae['central_produto_validade'] ?>" >				
													
													 <input type="hidden" name="unidade" class="form-control" placeholder="unidade" required value="<?php echo $_GET['unidade'] ?>" >
													 <input type="hidden" name="os" class="form-control" placeholder="os" required value="<?php echo $linhaos['id_os_reposicao'] ?>" >				
													<input type="hidden" name="id_entrada" class="form-control" placeholder="os" required value="<?php echo $linhae['id_produto_central'] ?>" >				
	
																	
																	
                                                </div>	 </div>		
																	
																	
																                                              
																		<br>
																			
																<div align="right"><button type="submit" class="btn btn-success" data-dismiss="modal"  ><i class="glyphicon glyphicon-ok"></i> Salvar</button> </div>

																	</div>
																	
																		
																	
																	
																	</div>
																				
																			
                                                            
																
							
																
																
																
																
																<script>
																	
																	
																	
	$(":submit").on("click", function(){
    $("#redModal").modal('hide');
});

// as linhas abaixo são apenas para não submeter o form. Não copie

$("form").submit(function(e){
   e.preventDefault();
});															
																	
	
	 $(document).ready(function() {
    $('#departamento2').on('change', function() {
	 
		 
	
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'listar_categorias.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#resultsd22").empty();
				$("#resultsd22").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });



</script>	
																
			</form>			<div id="resultsdi<?php echo $linhae['id_produto_central'] ?>"></div>	
																
																
																
																
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
                                            <!-- end col -->
                                                                      
                                                                </div>
                                                            </div>


                                                        </div>

                                                       
                                                  

                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  




<script>
	 $(document).ready(function() {
 
	 $("#formenviarentrada<?php echo $linhae['id_produto_central'] ?>").submit(function(){
		
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'salvar_reposicao',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
                

				$("#resultsdi<?php echo $linhae['id_produto_central'] ?>").empty();
				$("#resultsdi<?php echo $linhae['id_produto_central'] ?>").append(msg);
               

				document.getElementById("dvConteudo<?php echo $linhae['id_produto_central'] ?>").style.display = "none";
				document.getElementById("dvConteudo2<?php echo $linhae['id_produto_central'] ?>").style.display = "block";
                document.getElementById("dvConteudo3<?php echo $linhae['id_produto_central'] ?>").style.display = "none";



				
				
				
			}
			
		});
		 
		 return false;
	 });
 
 });

</script>



<?php } ?>
       
 
  <!-- Varying Modal Content js -->
        <script src="assets/js/pages/modal.init.js"></script>
<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>					
