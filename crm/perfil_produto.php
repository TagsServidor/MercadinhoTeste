<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

/// CONECTANDO OS PRODUTOS

$sql = "SELECT * FROM produtos p left join produtos_departamentos d on p.produto_departamento = d.id_departamentos   LEFT JOIN produtos_categorias pc on p.produto_categoria = pc.id_categoria LEFT JOIN produtos_subcategorias ps on p.produto_subcategoria = ps.id_subcategoria where p.id_produto = $_POST[id] ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	
$linha = mysqli_fetch_array($resultado);

// PEGANDO ULTIMAS 10 ENTRADAS
$sqlep = "SELECT * FROM entrada_produtos where 	entrada_produto = $linha[id_produto] order by id_entrada desc limit 10";
$resultadoep = mysqli_query($conn, $sqlep);
$totalep = mysqli_num_rows($resultadoep);

// PEGANDO ULTIMAS 10 VENDAS
$sqlv= "SELECT * FROM carrinho where produto_carrinho = $linha[id_produto] and status_carrinho ='2' order by data_carrinho desc limit 10";
$resultadov = mysqli_query($conn, $sqlv);
$totalv = mysqli_num_rows($resultadov);

// PEGANDO ESTOQUE CENTRAIS
$sqlec= "SELECT * FROM produtos_central where central_produto = $linha[id_produto]";
$resultadoec = mysqli_query($conn, $sqlec);
$totalec = mysqli_num_rows($resultadoec);


// PEGANDO ESTOQUE UNIDADES
$sqleu= "SELECT * FROM produtos_unidades where produto_unidade_produto = $linha[id_produto]";
$resultadoeu = mysqli_query($conn, $sqleu);
$totaleu = mysqli_num_rows($resultadoeu);
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
                                    <h4 class="mb-0">Produto &gt; Produtos</h4> 

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
                                                <img src="../produtos/<?php echo $linha['produto_foto'] ?>" alt="" class="avatar-xl rounded-circle ">
                                            </div>
                                            <h5 class="mt-3 mb-1"><?php echo $linha['produto_nome'] ?></h5>
                                             <span class="badge rounded-pill bg-soft-success font-size-12"><?php echo $linha['departamentos_nome'] ?></span>  <span class="badge rounded-pill bg-soft-info font-size-12"><?php echo $linha['categoria_nome'] ?></span> 
                                               <span class="badge rounded-pill bg-soft-warning font-size-12"><?php echo $linha['subcategoria_nome'] ?></span> 
											
											
											
                                           
                                        </div>

                                        <hr class="my-4">

                                        <div class="text-muted">
                                            <h5 class="font-size-16">Informações</h5>
                                           
                                            <div class="table-responsive mt-4">
                                                <div>
                                                    <p class="mb-1">Código de barras :</p>
                                                    <h5 class="font-size-16"><?php echo $linha['produto_codigobarras'] ?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">No sistema desde:</p>
                                                    <h5 class="font-size-16"><?php echo date('d/m/Y', strtotime($linha['cadastro'])); ?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">Descrição :</p>
                                                    <h5 class="font-size-16"><?php echo $linha['produto_informacoes'] ?></h5>
                                                </div>
                                                

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8">
                                <div class="row">
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="total-revenue-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">34</span></h4>
                                            <p class="text-muted mb-0">Un. vendidas</p>
                                        </div>
                                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>x%</span> mÊs anteriorsasas
                                        </p> --> <div align="right"><button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                               + Details
                                                            </button></div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="orders-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">R$ 250,00</span></h4>
                                            <p class="text-muted mb-0">Receita</p>
                                        </div>
                                         <!--<p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>x%</span> mês anterior
                                        </p> --><div align="right"><button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                               + Details
                                                            </button></div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="customers-chart"> </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"><span data-plugin="counterup">R$ 1200,00 </span></h4>
                                            <p class="text-muted mb-0">Despesa</p>
                                        </div>
                                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i class="mdi mdi-arrow-down-bold me-1"></i>0%</span> mês anterior
                                        </p> --><div align="right"><button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                               + Details
                                                            </button></div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div id="growth-chart"></div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1">+ <span data-plugin="counterup">12.58</span>%</h4>
                                            <p class="text-muted mb-0">XXXX</p>
                                        </div>
                                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i class="mdi mdi-arrow-up-bold me-1"></i>10.51%</span> since last week
                                        </p> --><div align="right"><button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                               + Details
                                                            </button></div>
                                    </div>
                                </div>
                            </div> <!-- end col-->
							  </div> 		
				
									
				
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                 <form id="verentradasprodutos" action="ver_entradas_produtos" method="post">
													<input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
													<a class=" dropdown-toggle" href="#"  aria-haspopup="true" aria-expanded="false" onClick="document.getElementById('verentradasprodutos').submit();">
                                                 <span class="text-muted">Ver todas <i class="fa fa-plus" aria-hidden="true"></i></span></a></form>

                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Últimas entradas</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
															<?php 
	while ($linhaep = mysqli_fetch_array($resultadoep)) {
																													
															
															?>
															
															
			
															
															
                                                            <td style="width: 20px;"><?php echo date('d/m/Y', strtotime($linhaep['entrada_data'])); ?> </td>
                                                            <td>
                                                               <?php echo $linhaep['entrada_qtd'] ?> <?php echo $linha['produto_unidade'] ?>
                                                               
                                                            </td>
                                                            <td><span class="badge bg-soft-info font-size-12"> R$ <?php echo $linhaep['entrada_unitario'] ?> <?php echo $linha['produto_unidade'] ?> </span></td>
                                                            <td class="text-muted fw-semibold text-end"> 
													<a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"> <i class="fa fa-plus" aria-hidden="true"> detalhes </a></td>
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
                                        <h4 class="card-title mb-4">Últimas Vendas</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
															
															<?php 
	while ($linhav = mysqli_fetch_array($resultadov)) { 
															
															
// PEGANDO UNIDADE E MOSTRANDO CONDOMINIO
$sqlu= "SELECT * FROM unidades u INNER JOIN condominios c on u.unidade_condominio = c.id_condominio where u.id_unidade = $linhav[unidade_carrinho] ";
$resultadou = mysqli_query($conn, $sqlu);
$linhau = mysqli_fetch_array($resultadou);													
															
															
															?>
															
															
                                                            <td style="width: 15px;"><?php if ($linhav['carrinho_local'] =='1') { ?><img src="assets/images/avatar_toten.jpg" class="avatar-xs rounded-circle " alt="..."><?php } ?><?php if ($linhav['carrinho_local'] =='2') { ?><img src="assets/images/avatar_app.jpg" class="avatar-xs rounded-circle " alt="..."><?php } ?></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><?php echo date('d/m/Y', strtotime($linhav['data_carrinho'])); ?></h6>
                                                              
                                                            </td>
                                                            <td><h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhav['qtd_carrinho'] ?> <?php echo $linha['produto_unidade'] ?></h6></td>
                                                            <td class="text-muted fw-semibold text-end"><i class="icon-xs icon me-2 text-success" data-feather="trending-up"></i>+ detalhes</td>
                                                        </tr>
														
														<?php } ?>
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
                                                <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <!--  <span class="text-muted">xxx<i class="mdi mdi-chevron-down ms-1"></i></span> -->
                                                </a>

                                                
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
	while ($linhaec = mysqli_fetch_array($resultadoec)) {
															
																
// PEGANDO UNIDADE E MOSTRANDO CENTRAL
$sqlce= "SELECT * FROM centrais where id_central = $linhaec[central_produto_central] ";
$resultadoce = mysqli_query($conn, $sqlce);
$linhace = mysqli_fetch_array($resultadoce);																
															
															
															?>
															
                                                            <td ><?php echo $linhaec['central_produto_estoque'] ?><?php echo $linha['produto_unidade'] ?> </td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhace['central_nome'] ?></h6>
                                                               
                                                            </td>
                                                            <td><h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhaec['central_produto_lote'] ?></h6></td>
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
                                <div class="card">
                                    <div class="card-body">
                                        <div class="float-end">
                                            <div class="dropdown">
                                                <a class=" dropdown-toggle" href="#" id="dropdownMenuButton2"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <!--  <span class="text-muted">xxx<i class="mdi mdi-chevron-down ms-1"></i></span> -->
                                                </a>

                                                
                                            </div>
                                        </div>
                                        <h4 class="card-title mb-4">Estoque Unidades</h4>

                                        <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-centered table-nowrap">
                                                    <tbody>
                                                        <tr>
														
                        <tr>
                          <th>Estoque</th>
                          <th>Unidade</th>
                          <th>Lote</th>
                          <th>Ações</th>
                        </tr>
                     
                      <tbody>
                        <tr>
								
															
														 <?php 
	while ($linhaeu = mysqli_fetch_array($resultadoeu)) {
															
// PEGANDO UNIDADE E MOSTRANDO CONDOMINIO
$sqluc= "SELECT * FROM unidades u INNER JOIN condominios c on u.unidade_condominio = c.id_condominio   where u.id_unidade = $linhaeu[produto_unidade_unidade] ";
$resultadouc = mysqli_query($conn, $sqluc);
$linhauc= mysqli_fetch_array($resultadouc);																
																										
		
															
															?>
															
                                                            <td ><?php echo $linhaeu['produto_unidade_estoque'] ?><?php echo $linha['produto_unidade'] ?> </td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhauc['unidade_nome'] ?></h6>
                                                               <?php echo $linhauc['condominio_nome'] ?>
                                                            </td>
                                                            <td><h6 class="font-size-15 mb-1 fw-normal"><?php echo $linhaeu['produto_unidade_lote'] ?></h6></td>
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