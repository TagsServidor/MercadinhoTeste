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
									
										<h3>OS <?php echo $id ?> - <?php echo $linha['unidade_nome'] ?></h3>
									
								</div>

												<div id="todo_collapse_1" class="collapse show">
													<div class="card-body">
														
															
															
															<?php // LISTANDO OS EM ABERTO
														
$sqlosp = "SELECT * FROM os_produtos o2 inner join produtos p on o2.os_produtos_produto = p.id_produto inner join produtos_departamentos pd on   p.produto_departamento = pd.id_departamentos where o2.os_produtos_os  = '$id' and o2.os_produtos_status ='2' order by pd.departamento_os_posicao , o2.os_produtos_qtd  ";
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
																		<div class="fs-7"><strong style="color:#057F53">Repor: (<?php echo $linhaos['os_produtos_qtd'] ?>)</strong></div> 
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

																$("#results2<?php echo $linhaos['os_produtos_id'] ?>").empty();
																$("#results2<?php echo $linhaos['os_produtos_id'] ?>").append(msg);
																document.getElementById("dvConteudo2<?php echo $linhaos['os_produtos_id'] ?>").style.display = "none";
																document.getElementById("dvConteudo3<?php echo $linhaos['os_produtos_id'] ?>").style.display = "block";





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
															<h5 class="modal-title">Editar</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
															</button>
														</div>
														<div class="modal-body">

															<form action="inserir_alerta_reposicao" method="post">

																<input type="hidden" name="deveria" value="<?php echo $produtosu['produto_unidade_estoque'] ?>">
																<input type="hidden" name="idos" value="<?php echo $id ?>">
																<input type="hidden" name="unidade" value="<?php echo $produtosu['produto_unidade_unidade']  ?>">



																<input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="id">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_os'] ?>" name="os">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_produto'] ?>" name="produto">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="idosproduto">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_unidade'] ?>" name="unidade">


																<div class="row">


																	<div class="col-12">
																		<label><strong> Informe o motivo do alerta</strong></label>




																		<?php // listando em um box os instrutores

																		echo "<SELECT NAME='alerta' SIZE='1' class='form-control' required >

<OPTION VALUE='' SELECTED> Escolha ";
																		// Selecionando os dados da tabela em ordem decrescente
																		$sql = "SELECT * FROM aletar_motivos where alerta_status ='1'  ORDER BY alerta_nome";
																		// Executando $sql e verificando se tudo ocorreu certo.
																		$resultado = mysqli_query($conn, $sql);
																		//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
																		while ($linha = mysqli_fetch_array($resultado)) {
																			echo "<OPTION VALUE='" . $linha['id_alerta'] . "'>" . ($linha['alerta_nome']);
																		}
																		echo "</SELECT>";

																		?>



																	</div>

																	<div class="col-6">
																		<label>QTD Encontrada estoque</label>
																		<input type="number" name="encontrada" value="" required class="form-control">

																	</div>

																	<div class="col-6">
																		<label>QTD Reposta em estoque</label>
																		<input type="number" name="reposta" value="" required class="form-control">

																	</div>

																	<div class="col-12">
																		<label>Observações</label>
																		<input type="text" name="observacoes" value="" class="form-control">

																	</div>

																	<div class="col-12"> <br>

																		<input type="hidden" name="id" value="<?php echo $linhaos['os_produtos_id'] ?>">


																		<button type="submit" class="btn btn-info"> SALVAR </button>
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
   