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

<head>

    <title>Mercadinho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">
<link href="estilo.css" rel="stylesheet" type="text/css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="assets/css/skins/default.css">
<script type="text/javascript" src="funcs.js"></script>

</head>
	
<body id="top">

<div class="page_loader"></div>

<!-- Login 4 start -->
<div class="login-4">
   
    <div class="container-fluid">
        
        <div class="row">
           
            <div class="col-xl-8 col-lg-7 col-md-12">
                <div align="center">   <h4><?php echo $linhau['unidade_nome'] ?></h4></div>

              <div class="g-3 align-items-center mt-5 mb-5">
              
                  <div class="row">
                    
                    <div class="col-6">
						<form action="sacola.php" method="post">
                      <input type="text"  id="busca" autocomplete="off" onkeyup="buscarNoticias(this.value)" autofocus  class="form-control" value="" placeholder="Busque pelo produto" name="busca">
						<div id="resultado"  style="position: absolute; z-index: 9999; padding: 15px" ></div>
 </form>
						
						
                    </div>
                   
					  <?php
	// CARREGANDO PRODUTOS
	
$sqlpu = "SELECT * FROM produtos_unidades pu INNER JOIN produtos p ON pu.produto_unidade_produto = p.id_produto where pu.produto_unidade_unidade = '$unidade' and pu.produto_unidade_status ='1' ";
$resultadopu = mysqli_query($conn, $sqlpu);
$totalpu = mysqli_num_rows($resultadopu);	
				
					?>
					  
                    <div class="col-6">
						  <form action="categoria.php" method="post">
						<?php // listando em um box os instrutores

			  echo "<SELECT NAME='departamento' SIZE='1' class='form-select' required id='filtro'>

<OPTION VALUE='' SELECTED> Informe o categoria ";
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
					
                    </div>

                    
                  </div>
                  
             

                <hr>
                
              </div>
                
                <div class="info">
                  <div class="row"> 
						
						
					<?php 
						
						while ($produto = mysqli_fetch_array($resultadopu)) {  ?>
						
					   <div class="col-sm-4"> 
						<div class="card">
  <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4ixslkv5r632jeKg4SS2d-yc2nNDemAwXjA&usqp=CAU" alt="Card image cap">
  <div class="card-body">
    <strong style="font-size: 12px; color: #000"><?php echo $produto['produto_nome'] ?></strong>
                          <h5 class="card-text">R$ <?php echo $produto['produto_unidade_valor'] ?></h5>
	  
	  <form action="add_carrinho.php" method="post"> 
							
							<input type="hidden" name="session_carrinho" value="<?php echo $session ?>"> 
						    	<input type="hidden" name="produto" value="<?php echo $produto['produto_unidade_produto'] ?>"> 
							    <input type="hidden" name="unidade" value="<?php echo $unidade ?>"> 
						         <input type="hidden" name="condominio" value="<?php echo $condominio ?>"> 
							<input type="hidden" name="cpf_cliente" value="<?php echo $cpf ?>"> 
							<input type="hidden" name="cliente" value="<?php echo $id_cliente ?>">
							<input type="hidden" name="produto_unidade" value="<?php echo $produto['id_produto_unidades'] ?>">
                          <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adicionar</button>
								
							</form>	
  </div>
</div></div>
						
						
						
                     
						
						<?php } ?>
						
						

                     
                      </div>    
                   
                </div>
            </div>
            
            <div class="col-xl-4 col-lg-5 col-md-12 bg-color-4">
                <div class="form-section">
                  <div class="text-center mb-5">
                    <h4 class="text-white">Seja bem vindo <?php echo $cliente_nome ?></h4>
                  </div>
                    <div class="text-center mb-5">
                            <img src="assets/img/logo.png" alt="logo" class="">
                    </div>
                   
                    <div class="text-center mt-5 mb-5"><h3 class="text-white">Minha Sacola</h3> </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header bg-success text-white text-center">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                     Itens
                                </div>
                                <div class="card-body text-center">
                                    <span><?php echo @$itenscar ?></span>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header bg-success text-white text-center">
                                    <i class="fa fa-usd" aria-hidden="true"></i>
                                     Total a pagar
                                </div>
                                <div class="card-body  text-center">
                                 <span><?php if (@$totalcar2 =='') {} else { ?> R$ <?php echo @$totalcar2 ?> <?php } ?></span>
                                </div>
                              </div>
                        </div>
                        
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <a href="sacola.php"> <button type="submit" class="btn btn-warning btn-lg btn-theme p-0">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i> VER SACOLA</button></a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-lg btn-theme p-0"><i class="fa fa-money" aria-hidden="true"></i> PAGAR</button>

                        </div>
                        
                    </div>
                    
                  
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 4 end -->

<!-- External JS libraries -->
<script src="assets/js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/popper.min.js" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Custom JS Script -->
<script>
  document.getElementById('filtro').addEventListener('change', function() {
    this.form.submit();
});
</script>
	
	
	
</body>
</html>