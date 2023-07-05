<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'];
$condominio = $_SESSION['condominio'];
$cpf = $_SESSION['cpf'];
$id_cliente = $_SESSION['id_cliente'];
$cliente_nome = $_SESSION['cliente_nome'];

$registro_apagar = rtrim($session);


if (!empty($_SESSION['registro'])) {
} else {
  $_SESSION['msg'] = "���rea restrita";
  header("Location: index.php?$unidade");
}


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
while ($carrinhoc1 = mysqli_fetch_array($resultadoc1)) {

  @$totalcar2 +=   $carrinhoc1['qtd_carrinho'] * $carrinhoc1['produto_unidade_valor'];
  @$itenscar +=   $carrinhoc1['qtd_carrinho'];
}

?>

<?php include "head.php"; ?>

<Style>
  .input {
    background: rgba(0, 0, 0, 0.0);

    border-color: nome;
    font-size: 1px;
    border-style: hidden;
    border: hidden;
    outline: 0;
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
</Style>

<!-- <div class="page_loader"></div> -->

<!-- Login 4 start -->
<div class="login-4">

  <div class="container-fluid bg-color-4">

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

    </div>
    <div class="row">
      <div class="d-flex justify-content-center">
        <div class="col-xl-4 col-lg-4 col-md-4 ">
          <div class="form-section">

            <div class="text-center mb-5">
              <h4 class="text-white">Seja bem vindo <?php echo $cliente_nome ?></h4>
            </div>

            <?php if (($cliente_nome == '') and ($cpf <> '091.240.500-75')) { ?>


              <div class="whatsapp-fixo">


                <div class="wrap">
                  <a href="completar_dados.php" ?><button class="button2a button2"> <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </button></a>
                </div>


              </div>





            <?php } ?>

            <div class="text-center mt-5 mb-5">
              <h3 class="text-white">Passe o produto no leitor ou clique no botão abaixo</h3>
            </div>





            <form action="add_item.php" method="post">

              <input type="text" inputmode="none" name="produto" id="leitor" autofocus class="input">


            </form>

            <div class="row">
              <div class="col-md-12">
                <a href="localizar_produto.php"> <button type="submit" class="btn btn-success btn-lg btn-theme p-0">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    LOCALIZAR PRODUTO</button></a>
              </div>


            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  function autofocus() {
    document.getElementById('leitor').focus();
  }
  setInterval(function() {
    autofocus();
  }, 10 * 100);
</script>


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