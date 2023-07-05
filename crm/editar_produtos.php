<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

include "bd/conexao.php";

$sqlos = "SELECT * FROM produtos WHERE id_produto = '$_POST[id]' ";
$resultadoos = mysqli_query($conn, $sqlos);
$totalos = mysqli_num_rows($resultadoos);	
$produto = mysqli_fetch_array($resultadoos);

?>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_produtos2.js"></script>
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
                                        <a href="listar_produtos"><button class="btn btn-info"> Voltar </button></a>  
											
											<form action="deletar_produto" method="post"> 
												<input type="hidden" value="<?php echo $produto['id_produto'] ?>" name="id">
											<button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar esse produto?')"> Remover Produto </button>
											</form> 
											
											
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
                                        <h4 class="card-title">Editar Produto</h4>
                                       
                                        <form id="formproduto" action="#" method="post" enctype="multipart/form-data">
											
											  <div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nome do Produto:</label>
                                                        <input name="nome" type="text" value="<?php echo $produto['produto_nome'] ?>" required class="form-control" id="nome" placeholder="Informe o nome do Produto">
                                                        
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Tags:</label>
                                                        <input name="tags" type="text" value="<?php echo $produto['tags_produto'] ?>" required class="form-control" id="nome" placeholder="">
                                                        
                                                    </div>
                                                </div>
												  
												   <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Departamento:</label>
                                                       
														
                                                     
														<?php // listando em um box os instrutores

	
	$sqldp = "SELECT * FROM produtos_departamentos where id_departamentos ='$produto[produto_departamento]'  ";
	$resultadodp = mysqli_query($conn, $sqldp);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
$linhadp=mysqli_fetch_array($resultadodp);											   
															   
			  echo "<SELECT NAME='departamento' SIZE='1' class='form-control' required id='departamento'>

<OPTION VALUE='$produto[produto_departamento]' SELECTED> $linhadp[departamentos_nome] ";
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
												  
												   
												  
												  
												  
												   
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Código barras:</label>
                                                        <input type="text" value="<?php echo $produto['produto_codigobarras'] ?>" class="form-control" id="codigobarras" name="codigobarras"  placeholder="Informe Código de barras do produto">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Status:</label>
                                                        <select name="status" id="unidade" class="form-control" required>
                                                          <?php if ($produto['produto_status'] =='1') { ?><option value="1">Ativo</option> <?php } ?>
															  <?php if ($produto['produto_status'] =='2') { ?><option value="1">Inativo</option> <?php } ?>
                                                          <option value="1">Ativo</option>
                                                          <option value="2">Inativo</option>
                                                         
                                                        </select>
                                                     
                                                    </div>
                                                </div>  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Unidade:</label>
                                                        <select name="unidade" id="unidade" class="form-control" required>
                                                          <option value="<?php echo $produto['produto_unidade'] ?>"><?php echo $produto['produto_unidade'] ?></option>
                                                          <option value="Un">Un</option>
                                                          <option value="Pc">Pc</option>
                                                          <option value="Lt">Lt</option>
                                                          <option value="Kg">Kg</option>
                                                          <option value="G">G</option>
                                                          <option value="Ml">Ml</option>
                                                        </select>
                                                       <!-- value="<?php echo $produto['produto_unidade'] ?>"  -->
                                                    </div>
                                                </div>  
												  
												  
												  
												   <hr>
												  <div class="col-md-12">
                                                    <div class="mb-3">
														
<h3> Configuração de Impostos	</h3>												  </div></div>
												  
												  
												
												  
												  
												 
												  
												  
												
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Origem do produto:</label>
														
													
														
               
														
<?php // 

			  echo "<SELECT NAME='origem' SIZE='1' class='form-control'>

<OPTION VALUE='' SELECTED> Informe ";
// Selecionando os dados da tabela em ordem decrescente
$sqlo = "SELECT * FROM produtos_origem  ORDER BY id_origem";
// Executando $sql e verificando se tudo ocorreu certo.
$resultadoo = mysqli_query($conn, $sqlo);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linhao=mysqli_fetch_array($resultadoo)) {
echo "<OPTION VALUE='".$linhao['id_origem']."' ";

if ($produto['produto_origem'] == $linhao['id_origem']) {

echo "SELECTED";

}

echo ">".$linhao['origem_titulo'];

}
echo "</SELECT>";
?>  																
														
														
														
                                                    </div>
                                                </div>  
												  
												  
												
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Grupo de Impostos:</label>
                                                       														
  <?php // listando em um box os instrutores

			  echo "<SELECT NAME='grupo' SIZE='1' class='form-control'>

<OPTION VALUE='' SELECTED> Informe ";
// Selecionando os dados da tabela em ordem decrescente
$sqlg = "SELECT * FROM grupo_impostos  ORDER BY grupo_impostos_id";
// Executando $sql e verificando se tudo ocorreu certo.
$resultadog = mysqli_query($conn, $sqlg);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linhag=mysqli_fetch_array($resultadog)) {
echo "<OPTION VALUE='".$linhag['grupo_impostos_id']."' ";

if ($produto['produto_grupo'] == $linhag['grupo_impostos_id']) {

echo "SELECTED";

}

echo ">".$linhag['grupo_impostos_titulo'];

}
echo "</SELECT>";
?>  														
			
															
										
											
                                       
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">CFOP (Dentro do Estado):</label>
                                                        
 
				                                                     
   <?php // 

			  echo "<SELECT NAME='cfopdentro' SIZE='1' class='form-control'>

<OPTION VALUE='' SELECTED> Informe ";
// Selecionando os dados da tabela em ordem decrescente
$sqlcd = "SELECT * FROM cfop_dentro  ORDER BY cfop_dentro_id";
// Executando $sql e verificando se tudo ocorreu certo.
$resultadocd = mysqli_query($conn, $sqlcd);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linhacd=mysqli_fetch_array($resultadocd)) {
echo "<OPTION VALUE='".$linhacd['cfop_dentro_id']."' ";

if ($produto['produto_cfop_dentro'] == $linhacd['cfop_dentro_id']) {

echo "SELECTED";

}

echo ">".$linhacd['cfop_dentro_titulo'];

}
echo "</SELECT>";
?>  						                                                 </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">CFOP (Fora do Estado)</label>
                                                      <?php // 

			  echo "<SELECT NAME='cfopfora' SIZE='1' class='form-control'>

<OPTION VALUE='' SELECTED> Informe ";
// Selecionando os dados da tabela em ordem decrescente
$sqlcf = "SELECT * FROM cfop_fora  ORDER BY cfop_fora_id";
// Executando $sql e verificando se tudo ocorreu certo.
$resultadocf = mysqli_query($conn, $sqlcf);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linhacf=mysqli_fetch_array($resultadocf)) {
echo "<OPTION VALUE='".$linhacf['cfop_fora_id']."' ";

if ($produto['produto_cfop_fora'] == $linhacf['cfop_fora_id']) {

echo "SELECTED";

}

echo ">".$linhacf['cfop_fora_titulo'];
}
echo "</SELECT>";
?>  	            
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Código NCM:</label>
                                                        <input name="ncm" type="text" class="form-control" id="ncm"  placeholder="Informe Código NCM" value="<?php echo $produto['produto_ncm'] ?>">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Código CEST:</label>
                                                        <input name="cest" type="text" class="form-control" id="cest"  placeholder="Informe Código CEST" value="<?php echo $produto['produto_cest'] ?>">
                                                        
                                                    </div>
                                                </div>  
												  
												
												  
												  <hr>
												  <h5>Informações Adicionais</h5>
												  
												  
												  <div class="col-md-12">
                                                    <div class="mb-3">
                                                      <textarea  id="classic-editor" value="<?php echo $produto['produto_informacoes'] ?>" name="informacoes"></textarea>  
                                                       
                                                    </div>
                                                </div>  
                                                    <input type="hidden" value="<?php echo $_POST['id'] ?>" name="id" id="textfield"> 
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

															 
                                                       <input type="file" onChange="readURL(this);"  class="form-control" name="arquivo"  accept="image/*" capture="user"></div>
														
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
                                    </div>
                                
                                    <input type="hidden" value="<?php echo $_POST['id'] ?>" name="id" id="textfield">
                                    
                                    </div>
											
												 <div align="right"> <button class="btn btn-primary" id="enviar" type="submit">Alterar</button> </div>
											
											
											
											
											
											
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

	<script src="assets/js/pages/form-validation.init.js"></script>
						
        <!-- select 2 plugin -->
        <script src="assets/libs/select2/js/select2.min.js"></script>
	
				 <!-- dropzone plugin -->
        <script src="assets/libs/dropzone/min/dropzone.min.js"></script>

        <!-- init js -->
        <script src="assets/js/pages/ecommerce-add-product.init.js"></script>	
					
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
					
					
