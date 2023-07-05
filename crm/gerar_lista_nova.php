<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Estoque &gt; Gerar Lista Distribuição (Reposição)</h4>

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
										 
										 <div align="center"><i class="dripicons-home" style="font-size: 100px"> </i> </div>
										 
										 <div align="center"> 
										 <div align="center" class="col-6">
										 <label class="form-label" for="validationCustom01">Informe a unidade: (Ponto de Venda)</label> 
											 <form action="form_gerar_os"  method="post"> 
										 
												 
												 
		<select id="link" class="form-control">
   <option value="" selected>Escolha</option>
			<?php
			$sql = "SELECT * FROM unidades where unidade_lixeira = 1  ORDER BY unidade_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
	?>
   <option value="form_gerar_os/<?php echo $linha['id_unidade'] ?>"><?php echo $linha['unidade_nome'] ?></option>
			
			
   <?php } ?>
</select>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
 $(document).ready(function(){

    $('#link').on('change', function () {
         var url = $(this).val(); 
         if (url) { 
             window.open(url, '_parent');
          }
          return false;
        });
     });
</script>										 
												 
												 
											 
												 </form>
										 </div>
											 
											 
										 </div>
										 
										 
										 </div></div></div></div></div>