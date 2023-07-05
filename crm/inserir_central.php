
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



/// INSERINDO DADOS NO BANCO DE DADOS

	 @$conn->query($insert = "INSERT INTO centrais (central_nome,central_cnpj,central_telefone,central_celular,central_email,central_cep,central_rua,central_numero,central_complemento,central_bairro, central_cidade,central_uf,central_informacoes) VALUES ('$_POST[nome]','$_POST[cnpj]','$_POST[telefone]','$_POST[celular]','$_POST[email]','$_POST[cep]', '$_POST[rua]', '$_POST[numero]', '$_POST[complemento]','$_POST[bairro]','$_POST[cidade]','$_POST[uf]','$_POST[informacoes]')");




?>

<button type="button" class="button"  id="sa-central"></button>

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

click('sa-central');

</script>