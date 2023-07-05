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


<!-- Select com Busca-->
<link href="assets/js/select2.min.css" rel="stylesheet" />
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/select2.min.js"></script>

<!-- Responsive Table css -->
<link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
<div class="main-content">

	<div class="page-content">
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box d-flex align-items-center justify-content-between">
						<h4 class="mb-0">OS &gt; <?php echo $id ?></h4>

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
							<h4 class="card-title">Relação de produtos</h4>






							<div class="table-rep-plugin">
								<div class="table-responsive mb-0">
									<table id="tech-companies-1" class="table">
										<thead>
											<tr>
												<th>Produto</th>
												<th data-priority="1">Estoque Atual</th>
												<th data-priority="1">QTD a repor</th>
												<th data-priority="1">QTD após reposição</th>
												<th data-priority="3">Lote</th>

												<th data-priority="3">Ação</th>
											</tr>
										</thead>
										<tbody>
											<tr>

												<?php // LISTANDO OS EM ABERTO

												$sqlosp = "SELECT * FROM os_produtos o2 inner join produtos p on o2.os_produtos_produto = p.id_produto  where o2.os_produtos_os  = '$id' and o2.os_produtos_status ='1'  ";
												$resultadoosp  = mysqli_query($conn, $sqlosp);
												$totalosp  = mysqli_num_rows($resultadoosp);


												while ($linhaos  = mysqli_fetch_array($resultadoosp)) {

													$sqlospu = "SELECT * FROM produtos_unidades  where produto_unidade_unidade = $linhaos[os_produtos_unidade] and produto_unidade_produto = $linhaos[os_produtos_produto]  ";
													$resultadoospu  = mysqli_query($conn, $sqlospu);
													$produtosu  = mysqli_fetch_array($resultadoospu);

													@$totalaposreposicao = 	$produtosu['produto_unidade_estoque'] + $linhaos['os_produtos_qtd'];

												?>














													<th><?php echo $linhaos['produto_nome'] ?> <span class="co-name"> </span></th>
													<th><?php if (@$produtosu['produto_unidade_estoque'] == '') { ?>0<?php } else { ?><?php echo $produtosu['produto_unidade_estoque'] ?> <?php } ?> <span class="co-name"> </span></th>
													<th><?php echo $linhaos['os_produtos_qtd'] ?> <span class="co-name"> </span></th>
													<td> <?php echo $totalaposreposicao ?></td>
													<td><?php echo $linhaos['os_produtos_lote'] ?></td>

													<td>

														<div id="dvConteudo2<?php echo $linhaos['os_produtos_id'] ?>">



															<form id="formos2<?php echo $linhaos['os_produtos_id'] ?>" action="#" method="post">

																<button class="btn btn-outline-warning btn-sm edit">
																	<i class="fas fa-check"></i>
																</button>
																<a href="#" class="btn btn-outline-danger btn-sm edit" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['os_produtos_id'] ?>">
																	<i class="fa fa-exclamation-triangle"></i>
																</a>


																<input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="id">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_os'] ?>" name="os">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_produto'] ?>" name="produto">
																<input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="idosproduto">
																<input name="unidade" type="hidden" id="unidade" value="<?php echo $linhaos['os_produtos_unidade'] ?>">

															</form>
														</div>


														<div id="dvConteudo3<?php echo $linhaos['os_produtos_id'] ?>" class="spinner" style="display: none">






															<img src="assets/images/checkp.gif" />

														</div>
													</td>







											</tr>




											<script>
												var i = setInterval(function() {
													clearInterval(i);


													document.getElementById("loading<?php echo $linhaos['os_produtos_id'] ?>").style.display = "none";
													document.getElementById("content<?php echo $linhaos['os_produtos_id'] ?>").style.display = "block";

												}, 2000);
											</script>
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

							<!-- Fim lista os aberto  -->

							</tbody>
							</table>
							</div>


						</div>



					</div>
				</div>
			</div>
		</div>
		<div class="text-center"> <a href="os_abertas" class="btn btn-success"> Voltar para OS </a> </div>