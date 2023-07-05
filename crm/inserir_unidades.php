
<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

// PEGANDO ENDEREÇO DA UNIDADE

$sql = "SELECT * FROM condominios where  id_condominio ='$_POST[condominio]'  ";
$resultado = mysqli_query($conn, $sql);
$linha=mysqli_fetch_array($resultado);

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

	 @$conn->query($insert = "INSERT INTO unidades (unidade_nome,unidade_cnpj,unidade_cep,unidade_rua,unidade_numero,unidade_complemento,unidade_bairro, unidade_cidade,unidade_uf,unidade_informacoes, unidade_condominio, unidade_central) VALUES ('$_POST[nome]','$_POST[cnpj]','$linha[condominio_cep]', '$linha[condominio_rua]', '$linha[condominio_numero]', '$linha[condominio_complemento]','$linha[condominio_bairro]','$linha[condominio_cidade]','$linha[condominio_uf]','$_POST[informacoes]','$_POST[condominio]','$linha[condominio_central]')");




?>

<button type="button" class="button"  id="sa-unidade"></button>

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

click('sa-unidade');

</script>