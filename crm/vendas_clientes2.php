	<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}


/// CONECTANDO AOS PEDIDOS
$sqlu = "SELECT * FROM unidades where id_unidade = $id  ";
$resultadou = mysqli_query($conn, $sqlu);
$linhau = mysqli_fetch_array($resultadou);

if($_POST[unidade] == '') { 
$sql = "SELECT count(*) as qtd, SUM(pedido_valor) AS pedido_valor, cliente_nome, cliente_unidade FROM pedidos p inner join clientes c on p.pedido_cliente = c.id_cliente where c.cliente_nome <> '' and p.pedido_status = '2' and  pedido_data2  BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' group by p.pedido_cliente     ";
} else {
    $sql = "SELECT count(*) as qtd, SUM(pedido_valor) AS pedido_valor, cliente_nome, cliente_unidade FROM pedidos p inner join clientes c on p.pedido_cliente = c.id_cliente where c.cliente_nome <> '' and p.pedido_status = '2' and  pedido_data2  BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_unidade = $_POST[unidade] group by p.pedido_cliente     ";

//WHERE pedidos_status ='2' and  pedido_data2  BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' group by pedido_cliente 
}

$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	




$sqltv = "SELECT * FROM unidades WHERE id_unidade  = '$_POST[unidade]'      ";
$resultadotv = mysqli_query($conn, $sqltv);
$linhatv = mysqli_fetch_array($resultadotv);
?>

<style>
	.esconderbarras {
		font-size: 0px;
	}

</style>
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

				






				

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Relatórios  &gt; Vendas por clientes
                                        <?php if ($_POST['unidade'] =='') { } else { ?>
                                        <?php } ?>
                                    </span></h4> 

                                    <div class="page-title-right">
										 
                                        <ol class="breadcrumb m-0">
                                        <a href="produtos_vendidos"> <button class="btn btn-outline-success btn-sm" type="submit">Realizar Nova Consulta</button>  </a>&nbsp;
<?php 
if ($_POST[unidade] <>'') { 
?>
    <a href="perfil_unidade/<?php echo $linhatv['id_unidade'] ?>"> <button class="btn btn-outline-info btn-sm" type="submit">Relatórios Gerais Unidade:  <?php echo $linhatv['unidade_nome'] ?></button> </a>
<?php } ?>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                  
                <div class="container-fluid">
                
                  
 </div> 
               
					
					

				<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h5 class="mb-0"><span class="card-title">Período de <?php echo date('d/m/Y H:i:s', strtotime($_POST['inicio'])); ?>  à <?php echo date('d/m/Y H:i:s', strtotime($_POST['fim'])); ?> - <?php if ($_POST['unidade'] =='') { ?> Geral <?php } else { ?> Unidade: <?php echo $linhatv['unidade_nome'] ?> <?php } ?> 
                                         </h5> <br>






                                      <p class="card-title-desc">
                                        </p>
        
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Unidade atual</th>
                                                <th>Quantidade</th>
                                                <th>Valor Total</th>
												
												
											
                                            </tr>
                                            </thead>
        
      	
                                            <tbody>
												
												
												
<?php while($linha = mysqli_fetch_array($resultado)){ 
$sqlp = "SELECT *  FROM unidades where id_unidade = '$linha[cliente_unidade]' ";
$resultadop = mysqli_query($conn, $sqlp);
$linhap = mysqli_fetch_array($resultadop);
	
	
										
												$qtd = $linha['qtd_carrinho'];
												$valortotal = $linha['preco_pago2'];
	                                            $custo =  $linha['preco_custo2'];
	                                            $lucro = $valortotal - $custo ;
												?>
												
                                            <tr>
                                                <td><?php echo $linha['cliente_nome']; ?></td>
                                                <td><?php echo $linhap['unidade_nome']; ?></td>

                                                <td><?php echo $linha['qtd']; ?></td>
                                                <td>
                                               
                                                
                                                R$<?php echo number_format($linha[pedido_valor], 2, ',', '');?></td>



                                               
												
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
	
	
	
	
	
	
	
	<?php
	$sql = "SELECT SUM(qtd_carrinho) AS qtd_carrinho , SUM(qtd_carrinho*preco_pago) AS preco_pago2, SUM(qtd_carrinho*preco_custo) AS preco_custo2, preco_pago, preco_custo, produto_carrinho, data_carrinho, id_carrinho FROM carrinho WHERE status_carrinho ='2' and preco_pago <> '0.00' and unidade_carrinho = $id  and data_carrinho BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' group by produto_carrinho    ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	

	while($linha = mysqli_fetch_array($resultado)){ 
$sqlp = "SELECT *  FROM produtos where id_produto = '$linha[produto_carrinho]' ";
$resultadop = mysqli_query($conn, $sqlp);
$linhap = mysqli_fetch_array($resultadop);
		
	?>
	

					
					<?php } ?>
					
                    

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
                text: 'Exportar em PDF',"className": 'btn btn-info btn-xs',
                title: 'Vendas por clientes -  <?php echo date('d/m/Y H:i:s', strtotime($_POST['inicio'])); ?>  à <?php echo date('d/m/Y H:i:s', strtotime($_POST['fim'])); ?> - <?php if ($_POST['unidade'] =='') { ?> Geral <?php } else { ?> Unidade: <?php echo $linhatv['unidade_nome'] ?> <?php } ?>  ',
                
            },
       
          
            {
                extend: 'excel',
                text: 'Exportar em excel',"className": 'btn btn-success btn-xs',
                title: 'Vendas por clientes -  <?php echo date('d/m/Y H:i:s', strtotime($_POST['inicio'])); ?>  à <?php echo date('d/m/Y H:i:s', strtotime($_POST['fim'])); ?> - <?php if ($_POST['unidade'] =='') { ?> Geral <?php } else { ?> Unidade: <?php echo $linhatv['unidade_nome'] ?> <?php } ?>  ',
            },
            {
                extend: 'print',
                text: 'Imprimir',"className": 'btn btn-primary btn-xs',
                title: 'Vendas por clientes -  <?php echo date('d/m/Y H:i:s', strtotime($_POST['inicio'])); ?>  à <?php echo date('d/m/Y H:i:s', strtotime($_POST['fim'])); ?> - <?php if ($_POST['unidade'] =='') { ?> Geral <?php } else { ?> Unidade: <?php echo $linhatv['unidade_nome'] ?> <?php } ?>  ',
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