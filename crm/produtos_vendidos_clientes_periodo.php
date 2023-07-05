	<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS

$sql = "SELECT SUM(qtd_carrinho) AS qtd_carrinho , SUM(qtd_carrinho*preco_pago) AS preco_pago2, SUM(qtd_carrinho*preco_custo) AS preco_custo2, preco_pago, preco_custo, produto_carrinho, data_carrinho FROM carrinho WHERE status_carrinho ='2' and preco_pago <> '0.00' and data_carrinho BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'  group by produto_carrinho    ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	


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
                                    <h4 class="mb-0">Relatórios  &gt; Produtos  &gt; Mais vendidos por cliente</h4> 

                                    <div class="page-title-right">
										
										
										 <form action="produtos_vendidos_clientes_periodo" method="post"><label><strong>Pesquisar por data: </strong> Inicio: &nbsp;&nbsp; </label><input name="inicio" type="datetime-local"><label> &nbsp;&nbsp;Fim: &nbsp;&nbsp;</label><input type="datetime-local" name="fim"> <input type="submit" value="pesquisar" class="btn btn-info"></form>
										
										
										
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                  
               
					
					
					
				<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                       
                                        <p class="card-title-desc">
                                        </p>
        
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                               
                                                <th order-priority="2" >Produto</th>
                                                <th>Quantidade</th>
                                                <th>Clientes</th>
                                               
												
												
											
                                            </tr>
                                            </thead>
        
      	
                                            <tbody>
												
												
												
<?php while($linha = mysqli_fetch_array($resultado)){ 
$sqlp = "SELECT *  FROM produtos where id_produto = '$linha[produto_carrinho]' ";
$resultadop = mysqli_query($conn, $sqlp);
$linhap = mysqli_fetch_array($resultadop);
	
	
										
												$qtd = $linha['qtd_carrinho'];
												$valortotal = $linha['preco_pago2'];
	                                            $custo =  $linha['preco_custo2'];
	                                            $lucro = $valortotal - $custo ;
												?>



<div class="modal fade bs-example-modal-xl<?php echo $linhap['id_produto']; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myExtraLargeModalLabel">Quantidade por cliente</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">


                                                            <?php /// LISTANDO POR CLIENTE
                                                            $sql2 = "SELECT SUM(qtd_carrinho)  AS qtd_carrinho, status_carrinho, preco_pago, produto_carrinho, cliente_carrinho, cl.cliente_nome, id_cliente, data_carrinho  FROM carrinho c  INNER JOIN clientes cl on c.cliente_carrinho = cl.id_cliente WHERE status_carrinho ='2' and preco_pago <> '0.00' and produto_carrinho = $linha[produto_carrinho] and cl.cliente_nome <> '' and data_carrinho BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'  group by cliente_carrinho order by qtd_carrinho desc  ";
                                                            $resultado2 = mysqli_query($conn, $sql2);
                                                            $total2 = mysqli_num_rows($resultado2);	
                                                            while($linha2 = mysqli_fetch_array($resultado2)){ 
                                                            ?>
                                                                <p><strong><?php echo $linha2['qtd_carrinho']; ?></strong> - <?php echo $linha2['cliente_nome']; ?>
                                                                   </p>
                                                                <?php } ?>
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->


												
                                            <tr>
                                                <td><?php echo $linhap['id_produto']; ?> - <?php echo $linhap['produto_nome']; ?></td>
                                                <td><?php echo $linha['qtd_carrinho']; ?></td>
                                                <td><button type="button" class="btn btn-primary waves-effect waves-light btn-small" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl<?php echo $linhap['id_produto']; ?>">Ver</button>
</td>
                                             
                                               
												
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