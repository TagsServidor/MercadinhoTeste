<?php // listando em um box os instrutores
include "bd/conexao.php";

?>

        <script src="assets/libs/jquery/jquery.min.js"></script>

<label class="form-label" for="validationCustom01">Informe o condominio:</label>
<?php 
			  echo "<SELECT NAME='condominio' SIZE='1' class='form-control'  id='unidades'>

<OPTION VALUE='' SELECTED> Escolha o condomínio ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM condominios where condominio_central = '$_POST[central]' and condominio_lixeira = 1  ORDER BY condominio_nome";
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



