<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$sql = "SELECT * FROM p_apagar p inner join terminais t ON p.id_terminal = t.id_terminal inner join unidades u ON t.id_unidade = u.id_unidade inner join clientes c on p.cliente_apagar = c.id_cliente   where p.id_apagar  = '$id'   ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);
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


<form action="confirmar_venda_confirmar2" method="post">

   




    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Financeiro &gt; Confirmar Venda</h4>


                        </div>
                    </div>
                </div>


            </div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Detalhes da venda</h4><br>
<strong> Unidade: </strong> <?php echo $linha['unidade_nome'] ?> <br>
<strong> Terminal:</strong> <?php echo $linha['id_terminal'] ?> - <?php echo $linha['t_maquina'] ?> <br>
<strong> Data:</strong> <?php echo date('d/m/Y', strtotime($linha['data_apagar'])); ?> <?php echo $linha['hora_apagar'] ?>  <br>								
								<br>

								                                <h4 class="card-title">Lista de produtos</h4>

								
								
					<input name="valor" type="hidden" value="<?php echo $linha['valor'] ?>">
	<input name="registro" type="hidden" value="<?php echo $linha['registro_apagar'] ?>">
								
		<?php if( $linha['metodo_pagamento'] =='1' ) { ?>						
	<input name="pagamento" type="hidden" value="Cartão de Credito">
	<?php } ?>	
								
		<?php if( $linha['metodo_pagamento'] =='d' ) { ?>						
	<input name="pagamento" type="hidden" value="Cartão de Debito">
	<?php } ?>								
								
	<input name="unidade" type="hidden" value="<?php echo $linha['id_unidade'] ?>">				
	<input name="data" type="hidden" value="<?php echo $linha['data_apagar'] ?>">							
  <input name="hora" type="hidden" value="<?php echo $linha['hora_apagar'] ?>">							
<input name="cliente" type="hidden" value="<?php echo $linha['cliente_apagar'] ?>">	
<input name="id" type="hidden" value="<?php echo $linha['id_apagar'] ?>">	
						
								
								
								
								
								
								
                                <div class="table-rep-plugin">
                                    <div >
                                        <table id="tech-companies-1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Produto</th>
                                                    <th data-priority="1">QTD</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                    <?php // LISTANDO OS EM ABERTO

	$x=0;
                                                    $sqlos = "SELECT * FROM carrinho c inner join produtos p ON c.produto_carrinho = p.id_produto  where c.session_carrinho  = '$linha[registro_apagar]'   ";
                                                    $resultadoos = mysqli_query($conn, $sqlos);
                                                    $totalos = mysqli_num_rows($resultadoos);
                                                    while ($linhaos = mysqli_fetch_array($resultadoos)) {
$x++;

                                                    ?>

	<input name="produto[]" type="hidden" id="produto[<?php echo $x  ?>]" value="<?php echo $linhaos['produto_carrinho'] ?>" />
	<input name="qtd[]" type="hidden" id="qtd[<?php echo $x  ?>]" value="<?php echo $linhaos['qtd_carrinho'] ?>" />
													
													

                                                    <th><?php echo $linhaos['produto_nome'] ?></th>
                                                    <td><?php echo $linhaos['qtd_carrinho'] ?> </td>
                                                    

                                                    </td>


                                                </tr>




                                            



                                            <?php } ?>

                                            <!-- Fim lista os aberto  -->

                                            </tbody>
                                        </table>
                                    </div>
							
  <div align="center"> <button type="submit"  class="btn btn-success" onclick="return confirm('Confirmar mesmo o registro desta venda?');">CONFIRMAR VENDA</button> </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
          </form>
                <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
                <script src="assets/js/pages/table-responsive.init.js"></script>
