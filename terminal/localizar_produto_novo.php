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



$sqlsa = "SELECT * FROM carrinho c INNER JOIN produtos p ON c.produto_carrinho = p.id_produto

INNER JOIN produtos_unidades pu ON c.unidade_produto_unidade = pu.id_produto_unidades

where c.session_carrinho = $registro_apagar and c.cliente_carrinho = $id_cliente and c.status_carrinho = 1  ";

$resultadosa = mysqli_query($conn, $sqlsa);

$totalsa = mysqli_num_rows($resultadosa);





?>
<!DOCTYPE html>
<html>
<head>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

</head>
<body>


</body>
</html>
<?php include "head.php";?>



<div class="page_loader"></div>




<!-- Login 4 start -->

<div class="login-4">

   

    <div class="container-fluid">

        

        <div class="row">

           

            <div class="col-xl-6 col-lg-7 col-md-12">

   

				<div class="container">

					   

  <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3">

					
			<?php
					
$sqlpu = "SELECT * FROM produtos_unidades pu INNER JOIN produtos p ON pu.produto_unidade_produto = p.id_produto where pu.produto_unidade_unidade = '$unidade' and pu.produto_unidade_status ='1' order by p.produto_nome asc";
$resultadopu = mysqli_query($conn, $sqlpu);
$totalpu = mysqli_num_rows($resultadopu);
while ($produto = mysqli_fetch_array($resultadopu)) { 
	?>
					 <div class="col">

				<form id="produto" method="post" action="#">  
					
					
      <div class="p-3 border text-white" align="center" style="border-radius: 10px; height: 200px">
	  <img src="https://mercadinho.top/produtos/<?php echo $produto['produto_foto'] ?> " height="40" alt=""/> <br>
	  <span class="text-black-50"> <?php echo $produto['produto_nome'] ?></span><br><br>sas
		  
		  <input type="submit">
		  
		  
			</div></div>	
						 
						 
			</form>				
					
					
		<script>
	
	 $(document).ready(function() {
    $('#produto').on('change', function() {
	 
		 
	
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'produtos.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#resultsd").empty();
				$("#resultsd").append(msg);
			}
			
		});
		 
		 return false;
	 });
 
 });



</script>			
					
					
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
	  </script>	
	  
	  
	  
	  
					<?php } ?>

			

    </div></div></div>


				

						

						
			
			



            

            <div class="col-xl-6 col-lg-5 col-md-12 bg-color-4">

				b <div id="resultsd"> </div>

						

                    </div>

                    

                  

		<?php include 'modais.php';?>

					



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