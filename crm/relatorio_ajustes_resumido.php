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

if ($id4 <> '') { 
	
$result_vendas = "SELECT  SUM(alerta_valor) AS qtd , alerta_valor, alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade, ir_alerta_reposicao  FROM alertas_reposicao where alerta_data BETWEEN '$id2' AND ' $id3' and alerta_unidade = $id4 and alerta_motivo = '$id' and alerta_valor <> '0'  group by alerta_produto ";
        
$sqluu = "SELECT * FROM unidades where id_unidade = $id4  ORDER BY unidade_nome";
$resultadouu = mysqli_query($conn, $sqluu);
$linhauu=mysqli_fetch_array($resultadouu);
} else {
            
$result_vendas = "SELECT  SUM(alerta_valor) AS qtd , alerta_valor,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade, ir_alerta_reposicao  FROM alertas_reposicao where alerta_data BETWEEN '$id2' AND ' $id3' and alerta_motivo = '$id' and alerta_valor <> '0' group by alerta_produto ";
            
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
                                    <h4 class="mb-0">Relatórios &gt; Ajustes > Resumido </h4> 

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
                                             
                                                <th>Produto</th>
							 <th>Qtd</th>
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


$totalitem = $rows_vendas['qtd'] * $produtou['os_produtos_valor'];	
$totalprejuizo += $totalitem;		
	
	
												?>

	
<!-- Center Modal example -->
<div class="modal fade bs-example-modal-center<?php echo $rows_vendas['ir_alerta_reposicao'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel<?php $rows_vendas[ir_alerta_reposicao] ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Center modal</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
<form method="post" action= "editar_ajuste">
<div class="row">
<div class="col-12">
<label> Quantidade </label>
<input type="text" class="form-control" name="qtd"  value = <?php echo $rows_vendas[qtd] ?>   required>
</div>

<div class="col-12">
<label> Motivo do ajuste </label>
<input type="text" class="form-control" name="motivo" required>
</div>
</p>
<div class="col-12">
<input type="submit" value="Salvar" class="btn btn-info">

</div>
<input type="hidden" class="form-control" name="1" value="<?php echo $id ?>" required>
<input type="hidden" class="form-control" name="de" value="<?php echo $id2 ?>" required>
<input type="hidden" class="form-control" name="a" value="<?php echo $id3 ?>" required>
<input type="hidden" class="form-control" name="4" value="<?php echo $id4 ?>" required>
<input type="hidden" class="form-control" name="id" value="<?php echo $rows_vendas['ir_alerta_reposicao'] ?>" required>
<input type="hidden" class="form-control" name="qtd2" value="<?php echo $rows_vendas[qtd] ?>" required>



</div>

</form>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->




						         <tr><td>


 <?php echo $produto['produto_nome'] ?> 
                                            </td>
<td><?php echo $rows_vendas[qtd] ?> </td>



					   <td><?php echo $totalitem ?></td>
							 
	 					
							
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
                title: '<?php echo $linhacat[alerta_nome] ?>  -  <?php echo date('d/m/Y H:i:s', strtotime($id2)); ?>  à <?php echo date('d/m/Y H:i:s', strtotime($id3)); ?> - <?php if ($id4['unidade'] =='') { ?> Geral <?php } else { ?> Unidade: <?php echo $linhauu['unidade_nome'] ?>  <?php } ?> - Valor Total:  R$<?php echo number_format($totalprejuizo, 2, ',', '.');  ?> ',
            },
                
            
       
          
            {
                extend: 'excel',
                text: 'Exportar em excel',"className": 'btn btn-success btn-xs',
                title: '<?php echo $linhacat[alerta_nome] ?>  -  <?php echo date('d/m/Y H:i:s', strtotime($id2)); ?>  à <?php echo date('d/m/Y H:i:s', strtotime($id3)); ?> - <?php if ($id4 =='') { ?> Geral <?php } else { ?> Unidade: <?php echo $linhauu['unidade_nome'] ?>  <?php } ?> - Valor Total:  R$<?php echo number_format($totalprejuizo, 2, ',', '.');  ?> ',
            },
            {
                extend: 'print',
                text: 'Imprimir',"className": 'btn btn-primary btn-xs',
                title: '<span style="font-size: 22px"> <?php echo $linhacat[alerta_nome] ?>  -  <?php echo date('d/m/Y H:i:s', strtotime($id2)); ?>  à <?php echo date('d/m/Y H:i:s', strtotime($id3)); ?> - <?php if ($id4 =='') { ?> Geral <?php } else { ?> Unidade: <?php echo $linhauu['unidade_nome'] ?> <?php } ?> </span> <span style="font-size: 14px"> <br> Valor Total:  R$<?php echo number_format($totalprejuizo, 2, ',', '.');  ?>  ',
            },
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