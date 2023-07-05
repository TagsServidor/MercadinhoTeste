
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

$sqlosp = "SELECT * FROM entrada_produtos  where entrada_status ='1' and entrada_produto = '$_POST[produto]'  ";
$resultadoosp  = mysqli_query($conn, $sqlosp);
$totalosp  = mysqli_num_rows($resultadoosp);

if ($totalosp == '0') { 

/// INSERINDO DADOS NO BANCO DE DADOS

	 @$conn->query($insert = "INSERT INTO entrada_produtos (entrada_central, entrada_produto, entrada_unitario,entrada_qtd, 
     entrada_data, entrada_lote, entrada_vencimento, entrada_quem, entrada_observacoes, entrada_fornecedor, entrada_venda, entrada_estoque,
     entrada_qtd_minima,entrada_qtd_maxima) VALUES ('$_POST[central]','$_POST[produto]', '$_POST[valorun]','$_POST[qtd]',
     '$_POST[entrada]','$_POST[lote]','$_POST[vencimento]','$user[id]','$_POST[observacoes]','$_POST[fornecedor]','$_POST[valorvenda]','$_POST[qtd]',
     '$_POST[minima]','$_POST[maxima]')");
}

?>

<button type="button" class="button"  id="sa-estoqueentrada"></button>

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

click('sa-estoqueentrada');

</script>
