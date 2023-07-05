<?php // listando em um box os instrutores
include "bd/conexao.php";


$sql = "SELECT * FROM os_reposicao where os_unidade = '$_POST[unidade]' and os_status ='1'  ";
$resultado = mysqli_query($conn, $sql);
$totalos = mysqli_num_rows($resultado);	

if ($totalos =='0'){
 @$conn->query($insert = "INSERT INTO os_reposicao (os_unidade) VALUES ('$_POST[unidade]')");
}
?>


<link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>


<label class="form-label" for="validationCustom01">Informe o produto: </label>
<?php 
			  echo "<SELECT NAME='produto' SIZE='1' class='form-control' id='produtos' autofocus >

<OPTION VALUE='' SELECTED> Escolha o produto ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos p where produto_status = '1' and produto_lixeira = '1'   ORDER BY produto_nome";
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



