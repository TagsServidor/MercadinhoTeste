
<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

?>

<!-- Sweet Alert-->
<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<!-- Deixando Botão Transparente -->
<style>

.button {     
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;        
}

</style>




<?php 





/// TRATANDO UPLOAD ARQUIVO

    $ext = strtolower(substr($_FILES['arquivo']['name'],-4)); //Pegando extensão do arquivo
    $new_name1 = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
    $new_name = md5($new_name1). $ext; //Definindo md5 do novo nome
    $dir = '../fornecedores/'; //Diretório para uploads 
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo


	/// INSERINDO NO BANCO DE DADOS
		
 @$conn->query($insert = "INSERT INTO fornecedores (fornecedor_nome, fornecedor_cnpj, fornecedor_telefone, fornecedor_celular, fornecedor_email, fornecedor_contato, fornecedor_cep, fornecedor_rua,fornecedor_numero, fornecedor_complemento, fornecedor_bairro, fornecedor_cidade, fornecedor_uf, fornecedor_informacoes, fornecedor_logomarca) VALUES 
('$_POST[nome]','$_POST[cnpj]','$_POST[telefone]','$_POST[celular]','$_POST[email]','$_POST[contato]','$_POST[cep]','$_POST[rua]','$_POST[numero]','$_POST[complemento]','$_POST[bairro]','$_POST[cidade]','$_POST[uf]','$_POST[informacoes]','$new_name')");


?>

<button type="button" class="button"  id="sa-fornecedor"></button>

  <!-- Sweet Alerts js -->
  <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

   <!-- Sweet alert init js-->
   <script src="assets/js/pages/sweet-alerts.init.js"></script>


   <!-- Executando Botao Automatico -->
<script>

function click(id)
{
    var element = document.getElementById(id);
    if(element.click)
        element.click();
    else if(document.createEvent)
    {
        var eventObj = document.createEvent('MouseEvents');
        eventObj.initEvent('click',true,true);
        element.dispatchEvent(eventObj);
    }
}

click('sa-fornecedor');

</script>
			