<!DOCTYPE html>
<html lang="pt_br">

<head>
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
	<div class="hk-wrapper hk-pg-auth" data-footer="simple">
		<!-- Main Content -->
		<div class="hk-pg-wrapper pt-0 pb-xl-0 pb-5">
			<div class="hk-pg-body pt-0 pb-xl-0">
				<!-- Container -->
				<div class="container-xxl">
					<!-- Row -->
					<div class="row">
						<div class="col-sm-10 position-relative mx-auto">
							<div class="auth-content py-8">
								<form class="w-100" method="post" action="valida.php">
									<div class="row">
										<div class="col-lg-5 col-md-7 col-sm-10 mx-auto">
											<div class="text-center mb-7">
												<a class="navbar-brand me-0" href="index-2.html">
													<img class="brand-img d-inline-block" src="dist/img/logo-light.png" alt="brand">
												</a>
											</div>
											<div class="card card-lg card-border">
												<div class="card-body">
													<h4 class="mb-4 text-center">Repositor</h4>
													<div class="row gx-3">
														<div class="form-group col-lg-12">
															<div class="form-label-group">
																<label>Login</label>
															</div>
															<input type="text" name="usuario" required="required" class="form-control" placeholder="Informe seu login" value="">
														</div>
														<div class="form-group col-lg-12">
															<div class="form-label-group">
																<label>Senha</label>
																
															</div>
															<div class="input-group password-check">
																<span class="input-affix-wrapper">
																	<input class="form-control" placeholder="Informe sua senha" value="" name="senha" required type="password">
																	<a href="#" class="input-suffix text-muted">
																		<span class="feather-icon"><i class="form-icon" data-feather="eye"></i></span>
																		<span class="feather-icon d-none"><i class="form-icon" data-feather="eye-off"></i></span>
																	</a>
																</span>
															</div>
														</div>
													</div>
													<div class="d-flex justify-content-center">
														
													</div>
													<input type="submit" id="btnLogin" name="btnLogin" class="btn btn-primary btn-uppercase btn-block" value="ACESSAR">
													
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /Row -->
				</div>
				<!-- /Container -->
			</div>
			<!-- /Page Body -->

			<!-- Page Footer -->
			<div class="hk-footer border-0">
				<footer class="container-xxl footer">
					<div class="row">
						
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