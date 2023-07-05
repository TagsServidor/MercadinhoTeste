<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS

?>



<?php 


	
// SOMANDA VALORES DE TOTTEM	
$sqltv = "SELECT SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_local = '$_POST[local]'   and pedido_status ='2' and pedido_local ='1'    ";
$resultadotv = mysqli_query($conn, $sqltv);
$linhatv = mysqli_fetch_array($resultadotv);
	
	
	if ($_POST[local] == '2') { 	
// SOMANDA VALORES DE APP	cartao
$sqltva = "SELECT SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_local = '2'  and pedido_pagamento = 'CreditCard' and pedido_status ='2' and pedido_local ='2'    ";
$resultadotva = mysqli_query($conn, $sqltva);
$linhatva = mysqli_fetch_array($resultadotva);
	} 

	
		if ($_POST[local] == '3') { 	
// SOMANDA VALORES DE APP	pix
$sqltva = "SELECT SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_local = '2'  and pedido_pagamento = 'PIXAPP' and pedido_status ='2' and pedido_local ='2'    ";
$resultadotva = mysqli_query($conn, $sqltva);
$linhatva = mysqli_fetch_array($resultadotva);
	} 
	
	
	if ( $_POST[local] == '1') { 
	
$result_vendas = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_local = '1' and   p.pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'   and p.pedido_status ='2' order by p.pedido_data  desc ";

}

	if ( $_POST[local] == '2') { 
	
$result_vendas = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_local = '2' and p.pedido_pagamento = 'CreditCard' and   p.pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'   and p.pedido_status ='2' order by p.pedido_data  desc ";

}

	if ( $_POST[local] == '3') { 
	
$result_vendas = "SELECT * FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   INNER JOIN condominios c on u.unidade_condominio = c.id_condominio 
INNER JOIN clientes ci on p.pedido_cliente = ci.id_cliente where p.pedido_local = '2' and p.pedido_pagamento = 'PIXAPP' and   p.pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'   and p.pedido_status ='2' order by p.pedido_data  desc ";

}
	
	
	
$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
?>
<head>
 <title>Vendas de  registradas no periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> <?php if ($_POST['unidade'] =='') { } else { ?> - Unidade: <?php echo $linhau['unidade_nome'] ?> <?php } ?> </title>
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
                                    <h4 class="mb-0">Financeiro &gt; Vendas &gt; Local</h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
                <div class="container-fluid">
                 <form action="vendas_periodo_local" method="post">
											   <input type="hidden" value="sim" required name="exportarvendas">  
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
													 <select class="form-control" name="local" required>
															   <option>Informe</option>
															   <option value="1">Terminal</option>
															   <option value="2">APP Cartão</option>
															    <option value="3">APP Pix</option>
												     </select>
													 </span></div>
												   
												   <div class="col-3">  
															 <label>&nbsp;<br></label><br>
											<button class="btn btn-info"> Listar </button>
												   </div>
												   
												   </div>
											
											</form>
                  
  <br><br>
               
					
					
					
					
					
				<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body"> <h4 class="card-title">Temos um total de (<?php echo $total_vendas2 ?>) vendas  registradas no periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> à <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> <?php if ($_POST['unidade'] =='') { } else { ?> - Unidade: <?php echo $linhau['unidade_nome'] ?> <?php } ?>  </h4>
        <h4 class="card-title"> 
        
        <?php if ( $_POST[local] == '1') {  ?> (<strong>Total das vendas Totem  </strong> R$<?php echo $linhatv['pedido_valor'] ?>
        <?php } ?>
        
        <?php if ( $_POST[local] == '2') {  ?>
        <strong> Total das vendas APP Cartão </strong> R$<?php echo $linhatva['pedido_valor'] ?>
           <?php } ?>
        
           <?php if ( $_POST[local] == '3') {  ?>
        <strong> Total das vendas APP PIX </strong> R$<?php echo $linhatva['pedido_valor'] ?>
           <?php } ?>
        
        
                                      </h4>
                                        <p class="card-title-desc">
                                        </p>
        
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                              <th>Reg.</th>
                                                <th>Data</th>
							 <th>Unidade</th>
							 <th>Cliente</th>
                          <th>Valor</th>
							 <th>Forma</th>
                        
												
												
											
                                            </tr> 
                                           
                                            </thead>
        
      	
                                            <tbody>
												
												
												
<?php while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)){ ?>

												
                                            <tr><td><?php echo $rows_vendas['id_pedido']; ?>
                                            </td>
                                                <td><?php echo date('d/m/Y', strtotime($rows_vendas['pedido_data'])); ?> - <?php echo date('H:i', strtotime($rows_vendas['pedido_hora'])); ?> </td>
					   <td><?php echo $rows_vendas['unidade_nome'] ?></td>
							 <td><?php  if ($rows_vendas['cliente_nome']  == '') { ?> Não informado <?php } ?> <?php echo $rows_vendas['cliente_nome'] ?></td>
                          <td>R$ <?php echo $rows_vendas['pedido_valor'] ?></td>
							<td> <span style="width: 15px;">
<?php if ($rows_vendas['pedido_pagamento'] =='CreditCard') { ?>
Cartão
<?php } ?>
<?php if ($rows_vendas['pedido_pagamento'] =='PIXAPP') { ?>
Pix (Pagseguro)
<?php } ?>
</span> </td>
	 					
							
                         
                          
							
							
							
                        </tr>        
                                   <?php } ?>
                                            </tbody>
											
											
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->








               
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
        order: [0, 'desc'],

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