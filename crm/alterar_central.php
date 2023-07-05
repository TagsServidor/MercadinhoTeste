
<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
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



/// SALVANDO DADOS NO BANCO DE DADOS

@$conn->query("update centrais set central_nome =  '$_POST[nome]',
                                   central_cnpj =  '$_POST[cnpj]',
                                   central_telefone = '$_POST[telefone]',
                                   central_celular = '$_POST[celular]',
                                   central_email = '$_POST[email]',
                                   central_cep = '$_POST[cep]',
                                   central_rua = '$_POST[rua]',
                                   central_numero = '$_POST[numero]',
                                   central_complemento = '$_POST[complemento]',
                                   central_bairro = '$_POST[bairro]',
                                   central_cidade = '$_POST[cidade]',
                                   central_uf = '$_POST[uf]',
                                   central_informacoes = '$_POST[informacoes]'


where id_central = '$_POST[id]' ");




?>

<button type="button" class="button"  id="sa-centrals"></button>

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

click('sa-centrals');

</script>