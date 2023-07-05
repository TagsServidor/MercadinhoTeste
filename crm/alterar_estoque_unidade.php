<?php
@session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";



$produtos = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($produtos);

foreach($produtos['produto'] as $produto_id => $preco){
    //echo "Id do produto: $produto_id <br>";
    //echo "Preço do produto: $preco <br>";

    $query_produto = "UPDATE produtos_unidades SET produto_unidade_estoque=:preco WHERE id_produto_unidades=:produto_id";
    $up_produto = $conn2->prepare($query_produto);
    $up_produto->bindParam(':preco', $preco);
    $up_produto->bindParam(':produto_id', $produto_id);
    $up_produto->execute();
}

?>

<script>

alert("Estoque atualizado com sucesso!");
window.location.href = "perfil_unidade/<?php echo $_POST['unidade'] ?>";

</script>