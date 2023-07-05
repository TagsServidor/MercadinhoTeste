<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

?>

<?php 

if ($_POST[unidade] <> '0') { 
$result_vendas = "SELECT * FROM produtos_unidades where produto_unidade_unidade = '$_POST[unidade]' and produto_unidade_produto = '$_POST[produto]' ";
$resultado_vendas = mysqli_query($conn, $result_vendas);
$rows_vendas = mysqli_fetch_assoc($resultado_vendas);
} else {
    $result_vendas = "SELECT * FROM produtos_unidades where  produto_unidade_produto = '$_POST[produto]' order by id_produto_unidades desc";
    $resultado_vendas = mysqli_query($conn, $result_vendas); 
    $rows_vendas = mysqli_fetch_assoc($resultado_vendas);   
}

/// INSERINDO DADOS NO BANCO DE DADOS

	 @$conn->query($insert = "INSERT INTO promocoes (promo_nome, promo_unidade, promo_valor, promo_produto, promo_inicio, promo_fim, promo_local, valor_original ) VALUES ('$_POST[nome]','$_POST[unidade]', '$_POST[valor]' , '$_POST[produto]' , '$_POST[inicio]',  '$_POST[fim]' ,  '$_POST[local]' , '$rows_vendas[produto_unidade_valor]')");
    //var_dump($insert);
?>
<script>

alert("Promoção cadastrada com sucesso");
window.location.href = "listar_promocoes";

</script>