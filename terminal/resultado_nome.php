<?php include 'head.php'; ?>
<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'];
$condominio = $_SESSION['condominio'];
$cpf = $_SESSION['cpf'];
$id_cliente = $_SESSION['id_cliente'];
$cliente_nome = $_SESSION['cliente_nome'];


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

?>


<?php if (($cliente_nome == '') and ($id_cliente <> '198')) { ?>

  <style>
    .container {
      height: 500px;
      width: 100%;
      overflow-y: scroll;
    }

    /* WHATSAPP FIXO */
    .whatsapp-fixo {
      position: fixed;
      bottom: 10px;
      right: 10px;
      z-index: 999;

    }

    html,
    body {
      height: 100%;
    }

    .wrap {
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .button2 {
      min-width: 60px;
      min-height: 60px;
      font-family: 'Nunito', sans-serif;
      font-size: 22px;
      text-transform: uppercase;
      letter-spacing: 1.3px;
      font-weight: 700;
      color: #313133;
      background: #D84848;
      border: none;
      border-radius: 1000px;
      transition: all 0.3s ease-in-out 0s;
      cursor: pointer;
      outline: none;
      color: #fff;
      position: relative;
      padding: 10px;
    }

    button2::before {
      content: '';
      border-radius: 1000px;
      min-width: calc(300px + 12px);
      min-height: calc(60px + 12px);
      border: 6px solid #00FFCB;
      box-shadow: 0 0 60px rgba(0, 255, 203, .64);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      opacity: 0;
      transition: all .3s ease-in-out 0s;
    }

    .button2:hover,
    .button2:focus {
      color: #313133;
      transform: translateY(-6px);
    }

    button2:hover::before,
    button2:focus::before {
      opacity: 1;
    }

    .button2a::after {
      content: '';
      width: 30px;
      height: 30px;
      border-radius: 100%;
      border: 6px solid #00FFCB;
      position: absolute;
      z-index: -1;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      animation: ring 1.5s infinite;
    }



    @keyframes ring {
      0% {
        width: 30px;
        height: 30px;
        opacity: 1;
      }

      100% {
        width: 300px;
        height: 300px;
        opacity: 0;
      }
    }

  </style>
  <div class="whatsapp-fixo">


    <div class="wrap">
      <a href="completar_dados.php" ?><button class="button2a button2"> <i class="fa fa-user-plus" aria-hidden="true"></i>
        </button></a>
    </div>


  </div>

<?php } ?>



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

            $busca = $_POST['palavra']; // palavra que o usuario digitou

            $sqlpu = "SELECT * FROM produtos_unidades pu INNER JOIN produtos p ON pu.produto_unidade_produto = p.id_produto where pu.produto_unidade_unidade = '$unidade' and pu.produto_unidade_status ='1'  and p.produto_nome LIKE '%$busca%' ";
            $resultadopu = mysqli_query($conn, $sqlpu);
            $totalpu = mysqli_num_rows($resultadopu);

            ?>
            <div class="row">

              <div class="col-12 text-left">
                <a href="busca_nome.php"> <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Localizar por nome </button> </a>


              </div>

              <div class="col-6 text-end">
              <?php if ($_GET['id'] <> '0') { ?>
                
                  <h5 class="text-end"> <?php echo $linhacat['departamentos_nome'] ?></h5>
                
              <?php  } else { ?>
                
                <h5 class="text-end">TODOS</h5>
              
              <?php } ?>

            </div>

              <!-- <div class="col-6 text-center">
						<a href="busca_categoria.php"> <button class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>  Localizar por categoria </button></a>
                    </div>   	 -->

            </div>

          </div>

          <hr>

        </div>
<!-- 
        <div class="alert alert-primary">
          <div class="row">
            <div class="col-sm-1"><strong>Produto</strong> </div>

            <div class="col-sm-7"> </div>

            <div class="col-sm-2"><strong>Valor</strong> </div>

            <div class="col-sm-2"><strong>Add</strong> </div>

          </div>
        </div> -->

        <div class="container2">

        <div class="row">
          <?php

          while ($produto = mysqli_fetch_array($resultadopu)) {


            $sqlos2a = "SELECT * FROM entrada_produtos where entrada_produto = $produto[id_produto] order by id_entrada desc   ";
            $resultadoos2a = mysqli_query($conn, $sqlos2a);
            $produtoa = mysqli_fetch_array($resultadoos2a);

       /// VERIFICANDO SE TEM PROMOCAO ATIVA
                   
       if($id_cliente <> '198') { // VERIFICA SE O CLIENTE ESTA CADASTRADO 
            
        $sqlpr = "SELECT * FROM promocoes  where promo_status ='1' and  promo_produto = '$produto[produto_unidade_produto]' and promo_unidade in ('0','$unidade') and  promo_local in ('TERMINAL','AMBOS') and promo_inicio <= STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s') and promo_fim > STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s')    ";
        $resultadopr = mysqli_query($conn, $sqlpr);
        $totalpr = mysqli_num_rows($resultadopr);
        $linhapr = mysqli_fetch_array($resultadopr);
       }
          ?>
      
           <div class="card m-1" style="width: 23.5%;">
                  <img src="../produtos/<?php echo $produto['produto_foto'] ?> " class="card-img-top" alt="" />

                  <div class="card-body">


                   <?php
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
                    <button type="submit" class="btn btn-success embaixo" style="border-radius: 30px;"><i class="fa fa-plus"></i> Adicionar </button>


                    <input type="hidden" name="session_carrinho" value="<?php echo $session ?>">
                    <input type="hidden" name="produto" value="<?php echo $produto['produto_unidade_produto'] ?>">
                    <input type="hidden" name="unidade" value="<?php echo $unidade ?>">
                    <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
                    <input type="hidden" name="cpf_cliente" value="<?php echo $cpf ?>">
                    <input type="hidden" name="cliente" value="<?php echo $id_cliente ?>">
                    <input type="hidden" name="produto_unidade" value="<?php echo $produto['id_produto_unidades'] ?>">
                    <input type="hidden" value="<?php echo $produtoa['entrada_unitario'] ?>" name="precocusto">

                    <input type="hidden" value="<?php echo $produto['produto_unidade_valor'] ?>" name="valoruni">
                    <input type="hidden" value="<?php echo $produto['produto_unidade_valor'] ?>" name="valorpago">
                  </form>
                  </div>
                </div>

            
          <?php } ?>
        </div>
        </div>
      </div>


      <div class="col-xl-4 col-lg-5 col-md-12 bg-color-4">
        <div class="form-section">
         
            <div class="row">
              <div class="col-md-7"><h5 class="mb-3 text-white"><?php echo $linhau['unidade_nome'] ?></h5></div>
              <div class="col-md-5"> <img src="assets/img/logo.png" alt="logo" class="img-fluid"></div>
              
            </div>

          <div class="text-center mt-3 mb-3">
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
                        } else { ?> R$ <?php echo number_format(@$totalcar2, 2, ',', '.');   ?> <?php } ?></span>
                </div>
              </div>
            </div>

          </div>


          <div class="row">
            <div class="col-md-12 mb-3">
              <a href="sacola.php"> <button type="submit" class="btn btn-success btn-lg btn-theme p-0">
                  <i class="fa fa-shopping-basket" aria-hidden="true"></i> VER SACOLA</button></a>
            </div>

            <div class="col-md-12 text-center mb-3">
              <a href="index.php?unidade=<?php echo $unidade ?>&condominio=<?php echo $condominio ?>"> <button type="submit" class="btn btn-danger btn-lg btn-theme p-0"> <i class="fa fa-ban" aria-hidden="true"></i> CANCELAR </button> </a>

            </div>

            <div class="col-md-12 text-center mb-3">
              <a href="inicio.php"> <button type="submit" class="btn btn-info btn-lg btn-theme p-0"> <i class="fa fa-barcode" aria-hidden="true"></i> USAR LEITOR </button> </a>

            </div>

          </div>


        </div>


      </div>
    </div>
  </div>
</div>
</div>
<!-- Login 4 end -->

<?php include 'modais.php'; ?>
<!-- Login 4 end -->
<!-- <script src="keyboard/Keyboard2.js"></script> -->
<!-- External JS libraries -->
<script src="assets/js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="assets/js/popper.min.js" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js" crossorigin="anonymous"></script>  
<!-- Custom JS Script -->
<script>
  document.getElementById('filtro').addEventListener('change', function() {
    this.form.submit();
  });
  var hasAutofocus = document.getElementById('focus').autofocus;
  // };
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