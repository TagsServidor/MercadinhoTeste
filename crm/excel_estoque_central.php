<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$sql = "SELECT * FROM aletar_motivos WHERE id_alerta ='$id' ";
$resultado = mysqli_query($conn, $sql);
$linhacat = mysqli_fetch_array($resultado);


?>



<?php 

/// CONECTANDO OS PRODUTOS

$sql = "SELECT * FROM centrais where id_central = '$id' ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);


$sqlpu = "SELECT * FROM produtos_central pc INNER JOIN produtos p ON pc.central_produto = p.id_produto where pc.central_produto_central = $id  and pc.produto_lixeira_central = '1'   order by  pc.produto_status_central asc";
$resultadopu = mysqli_query($conn, $sqlpu);
$totalopu = mysqli_num_rows($resultadopu);	
?>

<head>
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
                                    <h4 class="mb-0">Relatórios &gt; Estoque Central > Exportar em PDF </h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           <?php if ($id == '1') { ?>
                                       <a target="_blank" href="honestidade.php?unidade=<?php echo $id4 ?>&inicio=<?php echo $id2 ?>&fim=<?php echo $id3 ?>"> <buttom class="btn btn-info btn-warning"> Imprimir Indice </buttom> </a>
                                        <?php } ?>
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
              
					<div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                     <h4 class="card-title"><?php echo $linhacat[alerta_nome] ?> periodo de <?php echo date('d/m/Y', strtotime($id2)); ?> à <?php echo date('d/m/Y', strtotime($id3)); ?> <?php if ($id4 =='') { ?> Geral <?php } else { ?> - Unidade: <?php echo $linhauu['unidade_nome'] ?> <?php } ?>  </h4><br>
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                             
<th>Estoque</th>
<th>Produto</th>
<th>Fornecedor</th>
<th>Min.</th>
<th>Max.</th>
<th>Nivel</th>          
 <th>Status</th>                          
												
												
											
                                            </tr> 
                                           
                                            </thead>
        
      	
                                            <tbody>
												
                     



<?php 

while ($linhapu = mysqli_fetch_array($resultadopu)) {

	

$sqlproduto = "SELECT *  FROM entrada_produtos ep LEFT JOIN fornecedores f ON ep.entrada_fornecedor = f.id_fornecedor where ep.entrada_produto = $linhapu[central_produto]  ";
$sqlprodutos = mysqli_query($conn, $sqlproduto);
$produto = mysqli_fetch_array($sqlprodutos );
	
	
	
												?>

	


						         <tr>
<td><?php echo $linhapu['central_produto_estoque'] ?></td>
<td><?php echo $linhapu['produto_nome'] ?> </td>
<td><?php echo $produto ['fornecedor_nome'] ?> </td>
<td><?php echo $linhapu['central_produto_qtd_minima'] ?></td>
<td><?php echo $linhapu['central_produto_qtd_maxima'] ?></td>							 
<td style="width:5%" ><?php if ($linhapu['central_produto_estoque'] <=  $linhapu['central_produto_qtd_minima']) { ?>  <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: $fff"></i> Baixo</button> <?php } ?> <?php if ($linhapu['central_produto_estoque'] >  $linhapu['central_produto_qtd_minima']) { ?>  <button type="button" class="btn btn-success btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color: $fff"></i>Ok </button> <?php } ?>
	 <td><?php if ($linhapu['produto_status_central'] == '2') { ?>Inativo <?php } ?><?php if ($linhapu['produto_status_central'] == '1') { ?>Ativo <?php } ?></td>					
							
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
            {
                extend: 'pdf',
                text: 'Exportar em pdf',"className": 'btn btn-info btn-xs',
                title: 'Estoque central',
            },
                
            
       
          
            {
                extend: 'excel',
                text: 'Exportar em excel',"className": 'btn btn-success btn-xs',
                title: 'Estoque central',
            },
            {
                extend: 'print',
                text: 'Imprimir',"className": 'btn btn-primary btn-xs',
                title: 'Estoque central',
            },
    ],
    
    
        order: [1, 'asc'],

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