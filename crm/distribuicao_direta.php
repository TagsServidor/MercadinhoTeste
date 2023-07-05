<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>

 <script src="assets/js/form_distribuicao.js"></script>


 <!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>





 <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


  


</head>

<body>
  
  
</body>

</html>

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Estoque &gt; Distribuição (Reposição)</h4>

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
                                        <h4 class="card-title">Realizar Nova Distribuição (Reposição)</h4>
                                       
                                        <form id="formdistribuicao" action="#" method="post">
											
											  <div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Informe o produto: </label>
<?php 
			  echo "<SELECT NAME='produto' SIZE='1' class='form-control' id='produtos' autofocus >

<OPTION VALUE='' SELECTED> Escolha o produto ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos where produto_status = '1'   ORDER BY produto_nome";
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
            $('#produtos').select2();
        });
														
    </script>       
		<script>
	
	 $(document).ready(function() {
    $('#produtos').on('change', function() {
	 
		 
		
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'ver_produtosd.php?unidade=<?php echo $_POST['unidade'] ?>',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#resultscdv").empty();
				$("#resultscdv").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });


														</script>
														

                                                    </div>
                                                </div>
												  
												   
										<div class="col-md-12">
                                                    <div class="mb-3">
                                                          <div id="resultsd"></div>	
	<div id="results2d"></div>	
                                                    </div>
                                                </div>		   
												  
												  
												  
												  			   
										<div class="col-md-12">
                                                    <div class="mb-3">
												  
												  
												  <div id="resultscd"></div>	
										 	<div id="results2cd"></div>	
	<div id="results3cd"></div>	  
												  </div>
                                                </div>	
												  
												  
												  
												  
												  <div class="col-md-12">
                                                    <div class="mb-3">
												  
												  
												  <div id="resultscdp"></div>	
										 	<div id="results2cdp"></div>	
	<div id="results3cdp"></div>	  
												  </div>
                                                </div>	
												 
												  
												  
											<div class="col-md-12">
                                                    <div class="mb-3">
												  
												  
												  <div id="resultscdv"></div>	
										 	<div id="results2cdv"></div>	
	<div id="results3cdv"></div>	  
												  </div>
                                                </div>	
												 	  
												  
												  
												  
												  
												  
												  
												    
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
        
<script>
	
	 $(document).ready(function() {
    $('#central').on('change', function() {
	 
		 
	
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'listar_condominios.php',
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
