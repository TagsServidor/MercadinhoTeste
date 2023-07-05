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


if ($_GET['session'] <> '') {

  @$conn->query("DELETE from p_apagar where registro_apagar = $_GET[session] ");
}

/// localizando pedidos minas

if($unidade == "93")  {
$sqlpu = "SELECT * FROM pedidos where pedido_unidade = 93 and pedido_cliente = $id_cliente and pedido_status = 2  ";
$resultadopu = mysqli_query($conn, $sqlpu);
$totalpu = mysqli_num_rows($resultadopu);
}

/// CONECTANDO AO CONDOMINIO

$sqlc = "SELECT * FROM condominios c where c.id_condominio = '$condominio' and c.condominio_status ='1' ";
$resultadoc = mysqli_query($conn, $sqlc);
$totalc = mysqli_num_rows($resultadoc);
$linhac = mysqli_fetch_array($resultadoc);

/// CONECTANDO A UNIDADE

$sqlu = "SELECT * FROM unidades  where id_unidade = '$unidade' and unidade_status  ='1' ";
$resultadou = mysqli_query($conn, $sqlu);
$totalu = mysqli_num_rows($resultadou);
$linhau = mysqli_fetch_array($resultadou);

/// CONECTANDO AO TERMINAL

$sqlt = "SELECT * FROM terminais  where id_unidade = '$unidade' and status_terminal ='1' ";
$resultadot = mysqli_query($conn, $sqlt);
$totalt = mysqli_num_rows($resultadot);
$linhat = mysqli_fetch_array($resultadot);

$sqlc1 = "SELECT * FROM carrinho c INNER JOIN produtos p on c.produto_carrinho = 
id_produto INNER JOIN produtos_unidades pu on c.unidade_produto_unidade = pu.id_produto_unidades where c.session_carrinho = $registro_apagar and c.unidade_carrinho = '$unidade'  ";
$resultadoc1  = mysqli_query($conn, $sqlc1);
while ($carrinhoc1 = mysqli_fetch_array($resultadoc1)) {

  if($id_cliente <> '198') { // VERIFICA SE O CLIENTE ESTA CADASTRADO 
    $sqlpr = "SELECT * FROM promocoes  where  promo_status ='1' and promo_produto = '$carrinhoc1[produto_carrinho]' and promo_unidade in ('0','$unidade') and  promo_local in ('TERMINAL','AMBOS') and promo_inicio <= STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s') and promo_fim > STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s')    ";
    $resultadopr = mysqli_query($conn, $sqlpr);
    $totalpr = mysqli_num_rows($resultadopr);
    $linhapr = mysqli_fetch_array($resultadopr);
   }
   
  @$totalcar2a +=   $carrinhoc1['qtd_carrinho'] * $linhapr['promo_valor'];
@$totalcar2a +=  $carrinhoc1['qtd_carrinho'] * $carrinhoc1['produto_unidade_valor'];

   if  ($totalpr >= '1') { 
       
       
    if((($unidade == "93") and ($totalcar2a > '30') and ($totalpu == '0'))) {      
       
  @$totalcar2 +=   $carrinhoc1['qtd_carrinho'] * $linhapr['promo_valor'] - 10.00;
    } else {
        
 @$totalcar2 +=   $carrinhoc1['qtd_carrinho'] * $linhapr['promo_valor'];

    }
  
  
   } else { 
       
       
    if((($unidade == "93") and ($totalcar2a > '30') and ($totalpu == '0'))) {      
    @$totalcar2 +=   $carrinhoc1['qtd_carrinho'] * $carrinhoc1['produto_unidade_valor'] - 10.00;
} else {
    @$totalcar2 +=   $carrinhoc1['qtd_carrinho'] * $carrinhoc1['produto_unidade_valor'];
}

   }



  @$itenscar +=   $carrinhoc1['qtd_carrinho'];
}

// CARREGANDO ITENS DA SACOLA

$sqlsa = "SELECT * FROM carrinho c INNER JOIN produtos p ON c.produto_carrinho = p.id_produto

INNER JOIN produtos_unidades pu ON c.unidade_produto_unidade = pu.id_produto_unidades

where c.session_carrinho = $registro_apagar and c.cliente_carrinho = $id_cliente and c.status_carrinho = 1  ";
$resultadosa = mysqli_query($conn, $sqlsa);
$totalsa = mysqli_num_rows($resultadosa);


if ($totalsa == '0') {
?>

  <script>
    $('#myAlert').modal('show');
    setTimeout('inicio.php', 9000);
  </script>


<?php } ?>

<?php if (($cliente_nome == '') and ($cpf <> '091.240.500-75')) { ?>

  <style>
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

    .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
    }

    .divContent {
      overflow: hidden;
      border: solid 1px red;
    }

    /* mobile phone */
    @media screen and (max-width:360px) {
      #divContent {
        overflow: scroll;
        border: solid 1px green;
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


<?php include 'head.php'; ?>

<!-- Login 4 start -->
<div class="login-4">

  <div class="container-fluid">

    <div class="row">


      <div class="col-md-8 bg-img d-flex align-items-start p-0">

        <div class="info">

          <div class="table-itens table-responsive mt-0">
            <table class="table table-striped">

              <thead class="thead-dark">
                <tr class="table-success">
                  <th scope="col" style="width: 10%;">Remover</th>
                  <th scope="col" style="width: 45%;">itens</th>
                  <th scope="col" style="width: 20%;" class="text-center">Quantidade</th>
                  <th scope="col" style="width: 10%;" class="text-center">Unidade</th>
                  <th scope="col" style="width: 15%;" class="text-center">Total</th>
                </tr>
              </thead>
              <tbody>

                <div id="divContent" class='content'>
                  <?php
                  while ($sacola1 = mysqli_fetch_array($resultadosa)) {



                    if($id_cliente <> '198') { // VERIFICA SE O CLIENTE ESTA CADASTRADO 
                      $sqlpr = "SELECT * FROM promocoes  where promo_status ='1' and  promo_produto = '$sacola1[produto_carrinho]' and promo_unidade in ('0','$unidade') and  promo_local in ('TERMINAL','AMBOS') and promo_inicio <= STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s') and promo_fim > STR_TO_DATE('$atual', '%Y-%m-%d %H:%i:%s')    ";
                      $resultadopr = mysqli_query($conn, $sqlpr);
                      $totalpr = mysqli_num_rows($resultadopr);
                      $linhapr = mysqli_fetch_array($resultadopr);
                     }
                     $totalunidade2 = $sacola1['qtd_carrinho'] * $sacola1['produto_unidade_valor'];

                     if  ($totalpr >= '1') { 
                    $totalunidade = $sacola1['qtd_carrinho'] * $linhapr['promo_valor'];

                     } else { 
                      $totalunidade = $sacola1['qtd_carrinho'] * $sacola1['produto_unidade_valor'];
                  
                     }




                    
                  ?>

                    <tr>
                      <td class="text-center" scope="row"><a href="remover_item.php?id=<?php echo $sacola1['id_carrinho'] ?>" data-toggle="modal" data-target="#cancelar"> <button><i class="fa fa-trash text-danger" aria-hidden="true"></i>
                          </button></a></td>

                      <td><?php echo $sacola1['produto_nome'] ?></td>
                      <td>
                        <div class="row">
                          <div class="col-4 text-center">
                            <form action="atualizar.php" method="post"><input type="hidden" value="<?php echo $sacola1['id_carrinho'] ?>" name="id"><input name="id" type="hidden" value="<?php echo $sacola1['id_carrinho'] ?> "> <button class="b">-</button></form>
                          </div>

                          <div class="col-4 text-center">
                            <input class="maismenos text-center" type="text" name="quantidade" value="<?php echo $sacola1['qtd_carrinho'] ?>" id="<?php echo $sacola1['id_carrinho'] ?>" style="width: 100%">
                          </div>

                          <div class="col-4 text-center">
                            <form action="atualizar_mais.php" method="post"> <input type="hidden" value="<?php echo $sacola1['id_carrinho'] ?>" name="id"><button class="b">+</button></form>
                          </div>
                        </div>
                      </td>
                      <td class="text-center">
                        
                        <?php
                      if  ($totalpr >= '1') { ?>
                      <span  style="text-decoration: line-through; color: orange"> R$<?php echo $sacola1['produto_unidade_valor'] ?> </span><br>
                      <span  class="text-success"> R$<?php echo $linhapr['promo_valor'] ?> </span>
                      <?php } else { ?>
                      
                      
                      R$<?php echo $sacola1['produto_unidade_valor'] ?>
                    
                    <?php } ?>

                    </td>
                      <td class="text-center">
                        
                      <?php
                      if  ($totalpr >= '1') { ?>
                      <span  style="text-decoration: line-through; color: orange"> R$<?php echo number_format($totalunidade2, 2, ',', '.');  ?> </span><br>
                      <span  class="text-success"> R$<?php echo number_format($totalunidade, 2, ',', '.');  ?> </span>
                      <?php } else { ?>
                      
                      
                        R$<?php echo number_format($totalunidade, 2, ',', '.');  ?>
                    
                    <?php } ?>
                    
                    
                    
                    </td>
                    </tr>

                  <?php } ?>

                </div>
                <script>
                  function mais() {
                    var atual = document.getElementById("teste").value;
                    var novo = atual - (-1); //Evitando Concatenacoes
                    document.getElementById("teste").value = novo;
                  }

                  function menos() {
                    var atual = document.getElementById("teste").value;
                    if (atual > 0) { //evita números negativos
                      var novo = atual - 1;
                      document.getElementById("teste").value = novo;
                    }
                  }
                </script>

              </tbody>
              <tfoot>

              </tfoot>
            </table>

          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-5 col-md-12 bg-color-4">
        <div class="form-section">


          <div class="row">
            <div class="col-md-7">
              <h5 class="mb-3 text-white"><?php echo $linhau['unidade_nome'] ?></h5>
            </div>
            <div class="col-md-5"> <img src="assets/img/logo.png" alt="logo" class="img-fluid"></div>

          </div>

          <div class="text-center mt-3 mb-3">
            <h3 class="text-white">Minha Sacola</h3>
            <?php
    if((($unidade == "93") and ($totalcar2a > '30') and ($totalpu == '0'))) {      
?>
<div align="center">
   Você ganhou R$10 desconto na sua primeira compra
  </div>
<?php } ?>
          </div>




          <?php if (@$itenscar != 0) { ?>

          <div class="row mb-3">
            <div class="col-md-6">
              <div class="card card-info">
                <div class="card-header bg-success text-white text-center">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  Itens
                </div>
                <div class="card-body text-center">
                  <span><?php echo @$itenscar  ?></span>
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
                        } else { ?> 
                        
                        <?php      if((($unidade == "93") and ($totalcar2a > '30') and ($totalpu == '0'))) {       ?>
                        R$ <?php echo number_format($totalcar2 + 10.00, 2, ',', '.');  ?> 
                        <?php } else { ?>
                                                R$ <?php echo number_format($totalcar2, 2, ',', '.');  ?> 

                        
                        <?php }} ?> 
                        
                        
                        
                        
                        <?php if((($unidade == "93") and ($totalcar2a > '30') and ($totalpu == '0'))) { ?> - <span style="text-decoration: line-through;" >10.00</span>  
                        <br>
                        R$ <?php echo number_format($totalcar2, 2, ',', '.');  ?> <?php } ?></span>
                </div>
              </div>
            </div>

          </div>

          <?php }; ?>
          <div class="row">
          <?php if (@$itenscar != 0) { ?>
            <div class="col-md-12 mb-3">
              <button type="submit" class="btn btn-success btn-lg btn-theme p-0" data-toggle="modal" data-target="#modalExemplo"> <i class="fa fa-money" aria-hidden="true"></i> PAGAR</button>

            </div>
          <?php }; ?>

            <div class="col-md-12 mb-3">
              <a href="localizar_produto.php"> <button type="submit" class="btn btn-warning btn-lg btn-theme p-0">
                  <i class="fa fa-plus" aria-hidden="true"></i> MAIS ITENS</button></a>
            </div>


            <div class="col-md-12 text-center mb-3">
              <a href="index.php?unidade=<?php echo $unidade ?>"> <button type="submit" class="btn btn-danger btn-lg btn-theme p-0"> <i class="fa fa-ban" aria-hidden="true"></i> CANCELAR </button> </a>

            </div>


          </div>



          <form action="add_item.php" method="post">

            <input type="text" id="leitor" inputmode="none" name="produto" autofocus class="input">


          </form>


          <script>
            function autofocus() {
              document.getElementById('leitor').focus();
            }
            setInterval(function() {
              autofocus();
            }, 10 * 100);
          </script>


          <Style>
            .input {
              background: rgba(0, 0, 0, 0.0);
              border-color: nome;
              font-size: 1px;
              border-style: hidden;
              border: hidden;
              outline: 0;
            }
          </Style>
          <form action="add_item.php" method="post">
            <input type="text" name="produto" autofocus class="input">
          </form>


        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'modais.php'; ?>

<div class="modal" tabindex="-1" id="cancelar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remover Item</h5>
      
      </div>
      <div class="modal-body">
        <p>Deseja realmente remover este item?</p>
      </div>
      <div class="modal-footer">
        <form action="atualizar.php" method="post">
          <input type="hidden" value="<?php echo $sacola1['id_carrinho'] ?>" name="id">
          <input name="id" type="hidden" value="<?php echo $sacola1['id_carrinho'] ?> "> 
          <button type="button" class="btn btn-warning">Sim</button>
        </form> 
        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Não</button>
      </div>
    </div>
  </div>
</div>


<!-- <input placeholder="Quantos quartos?" min=0 id="total" type="number"><button onclick="menos()" class="a">-</button><button onclick="mais()" class="b">+</button> -->

<!-- Login 4 end -->

<!-- External JS libraries -->

<script src="assets/js/jquery-2.2.4.js"></script>
<script src="assets/js/popper.min.js" crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<!-- Custom JS Script -->
<script>
  // jQuery(window).load(function() {
  //   $(".loader").delay(100).fadeOut("slow"); //retire o delay quando for copiar!
  //   $("#tudo_page").toggle("fast");
  // });

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