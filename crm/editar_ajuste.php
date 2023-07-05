
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

$logresgistro= 'Alterou quantidade de' .$_POST[qtd2]. 'para' .$_POST[qtd2] ;

@$conn->query("update alertas_reposicao set alerta_valor =  $_POST[qtd] where ir_alerta_reposicao = '$_POST[id]' ");

@$conn->query($insert = "INSERT INTO logs_ajustes (quem_log, motivo_log, ajuste_id, log_registro) VALUES ('$user[id]','$_POST[motivo]', '$_POST[id]', '$logresgistro')");


?>
<script>
window.location.href = "relatorio_ajustes_resumido/<?php echo $_POST[1]?>/<?php echo $_POST[de]?>/<?php echo $_POST[a]?>/<?php echo $_POST[4]?>";
</script> 