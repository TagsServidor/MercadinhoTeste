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


if  ($_POST['acao'] == 'A') { 

$sqlavencido="SELECT * FROM alertas_reposicao  where  alerta_unidade = '$_POST[unidade]' and alerta_produto_unidade = '$_POST[id]' and alerta_data = '$data1' and alerta_motivo = '14'     ";
$resultadoavencido  = mysqli_query($conn, $sqlavencido);
$totalavencido = mysqli_num_rows($resultadoavencido); 

}

if  ($_POST['acao'] == 'R') { 

    $sqlavencido="SELECT * FROM alertas_reposicao  where  alerta_unidade = '$_POST[unidade]' and alerta_produto_unidade = '$_POST[id]' and alerta_data = '$data1' and alerta_motivo = '9'     ";
    $resultadoavencido  = mysqli_query($conn, $sqlavencido);
    $totalavencido = mysqli_num_rows($resultadoavencido); 
    
    }


/// INSERINDO DADOS NO BANCO DE DADOS

if (($totalavencido == '0') and ($_POST['acao'] == 'R'))  { 

@$conn->query($insert = "INSERT INTO alertas_reposicao (alerta_id_os, alerta_motivo, 
alerta_estoque_deveria,alerta_observacoes,alerta_repositor, alerta_data, alerta_hora, alerta_unidade, alerta_produto_unidade, alerta_produto, alerta_valor) 
VALUES ('0','9','$_POST[deveria]','$_POST[observacoes]','$iduser','$data1','$hora2',
'$_POST[unidade]','$_POST[id]','$_POST[produto]','$_POST[retirada]')");

}

if (($totalavencido == '0') and ($_POST['acao'] == 'A'))  { 

    @$conn->query($insert = "INSERT INTO alertas_reposicao (alerta_id_os, alerta_motivo, 
    alerta_estoque_deveria,alerta_observacoes,alerta_repositor, alerta_data, alerta_hora, alerta_unidade, alerta_produto_unidade, alerta_produto, alerta_valor) 
    VALUES ('0','14','$_POST[deveria]','$_POST[observacoes]','$iduser','$data1','$hora2',
    '$_POST[unidade]','$_POST[id]','$_POST[produto]','$_POST[retirada]')");
    
    }

if (($totalavencido == '0') and ($_POST['acao'] == 'R'))  { 
@$conn->query("update produtos_unidades set produto_unidade_estoque =  produto_unidade_estoque - '$_POST[retirada]'   where id_produto_unidades = '$_POST[id]' ");
@$conn->query("update produtos_central set central_produto_estoque =  central_produto_estoque + '$_POST[retirada]'   where central_produto = '$_POST[produto]'  ");

}

if (($totalavencido == '0') and ($_POST['acao'] == 'A'))  { 
    @$conn->query("update produtos_unidades set produto_unidade_estoque =  produto_unidade_estoque + '$_POST[retirada]'   where id_produto_unidades = '$_POST[id]' ");
    
    }

?>
