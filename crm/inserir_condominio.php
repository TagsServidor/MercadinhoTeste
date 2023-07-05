
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

	 @$conn->query($insert = "INSERT INTO condominios (condominio_nome,condominio_sindico,condominio_cnpj,condominio_telefone,condominio_celular,condominio_email,condominio_cep,condominio_rua,condominio_numero,condominio_complemento,condominio_bairro, condominio_cidade,condominio_uf,condominio_informacoes,condominio_central,condominio_apartamentos) VALUES ('$_POST[nome]','$_POST[sindico]','$_POST[cnpj]','$_POST[telefone]','$_POST[celular]','$_POST[email]','$_POST[cep]', '$_POST[rua]', '$_POST[numero]', '$_POST[complemento]','$_POST[bairro]','$_POST[cidade]','$_POST[uf]','$_POST[informacoes]','$_POST[central]','$_POST[apartamentos]')");




?>

<button type="button" class="button"  id="sa-condominio"></button>

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

click('sa-condominio');

</script>