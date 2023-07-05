<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

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

$sqlep = "SELECT * FROM entrada_produtos e INNER JOIN fornecedores f on e.entrada_fornecedor = f.id_fornecedor where e.entrada_produto ='$_POST[produto]' and e.entrada_status ='2' order by e.id_entrada desc  ";
$resultadoep = mysqli_query($conn, $sqlep);
$totalep = mysqli_num_rows($resultadoep);
$linhaep=mysqli_fetch_array($resultadoep);


$sqlpc = "SELECT * FROM produtos_central  where central_produto ='$_POST[produto]' and  central_produto_central ='$_POST[central]' ";
$resultadopc  = mysqli_query($conn, $sqlpc );
$totalpc  = mysqli_num_rows($resultadopc);
$linhapc =mysqli_fetch_array($resultadopc);



$a = $linhaep['entrada_unitario'];
$b = $linhaep['entrada_venda'];
$total2 = ($b - $a);
$margem1 = ($total2 / $b) * 100;


?>


<!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>




 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

</div>
<br>
 
                            <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-xl-5">
                                                <div class="product-detail">
                                                    <div class="row">
                                                        

                                                        <div class="col-12">
                                                            <div class="tab-content position-relative" id="v-pills-tabContent">

                                                                <div class="product-wishlist">
                                                                   
                                                                </div>
                                                                <div class="tab-pane fade show active" id="product-1" role="tabpanel">
                                                                    <div class="product-img">
                                                                        <img src="../produtos/<?php echo $linha['produto_foto'] ?>" alt="" class="img-fluid mx-auto d-block" data-zoom="../produtos/<?php echo $linha['produto_foto'] ?>">
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-7">
                                                <div class="mt-4 mt-xl-3 ps-xl-4">
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

                                                 

                                                   

                                                    <div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="mt-3">
                                                                    
                                                                    <h5 class="font-size-14">Dados última entrada:</h5>
                                                                    <ul class="list-unstyled product-desc-list text-muted">
                                                                       <i class="fa fa-bullseye align-middle"></i> Data: <?php echo date('d/m/Y', strtotime($linhaep['entrada_data'])); ?> <?php //echo date('d/m/Y', strtotime($linhaep['entrada_data'] )); ?>
                                                                       <i class="fa fa-bullseye align-middle"></i> Fornecedor: <?php echo $linhaep['fornecedor_nome'] ?>
<br>
                                                                       <i class="fa fa-bullseye align-middle"></i> Qtd: <?php echo $linhaep['entrada_qtd'] ?>
                                                                    <i class="fa fa-bullseye align-middle"></i> Valor compra un: R$ <?php echo $linhaep['entrada_unitario'] ?>
                                                                        <i class="fa fa-bullseye align-middle"></i> Valor venda un: R$ <?php echo $linhaep['entrada_venda'] ?>
                                                                        

                                                                    </ul>
                                                                      
                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="mt-3">
                                                                    
                                                            <h5 class="font-size-20 mb-3"><i class="fa fa-plus font-size-24 text-primary align-middle me-2"></i><strong> Lançar Nova Entrada:</strong></h5>
                                                            
                                                           </div>
														
														 <form id="formestoqueentrada2" action="#" method="post">
                                                            <div class="row">
																
																
																<div class="col-md-12">
                                                    <div class="mb-3">
                                                      
                                                        <?php // listando em um box os instrutores

			  echo "<SELECT NAME='fornecedor' SIZE='1' class='form-control' id='fornecedor' required>

<OPTION VALUE='$linhaep[id_fornecedor]' SELECTED> $linhaep[fornecedor_nome] ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM fornecedores where fornecedor_status ='1'  ORDER BY fornecedor_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_fornecedor']."'>" . ($linha['fornecedor_nome']) . '&nbsp;-&nbsp;' . ($linha['fornecedor_cnpj']);
}
echo "</SELECT>";

?>
          <script>
        $(document).ready(function() {
            $('#fornecedor').select2();
        });
														
    </script>                                       
                                                        
                                                    </div>
                                                </div>  
																
																
																<div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label>QTD Minima em estoque:</label>
                                                        <input type="number" class="form-control"  value="<?php echo $linhapc['central_produto_qtd_minima'] ?>" name="minima"  placeholder="Qtd minima em estoque">
                                                        
                                                    </div>
                                                </div>  
														
																<div class="col-md-6">
                                                    <div class="mb-3">
                                                      <labell>QTD Máxima em estoque:</labell>
                                                        <input type="number" class="form-control" value="<?php echo $linhapc['central_produto_qtd_maxima'] ?>" name="maxima"  placeholder="Qtf maxima em estoque">
                                                        
                                                    </div>
                                                </div>  
														
																
																
																
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                    <labell>Quantidade Entrada:</labell>

                                                        <input type="number" class="form-control" id="qtd" name="qtd"  placeholder="" required>
                                                        
                                                    </div>
                                                </div>  	
														
																
																
																<div class="col-md-6">
                                                    <div class="mb-3">
                                                    <labell>Valor entrada do produto:</labell>

                                                        <input type="text" id="soma1" class="form-control money" id="codigobarras" name="valorun" value ="<?php echo $linhaep['entrada_unitario'] ?>"   required>
                                                        
                                                    </div>
                                                </div>  
																
																
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                    <labell>Valor Venda Produto:</labell>

                                                        <input type="text" id="soma2" class="form-control money" id="codigobarras" name="valorvenda" value="<?php echo $linhaep['entrada_venda'] ?>" placeholder="Valor entrada do produto" required>
                                                        
                                                    </div>
                                                </div>  
															
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                    <labell>Lucro: (R$)</labell>

                                                        <input type="text" id="result" class="form-control money" id="codigobarras" name="lucror" value="<?php echo number_format($total2, 2, ',', '.')  ?>"  placeholder="" required>
                                                        
                                                    </div>
                                                </div>  			
															
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                    <labell>Margem Lucro: (%)</labell>

                                                        <input type="text" id="result2" class="form-control" id="codigobarras" name="margemlucro" value = "<?php echo round($margem1, 2) ?>"  placeholder="Valor venda do produto" required>
                                                        
                                                    </div>
                                                </div>  			
																
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                    <labell>.</labell>

                                                        
                                                    </div>
                                                </div>  	
														
															
																<div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label>Data vencimento:</label>
                                                        <input type="date" class="form-control" id="codigobarras" name="vencimento"  placeholder="Data vencimento">
                                                        
                                                    </div>
                                                </div>  	
																
																
																
																<div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label>Data entrada:</label>
                                                        <input type="date" value="<?php echo $data1 ?>" class="form-control" id="codigobarras" name="entrada"  placeholder="Data entrada">
                                                        
                                                    </div>
                                                </div>  	
																
																
																
																<div class="col-md-6">
                                                    <div class="mb-3">
                                                    
                                                        <input type="text" class="form-control" required id="codigobarras" name="lote"  placeholder="Identificação do  Lote">
                                                        <strong class="text-danger"> Lote anterior: <?php echo $linhaep['entrada_lote'] ?> </strong> 
                                                    </div>
                                                </div>  	
															
																
																<div class="col-md-6">
                                                    <div class="mb-3">
                                                      <br>
                                                        
                                                      <input type="hidden" name="central" id="hiddenField" value="<?php echo $_POST['central'] ?>">   <input type="hidden" name="produto" id="hiddenField" value="<?php echo $_POST['produto'] ?>">
                                                    </div>
                                                </div>  	
																
																
																
															   </div>
												 <div align="center"> <button class="btn btn-primary" id="enviar" type="submit">Lançar Entrada</button> </div>	
														
													    </div>	
                                                              
                                                        </div>

                                                       </form>

                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->




<script>
jQuery(document).ready(function(){
  jQuery('input').on('keyup',function(){
    if(jQuery(this).attr('name') === 'result<?php echo $linhaos['id_produto'] ?>'){
    return false;
    }
    
    var soma1 = (jQuery('#soma1').val() == '' ? 0 : jQuery('#soma1').val());
    var soma2 = (jQuery('#soma2').val() == '' ? 0 : jQuery('#soma2').val());

    // use prseFloat 
    var result = (parseFloat(soma2) - parseFloat(soma1));
    var result2 = (parseFloat(result) / parseFloat(soma2) ) * 100;


    

/* ########################## Solução com toLocaleString() ################# */  
//com R$
//result = result.toLocaleString('us');

//sem R$
result = result.toFixed(2); 
result2 = result2.toFixed(2);

   /* ######################################################################### */ 
    
    jQuery('#result<?php echo $linhaos['id_produto'] ?>').val(result<?php echo $linhaos['id_produto'] ?>);
    jQuery('#result2').val(result2);
  });
});

    </script>



<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>					

    