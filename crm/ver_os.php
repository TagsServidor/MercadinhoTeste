<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$sql = "SELECT * FROM unidades where id_unidade = '$id2'  ";
$resultado = mysqli_query($conn, $sql);
$linha=mysqli_fetch_array($resultado);
?>


<style>
/* ============================================================== 
     # Preloader 
=================================================================== */
#preloader {
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:#fff; /* cor do background que vai ocupar o body */
    z-index:999; /* z-index para jogar para frente e sobrepor tudo */
}
#preloader .inner {
    position: absolute;
    top: 50%; /* centralizar a parte interna do preload (onde fica a animação)*/
    left: 50%;
    transform: translate(-50%, -50%);  
}
.bolas > div {
  display: inline-block;
  background-color: #F27620;
  width: 25px;
  height: 25px;
  border-radius: 100%;
  margin: 3px;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  animation-name: animarBola;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
   
}
.bolas > div:nth-child(1) {
    animation-duration:0.75s ;
    animation-delay: 0;
}
.bolas > div:nth-child(2) {
    animation-duration: 0.75s ;
    animation-delay: 0.12s;
}
.bolas > div:nth-child(3) {
    animation-duration: 0.75s  ;
    animation-delay: 0.24s;
}
 
@keyframes animarBola {
  0% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
  }
  16% {
    -webkit-transform: scale(0.1);
    transform: scale(0.1);
    opacity: 0.7;
  }
  33% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1; 
  } 
}

.escoonderform {
font-size: 25px;
color: blueviolet;
border-radius: 10px;
border-width: 0px;
align:center;

}
/* end: Preloader */

</style>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


<div id="preloader">
        <div class="inner">
           <!-- HTML DA ANIMAÇÃO MUITO LOUCA DO SEU PRELOADER! -->
           <div class="bolas">
              <div></div>
              <div></div>
              <div></div>                    
           </div>
        </div>
    </div>

<script>
	//<![CDATA[
$(window).on('load', function () {
    $('#preloader .inner').fadeOut();
    $('#preloader').delay(350).fadeOut('slow'); 
    $('body').delay(350).css({'overflow': 'visible'});
})
//]]>
</script>
<div class="blogapp-content">
						<div class="blogapp-detail-wrap">
							<header class="blog-header">
								<div class="d-flex align-items-center">
									
										<h3>OS <?php echo $id ?> - <?php echo $linha['unidade_nome'] ?> </h3>
									
								</div>

												<div id="todo_collapse_1" class="collapse show">
													<div class="card-body">
														
															
															
															<?php // LISTANDO OS EM ABERTO
														
$sqlosp = "SELECT * FROM os_produtos o2 inner join produtos p on o2.os_produtos_produto = p.id_produto inner join produtos_departamentos pd on   p.produto_departamento = pd.id_departamentos  where o2.os_produtos_os  = '$id' and o2.os_produtos_status ='1' order by pd.departamento_os_posicao , p.produto_nome  ";
												$resultadoosp  = mysqli_query($conn, $sqlosp);
												$totalosp  = mysqli_num_rows($resultadoosp);


												while ($linhaos  = mysqli_fetch_array($resultadoosp)) {

													$sqlospu = "SELECT * FROM produtos_unidades  where produto_unidade_unidade = $linhaos[os_produtos_unidade] and produto_unidade_produto = $linhaos[os_produtos_produto]  ";
													$resultadoospu  = mysqli_query($conn, $sqlospu);
													$produtosu  = mysqli_fetch_array($resultadoospu);

													@$totalaposreposicao = 	$produtosu['produto_unidade_estoque'] + $linhaos['os_produtos_qtd'];
	
	
	?>
														
														<div id="dvConteudo3<?php echo $linhaos['os_produtos_id'] ?>" class="spinner" style="display: none">
														
															<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Ok
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
															
														</div>
															
															<div id="dvConteudo3a<?php echo $linhaos['os_produtos_id'] ?>" class="spinner" style="display: none">
														
															<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Ok ajuste realizado com sucesso
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
															
														</div>
														
														
														
														
															<div id="dvConteudo2<?php echo $linhaos['os_produtos_id'] ?>">
															
															<td>
																<div class="media align-items-center">
																	<div class="media-head me-2">
																		<div class="avatar avatar-xs avatar-rounded">
																			<img src="https://mercadinho.top/produtos/<?php echo $linhaos['produto_foto'] ?>" alt="user" class="avatar-img">
																		</div>
																	</div>
																	<div class="media-body">
																		<div class="text-high-em"><?php echo $linhaos['produto_nome'] ?></div> 
																		<div class="fs-7"><span style="color:#F0A70A" >Atual 
																		  <?php if (@$produtosu['produto_unidade_estoque'] == '') { ?>
																		  0 
																		  <?php } else { ?>
																		  <?php echo $produtosu['produto_unidade_estoque'] ?>
                                                                          <?php } ?></span>
                                                                        <strong style="color:#057F53">Repor: (<?php echo $linhaos['os_produtos_qtd'] ?>)</strong>
																			<span style="color:#2D36D4" > Após reposição <?php echo $totalaposreposicao ?> </span></div> 
																	</div>
																</div>
															</td>
															<td>
																<div class="progress-lb-wrap">
																	<div class="d-flex align-items-center">
																		<div class="progress progress-bar-rounded progress-bar-xs flex-1">
																			<div class="progress-bar bg-orange w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="height: 1px"></div>
																		</div>
																		
																	</div>
																</div>
															</td>
															
															<td>
																
																<div class="row"> 
																<div class="col-3"> 
																	
																	
																	<form id="formos2<?php echo $linhaos['os_produtos_id'] ?>" action="#" method="post">
																	<input type='submit' value='Tudo Ok'  class="btn btn-soft-success btn-sm my-1  me-2"/>


																
																	<input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="id">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_os'] ?>" name="os">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_produto'] ?>" name="produto">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="idosproduto">
																<input name="unidade" type="hidden" id="unidade" value="<?php echo $linhaos['os_produtos_unidade'] ?>">	
																</form>
																</div>	
																	
																	
																	
																	<div class="col-6"> 
																		
																		<a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['os_produtos_id'] ?>">
																	<input type="submit" class="btn btn-soft-danger btn-sm my-1  me-2" value="Ajuste">
																		</a>
																		
																</div>	
																</div>	
																
																
																
																
																
																
															</td>
															<td>
																
															</td>
															<hr>
														</div>
														
														
											<script>
												$(document).ready(function() {
													$("#formos2<?php echo $linhaos['os_produtos_id'] ?>").submit(function() {
														var dados = jQuery(this).serialize();
														$.ajax({
															url: 'atualizar_os_produtos.php',
															cache: false,
															data: dados,
															type: "POST",

															success: function(msg) {

																$("#results<?php echo $linhaos['os_produtos_id'] ?>").empty();
																$("#results<?php echo $linhaos['os_produtos_id'] ?>").append(msg);
																document.getElementById("dvConteudo2<?php echo $linhaos['os_produtos_id'] ?>").style.display = "none";
																document.getElementById("dvConteudo3<?php echo $linhaos['os_produtos_id'] ?>").style.display = "block";
															}

														});

														return false;
													});

												});
											</script>
															
															
												<script>
												$(document).ready(function() {
													$("#alerta_reposicao<?php echo $linhaos['os_produtos_id'] ?>").submit(function() {
														var dados = jQuery(this).serialize();
														$.ajax({
															url: 'inserir_alerta_reposicao.php',
															cache: false,
															data: dados,
															type: "POST",

															success: function(msg) {

																$("#results2a<?php echo $linhaos['os_produtos_id'] ?>").empty();
																$("#results2a<?php echo $linhaos['os_produtos_id'] ?>").append(msg);
																document.getElementById("dvConteudo2<?php echo $linhaos['os_produtos_id'] ?>").style.display = "none";
																document.getElementById("dvConteudo3a<?php echo $linhaos['os_produtos_id'] ?>").style.display = "block";
															}

														});

														return false;
													});

												});
											</script>			
															
															

													  <!-- Center Modal example -->
											<div class="modal fade modaleditar<?php echo $linhaos['os_produtos_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">






												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">Ajuste reposição</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
															</button>
														</div>
														<div class="modal-body">
															<form action="#" id="alerta_reposicao<?php echo $linhaos['os_produtos_id'] ?>">
																<input type="hidden" name="deveria" value="<?php echo $produtosu['produto_unidade_estoque'] ?>">
																<input type="hidden" name="idos" value="<?php echo $id ?>">
																<input type="hidden" name="unidade" value="<?php echo $produtosu['produto_unidade_unidade']  ?>">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="id">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_os'] ?>" name="os">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_produto'] ?>" name="produto">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="idosproduto">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_unidade'] ?>" name="unidade">

<input id="txt1<?php echo $linhaos['os_produtos_id'] ?>" type="hidden" value="<?php echo $produtosu['produto_unidade_estoque'] ?>" onfocus="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>

<div class="row"> 

<div class="col-6"> 
<label>Você repos? </label> <input name="reposta" id="txt2<?php echo $linhaos['os_produtos_id'] ?>" type="number" value="0" class="form-control"  required  onblur="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>
</div>

<div class="col-6"> 
<label>Encontrou a mais? </label> <input name="amais" id="txt6<?php echo $linhaos['os_produtos_id'] ?>" type="number" value="0"  class="form-control" required  onblur="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>
</div>

<div class="col-6"> 
<label>Vencidas? </label> <input name="vencidos" id="txt3<?php echo $linhaos['os_produtos_id'] ?>" type="number" value="0" class="form-control"  required  onblur="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>
</div>

<div class="col-6"> 
<label>Qtd extraviadas? </label>  <input name="extraviados" id="txt4<?php echo $linhaos['os_produtos_id'] ?>" type="number" value="0" class="form-control"  required  onblur="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>
</div>

<div class="col-6"> 
<label>Qtd perdidas? </label>  <input name="perdidos" id="txt5<?php echo $linhaos['os_produtos_id'] ?>" type="number" value="0" class="form-control"  required  onblur="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>
</div>

<div class="col-6"> 
<label>Vieram faltando? </label>  <input name="faltando" id="txt7<?php echo $linhaos['os_produtos_id'] ?>" type="number" value="0" class="form-control"  required  onblur="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>
</div>

<div class="col-6"> 
<label>Não coloquei (devolução)”</label>  <input name="paramais" id="txt8<?php echo $linhaos['os_produtos_id'] ?>" type="number" value="0" class="form-control"  required  onblur="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>
</div>

<div class="col-6"> 
<label>Perda no caminho? </label>  <input name="perdacaminho" id="txt9<?php echo $linhaos['os_produtos_id'] ?>" type="number" value="0" class="form-control"  required  onblur="calcular<?php echo $linhaos['os_produtos_id'] ?>()"/>
</div>

</div>

<div class="col-12">
																		<label>Observações</label>
																		<input type="text" name="observacoes" value="" class="form-control">

																	</div>


<hr>
<DIV align="center"> RESUMO </DIV>
<div class="row">
<div align="center" class="col-4">
<label>Atual: </label> <br>  

<span style="text-align: center" class="escoonderform"> 
<?php if (@$produtosu['produto_unidade_estoque'] == '') { ?>
0 
<?php } else { ?>
<?php echo $produtosu['produto_unidade_estoque'] ?>
<?php } ?>
</span>


</div>

<div align="center" class="col-4">
<label>Repor: </label> <br>  <span style="text-align: center" class="escoonderform"> <?php echo $linhaos['os_produtos_qtd'] ?> </span>
</div>

<div align="center" class="col-4">
<label>Ajustado: </label>  <input id="result<?php echo $linhaos['os_produtos_id'] ?>" style="text-align: center; width:55px" type="number" class="escoonderform"  required/>
<input name="cestoque" id="result2<?php echo $linhaos['os_produtos_id'] ?>" type="hidden" class="form-control"  required/>
</div>

</div>

    <script type="text/javascript">
        function calcular<?php echo $linhaos['os_produtos_id'] ?>(){
    var valor1<?php echo $linhaos['os_produtos_id'] ?> = parseInt(document.getElementById('txt1<?php echo $linhaos['os_produtos_id'] ?>').value, 10);
    var valor2<?php echo $linhaos['os_produtos_id'] ?> = parseInt(document.getElementById('txt2<?php echo $linhaos['os_produtos_id'] ?>').value, 10);
    var valor3<?php echo $linhaos['os_produtos_id'] ?> = parseInt(document.getElementById('txt3<?php echo $linhaos['os_produtos_id'] ?>').value, 10);
    var valor4<?php echo $linhaos['os_produtos_id'] ?> = parseInt(document.getElementById('txt4<?php echo $linhaos['os_produtos_id'] ?>').value, 10);
    var valor5<?php echo $linhaos['os_produtos_id'] ?> = parseInt(document.getElementById('txt5<?php echo $linhaos['os_produtos_id'] ?>').value, 10);
    var valor6<?php echo $linhaos['os_produtos_id'] ?> = parseInt(document.getElementById('txt6<?php echo $linhaos['os_produtos_id'] ?>').value, 10);

    document.getElementById('result<?php echo $linhaos['os_produtos_id'] ?>').readOnly = true;
    document.getElementById('result<?php echo $linhaos['os_produtos_id'] ?>').value = valor1<?php echo $linhaos['os_produtos_id'] ?> + valor2<?php echo $linhaos['os_produtos_id'] ?> + valor6<?php echo $linhaos['os_produtos_id'] ?> - valor3<?php echo $linhaos['os_produtos_id'] ?>  - valor4<?php echo $linhaos['os_produtos_id'] ?>  - valor5<?php echo $linhaos['os_produtos_id'] ?>;
    document.getElementById('result2<?php echo $linhaos['os_produtos_id'] ?>').value = valor1<?php echo $linhaos['os_produtos_id'] ?> + valor2<?php echo $linhaos['os_produtos_id'] ?> + valor6<?php echo $linhaos['os_produtos_id'] ?> - valor3<?php echo $linhaos['os_produtos_id'] ?>  - valor4<?php echo $linhaos['os_produtos_id'] ?>  - valor5<?php echo $linhaos['os_produtos_id'] ?>;

}


    </script>








																<div class="row">


																	

																	

																	

																	<div class="col-12"> <br>

																		<input type="hidden" name="id" value="<?php echo $linhaos['os_produtos_id'] ?>">


																		<button type="submit" class="btn btn-info" data-bs-dismiss="modal"> SALVAR </button>
																	</div>
															</form>
														</div>



													</div>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
														
															<?php } ?>
															
														
															
									</div>
								</div>
							</div>
						</div>
						<!-- /Edit Info -->
					</div>
				</div>
			</div>
			<!-- /Page Body -->
		</div>
		<!-- /Main Content -->
	</div>
   