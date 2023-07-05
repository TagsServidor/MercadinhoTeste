<?php @session_start();
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

<!DOCTYPE html>
<html lang="pt_br">
<head>
	
	<?php $base = "https://" . $_SERVER['SERVER_NAME'] .'/repositor/' ?>
<base href="<?php echo $base ?>">	
	
    <!-- Meta Tags -->
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercadinho - Repositor</title>
    
    
	<!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
   	<!-- Wrapper -->
	<div class="hk-wrapper hk-pg-auth" data-layout="vertical" data-layout-style="default" data-menu="light" data-footer="simple">
		<!-- Top Navbar -->
		<nav class="hk-navbar navbar navbar-expand-xl navbar-light fixed-top">
			<div class="container-fluid">
			<!-- Start Nav -->
			<div class="nav-start-wrap">
				<button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle d-xl-none"><span class="icon"><span class="feather-icon"><i data-feather="align-left"></i></span></span></button>
					
				
							
							
			</div>
			<!-- /Start Nav -->
			
			<!-- End Nav -->
			<div class="nav-end-wrap">
				<ul class="navbar-nav flex-row">
					<li class="nav-item">
						
					</li>
					<li class="nav-item">
						<div class="dropdown dropdown-notifications">
							
							<div class="dropdown-menu dropdown-menu-end p-0">
								<h6 class="dropdown-header px-4 fs-6">Notifications<a href="#" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"><span class="icon"><span class="feather-icon"><i data-feather="settings"></i></span></span></a>
								</h6>
								<div data-simplebar class="dropdown-body  p-2">
									<a href="javascript:void(0);" class="dropdown-item">
										<div class="media">
											<div class="media-head">
												<div class="avatar avatar-rounded avatar-sm">
													<img src="dist/img/avatar2.jpg" alt="user" class="avatar-img">
												</div>
											</div>
											<div class="media-body">
												<div>
													<div class="notifications-text">Morgan Freeman accepted your invitation to join the team</div>
													<div class="notifications-info">
														<span class="badge badge-soft-success">Collaboration</span>
														<div class="notifications-time">Today, 10:14 PM</div>
													</div>
												</div>
											</div>
										</div>
									</a>
									<a href="javascript:void(0);" class="dropdown-item">
										<div class="media">
											<div class="media-head">
												<div class="avatar  avatar-icon avatar-sm avatar-success avatar-rounded">
													<span class="initial-wrap">
														<span class="feather-icon"><i data-feather="inbox"></i></span>
													</span>
												</div>
											</div>
											<div class="media-body">
												<div>
													<div class="notifications-text">New message received from Alan Rickman</div>
													<div class="notifications-info">
														<div class="notifications-time">Today, 7:51 AM</div>
													</div>
												</div>
											</div>
										</div>
									</a>
									<a href="javascript:void(0);" class="dropdown-item">
										<div class="media">
											<div class="media-head">
												<div class="avatar  avatar-icon avatar-sm avatar-pink avatar-rounded">
													<span class="initial-wrap">
														<span class="feather-icon"><i data-feather="clock"></i></span>
													</span>
												</div>
											</div>
											<div class="media-body">
												<div>
													<div class="notifications-text">You have a follow up with Jampack Head on Friday, Dec 19 at 9:30 am</div>
													<div class="notifications-info">
														<div class="notifications-time">Yesterday, 9:25 PM</div>
													</div>
												</div>
											</div>
										</div>
									</a>
									<a href="javascript:void(0);" class="dropdown-item">
										<div class="media">
											<div class="media-head">
												<div class="avatar avatar-sm avatar-rounded">
													<img src="dist/img/avatar3.jpg" alt="user" class="avatar-img">
												</div>
											</div>
											<div class="media-body">
												<div>
													<div class="notifications-text">Application of Sarah Williams is waiting for your approval</div>
													<div class="notifications-info">
														<div class="notifications-time">Today 10:14 PM</div>
													</div>
												</div>
											</div>
										</div>
									</a>
									<a href="javascript:void(0);" class="dropdown-item">
										<div class="media">
											<div class="media-head">
												<div class="avatar avatar-sm avatar-rounded">
													<img src="dist/img/avatar10.jpg" alt="user" class="avatar-img">
												</div>
											</div>
											<div class="media-body">contatoc
												<div>	
													<div class="notifications-text">Winston Churchil shared a document with you</div>
													<div class="notifications-info">
														<span class="badge badge-soft-violet">File Manager</span>
														<div class="notifications-time">2 Oct, 2021</div>
													</div>
												</div>
											</div>
										</div>
									</a>
									<a href="javascript:void(0);" class="dropdown-item">
										<div class="media">
											<div class="media-head">
												<div class="avatar  avatar-icon avatar-sm avatar-danger avatar-rounded">
													<span class="initial-wrap">
														<span class="feather-icon"><i data-feather="calendar"></i></span>
													</span>
												</div>
											</div>
											<div class="media-body">
												<div>	
													<div class="notifications-text">Last 2 days left for the project to be completed</div>
													<div class="notifications-info">
														<span class="badge badge-soft-orange">Updates</span>
														<div class="notifications-time">14 Sep, 2021</div>
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-footer"><a href="#"><u>View all notifications</u></a></div>
							</div>
						</div>
					</li>
					<li class="nav-item">
						<div class="dropdown ps-2">
							<a class=" dropdown-toggle no-caret" href="#" role="button" data-bs-display="static" data-bs-toggle="dropdown" data-dropdown-animation data-bs-auto-close="outside" aria-expanded="false">
								<div class="avatar avatar-rounded avatar-xs">
									<img src="dist/img/avatar12.jpg" alt="user" class="avatar-img">
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<div class="p-2">
									<div class="media">
										
										<div class="media-body">
											<div class="dropdown">
												<?php echo $user['nome'] ?>
												<div class="dropdown-menu dropdown-menu-end">
													<div class="p-2">
														<div class="media align-items-center active-user mb-3">
															
															
														</div>
														
														
													</div>
												</div>
											</div>
											<div class="fs-7"><?php echo $user['login'] ?></div>
											<a href="sair.php" class="d-block fs-8 link-secondary"><u>Sair</u></a>
										</div>
									</div>
								</div>
								<div class="dropdown-divider"></div>
							<!--	<a class="dropdown-item" href="perfil">Meus Dados</a> -->
								
							</div>
						</div>
					</li>
				</ul>
			</div>
			<!-- /End Nav -->
			</div>									
		</nav>
		<!-- /Top Navbar -->

        <!-- Vertical Nav -->
        <div class="hk-menu">
			<!-- Brand -->
			<div class="menu-header">
				<span>
					<a class="navbar-brand" href="home">
						<img class="brand-img d-inline-block" src="dist/img/logo-light.png" alt="brand">
					</a>
					<button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle">
						<span class="icon">
							<span class="svg-icon fs-5">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<line x1="10" y1="12" x2="20" y2="12"></line>
									<line x1="10" y1="12" x2="14" y2="16"></line>
									<line x1="10" y1="12" x2="14" y2="8"></line>
									<line x1="4" y1="4" x2="4" y2="20"></line>
								</svg>
							</span>
						</span>
					</button>
				</span>
			</div>
			<!-- /Brand -->

			<!-- Main Menu -->
			<div data-simplebar class="nicescroll-bar">
				<div class="menu-content-wrap">
					<div class="menu-group">
						<ul class="navbar-nav flex-column">
							<li class="nav-item active">
								<a class="nav-link" href="home">
									<span class="nav-icon-wrap">
										<span class="svg-icon">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-template" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
												<rect x="4" y="4" width="16" height="4" rx="1" />
												<rect x="4" y="12" width="6" height="8" rx="1" />
												<line x1="14" y1="12" x2="20" y2="12" />
												<line x1="14" y1="16" x2="20" y2="16" />
												<line x1="14" y1="20" x2="20" y2="20" />
											</svg>
										</span>
									</span>
									<span class="nav-link-text">Painel Inicial</span>
									
								</a>
							</li>
						</ul>	
					</div>
					<div class="menu-gap"></div>
					<div class="menu-group">
						<div class="nav-header">
							<span>Menu</span>
						</div>
						<ul class="navbar-nav flex-column">
							
							
							<li class="nav-item">
								<a class="nav-link" href="os_abertas">
									<span class="nav-icon-wrap">
										<i class="fa fa-list" aria-hidden="true"></i>

										</span>
									</span>
									<span class="nav-link-text">OS Abertas</span>
								</a>
							</li>	
							
							
							<li class="nav-item">
								<a class="nav-link" href="os_concluidas">
									<span class="nav-icon-wrap">
										<i class="fa fa-check" aria-hidden="true"></i>

									</span>
									<span class="nav-link-text">OS Concluídas</span>
								</a>
							</li>	
							

							<li class="nav-item">
								<a class="nav-link" href="retiradas">
									<span class="nav-icon-wrap">
										<i class="fa fa-clone" aria-hidden="true"></i>


									</span>
									<span class="nav-link-text">Retiradas/Acréscimos</span>
								</a>
							</li>	
							<!--
								<li class="nav-item">
								<a class="nav-link" href="ajuste_estoque">
									<span class="nav-icon-wrap">
										<i class="fa fa-window-restore" aria-hidden="true"></i>


									</span>
									<span class="nav-link-text">Ajuste em estoque</span>
								</a>
							</li>	
-->
							
						</ul>
					</div>
					
					
					
				</div>
			</div>
			<!-- /Main Menu -->
		</div>
        <!-- /Vertical Nav -->

	
	
	
	
		<!-- Main Content -->
		<div class="hk-pg-wrapper">
			<div class="container-xxl">
				<!-- Page Body -->
				<div class="hk-pg-body">
					<div class="row">
						<div class="col-12">
							
								<div class="row">
									<div class="col-xl-12">
									
										<?php // ROTAS
										include "url.php";
										?>
									
								</div>
							</div>
						</div>
						
				<!-- /Page Body -->		
			</div>
			
			<!-- Page Footer -->
			<div class="hk-footer">
				<footer class="container-xxl footer">
					<div class="row">
						<div class="col-xl-8">
							<p class="footer-text"><span class="copy-text">Mercadinho © 2022 </span> </p>
						</div>
						<div class="col-xl-4">
							
						</div>
					</div>
				</footer>
			</div>
			<!-- / Page Footer -->

		</div>
		<!-- /Main Content -->
	</div>
    <!-- /Wrapper -->

	<!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
   	<script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FeatherIcons JS -->
    <script src="dist/js/feather.min.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Simplebar JS -->
	<script src="vendors/simplebar/dist/simplebar.min.js"></script>
	
	<!-- Init JS -->
	<script src="dist/js/init.js"></script>
</body>

</html>