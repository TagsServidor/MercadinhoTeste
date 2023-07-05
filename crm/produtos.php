<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
?>

<link href="assets/js/select2.min.css" rel="stylesheet" />

<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_produtos.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

<style>
.img
	{
		border-radius: 10px;
		width: 100px;
	}

</style>

 <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Produtos</h4>

                                    <div>
                                        <ol class="breadcrumb m-0">
                                        <a href="listar_produtos"><button class="btn btn-info"> Listar Produtos </button></a>      
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
                                        <h3 >Adicionar Novo Produto</h3>
                                       
                                        <form id="formproduto" action="#" method="post" enctype="multipart/form-data">
											
											  <div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nome do Produto:</label>
                                                        <input name="nome" type="text"  required class="form-control" id="nome" placeholder="Informe o nome do Produto">
                                                        
                                                    </div>
                                                </div>
												  
												  <div class="col-md-12">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Tags:</label>
                                                        <input name="tags" type="text"  required class="form-control" id="tags" placeholder="Tags para facilitar a busca separadas por virgula ex: miojo, Macarrão instantâneo...">
                                                        
                                                    </div>
                                                </div>
												  
												   
												  
												   <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Categoria:</label>
                                                       <?php // listando em um box os instrutores

			  echo "<SELECT NAME='departamento' SIZE='1' class='form-control' required id='departamento'>

<OPTION VALUE='' SELECTED> Informe o categoria ";
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
												  <hr>
												  <div class="col-md-12">
                                                    <div class="mb-3">
														
<h3> Configuração de Impostos	</h3>												  </div></div>
												  
												  
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
												  
												  
												
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Origem do produto:</label>
                                                       <?php // listando em um box os instrutores

			  echo "<SELECT NAME='origem' SIZE='1' class='form-control' id='origem' >

<OPTION VALUE='' SELECTED> Selecione ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos_origem   ORDER BY id_origem";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['origem_valor']."'>".($linha['origem_titulo']);
}
echo "</SELECT>";

?>
     <script>
        $(document).ready(function() {
            $('#origem').select2();
        });
														
    </script>                                                       
                                                    </div>
                                                </div>  
												  
												  
												
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Grupo de Impostos:</label>
                                                       <?php // listando em um box os instrutores

			  echo "<SELECT NAME='grupo' SIZE='1' class='form-control' id='grupo' >

<OPTION VALUE='' SELECTED> Selecione ";
// Selecionando os dados da tabela em ordem decrescente
$sql2g = "SELECT * FROM grupo_impostos   ORDER BY grupo_impostos_id";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado2g = mysqli_query($conn, $sql2g);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha2g=mysqli_fetch_array($resultado2g)) {
echo "<OPTION VALUE='".$linha2g['grupo_impostos_id']."'>".($linha2g['grupo_impostos_titulo']);
}
echo "</SELECT>";

?>
     <script>
        $(document).ready(function() {
            $('#cfopfora').select2();
        });
														
    </script>            
                                       
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">CFOP (Dentro do Estado):</label>
                                                        <?php // listando em um box os instrutores

			  echo "<SELECT NAME='cfopdentro' SIZE='1' class='form-control' id='cfopdentro' >

<OPTION VALUE='' SELECTED> Selecione ";
// Selecionando os dados da tabela em ordem decrescente
$sql2 = "SELECT * FROM cfop_dentro   ORDER BY cfop_dentro_id";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado2 = mysqli_query($conn, $sql2);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha2=mysqli_fetch_array($resultado2)) {
echo "<OPTION VALUE='".$linha2['cfop_dentro_valor']."'>".($linha2['cfop_dentro_titulo']);
}
echo "</SELECT>";

?>
     <script>
        $(document).ready(function() {
            $('#cfopdentro').select2();
        });
														
    </script>                      
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">CFOP (Fora do Estado)</label>
                                                      <?php // listando em um box os instrutores

			  echo "<SELECT NAME='cfopfora' SIZE='1' class='form-control' id='cfopfora' >

<OPTION VALUE='' SELECTED> Selecione ";
// Selecionando os dados da tabela em ordem decrescente
$sql3 = "SELECT * FROM cfop_fora   ORDER BY cfop_fora_id";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado3 = mysqli_query($conn, $sql3);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha3=mysqli_fetch_array($resultado3)) {
echo "<OPTION VALUE='".$linha3['cfop_fora_valor']."'>".($linha3['cfop_fora_titulo']);
}
echo "</SELECT>";

?>
     <script>
        $(document).ready(function() {
            $('#cfopfora').select2();
        });
														
    </script>            
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Código NCM:</label>
                                                        <input type="text" class="form-control" id="ncm" name="ncm"  placeholder="Informe Código NCM">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Código CEST:</label>
                                                        <input type="text" class="form-control" id="cest" name="cest"  placeholder="Informe Código CEST">
                                                        
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
											
											
											
											<div class="card">
                                        <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-img-collapse">
                                            <div class="p-4">
                                                
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                       
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Imagem do produto</h5>
                                                        <p class="text-muted text-truncate mb-0">Adicionar imagem principal do produto</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
														
														<i class="fa fa-upload font-size-24 " aria-hidden="true"></i>

														
                                                       
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </a>

                                        <div id="addproduct-img-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                              
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            
                                                        </div>
                                                        <div class="row">  
														<div class="col-md-9"> <input type="file" name="arquivo"

															 
                                                       <input type="file" onChange="readURL(this);"  class="form-control" name="arquivo"  accept="image/*" capture="user" id="arquivo"></div>
														
														<div class="col-md-3" align="center"> <img id="ImdID" src="" class="img" />	</div>
    <script type="text/javascript">
        function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#ImdID').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
    </script>
														
														</div>
														
														
                                                    </div>
                                               
                                        </div>
                                    </div></div>
											
												 <div align="right"> <button class="btn btn-primary" id="enviar" type="submit">Cadastrar</button> </div>
											
											
											
											
											
											
										 </form>

										 
										    	<div id="results"></div>	
										 	<div id="results2"></div>	
	<div id="results3"></div>	  


                                  </div> </div> </div> </div>
					
					
					
					
		<script>
	
	 $(document).ready(function() {
    $('#departamento').on('change', function() {
	 
		 
	
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'listar_categorias.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#resultsd").empty();
				$("#resultsd").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });



</script>			
					
					
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
					
					
	
	<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>					


						
        <!-- select 2 plugin -->
        <script src="assets/libs/select2/js/select2.min.js"></script>
	
				 <!-- dropzone plugin -->
        <script src="assets/libs/dropzone/min/dropzone.min.js"></script>

        <!-- ckeditor -->
        <script src="assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

       

        <script>
        ClassicEditor
        .create( document.querySelector( '#classic-editor' ) )
        .catch( error => {
            console.error( error );
        } );
        </script>
					
					
