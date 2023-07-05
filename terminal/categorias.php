<?php

@session_start();

$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'];
$condominio = $_SESSION['condominio'];
$cpf = $_SESSION['cpf'];
$id_cliente = $_SESSION['id_cliente'];
$cliente_nome = $_SESSION['cliente_nome'];
$registro_apagar = rtrim($session);

include "bd/conexao.php";

/// CONECTANDO AO CONDOMINIO
$sqlc = "SELECT * FROM condominios c where c.id_condominio = '$condominio' and c.condominio_status ='1' ";
$resultadoc = mysqli_query($conn, $sqlc);
$totalc = mysqli_num_rows($resultadoc);
$linhac = mysqli_fetch_array($resultadoc);

// CATEGORIA

$sqlcat = "SELECT * FROM produtos_departamentos  where id_departamentos = $_GET[id] ";
$resultadocat = mysqli_query($conn, $sqlcat);
$linhacat = mysqli_fetch_array($resultadocat);


/// CONECTANDO A UNIDADE
$sqlu = "SELECT * FROM unidades  where id_unidade = '$unidade' and unidade_status ='1' ";
$resultadou = mysqli_query($conn, $sqlu);
$totalu = mysqli_num_rows($resultadou);
$linhau = mysqli_fetch_array($resultadou);


$sqlc1 = "SELECT * FROM carrinho c INNER JOIN produtos p on c.produto_carrinho = p.id_produto INNER JOIN produtos_unidades pu on c.unidade_produto_unidade = pu.id_produto_unidades where c.session_carrinho = $registro_apagar and c.unidade_carrinho = '$unidade'  ";

$resultadoc1  = mysqli_query($conn, $sqlc1);

while ($carrinhoc1 = mysqli_fetch_array($resultadoc1)) {


  if($id_cliente <> '198') { // VERIFICA SE O CLIENTE ESTA CADASTRADO 
    $sqlpr = "SELECT * FROM promocoes  where promo_status ='1' and  promo_produto = '$carrinhoc1[produto_carrinho]' and promo_unidade in ('0','$unidade') and  promo_local in ('TERMINAL','AMBOS') and promo_inicio <= STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s') and promo_fim > STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s')    ";
    $resultadopr = mysqli_query($conn, $sqlpr);
    $totalpr = mysqli_num_rows($resultadopr);
    $linhapr = mysqli_fetch_array($resultadopr);
   }

   if  ($totalpr >= '1') { 
  @$totalcar2 +=   $carrinhoc1['qtd_carrinho'] * $linhapr['promo_valor'];
   } else { 
    @$totalcar2 +=   $carrinhoc1['qtd_carrinho'] * $carrinhoc1['produto_unidade_valor'];

   }



  @$itenscar +=   $carrinhoc1['qtd_carrinho'];

}


$sqlsa = "SELECT * FROM carrinho c INNER JOIN produtos p ON c.produto_carrinho = p.id_produto

INNER JOIN produtos_unidades pu ON c.unidade_produto_unidade = pu.id_produto_unidades

where c.session_carrinho = $registro_apagar and c.cliente_carrinho = $id_cliente and c.status_carrinho = 1  ";

$resultadosa = mysqli_query($conn, $sqlsa);

$totalsa = mysqli_num_rows($resultadosa);

?>

<?php include "head.php"; ?>



<!-- <div class="page_loader"></div> -->



<!-- Login 4 start -->

<div class="login-4">



  <div class="container-fluid">



    <div class="row">



      <div class="col-xl-8 col-lg-7 col-md-12">

        <div class="g-3 align-items-center mt-3 mb-3">

          <div class="row">


            <?php

            // CARREGANDO PRODUTOS

            if ($_GET['id'] <> '0') {

              $sqlpu = "SELECT * FROM produtos_unidades pu INNER JOIN produtos p ON pu.produto_unidade_produto = p.id_produto where pu.produto_unidade_unidade = '$unidade' and pu.produto_unidade_status ='1' and pu.produto_unidade_departamento = '$_GET[id]' order by p.produto_nome asc";
            } else {

              $sqlpu = "SELECT * FROM produtos_unidades pu INNER JOIN produtos p ON pu.produto_unidade_produto = p.id_produto where pu.produto_unidade_unidade = '$unidade' and pu.produto_unidade_status ='1'order by p.produto_nome asc";
            }

            $resultadopu = mysqli_query($conn, $sqlpu);

            $totalpu = mysqli_num_rows($resultadopu);

            ?>

            <div class="col-6">
              <a href="busca_nome.php">
                <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Localizar por nome </button> 
              </a>
            </div>

            <div class="col-6 text-end">
              <?php if ($_GET['id'] <> '0') { ?>
                
                  <h5 class="text-end"> <?php echo $linhacat['departamentos_nome'] ?></h5>
                
              <?php  } else { ?>
                
                <h5 class="text-end">TODOS</h5>
              
              <?php } ?>

            </div>


            <!-- <div class="col-6 text-center">

                      <a href="busca_categoria.php"> 

                        <button class="btn btn-primary">

                          <i class="fa fa-search" aria-hidden="true"></i>Localizar por categoria

                        </button>

                      </a>

                    </div> -->


          </div>



          <hr>

        </div>

        

        <style>
          .container2 {

            height: 640px;

            width: 100%;

            overflow-y: scroll;
            overflow-x: hidden;
          }

          .embaixo{
              position: absolute;
              left: 5%;
              bottom: 20px;
              width: 90%;
            }

            .container2 .card{
              padding-bottom: 40px;
            }
        </style>

        <div class="container2 mt-3">

          <div class="container-fluid">
            <div class="row">
              <?php

              while ($produto = mysqli_fetch_array($resultadopu)) {

                $sqlos2a = "SELECT * FROM entrada_produtos where entrada_produto = $produto[id_produto] order by id_entrada desc   ";
                $resultadoos2a = mysqli_query($conn, $sqlos2a);
                $produtoa = mysqli_fetch_array($resultadoos2a);

                 /// VERIFICANDO SE TEM PROMOCAO ATIVA
                   
                 if($id_cliente <> '198') { // VERIFICA SE O CLIENTE ESTA CADASTRADO 
            
                 $sqlpr = "SELECT * FROM promocoes  where  promo_status ='1' and promo_produto = '$produto[produto_unidade_produto]' and promo_unidade in ('0','$unidade') and  promo_local in ('TERMINAL','AMBOS') and promo_inicio <= STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s') and promo_fim > STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s')    ";
                 $resultadopr = mysqli_query($conn, $sqlpr);
                 $totalpr = mysqli_num_rows($resultadopr);
                 $linhapr = mysqli_fetch_array($resultadopr);
                }

              ?>

                <div class="card m-1" style="width: 23.5%;">
                  <img src="../produtos/<?php echo $produto['produto_foto'] ?> " class="card-img-top" alt="" />

                  <div class="card-body">
                    

                  <?php 
                  //echo $atual; ?> <br>
                  <?php
                  //echo $linhapr['promo_inicio'];
                  
                  if  ($totalpr >= '1') { ?>

                   <div class="row">

                   <div class="col-6">                   <h5 class="card-title" style="text-decoration: line-through; color: orange"><strong>R$<?php echo $produto['produto_unidade_valor'] ?></strong></h5>
</div>
                   <div class="col-6">                   <h5 class="card-title text-success" ><strong>R$<?php echo $linhapr['promo_valor'] ?></strong></h5>
</div>



                  </div>


                  <?php } else {  ?>
                    <h5 class="card-title text-success"><strong>R$<?php echo $produto['produto_unidade_valor'] ?></strong></h5>
<?php } ?>

                    <p class="card-text"><?php echo $produto['produto_nome'] ?></p>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    <form action="add_carrinho.php" method="post">
                      <button type="submit" class="btn btn-success embaixo" style="border-radius: 30px; "><i class="fa fa-plus"></i> Adicionar </button>
                      <input type="hidden" name="session_carrinho" value="<?php echo $session ?>">
                      <input type="hidden" name="produto" value="<?php echo $produto['produto_unidade_produto'] ?>">
                      <input type="hidden" name="unidade" value="<?php echo $unidade ?>">
                      <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
                      <input type="hidden" name="cpf_cliente" value="<?php echo $cpf ?>">
                      <input type="hidden" name="cliente" value="<?php echo $id_cliente ?>">
                      <input type="hidden" name="produto_unidade" value="<?php echo $produto['id_produto_unidades'] ?>">

                      <input type="hidden" value="<?php echo $produtoa['entrada_unitario'] ?>" name="precocusto">

<input type="hidden" value="<?php echo $produto['produto_unidade_valor'] ?>" name="valoruni">


<?php  if  ($totalpr >= '1') { ?>
<input type="hidden" value="<?php echo $linhapr['promo_valor'] ?>" name="valorpago">
<?php } else {  ?>
  <input type="hidden" value="<?php echo $produto['produto_unidade_valor'] ?>" name="valorpago">
<?php } ?>

                    </form>
                  </div>
                </div>

              <?php } ?>
            </div>
          </div>

          


          

        </div>
          

      </div>


      <div class="col-xl-4 col-lg-5 col-md-12 bg-color-4">

        <div class="form-section">

          <!-- <div class="text-center mb-5">

            <h4 class="text-white">Seja bem vindo <?php //echo $cliente_nome ?></h4>

          </div> -->
          <div class="row mb-3">
          <div class="col-md-7"><h5 class="mb-3 text-white"><?php echo $linhau['unidade_nome'] ?></h5></div>
          <div class="col-md-5"> <img src="assets/img/logo.png" alt="logo" class="img-fluid"></div>
          
          </div>

         



          <?php if ($totalsa == "0") {
          } else {   ?>



            <div class="text-center mb-3">
              <h3 class="text-white">Minha Sacola</h3>
            </div>



            <div class="row mb-3">

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

                    <span><?php if (@$totalcar2 == '') {
                          } else { ?> R$ <?php echo number_format(@$totalcar2, 2, ',', '.');  ?> <?php } ?></span>

                  </div>

                </div>

              </div>



            </div>


            <div class="row">

              <div class="col-md-12 mb-3">

                <a href="sacola.php"> <button type="submit" class="btn btn-success btn-lg btn-theme p-0">

                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> VER SACOLA</button></a>

              </div>

              <?php } ?>



                <div class="col-md-12 text-center mb-3">

                  <a href="index.php?unidade=<?php echo $unidade ?>"> <button type="submit" class="btn btn-danger btn-lg btn-theme p-0"> <i class="fa fa-ban" aria-hidden="true"></i> CANCELAR </button> </a>

                </div>

                <div class="col-md-12 text-center mb-3">

                  <a href="inicio.php"> <button type="submit" class="btn btn-info btn-lg btn-theme p-0"> <i class="fa fa-barcode" aria-hidden="true"></i> USAR LEITOR </button> </a>

                </div>

                <div class="col-md-12 mb-3">
                  <a href="localizar_produto.php"> <button type="submit" class="btn btn-warning btn-lg btn-theme p-0">
                      <i class="fa fa-plus" aria-hidden="true"></i> MAIS ITENS</button></a>
                </div>


                

              </div>

            <?php include 'modais.php'; ?>

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

  function OpenBootstrapPopup() {

    $("#modalOffline").modal({

      show: true,

      focus: true

    });

  }



  function CloseModal() {

    $("#modalOffline").modal('hide');

  }
</script>

</body>

</html>