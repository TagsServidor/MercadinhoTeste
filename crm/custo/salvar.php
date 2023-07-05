<?php

include "../bd/conexao.php";



$produtos = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($produtos);

foreach($produtos['produto'] as $produto_id => $preco){
    echo "Id do produto: $produto_id <br>";
    echo "Preço do produto: $preco <br>";

    $query_produto = "UPDATE os_produtos SET os_custo_total = '$preco' WHERE os_produtos_id='$produto_id'";
    $up_produto = $conn2->prepare($query_produto);
    $up_produto->execute();
}

?>

<script>

alert("Estoque atualizado com sucesso!");

</script>