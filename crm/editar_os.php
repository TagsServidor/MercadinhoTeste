
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

@$conn->query("update os_produtos set os_produtos_qtd =  '$_POST[qtd]',
                                   	os_produtos_minima =  '$_POST[min]',
                                   os_produtos_maxima = '$_POST[max]',
                                   os_produtos_lote = '$_POST[lote]',
                                  os_produtos_valor = '$_POST[valor]'
                                 
                               


where os_produtos_id = '$_POST[id]' ");




?>

<script>
      alert("Alterado com sucesso!");
 
    window.location.href = "relatorio_centrais";


</script>