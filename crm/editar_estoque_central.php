
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

if ($_POST['excluir'] == '') {
$excluir = '1';
}
if ($_POST['excluir'] <> '') {
$excluir = $_POST[excluir];
    }

/// SALVANDO DADOS NO BANCO DE DADOS

@$conn->query("update produtos_central set central_produto_estoque =  '$_POST[qtd]',
                                   	central_produto_qtd_minima =  '$_POST[min]',
                                   central_produto_qtd_maxima = '$_POST[max]',
                                   central_produto_lote = '$_POST[lote]',
                                   central_produto_validade = '$_POST[vencimento]',
                                   produto_status_central = '$_POST[statusp]',
                                   produto_lixeira_central = '$excluir'
                               


where id_produto_central = '$_POST[id]' ");


@$conn->query($insert = "INSERT INTO logs_ajuste_estoque_central (quem_log,motivo_ajuste, produto_central) VALUES ('$user[id]','$_POST[motivo]', '$_POST[id]')");
?>

<script>
      alert("Alterado com sucesso!");
 
    window.location.href = "ver_estoque_central/8/#<?php echo $_POST[id] ?>";


</script>