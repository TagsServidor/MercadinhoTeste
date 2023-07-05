<?php // listando em um box os instrutores
include "bd/conexao.php";

														
$sqlosp = "SELECT * FROM produtos_unidades pu inner join produtos p on pu.produto_unidade_produto = p.id_produto inner join produtos_departamentos pd on   p.produto_departamento = pd.id_departamentos   where  pu.produto_unidade_unidade = $_POST[unidade]   order by pd.departamento_os_posicao, p.produto_nome  ";
$resultadoosp  = mysqli_query($conn, $sqlosp);


$sqlos = "SELECT * FROM os_reposicao where os_unidade =  $_POST[unidade] and os_reposicao_tipo ='2' and os_status = '1' ";
$resultadoos  = mysqli_query($conn, $sqlos);
$linhaos  = mysqli_fetch_array($resultadoos);
$totalos = mysqli_num_rows($resultadoos );
?>
<!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


<link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
<br>
<?php if ($totalos >= '1' ) { ?> 

<div class="alert alert-danger" role="alert">
                                                Atenção não é permitido abrir outra OS de LISTA para essa central, já existe uma OS aberta, clique aqui para conferir.
                                                </div>

<?php } else { ?>

<script>
	document.addEventListener("keydown", function(e) {

  if(e.keyCode === 13) {
        
    e.preventDefault();
    
  }

});
	</script>
<h4>Lista atual de reposição: </h4>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<form id="formID" method="post" action="salvar_lista_os" > 
  <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0">
                                                <table id="tech-companies-1" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Produto</th>
                                                        <th data-priority="1">Estoque Atual</th>
                                                        <th data-priority="3">Estoque Minimo</th>
                                                       <th data-priority="3">Estoque Máximo</th>
														<th data-priority="3">Valor venda</th>
														<th data-priority="3">QTD Repor</th>
                                                        <th data-priority="3">Repor</th>
														<th data-priority="3">Estoque Central</th>
                                                      </tr>
                                                    </thead>
													
                                                    <tbody>
														
                                                    <tr>
														
<?php // LISTANDO OS EM ABERTO

$x = 0;
while($linhaos  = mysqli_fetch_array($resultadoosp )){
$x++;
	
$repor = $linhaos['produto_unidade_maximo'] - $linhaos['produto_unidade_estoque'] ;

$sqlec = "SELECT * FROM produtos_central where central_produto =  $linhaos[produto_unidade_produto] ";
$resultadoec  = mysqli_query($conn, $sqlec);
$linhaec  = mysqli_fetch_array($resultadoec);
	
$sqlep = "SELECT * FROM entrada_produtos where entrada_produto =  $linhaos[produto_unidade_produto] and entrada_status='2' order by entrada_data desc   ";
$resultadoep  = mysqli_query($conn, $sqlep);
$linhaep  = mysqli_fetch_array($resultadoep);
	
 ?>    
														
														
														
														     <!-- Center Modal example -->
                                                <div class="modal fade bs-example-modal-center<?php echo $linhaos['id_produto_unidades'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">ATENÇÃO!!!!</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div align="center"> <h5><strong>A quantidade a repor para este produto é maior que o estoque da CENTRAL</strong></h5> Para evitar quebra de estoque o sistema realizou o ajuste necessário na quantidade a repor. 
																</div>	
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
  
														
														<!-- /.div remover produto -->
														
														
														
														<div id="removerproduto<?php echo $linhaos['id_produto_unidades'] ?>" style="font-display: none">
															
															
														
		                                                <th>
															
															
																
																<?php echo $x ?> - <?php echo $linhaos['produto_nome'] ?> 
															
														
														
														</th>
														
													
						
														
														
														
                                                        <td> <div class="d-flex flex-wrap gap-3">

                                                    <!-- Center Modal -->
															<div id="results2a<?php echo $linhaos['id_produto_unidades'] ?>"> </div>
															
															
															
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center1<?php echo $linhaos['id_produto_unidades'] ?>">Center Modal</button>

                                                </div>



                                               

                                            </div><?php echo $linhaos['produto_unidade_estoque'] ?> <input name="atual[]" type="hidden" id="atual[]" value="<?php echo $linhaos['produto_unidade_estoque'] ?>"></td>
                                                        <td><?php echo $linhaos['produto_unidade_minimo'] ?></td>
														<td><?php echo $linhaos['produto_unidade_maximo'] ?></td>
														<td><input name="valor[]" type="text" id='auto' required="required" class="money form-control" style="width: 105px" value="<?php echo $linhaep['entrada_venda'] ?>"></td>
														
														 <td>
															 
															 <?php 
	 
	 if ($repor < '0') { ?> 0 <?php } else {
	 echo $repor; } ?> 
															 
															 
															 <?php if($repor > $linhaec['central_produto_estoque']) { ?> 
															 
															 
															 <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center<?php echo $linhaos['id_produto_unidades'] ?>"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: $fff"></i>  Alerta!</button>
															 
<?php } ?></td>
													
															 <td>
																 
																 
																 <?php 
	 
	 if ($repor < '0') { ?> <input name="repor[]" type="number" required="required" class="form-control" style="width: 65px" max="<?php echo $linhaec['central_produto_estoque']?>" id='auto' value="0">
																 <?php } else { ?>
																 
															 <?php if($repor > $linhaec['central_produto_estoque']) { ?>	 <input name="repor[]" type="number" required="required" class="form-control" style="width: 65px" max="<?php echo $linhaec['central_produto_estoque']?>"  value="<?php echo $linhaec['central_produto_estoque']	  ?>">
																

														 <?php } else { ?>
																<input name="repor[]" type="number" required="required" class="form-control" style="width: 65px" max="<?php echo $linhaec['central_produto_estoque']?>" value="<?php echo $repor  ?>"> 
																 <?php }} ?>
														
													  </td>
														<td><?php echo $linhaec['central_produto_estoque'] ?>
													
														
														<input type="hidden" name="unidade" value="<?php echo $_POST['unidade'] ?>">
														<input type="hidden" name="lote[]" value="<?php echo $linhaec['central_produto_lote'] ?>">
														<input type="hidden" name="vencimento[]" value="<?php echo $linhaec['central_produto_validade'] ?>">	
														<input type="hidden" name="custo[]" value="<?php echo $linhaep['entrada_unitario'] ?>">		
															
														<input type="hidden" name="minimo[]" value="<?php echo $linhaos['produto_unidade_minimo'] ?>">	
														<input type="hidden" name="maximo[]" value="<?php echo $linhaos['produto_unidade_maximo'] ?>">		
														<input type="hidden" name="repor2[]" value="<?php echo $repor ?>">		
															
														
														<input type="hidden" name="produtou[]" value="<?php echo $linhaos['id_produto_unidades'] ?>">
														<input type="hidden" name="produto[]" value="<?php echo $linhaos['produto_unidade_produto'] ?>">	 
																 
														<input type="hidden" name="central" value="<?php echo $_GET['central'] ?>">
														<input type="hidden" name="idprodutocentral[]" value="<?php echo $linhaec['id_produto_central'] ?>">	 
															
														 <?php if($repor > $linhaec['central_produto_estoque']) { ?> 
															
															<?php $amenos = $repor - $linhaec['central_produto_estoque'] ?>
															<input type="hidden" name="amenos[]" value="sim">  
															<input type="hidden" name="qtdamenos[]" value="<?php echo $amenos ?>">  
															
															<?php } else {  ?>	
															
															  <input type="hidden" name="amenos[]" value="nao">
															<input type="hidden" name="qtdamenos[]" value="0"> 
															
															<?php } ?>
														</td>	
														
														
													  </div>
														</td>
														
														
	</div>
														
														
														
													
                                                      </tr>
													
														
<?php } ?>
	  
	
	 
														</tbody>
                                                </table>
                                            </div>
         <div align="center">  <input type="SUBMIT" class="btn btn-info" value="GERAR OS"  name="send" id="send"></div>

                </form>                  
										 </div>
<div id="results"> </div>



<?php
	
	$sqlosp = "SELECT * FROM produtos_unidades pu inner join produtos p on pu.produto_unidade_produto = p.id_produto inner join produtos_departamentos pd on   p.produto_departamento = pd.id_departamentos   where  pu.produto_unidade_unidade = $_POST[unidade]   order by pd.departamento_os_posicao, p.produto_nome  ";
$resultadoosp  = mysqli_query($conn, $sqlosp);

	
while($linhaos  = mysqli_fetch_array($resultadoosp )){
	?>

 <!-- Center Modal example -->

                                                <div class="modal fade bs-example-modal-center1<?php echo $linhaos['id_produto_unidades'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                                    <div class="modal-dialog modal-dialog-centered">

                                                        <div class="modal-content">

                                                            <div class="modal-header">

                                                                <h5 class="modal-title">Center modal</h5>

                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                                                                </button>

                                                            </div>

                                                            <div class="modal-body">

                                                               
																<form id="minimo2<?php echo $linhaos['id_produto_unidades'] ?>" action="#" method="post">
																<input type="text" name="minimo">
																	<input type="submit" data-bs-dismiss="modal" aria-label="Close">
																</form>
																
																<script>
																 $(document).ready(function() {
 
	 $("#minimo2<?php echo $linhaos['id_produto_unidades'] ?>").submit(function(){
		 
		 
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'teste2.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#results2a<?php echo $linhaos['id_produto_unidades'] ?>").empty();
				$("#results2a<?php echo $linhaos['id_produto_unidades'] ?>").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });
																
																</script>

                                                            </div>

                                                        </div><!-- /.modal-content -->

                                                    </div><!-- /.modal-dialog -->

                                                </div><!-- /.modal -->


<?php } ?>



<!-- JAVASCRIPT -->
        
<script>

var formID = document.getElementById("formID");
var send = $("#send");

$(formID).submit(function(event){
  if (formID.checkValidity()) {
    send.attr('disabled', 'disabled');
  }
});
</script>



<?php } ?>

<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>	