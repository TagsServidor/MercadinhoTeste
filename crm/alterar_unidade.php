
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

@$conn->query("update unidades set unidade_nome =  '$_POST[nome]',
                                   unidade_cnpj =  '$_POST[cnpj]',
                                   unidade_telefone = '$_POST[telefone]',
                                   unidade_celular = '$_POST[celular]',
                                   unidade_email = '$_POST[email]',
                                   unidade_cep = '$_POST[cep]',
                                   unidade_rua = '$_POST[rua]',
                                   unidade_numero = '$_POST[numero]',
                                   unidade_complemento = '$_POST[complemento]',
                                   unidade_bairro = '$_POST[bairro]',
                                   unidade_cidade = '$_POST[cidade]',
                                   unidade_uf = '$_POST[uf]',
                                   unidade_informacoes = '$_POST[informacoes]',
								   unidade_condominio = '$_POST[condominio]'


where id_unidade = '$_POST[id]' ");




?>

<button type="button" class="button"  id="sa-unidades"></button>

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

click('sa-unidades');

</script>