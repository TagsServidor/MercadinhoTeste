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

<!DOCTYPE html>
<html lang="pt-BR">

<?php include "head.php";?>
	
<body id="top">

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
        
        <div class="row">
           
        
        
            
            <div class="col-xl-12 col-lg-12 col-md-12 bg-color-4">
                <div class="form-section">
					
					<div class="text-center mb-5">
                            <img src="assets/img/logo.png" alt="logo" class="">
                    </div>
					
                  <div class="text-center mb-5">
                    <h4 class="text-white">Seja bem vindo <?php echo $cliente_nome ?></h4>
                  </div>
                    
                   
                    <div class="text-center mt-5 mb-5"><h3 class="text-white">Passe o produto no leitor ou clique no botão abaixo</h3> </div>

                   
                        
                  
           
		<form action="add_item.php" method="post">
			
			<input type="text" name="produto" autofocus class="input" >
			
			
			</form>

                    <div class="row">
                        <div class="col-md-12">
                            <a href="localizar_produto.php"> <button type="submit" class="btn btn-warning btn-lg btn-theme p-0">
                                <i class="fa fa-search" aria-hidden="true"></i>
 LOCALIZAR PRODUTO</button></a>
                        </div>
                        
                        
                    </div>
                    
                  
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 4 end -->

<!-- External JS libraries -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Custom JS Script -->
<script>
  document.getElementById('filtro').addEventListener('change', function() {
    this.form.submit();
});
</script>
	
	
	
</body>
</html>