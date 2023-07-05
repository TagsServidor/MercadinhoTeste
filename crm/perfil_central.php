<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

/// CONECTANDO AOS DADOS DA CENTRAL
$sql = "SELECT * FROM centrais  where id_central = $_POST[id] ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	
$linha = mysqli_fetch_array($resultado);

/// CONECTANDO AS ENTRADAS DA CENTRAL
$sqlec = "SELECT * FROM entrada_produtos ep INNER JOIN produtos p ON ep.entrada_produto = p.id_produto where ep.entrada_central = $_POST[id] and ep.entrada_status ='2' order by ep.entrada_data desc ";
$resultadoec = mysqli_query($conn, $sqlec);
$totalec = mysqli_num_rows($resultadoec);	

/// CONECTANDO AS SAIDAS DA CENTRAL
$sqlop = "SELECT * FROM os_produtos op INNER JOIN produtos p ON op.os_produtos_produto = p.id_produto where op.os_produtos_central = $_POST[id] and op.os_produtos_status ='2' order by op.os_produtos_cadatro desc ";
$resultadoop = mysqli_query($conn, $sqlop);
$totalop = mysqli_num_rows($resultadoop);	

/// CONECTANDO AO ESTOQUE DA CENTRAL
$sqlpc = "SELECT * FROM produtos_central pc INNER JOIN produtos p ON pc.central_produto = p.id_produto where pc.central_produto_central = $_POST[id] order by  pc.central_produto_estoque asc ";
$resultadopc = mysqli_query($conn, $sqlpc);
$totalopc = mysqli_num_rows($resultadopc);	

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
<div id="results"></div>
					
					<div id="dvConteudo" >

<div class="main-content">

                <div class="page-content">
<div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Central &gt; Produtos</h4> 

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
</div> 
               
					
                <div class="container-fluid">
					
				  <div class="row mb-4">
<div class="col-xl-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="dropdown float-end">
                                                <a class="text-body dropdown-toggle font-size-18" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                  <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                              
                                                
                                            </div>
                                            <div class="clearfix"></div>
                                            <div>
                                               <!-- <img src="foto" alt="" class="avatar-xl rounded-circle "> -->
                                            </div>
                                            <h5 class="mt-3 mb-1"> <strong><?php echo $linha['central_nome'] ?></strong></h5>
                                             
											<?php echo $linha['central_rua'] ?> <?php echo $linha['central_numero'] ?> <?php echo $linha['central_bairro'] ?>
											<?php echo $linha['central_complemento'] ?> <?php echo $linha['central_cep'] ?> <?php echo $linha['central_uf'] ?>
											<?php echo $linha['central_cidade'] ?>
                                           
                                        </div>

                                        <hr class="my-4">

                                        <div class="text-muted">
                                           
                                                

                                           
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8">
<div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <a class=" dropdown-toggle" href="entradas_central/<?php echo $linha['id_central'] ?>" id="dropdownMenuButton2"
                                                   >
                                                    <span class="text-muted">Ver Todas <i class="fa fa-plus" aria-hidden="true"></i>
</span>
                                                </a>

                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Últimas entradas</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
															<?php 
	while ($linhaec = mysqli_fetch_array($resultadoec)) {
															
															
															
															?>
															
                                                            <td style="width: 20px;"><?php echo date('d/m/Y', strtotime($linhaec['entrada_data'])); ?> </td>
                                                            <td>
                                                               <?php echo $linhaec['produto_nome'] ?> <?php  //echo $linha['produto_unidade'] ?>
                                                               
                                                            </td>
                                                            <td> <?php echo $linhaec['entrada_qtd'] ?> <?php echo $linhaec['produto_unidade'] ?></td>
                                                            <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>+ detalhes</td>
                                                        </tr>
													<?php } ?>	
														
														
														
                                                    </tbody>
                                                </table>
                                            </div> 
                                            <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> </div> <!-- end card-->
								
								
							  <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <span class="text-muted">Ver Todas <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>

                                               
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Últimas Saídas</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
															
															<?php 
	while ($linhaop = mysqli_fetch_array($resultadoop)) { 
															
												
															
															
															?>
															
															
                                                            <td style="width: 15px;"><?php echo date('d/m/Y', strtotime($linhaop['os_produtos_cadatro'])); ?></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhaop['produto_nome']  ?></h6>
                                                              
                                                            </td>
                                                            <td><h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhaop['os_produtos_qtd'] ?> <?php echo $linhaop['produto_unidade'] ?></h6></td>
                                                            <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>+ detalhes</td>
                                                        </tr>
														
														<?php  } ?>
                                                    </tbody>
                                                </table>
                                            </div> 
                                            <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> 
								
								
								
                            </div><!-- end col -->

					 <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                               
													<a href="ver_estoque_central/<?php echo $_POST[id] ?>">
                                                 <span class="text-muted">Ver todas <i class="fa fa-plus" aria-hidden="true"></i></span></form>

                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Estoque Central</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
														
                        <tr>
                          <th>Estoque</th>
                          <th>Central</th>
                          <th>Lote</th>
                          <th>Ações</th>
                        </tr>
                     
                      <tbody>
                        <tr>
								
															
														 <?php 
	while ($linhapc = mysqli_fetch_array($resultadopc)) {
															
			
															
															?>
															
                                                            <td ><?php echo $linhapc['central_produto_estoque'] ?><?php echo $linhapc['produto_unidade'] ?> </td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhapc['produto_nome'] ?></h6>
                                                               
                                                            </td>
                                                            <td><h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhapc['central_produto_lote'] ?></h6></td>
                                                            <td ><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>+ detalhes</td>
                                                        </tr>
														
														<?php } ?>
														
                                                    </tbody>
                                                </table>
                                            </div> 
                                            <!-- enbd table-responsive-->
                                        </div> <!-- data-sidebar-->
                                    </div><!-- end card-body-->
                                </div> 
					  
						 
						 
						 
				<div class="col-xl-12">

		 <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- apexcharts -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>