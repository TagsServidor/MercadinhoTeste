<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

?>

<div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nome do Produto:</label>
                                                        <input name="nome" type="text"  required class="form-control" id="nome" placeholder="Informe o nome do Produto">
                                                        
                                                    </div>
                                                </div>
												  
												   
												  
												   <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Departamento:</label>
                                                       <?php // listando em um box os instrutores

			  echo "<SELECT NAME='departamento' SIZE='1' class='form-control' required id='departamento'>

<OPTION VALUE='' SELECTED> Informe o departamento ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos_departamentos where departamentos_status ='1'  ORDER BY departamentos_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_departamentos']."'>".($linha['departamentos_nome']);
}
echo "</SELECT>";

?>
                                                        
                                                    </div>
                                                </div>
												  
												  
												  
												   <div class="col-md-4">
                                                    <div class="mb-3">
                                                       <div id="resultsd"></div>	
	<div id="results2d"></div>	

                                                        
                                                    </div>
                                                </div>
												  
												   <div class="col-md-4">
                                                    <div class="mb-3">
                                                       
     <div id="resultscd"></div>	
	<div id="results2cd"></div>	
                                                        
                                                    </div>
                                                </div>
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Código barras:</label>
                                                        <input type="text" class="form-control" id="codigobarras" name="codigobarras"  placeholder="Informe Código de barras do produto">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Unidade:</label>
                                                        <select name="unidade" id="unidade" class="form-control" required>
                                                          <option  value="">Informe</option>
                                                          <option value="Un">Un</option>
                                                          <option value="Pc">Pc</option>
                                                          <option value="Lt">Lt</option>
                                                          <option value="Kg">Kg</option>
                                                          <option value="G">G</option>
                                                          <option value="Ml">Ml</option>
                                                        </select>
                                                    </div>
                                                </div>  
												  
												  
												  
												  
												
												  
												  <hr>
												  <h5>Informações Adicionais</h5>
												  
												  
												  <div class="col-md-12">
                                                    <div class="mb-3">
                                                      <textarea  id="classic-editor"	 name="informacoes"></textarea>
                                                        
                                                    </div>
                                                </div>  
												  
												     </div>