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

  @$totalcar2 +=   $carrinhoc1['qtd_carrinho'] * $carrinhoc1['produto_unidade_valor'];
  @$itenscar +=   $carrinhoc1['qtd_carrinho'];
}

?>


<?php if ($cliente_nome == '') { ?>

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
  </style>
  <div class="whatsapp-fixo">


    <div class="wrap">
      <a href="completar_dados.php" ?><button class="button2a button2"> <i class="fa fa-user-plus" aria-hidden="true"></i>
        </button></a>
    </div>


  </div>

<?php } ?>


<?php include "head.php"; ?>

<body id="top">

  <!-- <div class="page_loader"></div> -->

  <!-- Login 4 start -->
  <div class="login-4">

    <div class="container-fluid">

      <div class="row">

        <div class="col-xl-8 col-lg-7 col-md-12">
          <div class="text-center">
            <h4><?php echo $linhau['unidade_nome'] ?></h4>
          </div>

          <div class="g-3 align-items-center mt-5 mb-5">

            <div class="row">



              <?php
              // CARREGANDO PRODUTOS
              $sqlpu = "SELECT * FROM produtos_unidades pu INNER JOIN produtos p ON pu.produto_unidade_produto = p.id_produto where pu.produto_unidade_unidade = '$unidade' and pu.produto_unidade_status ='1' and pu.produto_unidade_departamento = $_POST[departamento] ";
              $resultadopu = mysqli_query($conn, $sqlpu);
              $totalpu = mysqli_num_rows($resultadopu);

              ?>

              <div class="col-12">
                <form action="categoria.php" method="post">
                  <?php // listando em um box os instrutores

                  echo "<SELECT NAME='departamento' SIZE='1' class='form-select' required id='filtro'>

<OPTION VALUE='' SELECTED> Informe o categoria ";
                  // Selecionando os dados da tabela em ordem decrescente
                  $sqldp = "SELECT * FROM produtos_departamentos where departamentos_status ='1'  ORDER BY departamentos_nome";
                  // Executando $sql e verificando se tudo ocorreu certo.
                  $resultadodp = mysqli_query($conn, $sqldp);
                  //Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
                  while ($linhadp = mysqli_fetch_array($resultadodp)) {
                    echo "<OPTION VALUE='" . $linhadp['id_departamentos'] . "'>" . ($linhadp['departamentos_nome']);
                  }
                  echo "</SELECT>";

                  ?>
                </form>

              </div>


            </div>



            <hr>

          </div>

          <!-- <div class="alert alert-primary">
            <div class="row">
              <div class="col-sm-1"><strong>Produto</strong> </div>

              <div class="col-sm-7"> </div>

              <div class="col-sm-2"><strong>Valor</strong> </div>

              <div class="col-sm-2"><strong>Add</strong> </div>

            </div>
          </div> -->

          <style>
            .container {
              height: 500px;
              width: 100%;
              overflow-y: scroll;
            }
            .embaixo{
              position: absolute;
              left: 5%;
              bottom: 20px;
              width: 90%;
            }

            .card{
              padding-bottom: 40px;
            }
          </style>
          <div class="container">


            <?php

            while ($produto = mysqli_fetch_array($resultadopu)) {  ?>
              <div class="card m-1" style="width: 23.5%;">
                <img src="../produtos/<?php echo $produto['produto_foto'] ?> " class="card-img-top" alt="" />

                <div class="card-body">
                  <h5 class="card-title text-success">R$<?php echo $produto['produto_unidade_valor'] ?></h5>
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

                  </form>
                </div>
              </div>
              
            <?php } ?>

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

            <div class="text-center mt-5 mb-5">
              <h3 class="text-white">Minha Sacola</h3>
            </div>

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
                    <span><?php if (@$totalcar2 == '') {
                          } else { ?> R$ <?php echo @$totalcar2 ?> <?php } ?></span>
                  </div>
                </div>
              </div>

            </div>


            <div class="row mb-5">
              <div class="col-md-6 mb-3">
                <a href="sacola.php"> <button type="submit" class="btn btn-warning btn-lg btn-theme p-0">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i> VER SACOLA</button></a>
              </div>
              <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-success btn-lg btn-theme p-0" data-toggle="modal" data-target="#modalExemplo"> <i class="fa fa-money" aria-hidden="true"></i> PAGAR</button>

              </div>
            </div>

            <div class="row mt-5">
              <div class="col-md-12 mb-3 text-center">
                <a href="index.php?unidade=<?php echo $unidade ?>&condominio=<?php echo $condominio ?>" onclick="return confirm('Deseja realmente cancelar sua compra?')"> <button type="submit" class="btn btn-danger btn-lg btn-theme p-0"> <i class="fa fa-ban" aria-hidden="true"></i> CANCELAR </button> </a>
              </div>

              <div class="col-md-12 mb-3 text-center">
                <a href="inicio.php"> <button type="submit" class="btn btn-info btn-lg btn-theme p-0"> <i class="fa fa-barcode" aria-hidden="true"></i> USAR LEITOR </button> </a>
              </div>

            </div>



            <!-- Modal -->
            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Escolha a forma de pagamento!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>


                  </div>

                  <div class="text-center">


                    <div class="modal-body">
                      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalExemplo2">Crédito</button>
                      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalExemplo3">Débito</button>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Credito -->
            <div class="modal fade" id="modalExemplo2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pagamento no cartão de crédito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center">
                    <strong>
                      <h2>OPERAÇÃO REALIZADA NA MAQUINA DE CARTÃO </h3>
                    </strong> <br><img src="loading.gif" width="150" height="150" alt="" />
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar ?</button>

                  </div>
                </div>
              </div>
            </div>


            <!-- Modal Debito -->
            <div class="modal fade" id="modalExemplo3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pagamento no cartão de débito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center">
                    <strong>
                      <h2>OPERAÇÃO REALIZADA NA MAQUINA DE CARTÃO </h3>
                    </strong> <BR><img src="loading.gif" width="150" height="150" alt="" />
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar?</button>

                  </div>
                </div>
              </div>
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