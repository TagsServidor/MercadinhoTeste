
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
/// INSERINDO NO BANCO DE DADOS
   $x=0;
   $vencimento 	 = $_POST['vencimento'];
  $valor = $_POST['valor'];
  $quant_linhas = count($vencimento);
  for ($i=0; $i<$quant_linhas; $i++) {
$x++;  
@$conn->query($insert = "INSERT INTO apagar (vencimento_apagar,valor_apagar,referente_apagar, condominio_apagar,unidade_apagar,fornecedor_apagar, parcela_apagar, parcelas_apagar) VALUES ('$vencimento[$i]','$valor[$i]','$_POST[referente]','$_POST[condominio]','$_POST[unidade]','$_POST[fornecedor]','$x','$quant_linhas')"); 
 
  }



?>

<button type="button" class="button"  id="sa-apagar"></button>

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

click('sa-apagar');

</script>
			
	
		