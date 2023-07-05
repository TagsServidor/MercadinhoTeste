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
?>
<script src="assets/js/jquery.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


 <!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>

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

$estoque = $_POST['deveria'] - $_POST['encontrada'] ; 

$sqllog= "SELECT * FROM alertas_reposicao  where alerta_id_os = '$_POST[idos]' and alerta_unidade = '$_POST[unidade]' and alerta_produto_unidade = '$_POST[idosproduto]'      ";
$resultadolog  = mysqli_query($conn, $sqllog);
$totallog = mysqli_num_rows($resultadolog); 





/// INSERINDO DADOS NO BANCO DE DADOS
if ($totallog == '0') { 
	 @$conn->query($insert = "INSERT INTO alertas_reposicao (alerta_id_os, alerta_motivo,alerta_estoque_encontrado, alerta_qtd_reposta, alerta_estoque_deveria,alerta_observacoes,alerta_repositor, alerta_data, alerta_hora, alerta_unidade, alerta_produto_unidade, alerta_produto  ) VALUES ('$_POST[idos]','$_POST[alerta]','$_POST[encontrada]','$_POST[reposta]','$_POST[deveria]','$_POST[observacoes]','$iduser','$data1','$hora2','$_POST[unidade]','$_POST[idosproduto]','$_POST[produto]')");
}


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


    if ($totallog == '0') { 
@$conn->query("update produtos_unidades set produto_unidade_estoque =  '$estoque' , produto_unidade_minimo = '$linhaproduto[os_produtos_minima]' , produto_unidade_maximo = '$linhaproduto[os_produtos_maxima]' ,  produto_unidade_lote = '$linhaproduto[os_produtos_lote]' where id_produto_unidades ='$produtolinha[id_produto_unidades]'  ");

}
}



$sqlosp = "SELECT * FROM os_produtos  where os_produtos_os  = '$_POST[os]' and os_produtos_status ='1'  ";
$resultadoosp  = mysqli_query($conn, $sqlosp);
$totalosp  = mysqli_num_rows($resultadoosp);
if ($totalosp == '1') { 
@$conn->query("update os_reposicao set os_status =  '2'  where id_os_reposicao = '$_POST[os]' ");

}



?>
ok
<script>

alert("Atualizado com Sucesso!");
window.location.href = "ver_os/<?php echo $_POST['os'] ?>/<?php echo $_POST['unidade'] ?>";

</script>


<!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>		
					
         <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>
        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
        <script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script>