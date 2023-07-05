
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

@$conn->query("update produtos_unidades set produto_unidade_estoque =  '$_POST[qtd]',
                                   	produto_unidade_minimo =  '$_POST[min]',
                                   produto_unidade_maximo = '$_POST[max]',
                                   produto_unidade_lote = '$_POST[lote]',
                                  produto_unidade_codigobarras = '$_POST[barras]',
								  produto_unidade_valor = '$_POST[valor]'
                                 
                               


where id_produto_unidades = '$_POST[id]' ");


@$conn->query($insert = "INSERT INTO logs_ajuste_estoque_unidade (quem_ajuste,motivo_ajuste, produto_unidade) VALUES ('$user[id]','$_POST[motivo]', '$_POST[id]')");


?>

<script>
      alert("Alterado com sucesso!");
 
    window.location.href = "ver_estoque_unidade/<?php echo $_POST['unidade'] ?>";


</script>