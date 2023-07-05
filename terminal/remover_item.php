<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;




include "bd/conexao.php";

@$conn->query("DELETE from carrinho where id_carrinho = '$_GET[id]' and cliente_carrinho = $id_cliente and status_carrinho = '1'  ");


header("Location:sacola.php");
die();
?>
