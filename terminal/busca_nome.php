<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;

$registro_apagar = rtrim($session);


include "bd/conexao.php";


/// CONECTANDO AO CONDOMINIO

$sqlc = "SELECT * FROM condominios c where c.id_condominio = '$condominio' and c.condominio_status ='1' ";
$resultadoc = mysqli_query($conn, $sqlc);
$totalc = mysqli_num_rows($resultadoc);	
$linhac = mysqli_fetch_array($resultadoc);
 
/// CONECTANDO A UNIDADE

$sqlu = "SELECT * FROM unidades  where id_unidade = '$unidade' and unidade_status ='1' ";
$resultadou = mysqli_query($conn, $sqlu);
$totalu = mysqli_num_rows($resultadou);	
$linhau = mysqli_fetch_array($resultadou);

$sqlc1 = "SELECT * FROM carrinho c INNER JOIN produtos p on c.produto_carrinho = p.id_produto INNER JOIN produtos_unidades pu on c.unidade_produto_unidade = pu.id_produto_unidades where c.session_carrinho = $registro_apagar and c.unidade_carrinho = '$unidade'  ";
$resultadoc1  = mysqli_query($conn, $sqlc1);
while ($carrinhoc1 = mysqli_fetch_array($resultadoc1)){ 

@$totalcar2 += 	$carrinhoc1['qtd_carrinho'] * $carrinhoc1['produto_unidade_valor'];
@$itenscar += 	$carrinhoc1['qtd_carrinho'];

}

?>

<?php include "head.php";?>

	<Style>
		.input {
	    background: rgba(0, 0, 0, 0.0);
		border-color: nome;
		font-size: 1px;
		border-style: hidden;
		border:hidden;
		   outline: 0;
	}
	</Style>
	
<!-- <div class="page_loader"></div> -->

<!-- Login 4 start -->
<div class="login-4">
   
    <div class="container-fluid bg-color-4 ">
        
        <div class="row">
            <div class="d-flex justify-content-start">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2 mb-5">
                            <img src="assets/img/logo.png" alt="logo" class="img-fluid">
                        </div>
                        <div class="col-md-8"></div>
                        <div class="col-md-2 float-md-right">
                            <a href="localizar_produto.php" class="btn btn-warning btn-lg btn-theme p-0 mb-3">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> VOLTAR</button></a>
                        </div>
                    </div>
                </div>
                
            </div>
             
            <div class="d-flex justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6 ">
           
            <div class="form-section">
               
                <div class="text-center ">
                <h4 class="text-white">Seja bem vindo <?php echo $cliente_nome ?></h4>
                </div>
                    
                <div class="text-center mt-3 mb-5"><h3 class="text-white">Informe o produto desejado</h3> </div>
            
                <form action="resultado_nome.php" method="post">
            
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="palavra" class="form-control keyboard-text mb-5" placeholder="Informe nome produto">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-md btn-theme p-0 mb-3 rounded-50">
                                <i class="fa fa-search" aria-hidden="true"></i> LOCALIZAR</button>
                        </div>

                        
                    </div>
                </form>

            </div>
            </div>
            
        </div>
    </div>
</div>	
<?php include 'modais.php';?>	

	
	
<!-- External JS libraries -->
<script src="assets/js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/popper.min.js" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Custom JS Script -->

<!-- <script src="assets/js/teclado-text.js"></script> -->
<script>
    // };
    function OpenBootstrapPopup() {
        $("#modalOffline").modal({
          show : true,
          focus : true
        });
    }

    function CloseModal() {
        $("#modalOffline").modal('hide');
    }
</script>

</body>
</html>