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


 <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Estoque &gt; Entrada de Produtos</h4>

                                    <div class="page-title-right"> <a href="listar_entradas"><button class="btn btn-info btn-sm">Entradas em aberto</button></a>
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
                                        <h4 class="card-title">Adicionar Nova Entrada</h4>
                                       
                                        <form id="formestoqueentrada1" action="#" method="post">
											
											  <div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Central:</label>
                                                        <?php // listando em um box os instrutores

			  echo "<SELECT NAME='central' SIZE='1' class='form-control' id='central' required>

<OPTION VALUE='' SELECTED> Escolha a central de recebimento ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM centrais where central_status ='1'  ORDER BY central_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_central']."'>".($linha['central_nome']);
}
echo "</SELECT>";

?>
														
														

                                                    </div>
                                                </div>
												  
												   
										<div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Produto:</label>
                                                       <?php // listando em um box os instrutores

			  echo "<SELECT NAME='produto' SIZE='1' class='form-control' id='produto' required>

<OPTION VALUE='' SELECTED> Escolha o produto ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos where produto_status ='1'  ORDER BY produto_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_produto']."'>". ($linha['produto_nome']) .'&nbsp;-&nbsp;Cod Barras:  '. ($linha['produto_codigobarras']);
}
echo "</SELECT>";

?>
          <script>
        $(document).ready(function() {
            $('#central').select2();
        });
															
		  $(document).ready(function() {
            $('#produto').select2();
        });													
    </script>                                              
                                                    </div>
                                                </div>		   
												  
												  
												 
												     </div>
												 <div align="right"> <button class="btn btn-info" id="enviar" type="submit">Avançar</button> </div>
										 </form>

										 
										    	<div id="results"></div>	
										 	<div id="results2"></div>	
	<div id="results3"></div>	  

										 
										 
										 <div id="resultsq"></div>	
										 	<div id="results2q"></div>	
	<div id="results3q"></div>	  

                                  </div> </div> </div> </div>
					
					
	
	<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>					

						
	
					
					
     <!-- JAVASCRIPT -->
        

        <!-- ckeditor -->
        <script src="assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

       

        <script>
        ClassicEditor
        .create( document.querySelector( '#classic-editor' ) )
        .catch( error => {
            console.error( error );
        } );
		
			
        </script>
					
					
