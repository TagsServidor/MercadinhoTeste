
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

@$conn->query("update entrada_produtos set entrada_qtd =  '$_POST[qtd]',
                                   entrada_qtd_minima =  '$_POST[min]',
                                   entrada_qtd_maxima = '$_POST[max]',
                                   entrada_lote = '$_POST[lote]',
                                   entrada_venda = '$_POST[valor]'
                                 
                               


where id_entrada = '$_POST[id]' ");




?>

<script>
      alert("Alterado com sucesso!");
 
    window.location.href = "listar_entradas";


</script>