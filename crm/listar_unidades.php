<?php // listando em um box os instrutores
include "bd/conexao.php";

?>

        <script src="assets/libs/jquery/jquery.min.js"></script>

<label class="form-label" for="validationCustom01">Informe a unidade: (Ponto de Venda)</label>
<?php 
			  echo "<SELECT NAME='unidade' SIZE='1' class='form-control' id='produto' >

<OPTION VALUE='' SELECTED> Escolha a unidade ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM unidades where unidade_condominio = '$_POST[condominio]' and unidade_lixeira = 1  ORDER BY unidade_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_unidade']."'>".($linha['unidade_nome']);
}
echo "</SELECT>";

?>

<script>
	
	 $(document).ready(function() {
    $('#produto').on('change', function() {
	 
		 
		
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'listar_produtosd2.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#resultscdp").empty();
				$("#resultscdp").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });



