<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$sql = "SELECT * FROM unidades where id_unidade = '$id'  ";
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
									
										<h3>Unidade - <?php echo $linha['unidade_nome'] ?></h3>
									
								</div>

												<div id="todo_collapse_1" class="collapse show">
													<div class="card-body">
														
															
															
															<?php // LISTANDO OS EM ABERTO
														
$sqlosp = "SELECT * FROM produtos_unidades pu inner join produtos p on pu.produto_unidade_produto = p.id_produto  where pu.produto_unidade_unidade  = '$id'  order by p.produto_departamento desc ";
												$resultadoosp  = mysqli_query($conn, $sqlosp);
												$totalosp  = mysqli_num_rows($resultadoosp);


												while ($linhaos  = mysqli_fetch_array($resultadoosp)) {
													
	
	?>
														
														
															
															
															<td>
																<div class="media align-items-center">
																	<div class="media-head me-2">
																		<div class="avatar avatar-xs avatar-rounded">
																			<img src="https://mercadinho.top/produtos/<?php echo $linhaos['produto_foto'] ?>" alt="user" class="avatar-img">
																		</div>
																	</div>
																	<div class="media-body">
																		<div class="text-high-em"><?php echo $linhaos['produto_nome'] ?></div> 
																		<div class="fs-7"></div> 
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
																
																
																<div id="dvConteudo3<?php echo $linhaos['id_produto_unidades'] ?>" class="spinner" style="display: none">
														
															<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong> Ok registrado
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
															
														</div>
																
																
																
																<div id="dvConteudo2<?php echo $linhaos['id_produto_unidades'] ?>">
                                                                <form id="formos2<?php echo $linhaos['id_produto_unidades'] ?>" action="#" method="post">

																<div class="row"> 
																<div class="col-12"> 
																   <label> Ação </label>
																   <select name="acao" required class="form-control" >
																   <option value="">Informe</option>

  <option value="R">Retirada</option>
  <option value="A" >Acrescimo</option>
</select>
																	
                                                                   
                                                                    <label>Quantidade </label>
																		
<input type="number" class="form-control" required value="" name="retirada" min="1">
																
</div>	
																	
<div class="col-12"> 
																	
																	
                                                                    <label>Observações </label>
																		
<input type="text" class="form-control" value="" required name="observacoes">
																
</div>																	
																	
																	<div class="col-6"> 
<input type="submit" class="btn btn-soft-success btn-sm my-1  me-2" value="Salvar">
<input type="hidden" value="<?php echo $linhaos['id_produto'] ?>" name="produto">
<input type="hidden" value="<?php echo $linhaos['id_produto_unidades'] ?>" name="id">
<input type="hidden" value="<?php echo $linhaos['produto_unidade_unidade'] ?>" name="unidade">
<input type="hidden" value="<?php echo $linhaos['produto_unidade_estoque'] ?>" name="deveria">



																			</div>	
																	
																		</div>	
																	</form>
																</div>	
																
																
																
																
																
																
															</td>
															<td>
																
															</td>
															<hr>
														
														
														
											<script>
												$(document).ready(function() {
													$("#formos2<?php echo $linhaos['id_produto_unidades'] ?>").submit(function() {
														var dados = jQuery(this).serialize();
														$.ajax({
															url: 'atualizar_estoque_retirada.php',
															cache: false,
															data: dados,
															type: "POST",

															success: function(msg) {

																$("#results2<?php echo $linhaos['id_produto_unidades'] ?>").empty();
																$("#results2<?php echo $linhaos['id_produto_unidades'] ?>").append(msg);
																document.getElementById("dvConteudo2<?php echo $linhaos['id_produto_unidades'] ?>").style.display = "none";
																document.getElementById("dvConteudo3<?php echo $linhaos['id_produto_unidades'] ?>").style.display = "block";





															}

														});

														return false;
													});

												});
											</script>

													
														
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
   