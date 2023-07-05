<!doctype html>
<html lang="pt_br">

<head>
        
        <meta charset="utf-8" />
        <title>Mercadino</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>
<script>
    console.log(a);

    
</script>
    <body class="authentication-bg">
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <a href="#" class="mb-4 d-block auth-logo">
                                <img src="assets/images/logo-dark.png" alt="" height="42" class="logo logo-dark">
                                <img src="assets/images/logo-light.png" alt="" height="42" class="logo logo-light">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">
                           
                            <div class="card-body p-4"> 
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Bem vindo de volta!</h5>
                                    <p class="text-muted">Faça seu login abaixo</p>
                                </div>
                                <div class="p-2 mt-4">
<form  action="valida.php" method="post">
        
                                        <div class="mb-3">
                                            <label class="form-label" for="username">Login</label>
											<input name="usuario" id="usuario" class="form-control" type="text" maxlength="14" required >
                                            
                                        </div>
                
                                        <div class="mb-3">
                                            <div class="float-end">
                                                

                                            </div>
                                            <label class="form-label" for="userpassword">Senha</label>
                                           <input type="password" name="senha" class="form-control" required="" id="senha"> 
                                        </div>
                
                                        
                                        
                                        <div class="mt-3 text-end">
                                           <input onclick="changeValues()" style="background-color:#009c82" name="btnLogin" type="submit" value="Acessar" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                        </div>
            
                                        

                                        
                                            
            
                                           

                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Esqueceu sua senha? <a href="#" class="fw-medium text-primary"> Clique aqui </a> </p>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>

                        <div class="mt-5 text-center text-white">
                            <p>© <script>document.write(new Date().getFullYear())</script> Mercadinho <i class="fa fa-heart text-success"></i> 100% Nacional</p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>

</html>
