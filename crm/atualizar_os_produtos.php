<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

// PEGANDO DADOS DO USUARIO
$iduser = $_SESSION['id'];
$sqluser = "SELECT SQL_CACHE * FROM adm WHERE id = '$iduser'";
$exeuser = mysqli_query($conn, $sqluser);
$user = mysqli_fetch_array($exeuser);

// CONECTANDO A OS DE REPOSICAO

$sqlosp = "SELECT * FROM os_produtos  where os_produtos_os  = '$_POST[os]' and os_produtos_status ='1'  ";
$resultadoosp  = mysqli_query($conn, $sqlosp);
$totalosp  = mysqli_num_rows($resultadoosp);



// CONECTAR PRODUTOS UNIDADES PARA VERIFICAR SE JÁ EXISTE O PRODUTO CADASTRADO NESTA UNIDADE
$sqlpu= "SELECT * FROM produtos_unidades  where produto_unidade_produto  = '$_POST[produto]' and produto_unidade_status ='1' and produto_unidade_unidade ='$_POST[unidade]'  ";
$resultadopu  = mysqli_query($conn, $sqlpu);
$totalopu  = mysqli_num_rows($resultadopu);
$produtolinha = mysqli_fetch_array($resultadopu);


// CONECTAR PRODUTOS UNIDADES PARA VERIFICAR SE JÁ EXISTE O PRODUTO CADASTRADO NESTA UNIDADE
$sqlpr= "SELECT * FROM produtos p inner join os_produtos o on o.os_produtos_id = '$_POST[idosproduto]'  where p.id_produto = '$_POST[produto]'     ";
$resultadopr  = mysqli_query($conn, $sqlpr);
$linhaproduto = mysqli_fetch_array($resultadopr);


// INSERIR PRODUTO NA PRODUTOS UNIDADES CASO AINDA NÃO TENHA
if ($totalopu =='0') {
	
 @$conn->query($insert = "INSERT INTO produtos_unidades (produto_unidade_produto, produto_unidade_departamento, produto_unidade_categoria, produto_unidade_subcategoria, produto_unidade_codigobarras, produto_unidade_estoque, produto_unidade_valor, produto_unidade_lote, produto_unidade_vencimento, produto_unidade_os, produto_unidade_minimo, produto_unidade_maximo, produto_unidade_unidade ) VALUES ('$_POST[produto]','$linhaproduto[produto_departamento]','$linhaproduto[produto_categoria]','$linhaproduto[produto_subcategoria]','$linhaproduto[produto_codigobarras]','$linhaproduto[os_produtos_qtd]','$linhaproduto[os_produtos_valor]','$linhaproduto[os_produtos_lote]','$linhaproduto[os_produtos_vencimento]','$linhaproduto[os_produtos_os]','$linhaproduto[os_produtos_minima]','$linhaproduto[os_produtos_maxima]','$_POST[unidade]')");
	
} else { 

@$conn->query("update produtos_unidades set produto_unidade_estoque =  produto_unidade_estoque + '$linhaproduto[os_produtos_qtd]' , produto_unidade_minimo = '$linhaproduto[os_produtos_minima]' , produto_unidade_maximo = '$linhaproduto[os_produtos_maxima]' , produto_unidade_valor = '$linhaproduto[os_produtos_valor]' , produto_unidade_lote = '$linhaproduto[os_produtos_lote]' where id_produto_unidades ='$produtolinha[id_produto_unidades]'  ");


}



$sqlosp = "SELECT * FROM os_produtos  where os_produtos_os  = '$_POST[os]' and os_produtos_status ='1'  ";
$resultadoosp  = mysqli_query($conn, $sqlosp);
$totalosp  = mysqli_num_rows($resultadoosp);
if ($totalosp == '1') { 
@$conn->query("update os_reposicao set os_status =  '2'  where id_os_reposicao = '$_POST[os]' ");

}


@$conn->query("update os_produtos set os_produtos_status =  '2', os_produtos_r_data = '$data1' , os_produtos_r_quem = '$iduser'   where os_produtos_id = '$_POST[id]' ");


?>
