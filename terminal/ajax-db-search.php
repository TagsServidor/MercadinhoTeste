<?php
include("bd/conexao.php");
    if (isset($_GET['produto_nome'])) {
         
        $sql = "SELECT * FROM 'produtos' WHERE 'id_produto' LIKE '{$_GET['produto_nome']}%' LIMIT 25";
    
        $resultadodp = mysqli_query($conn, $sql);
     
        if (mysqli_num_rows($resultadodp) > 0) {
         while ($nomeproduto = mysqli_fetch_array($resultadodp)) {
          $res[] = $nomeproduto['produto_nome'];
         }
        } else {
          $res = array();
        }
        //return json res
        echo json_encode($res);
    }
    ?>