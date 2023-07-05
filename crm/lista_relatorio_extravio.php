<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS

?>



<?php 

if ($_POST[unidade] <> '') { 
	
$result_vendas = "SELECT  SUM(alerta_estoque_deveria - alerta_estoque_encontrado) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_unidade = $_POST[unidade] and alerta_motivo = '1' group by alerta_produto ";

	$sqluu = "SELECT * FROM unidades where id_unidade = $_POST[unidade]  ORDER BY unidade_nome";
$resultadouu = mysqli_query($conn, $sqluu);
$linhauu=mysqli_fetch_array($resultadouu);
	} else {
	
$result_vendas = "SELECT  SUM(alerta_estoque_deveria - alerta_estoque_encontrado) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_motivo = '1' group by alerta_produto ";
	
}


$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);

?><head>
</head>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
 
   <script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


 <!-- Select com Busca-->
 



<link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>

  <!-- Responsive Table css -->
        <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

<!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />   
					

				


					


                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Relatorios &gt; Extravios </h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
                <div class="container-fluid">
                 <form action="#" method="post">
											   <input type="hidden" value="sim" name="exportarextravio">
					 <input type="hidden" value="<?php echo $_POST['unidade'] ?>" name="unidade"> 
											   <div class="row"> 
												   
												<div class="col-3">    <label><strong>Inicio:</strong></label>
											<input type="date" class="form-control" required name="inicio"> 
												   </div>
												   
														<div class="col-3">  
															 <label><strong>Fim:</strong></label>
											<input type="date" class="form-control" required name="fim">
												   </div>
												   
												   <div class="col-3">  
													 <label><strong>Unidade:</strong></label>
															 <span class="mb-3">
															 <?php // listando em um box os instrutores

			  echo "<SELECT NAME='unidade' SIZE='1' class='form-control' >

<OPTION VALUE='' SELECTED> Geral ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM unidades where unidade_status ='1'  ORDER BY unidade_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_unidade']."'>".($linha['unidade_nome']);
}
echo "</SELECT>";

?>
															 </span></div>
												   
												   <div class="col-3">  
															 <label>&nbsp;<br></label><br>
											<button class="btn btn-info"> Listar </button>
												   </div>
												   
												   </div>
											
											</form>
                  
 </div> <br><br>
					<div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                     <h4 class="card-title">Extravio periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> à <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> <?php if ($_POST['unidade'] =='') { ?> Geral <?php } else { ?> - Unidade: <?php echo $linhauu['unidade_nome'] ?> <?php } ?><a href="honestidade.php?unidade=<?php echo $_POST[unidade] ?>&inicio=<?php echo $_POST[inicio] ?>&fim=<?php echo $_POST[fim] ?>" target="_blank" > IMPRIMIR </a></h4>
                     <br>
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                             
                                                <th>Produto</th>
							 <th>Qtd Extravio</th>
							 <th>Valor total</th>
                          
                        
												
												
											
                                            </tr> 
                                           
                                            </thead>
        
      	
                                            <tbody>
												
                     



<?php while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)){ 

	

$sqlproduto = "SELECT *  FROM produtos where id_produto = $rows_vendas[alerta_produto]  ";
$sqlprodutos = mysqli_query($conn, $sqlproduto);
$produto = mysqli_fetch_array($sqlprodutos );
	
$sqlva = "SELECT *  FROM os_produtos where os_produtos_id = $rows_vendas[alerta_produto_unidade]  ";
$sqlpva= mysqli_query($conn, $sqlva);
$produtou = mysqli_fetch_array($sqlpva);
$totalitem = $rows_vendas['qtd'] * 	$produtou['os_produtos_valor'];	
$totalprejuizo += $totalitem;		
	
	
												?>

							
						         <tr><td><?php echo $produto['produto_nome'] ?> 
                                            </td>
                                                <td><?php echo $rows_vendas[qtd] ?> </td>
					   <td>R$ <?php echo $totalitem ?></td>
							 
	 					
							
                         
                          
							
							
							
												</tr>
													
							
							 


	<?php } ?>
	
	</tbody>
                    </table>



               
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
        
	
	<script>
	
	$(document).ready(function () {
	
    $('#datatable-buttons').DataTable({
		
		buttons: [
         'excel', 'pdf',
			
    ],
        order: [1, 'desc'],

    });
})
	
		

		
	</script>
	
	
	
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