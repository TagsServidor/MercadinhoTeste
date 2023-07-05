
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

@$conn->query("update fornecedores set fornecedor_nome =  '$_POST[nome]',
                                   fornecedor_cnpj =  '$_POST[cnpj]',
                                   fornecedor_telefone = '$_POST[telefone]',
                                   fornecedor_celular = '$_POST[celular]',
                                   fornecedor_email = '$_POST[email]',
                                   fornecedor_contato = '$_POST[contato]',
                                   fornecedor_cep = '$_POST[cep]',
                                   fornecedor_rua = '$_POST[rua]',
                                   fornecedor_numero = '$_POST[numero]',
                                   fornecedor_complemento = '$_POST[complemento]',
                                   fornecedor_bairro = '$_POST[bairro]',
                                   fornecedor_cidade = '$_POST[cidade]',
                                   fornecedor_uf = '$_POST[uf]',
                                   fornecedor_informacoes = '$_POST[informacoes]'


where id_fornecedor = '$_POST[id]' ");




?>

<button type="button" class="button"  id="sa-fornecedors"></button>

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

click('sa-fornecedors');

</script>