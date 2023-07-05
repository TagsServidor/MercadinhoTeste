<?php session_start();

if (!empty($_SESSION['id'])) {

} else {

    $_SESSION['msg'] = "Área restrita";

    header("Location: logar.php");

}



include('bd/conexao.php'); 



date_default_timezone_set('America/Sao_Paulo');

$data1 = date('Y-m-d');

$hora2 = date('H:i:s');

$datageral = date('Y-m-d');

$data = substr($data1, 8, 2) . '/' . substr($data1, 5, 2) . '/' . substr($data1, 0, 4);

$hora = substr($hora2, 0, 2) . 'h' . substr($hora2, 3, 2) . 'min';

$segd = date('Ymd');

$segh = date('His');







// PEGANDO DADOS DO USUARIO

$iduser = $_SESSION['id'];

$sqluser = "SELECT SQL_CACHE * FROM adm WHERE id = '$iduser'";

$exeuser = mysqli_query($conn, $sqluser);

$user = mysqli_fetch_array($exeuser);







?>

<!doctype html>

<html lang="pt_br">



    



<?php $base = "https://" . $_SERVER['SERVER_NAME'] .'mercadinho/crm/' ?>

<base href="<?php echo $base ?>">	

        <meta charset="utf-8" />

        

        <?php if($_POST[exportarvendas] =='sim') { ?>

        <title>Mercadinho Vendas <?php if ( $_POST[local] == '1') {  ?> Totem <?php } ?><?php if ( $_POST[local] == '2') {  ?> APP Cartão <?php } ?> <?php if ( $_POST[local] == '3') {  ?> App Pix (Pagseguro) <?php } ?> - Periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> <?php if ($_POST['unidade'] =='') { } else { ?> - Unidade: <?php echo $linhau['unidade_nome'] ?> <?php } ?></title>

        <?php }  ?>

	
	
	
        <?php if($_POST[exportarextravio] =='sim') { 
$sqluu = "SELECT * FROM unidades where id_unidade = $_POST[unidade]  ORDER BY unidade_nome";
$resultadouu = mysqli_query($conn, $sqluu);
$linhauu=mysqli_fetch_array($resultadouu);
	
	
if ($_POST[unidade] <> '') { 	
$result_vendas = "SELECT  SUM(alerta_estoque_deveria - alerta_estoque_encontrado) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_unidade = $_POST[unidade] and alerta_motivo = '1' group by alerta_produto ";
} else {
	
$result_vendas = "SELECT  SUM(alerta_estoque_deveria - alerta_estoque_encontrado) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_motivo = '1' group by alerta_produto ";
}

$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)) { 
										
$sqlva = "SELECT *  FROM os_produtos where os_produtos_id = $rows_vendas[alerta_produto_unidade]  ";
$sqlpva= mysqli_query($conn, $sqlva);
$produtou = mysqli_fetch_array($sqlpva);
$totalitem = $rows_vendas['qtd'] * 	$produtou['os_produtos_valor'];	
$totalprejuizo += $totalitem;			
	
	} 
	
$sqltv = "SELECT SUM(pedido_valor) AS total_vendas  FROM pedidos WHERE pedido_status ='2' and pedido_unidade = $_POST[unidade] and pedido_data  BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'      ";
$resultadotv = mysqli_query($conn, $sqltv);
$totaltv = mysqli_num_rows($resultadotv);	
$totalvendas = mysqli_fetch_array($resultadotv);

$valor_base = $totalvendas[total_vendas];
$valor = $totalprejuizo;
$resultado2 = ($valor / $valor_base) * 100;


$honestidade2  = substr($resultado2, 0, 2); 
$honestidade  = 100 - $honestidade2 ;
	
	
	
	
	?>
	
	
	
	

        <title>Extravios - Periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> - Unidade: <?php if ($_POST[unidade] <> '') { echo $linhauu['unidade_nome']; } else { ?>Geral <?php } ?> Prejuizo Total R$<?php echo  number_format($totalprejuizo, 2, ',', '.');  ?> 
	

	
		
	</title>
        <?php }  ?>


<?php if($_POST[alertareposicao] =='sim') { 


//// ALERTAS
$result_motivo = "SELECT  * FROM aletar_motivos WHERE id_alerta = $_POST[alerta]    ";
$resultado_motivo = mysqli_query($conn, $result_motivo);
$motivo = mysqli_fetch_assoc($resultado_motivo);

$sqluu = "SELECT * FROM unidades where id_unidade = $_POST[unidade]  ORDER BY unidade_nome";
$resultadouu = mysqli_query($conn, $sqluu);
$linhauu=mysqli_fetch_array($resultadouu);

// ENCONTRO A MAIS

if ($_POST[unidade] <> '') { 
    
    
$result_vendas = "SELECT  SUM(alerta_estoque_encontrado - alerta_estoque_deveria) AS qtd , ir_alerta_reposicao,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_unidade = $_POST[unidade] and alerta_motivo = '$_POST[alerta]' group by alerta_produto ";


	} else {
	
$result_vendas = "SELECT  SUM(alerta_estoque_encontrado - alerta_estoque_deveria) AS qtd , ir_alerta_reposicao, alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_motivo = '$_POST[alerta]' group by alerta_produto ";
	
}

$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)) { 
										
$sqlva = "SELECT *  FROM os_produtos where os_produtos_id = $rows_vendas[alerta_produto_unidade]  ";
$sqlpva= mysqli_query($conn, $sqlva);
$produtou = mysqli_fetch_array($sqlpva);
$totalitem = $rows_vendas['qtd'] * 	$produtou['os_produtos_valor'];	
$totalprejuizo += $totalitem;	
}
?>

          <title>Mercadinho Encontrado a Mais - Periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> - Unidade: <?php if ($_POST[unidade] <> '') { echo $linhauu['unidade_nome']; } else { ?>Geral <?php } ?>  

Total R$<?php echo  number_format($totalprejuizo, 2, ',', '.');  ?>  	</title>

  
    
    
<?php } ?>
 

	
	
	
        <?php if($_POST[exportarmotivos] =='sim') { 
$sqluu = "SELECT * FROM unidades where id_unidade = $_POST[unidade]  ORDER BY unidade_nome";
$resultadouu = mysqli_query($conn, $sqluu);
$linhauu=mysqli_fetch_array($resultadouu);
	
	
if ($_POST[unidade] <> '') { 	
$result_vendas = "SELECT  SUM(alerta_estoque_deveria - alerta_estoque_encontrado) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_unidade = $_POST[unidade] and alerta_motivo = '1' group by alerta_produto ";
} else {
	
$result_vendas = "SELECT  SUM(alerta_estoque_deveria - alerta_estoque_encontrado) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_motivo = '1' group by alerta_produto ";
}

$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)) { 
										
$sqlva = "SELECT *  FROM os_produtos where os_produtos_id = $rows_vendas[alerta_produto_unidade]  ";
$sqlpva= mysqli_query($conn, $sqlva);
$produtou = mysqli_fetch_array($sqlpva);
$totalitem = $rows_vendas['qtd'] * 	$produtou['os_produtos_valor'];	
$totalprejuizo += $totalitem;			
	
	} 
	
$sqltv = "SELECT SUM(pedido_valor) AS total_vendas  FROM pedidos WHERE pedido_status ='2' and pedido_unidade = $_POST[unidade] and pedido_data  BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'      ";
$resultadotv = mysqli_query($conn, $sqltv);
$totaltv = mysqli_num_rows($resultadotv);	
$totalvendas = mysqli_fetch_array($resultadotv);

$valor_base = $totalvendas[total_vendas];
$valor = $totalprejuizo;
$resultado2 = ($valor / $valor_base) * 100;


$honestidade2  = substr($resultado2, 0, 2); 
$honestidade  = 100 - $honestidade2 ;
	
	
	
	
	?>
	
	
	
	

        <title>Mercadinho - Periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> - Unidade: <?php if ($_POST[unidade] <> '') { echo $linhauu['unidade_nome']; } else { ?>Geral <?php } ?>  
	
	
	</title>
        <?php }  ?>



        <?php if($_POST[exportarextravioprodutos] =='sim') { 
$sqluu = "SELECT * FROM produtos where id_produto = $_POST[produto]  ORDER BY produto_nome";
$resultadouu = mysqli_query($conn, $sqluu);
$linhauu=mysqli_fetch_array($resultadouu);
	
	
if ($_POST[produto] <> '') { 	
$result_vendas = "SELECT  SUM(alerta_estoque_deveria - alerta_estoque_encontrado) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_produto = $_POST[produto] and alerta_motivo = '1' group by alerta_produto ";
} else {
	
$result_vendas = "SELECT  SUM(alerta_estoque_deveria - alerta_estoque_encontrado) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_motivo = '1' group by alerta_produto ";
}

$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
while($rows_vendas = mysqli_fetch_assoc($resultado_vendas)) { 
										
$sqlva = "SELECT *  FROM os_produtos where os_produtos_id = $rows_vendas[alerta_produto_unidade]  ";
$sqlpva= mysqli_query($conn, $sqlva);
$produtou = mysqli_fetch_array($sqlpva);
$totalitem = $rows_vendas['qtd'] * 	$produtou['os_produtos_valor'];	
$totalprejuizo += $totalitem;			
	
	} 
	
	?>

        <title>Extravios - Periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> - Produto: <?php if ($_POST[unidade] <> '') { echo $linhauu['unidade_nome']; } else { ?>Produto > Geral <?php } ?> Prejuizo Total R$<?php echo  number_format($totalprejuizo, 2, ',', '.');  ?> </title>
        <?php }  ?>



        

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

        <!-- App favicon -->

        <link rel="shortcut icon" href="assets/images/favicon.ico">



        <!-- Bootstrap Css -->

        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

        <!-- Icons Css -->

        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <!-- App Css-->

        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />











  







    <body data-layout="horizontal" data-topbar="colored">

        

        

   

        

        

        



        <!-- Begin page -->

        <div id="layout-wrapper">



            <header id="page-topbar">

                <div class="navbar-header">

                    <div class="d-flex">

                        <!-- LOGO -->

                        <div class="navbar-brand-box">

                            <a href="home" class="logo logo-dark">

                                <span class="logo-sm">

                                    <img src="assets/images/logo-sm.png" alt="" height="22">

                                </span>

                                <span class="logo-lg">

                                    <img src="assets/images/logo-dark.png" alt="" height="20">

                                </span>

                            </a>



                            <a href="home" class="logo logo-light">

                                <span class="logo-sm">

                                    <img src="assets/images/logo-sm.png" alt="" height="22">

                                </span>

                                <span class="logo-lg">

                                    <img src="assets/images/logo-light.png" alt="" height="40">

                                </span>

                            </a>

                        </div>



                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">

                            <i class="fa fa-fw fa-bars"></i>

                        </button>



                        <!-- 

                        <form class="app-search d-none d-lg-block">

                            <div class="position-relative">

                                <input type="text" class="form-control" placeholder="Search...">

                                <span class="uil-search"></span>

                            </div>

                        </form>

App Search-->

                    </div>



                    <div class="d-flex">



                        <div class="dropdown d-inline-block d-lg-none ms-2">

                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"

                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="uil-search"></i>

                            </button>

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"

                                aria-labelledby="page-header-search-dropdown">

                    

                                <form class="p-3">

                                    <div class="m-0">

                                        <div class="input-group">

                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">

                                            <div class="input-group-append">

                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>

                                            </div>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>



                       



                        <div class="dropdown d-none d-lg-inline-block ms-1">

                            <button type="button" class="btn header-item noti-icon waves-effect"

                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="uil-apps"></i>

                            </button>

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                                <div class="px-lg-2">

                                    <div class="row g-0">

                                        <div class="col">

                                            <a class="dropdown-icon-item" href="#">

                                                <img src="assets/images/brands/github.png" alt="Github">

                                                <span>GitHub</span>

                                            </a>

                                        </div>

                                        <div class="col">

                                            <a class="dropdown-icon-item" href="#">

                                                <img src="assets/images/brands/bitbucket.png" alt="bitbucket">

                                                <span>Bitbucket</span>

                                            </a>

                                        </div>

                                        <div class="col">

                                            <a class="dropdown-icon-item" href="#">

                                                <img src="assets/images/brands/dribbble.png" alt="dribbble">

                                                <span>Dribbble</span>

                                            </a>

                                        </div>

                                    </div>



                                    <div class="row g-0">

                                        <div class="col">

                                            <a class="dropdown-icon-item" href="#">

                                                <img src="assets/images/brands/dropbox.png" alt="dropbox">

                                                <span>Dropbox</span>

                                            </a>

                                        </div>

                                        <div class="col">

                                            <a class="dropdown-icon-item" href="#">

                                                <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp">

                                                <span>Mail Chimp</span>

                                            </a>

                                        </div>

                                        <div class="col">

                                            <a class="dropdown-icon-item" href="#">

                                                <img src="assets/images/brands/slack.png" alt="slack">

                                                <span>Slack</span>

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="dropdown d-none d-lg-inline-block ms-1">

                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">

                                <i class="uil-minus-path"></i>

                            </button>

                        </div>



                        <div class="dropdown d-inline-block">

                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"

                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fa fa-bell" aria-hidden="true"></i>



                                <span class="badge bg-info rounded-pill">3</span>

                            </button>

                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                                <div class="p-3">

                                    <div class="row align-items-center">

                                        <div class="col">

                                            <h5 class="m-0 font-size-16"> Notificações </h5>

                                        </div>

                                        <div class="col-auto">

                                            <a href="javascript:void(0);" class="small"> Marcar todos como lidas</a>

                                        </div>

                                    </div>

                                </div>

                                <div data-simplebar style="max-height: 230px;">

                                    <a href="javascript:void(0);" class="text-reset notification-item">

                                        <div class="d-flex align-items-start">

                                            <div class="flex-shrink-0 me-3">

                                                <div class="avatar-xs">

                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">

                                                        <i class="fa fa-comment" aria-hidden="true"></i>



                                                    </span>

                                                </div>

                                            </div>

                                            <div class="flex-grow-1">

                                                <h6 class="mb-1">Texto chamado 1</h6>

                                                <div class="font-size-12 text-muted">

                                                    <p class="mb-1">Resumo do chamado</p>

                                                    <p class="mb-0"><i class="fa fa-clock" aria-hidden="true"></i>

 12hs</p>

                                                </div>

                                            </div>

                                        </div>

                                    </a>

                                    

                                    <a href="javascript:void(0);" class="text-reset notification-item">

                                        <div class="d-flex align-items-start">

                                            <div class="flex-shrink-0 me-3">

                                                <img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-xs" alt="user-pic">

                                            </div>

                                            <div class="flex-grow-1">

                                                <h6 class="mb-1">Repositor Nome</h6>

                                                <div class="font-size-12 text-muted">

                                                    <p class="mb-1">Texto do chamado xxxx</p>

                                                    <p class="mb-0"><i class="fa fa-clock" aria-hidden="true"></i> há 1 hora</p>

                                                </div>

                                            </div>

                                        </div>

                                    </a>

                                </div>

                                <div class="p-2 border-top">

                                    <div class="d-grid">

                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">

                                            <i class="uil-arrow-circle-right me-1"></i> Visualizar Todos

                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="dropdown d-inline-block">

                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"

                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-4.jpg"

                                    alt="Header Avatar">

                                <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15"><?php echo $user['nome'] ?></span>

                                <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>

                            </button>

                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->

                                <a class="dropdown-item" href="#"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Meu Perfil</span></a>

                                

                                <a class="dropdown-item" href="sair.php"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Sair</span></a>

                            </div>

                        </div>



                        <div class="dropdown d-inline-block">

                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">

                                <i class="uil-cog"></i>

                            </button>

                        </div>

            

                    </div>

                </div>

                <div class="container-fluid">

                    <div class="topnav">



					

						<?php if($user['gerenciavel'] =='2') {  ?> 

						

                        
<?php include "menugerencial.php"; ?>
	

							<?php } ?>

							

							

							

						<?php if($user['repositor'] =='2') {  ?> 

						

                        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

    

                            <div class="collapse navbar-collapse" id="topnav-menu-content">

                                <ul class="navbar-nav">



                                    <li class="nav-item">

                                        <a class="nav-link" href="home">

                                            <i class="uil-home-alt me-2"></i> Home

                                        </a>

                                    </li>

    

                                    

									

									<li class="nav-item dropdown">

                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">

                                            <i class="uil-apps me-2"></i>OS Reposição <div class="arrow-down"></div>

                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="topnav-pages">



                                          <a href="os_abertas" class="dropdown-item">Abertas</a>

                                            <a href="os_concluidas" class="dropdown-item">Concluídas</a>

                                            

                                           



                                           

                                        </div>

                                    </li>

									

    <!--

                                    <li class="nav-item dropdown">

                                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">

                                            <i class="uil-apps me-2"></i>Estoque <div class="arrow-down"></div>

                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="topnav-pages">



                                            <a href="baixa_manual" class="dropdown-item">Baixas Manuais</a>

                                            <a href="redistribuicao" class="dropdown-item">Redistribuição (Central)</a>

                                            

                                           



                                           

                                        </div>

                                    </li>

									

									-->

									

    

									

									

									

						

						

								

								

								

								

    

                                </ul>

	

							<?php } ?>

							

							

							

                            </div>

                        </nav>

                    </div>

                </div>

            </header>

            

       

  

		

<?php // INCLUDE CAMINHOS

require("url.php"); ?>

			

 



        <!-- JAVASCRIPT -->

        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="assets/libs/metismenu/metisMenu.min.js"></script>

        <script src="assets/libs/simplebar/simplebar.min.js"></script>

        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>

        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- apexcharts -->




        <script src="assets/js/pages/dashboard.init.js"></script>



        <!-- App js -->

        <script src="assets/js/app.js"></script>



    </body>



</html>

