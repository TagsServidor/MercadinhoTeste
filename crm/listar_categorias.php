<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

include "bd/conexao.php";

$departamento = $_POST['departamento'];
?>

        <script src="assets/libs/jquery/jquery.min.js"></script>

<label class="form-label" for="validationCustom01">Categoria:</label>
<?php 
			  echo "<SELECT NAME='categoria' SIZE='1' class='form-control'  id='categoria'>

<OPTION VALUE='' SELECTED> Informe a categoria ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos_categorias where categoria_departamento = '$departamento'   ORDER BY categoria_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_categoria']."'>".($linha['categoria_nome']);
}
echo "</SELECT>";

?>


	  

<script>
	
	 $(document).ready(function() {
    $('#categoria').on('change', function() {
	 
		 
		
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'listar_subcategorias.php',
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



