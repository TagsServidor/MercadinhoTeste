<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

@session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";



$produtos = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($produtos);
$x=0;
foreach($_POST['produto'] as $produto_id => $preco){
$x++;
$id = $_POST[produto][$preco];
$barras = $_POST[barras][$preco];
$venda = $_POST[valor][$preco];
$custo = $_POST[valorcusto][$preco];
//var_dump($id);




if(@$_POST[excluir][$preco] == '') {
@$lixeira = '1';
}
if(@$_POST[excluir][$preco] <> '') {
    @$lixeira = @$_POST[excluir][$preco];
}

  @$status = $_POST[desativar][$preco];
  


  $query_produto = "UPDATE produtos SET produto_codigobarras = $barras, produto_status = $status WHERE id_produto=$id";
  $up_produto = $conn2->prepare($query_produto);
  $up_produto->execute();


  $query_produto2 = "UPDATE entrada_produtos SET entrada_venda = $venda, entrada_unitario = $custo WHERE entrada_produto=$id  order by id_entrada DESC ";
  $up_produto2 = $conn2->prepare($query_produto2);
  $up_produto2->execute();


  $query_produto3 = "UPDATE produtos_unidades SET produto_unidade_valor = $venda, produto_unidade_codigobarras = $barras, produto_unidade_status = $status WHERE produto_unidade_produto=$id  ";
  $up_produto3 = $conn2->prepare($query_produto3);
  $up_produto3->execute();



    
}

?>

<script>

alert("Atualização realizada com sucesso!");
window.location.href = "editar_produto_massa";

</script>