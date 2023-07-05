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
                                    <h4 class="mb-0">Relatórios &gt; Estoque Central > Valor Estoque </h4> 

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
<th>Total Base Custo</th>
<th>Total Base Venda</th>
         
                        
												
												
											
                                            </tr> 
                                           
                                            </thead>
        
      	
                                            <tbody>
												
                     



<?php 
$totalcentral1 = '';
while ($linhapu = mysqli_fetch_array($resultadopu)) {


$sqltv34 = "SELECT *  FROM  entrada_produtos ep WHERE ep.entrada_produto =  $linhapu[central_produto] and ep.entrada_status = '2' order by ep.id_entrada desc    ";
$resultadotv34 = mysqli_query($conn, $sqltv34);
$totalvendasg34 = mysqli_fetch_array($resultadotv34);
	
$totalcentral1 = $linhapu[central_produto_estoque] * $totalvendasg34[entrada_unitario];
$totalcentral1v = $linhapu[central_produto_estoque] * $totalvendasg34[entrada_venda];

												?>

	


						         <tr>
<td><?php echo $linhapu['central_produto_estoque'] ?></td>
<td><?php echo $linhapu['produto_nome'] ?> </td>
<td><?php echo $totalcentral1;?></td>
<td><?php echo $totalcentral1v; ?></td>
						
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
    
    
        order: [3, 'desc'],

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