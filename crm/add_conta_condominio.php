<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
?>


<script src="assets/js/jquery.js"></script>
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
                                    <h4 class="mb-0">Financeiro &gt; Contas a pagar &gt; Cadastrar &gt; Condominios/Unidades</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        <a href="contas_a_pagar">
                                        <button class="btn btn-info"> Listar Contas a pagar</button></a>      
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
                                        <h4 class="card-title">Adicionar Nova Conta</h4>
                                       
                                        <form id="formapagar" action="#" method="post" enctype="multipart/form-data">
											
											  <div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">
                                                        
                                                          Informe o condominio:
                                                         
                                                        </label>
                                                        <?php 
			  echo "<SELECT NAME='condominio' SIZE='1' class='form-control'  id='unidades' required>

<OPTION VALUE='' SELECTED> Escolha o condomínio ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM condominios where condominio_status = '1'   ORDER BY condominio_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_condominio']."'>".($linha['condominio_nome']);
}
echo "</SELECT>";

?>



<script>
	
	 $(document).ready(function() {
    $('#unidades').on('change', function() {
	 
		 
		
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'listar_unidades.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#resultscd").empty();
				$("#resultscd").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });


	</script> <div id="resultscd"></div>
                                                    </div>
                                                </div>
												  
												   
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">
                                                         
                                                          Informe o fornecedor:
                                                          
                                                        </label>
                                                        <?php // listando em um box os instrutores

			  echo "<SELECT NAME='fornecedor' SIZE='1' class='form-control' >

<OPTION VALUE='' SELECTED> Não informado ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM fornecedores where fornecedor_status ='1'  ORDER BY fornecedor_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_fornecedor']."'>".($linha['fornecedor_nome']);
}
echo "</SELECT>";

?>
                                                    </div>
                                                </div>
												  	  
												  
                                          <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">
                                                         
                                                         Referente a:
                                                          
                                                        </label>
                                                        <input type="text" class="form-control" name="referente" required>
                                                    </div>
                                                </div>              

												  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">QTD Parcelas:</label>
                                                      <input name="parcelas" type="number"  required class="form-control"  id='central' min="1">
                                                    </div>
                                                </div>  
												  
												  
												  
												  
												
												  
												
											
												 <div align="right" id="btn" style="display: block"> <button class="btn btn-primary" id="enviar" type="submit">Cadastrar</button> </div>
											
											
											
											
											
											
										

										 
										    	<div id="results"></div>	
										 	


                                  </div> </div> </div> </div>
					
					 </form>
					
	   <script>
	
	 $(document).ready(function() {
    $('#central').on('change', function() {
	 		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'apagar2.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				document.getElementById("btn").style.display = "none";
				$("#results").empty();
				$("#results").append(msg);
				
			}
			
		});
		 
		 return false;
	 });
 
 });


		   
		    $(document).ready(function() {
 
	 $("#formapagar").submit(function(){
		 
		 
		 
		    var formData = new FormData(this);

		 
		$.ajax({
			url: 'inserir_a_pagar_condominio.php',
			cache: false,
			data: formData,
			type: "POST",  
			enctype: 'multipart/form-data',
			processData: false, // impedir que o jQuery tranforma a "data" em querystring
            contentType: false, // desabilitar o cabeçalho "Content-Type"


			success: function(msg){
				
				$("#results").empty();
				$("#results").append(msg);
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

       

    
					
