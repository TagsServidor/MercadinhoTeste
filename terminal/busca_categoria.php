<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;


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

$sqlc1 = "SELECT * FROM carrinho c INNER JOIN produtos p on c.produto_carrinho = p.id_produto INNER JOIN produtos_unidades pu on c.unidade_produto_unidade = pu.id_produto_unidades where c.session_carrinho = '$session' and c.unidade_carrinho = '$unidade'  ";
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
	
<div class="page_loader"></div>

<!-- Login 4 start -->
<div class="login-4">
   
    <div class="container-fluid">
            <div class="text-center mb-5">
                    <img src="assets/img/logo.png" alt="logo" class="">
            </div>
        <div class="row">
           
       
        
            
            <div class="col-xl-12 col-lg-12 col-md-12 bg-color-4">
                <div class="form-section">
					
					
					
                  <div class="text-center mb-5">
                    <h4 class="text-white">Seja bem vindo <?php echo $cliente_nome ?></h4>
                  </div>
                    
					
                   
                    <div class="text-center mt-5 mb-5"><h3 class="text-white">Escolha categoria abaixo</h3> </div>

                   
                        
                  
           
		<form action="categoria.php" method="post">
			
			<?php // listando em um box os instrutores

			  echo "<SELECT NAME='departamento' SIZE='1' class='form-select mb-5' required id='filtro'>

<OPTION VALUE='' SELECTED> Localizar por categoria ";
// Selecionando os dados da tabela em ordem decrescente
$sqldp = "SELECT * FROM produtos_departamentos where departamentos_status ='1'  ORDER BY departamentos_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultadodp = mysqli_query($conn, $sqldp);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linhadp=mysqli_fetch_array($resultadodp)) {
echo "<OPTION VALUE='".$linhadp['id_departamentos']."'>".($linhadp['departamentos_nome']);
}
echo "</SELECT>";

?>
			
			</form>
            <div class="row">
            <div class="col-md-12">
                <button onclick="history.go(-1);" class="btn btn-danger btn-lg btn-theme p-0 mb-3">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> VOLTAR</button>
                </div>
            </div>
            </div>
            
                    
                  
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
<!-- <script src="assets/js/teclado-text.js"></script> -->
	
</body>
</html>