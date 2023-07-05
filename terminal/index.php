<?php include 'head.php'; ?>
<?php

// CONEXAO COM O BANCO DE DADOS

include "bd/conexao.php";
// MONTANDO CODIGO DA SESSION



for ($i = 0; $i < 10; $i++) {

  $registro = rand(10000, 99999) . "

";
}

date_default_timezone_set('America/Sao_Paulo');

$data1 = date('Y-m-d');

$hora2 = date('H:i:s');

$datageral = date('Y-m-d');

$data = substr($data1, 8, 2) . '/' . substr($data1, 5, 2) . '/' . substr($data1, 0, 4);

$hora = substr($hora2, 0, 2) . 'h' . substr($hora2, 3, 2) . 'min';

$segd = date('Ymd');

$segh = date('His');

$seghs = date('s');



$seguranca = $_GET['unidade'] . $seghs . $registro;


if($_GET[id] <> '') {

  @$conn->query("update p_apagar set tentou_pagar  = '1' , falha = 'sim'   where id_apagar = $_GET[id] and tentou_pagar  = '0'   ");

}




/// CONECTANDO A UNIDADE



$sqlu = "SELECT * FROM unidades  where id_unidade = '$_GET[unidade]' and unidade_status ='1' ";

$resultadou = mysqli_query($conn, $sqlu);

$totalu = mysqli_num_rows($resultadou);

$linhau = mysqli_fetch_array($resultadou);



/// CONECTANDO TERMINAL A MAQUINA



$sqltu = "SELECT * FROM terminais  where id_unidade = '$_GET[unidade]'  ";

$resultadotu = mysqli_query($conn, $sqltu);

$totaltu = mysqli_num_rows($resultadotu);

$linhatu = mysqli_fetch_array($resultadotu);





/// VERIFICANDO SE EXISTE TRANSAÇÃO EM ABERTO NO SISTEMA

$sqlsa = "SELECT * FROM p_apagar where tentou_pagar = 0 and id_terminal = $linhatu[id_terminal]   ";
$resultadosa = mysqli_query($conn, $sqlsa);
$totalsa = mysqli_num_rows($resultadosa);







?>

<?php



$result_vendas = "SELECT  SUM(alerta_valor) AS qtd ,  alerta_data, alerta_unidade, alerta_motivo, alerta_produto, alerta_data, alerta_produto_unidade  FROM alertas_reposicao where alerta_data  BETWEEN '2023-01-09' and '2100-01-09'     and alerta_unidade = $_GET[unidade] and alerta_motivo = '1' group by alerta_produto ";

$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
while ($rows_vendas = mysqli_fetch_assoc($resultado_vendas)) {

  $sqlva = "SELECT *  FROM os_produtos where os_produtos_id = $rows_vendas[alerta_produto_unidade]  ";
  $sqlpva = mysqli_query($conn, $sqlva);
  $produtou = mysqli_fetch_array($sqlpva);
  $totalitem = $rows_vendas['qtd'] *   $produtou['os_produtos_valor'];
  $totalprejuizo += $totalitem;
}

$sqltv = "SELECT SUM(pedido_valor) AS total_vendas  FROM pedidos WHERE pedido_status ='2' and pedido_unidade = $_GET[unidade] and pedido_data  BETWEEN '2023-01-09' and '2100-01-09'      ";
$resultadotv = mysqli_query($conn, $sqltv);
$totaltv = mysqli_num_rows($resultadotv);
$totalvendas = mysqli_fetch_array($resultadotv);

$valor_base = $totalvendas['total_vendas'];
$valor = $totalprejuizo;
$resultado2 = ($valor / $valor_base) * 100;


$honestidade2  = substr($resultado2, 0, 2);
$honestidade  = 100 - $honestidade2;


// echo $valor_base;
// echo $valor;
?>



<style>
  .show {

    display: block !important
  }
</style>




<?php if ($totalsa >= '1') {
  @$conn->query("update p_apagar set tentou_pagar  = '1' , falha = 'sim'   where tentou_pagar = 0 and id_terminal = $linhatu[id_terminal]   ");


?>

  <!-- Modal -->

  <div class="modal show " id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

      <div class="modal-content">

        <div class="modal-header">

          <div class="text-center">

            <h5 class="modal-title" id="staticBackdropLabel">Atenção!!</h5>

          </div>







        </div>

        <div class="modal-body">

          <h6 class="text-center">Desculpe, houve uma falha de comunicação com a máquina de pagamento. Por favor, utilize o aplicativo de celular <span style="color:red;"> (qr code abaixo) </span> ou clique em ok e escolha a opção "pix" pelo próprio terminal para realizar a compra.</h6> <br><br>





          <div class="row text-center">

            <div class="col-12 text-center">



              <img src="assets/img/qrcode_baixar.png" alt="" class="mx-auto d-block qrcode2"><Br><Br>

              <form method="post" action="index.php?unidade=<?php echo $_GET['unidade'] ?>">

                <button type="submit" class="btn btn-success" style="width:80%;">Ok</button>

              </form>

            </div>





            <!-- <div class="col-6"> 

				 

		  <img src="passo2.gif" width="280" height="280" alt=""/>

				   <Br>

				   <h6> Clique em OK passos realizados</h6>

		  </div> -->



          </div>



        </div>





      </div>

    </div>

  </div>



<?php } ?>







<!-- <p>The network is: <span id="indicator">(state unknown)</span> -->



<style class="cp-pen-styles">
  /* fade slider */

  .slides {

    height: 100vh;

    width: 100vw;

    margin: 0;

    overflow: hidden;

    position: absolute;





  }



  .slides ul {

    list-style: none;

    position: relative;

  }



  /* keyframes #anim_slides */

  @-webkit-keyframes anim_slides {

    0% {

      opacity: 0;

    }



    6% {

      opacity: 1;

    }



    24% {

      opacity: 1;

    }



    30% {

      opacity: 0;

    }



    100% {

      opacity: 0;

    }

  }



  @-moz-keyframes anim_slides {

    0% {

      opacity: 0;

    }



    6% {

      opacity: 1;

    }



    24% {

      opacity: 1;

    }



    30% {

      opacity: 0;

    }



    100% {

      opacity: 0;

    }

  }



  .slides ul li {

    opacity: 0;

    position: absolute;

    top: 0;



    /* css3 animation */

    -webkit-animation-name: anim_slides;

    -webkit-animation-duration: 24.0s;

    -webkit-animation-timing-function: linear;

    -webkit-animation-iteration-count: infinite;

    -webkit-animation-direction: normal;

    -webkit-animation-delay: 0;

    -webkit-animation-play-state: running;

    -webkit-animation-fill-mode: forwards;



    -moz-animation-name: anim_slides;

    -moz-animation-duration: 24.0s;

    -moz-animation-timing-function: linear;

    -moz-animation-iteration-count: infinite;

    -moz-animation-direction: normal;

    -moz-animation-delay: 0;

    -moz-animation-play-state: running;

    -moz-animation-fill-mode: forwards;

  }



  /* css3 delays */

  .slides ul li:nth-child(2),

  .slides ul li:nth-child(2) div {

    -webkit-animation-delay: 6.0s;

    -moz-animation-delay: 6.0s;

  }



  .slides ul li:nth-child(3),

  .slides ul li:nth-child(3) div {

    -webkit-animation-delay: 12.0s;

    -moz-animation-delay: 12.0s;

  }



  .slides ul li:nth-child(4),

  .slides ul li:nth-child(4) div {

    -webkit-animation-delay: 18.0s;

    -moz-animation-delay: 18.0s;

  }



  .slides ul li img {

    display: block;

    height: 100vh;

    width: 100vw;

    position: absolute;

  }



  /* keyframes #anim_titles */

  @-webkit-keyframes anim_titles {

    0% {

      left: 100%;

      opacity: 0;

    }



    5% {

      left: 10%;

      opacity: 1;

    }



    20% {

      left: 10%;

      opacity: 1;

    }



    25% {

      left: 100%;

      opacity: 0;

    }



    100% {

      left: 100%;

      opacity: 0;

    }

  }



  @-moz-keyframes anim_titles {

    0% {

      left: 100%;

      opacity: 0;

    }



    5% {

      left: 10%;

      opacity: 1;

    }



    20% {

      left: 10%;

      opacity: 1;

    }



    25% {

      left: 100%;

      opacity: 0;

    }



    100% {

      left: 100%;

      opacity: 0;

    }

  }



  .slides ul li div {

    background-color: #000000;

    border-radius: 10px 10px 10px 10px;

    box-shadow: 0 0 5px #FFFFFF inset;

    color: #FFFFFF;

    font-size: 26px;

    left: 10%;

    margin: 0 auto;

    padding: 20px;

    position: absolute;

    top: 50%;

    width: 200px;



    /* css3 animation */

    -webkit-animation-name: anim_titles;

    -webkit-animation-duration: 24.0s;

    -webkit-animation-timing-function: linear;

    -webkit-animation-iteration-count: infinite;

    -webkit-animation-direction: normal;

    -webkit-animation-delay: 0;

    -webkit-animation-play-state: running;

    -webkit-animation-fill-mode: forwards;



    -moz-animation-name: anim_titles;

    -moz-animation-duration: 24.0s;

    -moz-animation-timing-function: linear;

    -moz-animation-iteration-count: infinite;

    -moz-animation-direction: normal;

    -moz-animation-delay: 0;

    -moz-animation-play-state: running;

    -moz-animation-fill-mode: forwards;

  }

  .aviso {

    width: 300px;

    position: absolute;

    left: 20px;

    bottom: 20px;

  }
</style>



<div class="page_loader"></div>



<!-- Login 4 start -->

<div class="login-4">



  <div class="container-fluid">



    <div class="row">

      <div class="col-xl-8 col-lg-7 col-md-12 absolute">



      </div>

      <div class="col-xl-8 col-lg-7 col-md-12 bg-img">

        <div class="slides">

          <ul>

            <!-- slides -->
            <li><img src="promocoes/s2.jpg" alt="image02" />

              <!-- <div>Promo text #2</div> -->

            </li>

            <li><img src="promocoes/s1.jpg" alt="image01" />

              <!-- <div>Promo text #1</div> -->

            </li>

            <li><img src="promocoes/s2.jpg" alt="image02" />

              <!-- <div>Promo text #2</div> -->

            </li>

            <li><img src="promocoes/s1.jpg" alt="image01" />

              <!-- <div>Promo text #1</div> -->

            </li>

            



          </ul>

        </div>

        <div class="info">

          <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" style="animation-delay: 1.5s;">

            <div class="carousel-inner">

              <div class="carousel-item active">

                <div class="box-image">

                  <div></div>



                </div>



              </div>

              <div class="carousel-item ">

                <div class="box-image">

                  <div></div>



                </div>



              </div>



            </div>

          </div>



        </div>

      </div>



      <div class="col-xl-4 col-lg-5 col-md-12 bg-color-4">

        <div class="form-section">

          <div class="text-center">

            <img src="assets/img/logo.png" alt="logo">

            <h4 class="text-center text-white mt-3 mb-3"><?php echo $linhau['unidade_nome'] ?></h4>

          </div>



          <div class="text-center">

            <h5 class="text-white text-center">Para iniciar sua compra informe seu CPF abaixo</h5>

          </div>

          <div class="login-inner-form">

            <form action="iniciar.php" method="post">

              <div class="form-group clearfix">

                <div class="form-box">

                  <input name="cpf" type="number" class="form-control keyboardnumber-number" required id="first_field" placeholder="Informe o seu CPF" autocomplete="off"  maxlength="14">

                  <i class="flaticon-user-1"></i>

                  <div id="dvCpf" style="display: none"> Cpf Invalido</div>

                </div>

              </div>



              <div class="checkbox form-group clearfix">





              </div>

              <div class="form-group clearfix mb-0">

                <button type="submit" class="btn btn-primary btn-lg btn-theme">INICIAR</button>

              </div>



              <input type="hidden" name="registro" value="<?php echo rtrim($seguranca) ?>">

              <input type="hidden" name="unidade" value="<?php echo $_GET['unidade'] ?>">

              <input type="hidden" name="condominio" value="<?php echo $_GET['condominio'] ?>">





            </form>

            <form action="iniciar.php" method="post" class="mt-4">

              <button type="submit" class="btn btn-success btn-lg btn-theme">INICIAR SEM CPF</button>

              <input type="hidden" name="registro" value="<?php echo $seguranca  ?>">

              <input type="hidden" name="unidade" value="<?php echo $_GET['unidade'] ?>">

              <input type="hidden" name="condominio" value="<?php echo $_GET['condominio'] ?>">

              <input type="hidden" name="cpf" value="091.240.500-75">

            </form>



            <div class="extra-login mt-0"></div>


            <div class="row">


              <div class="col-6">

                <h6 class="text-white text-center">Baixe o nosso aplicativo</h6>




                <img src="assets/img/qrcode_baixar.png" alt="" class="mx-auto d-block qrcode2">

              </div>


              <div class="col-6 text-center">

                <h6 class="text-white">Indice de honestidade</h6>


                <div style="background-color: #fff; border-radius: 5px; padding: 5px">


                  <div class="row">


                    <div class="col-2">

                      <?php if ($honestidade > 94 && $honestidade < 100) { ?>
                        <img src="icones/alegre.jpg" style="height: 30px" alt="" />
                      <?php } ?>

                      <?php if ($honestidade > 50 && $honestidade < 94) { ?>
                        <img src="icones/medio.jpg" style="height: 30px" alt="" />
                      <?php } ?>

                      <?php if ($honestidade > 25 && $honestidade < 50) { ?>
                        <img src="icones/triste2.jpg" style="height: 30px" alt="" />
                      <?php } ?>

                      <?php if ($honestidade > 0 && $honestidade < 25) { ?>
                        <img src="icones/triste.jpg" style="height: 30px" alt="" />
                      <?php } ?>


                    </div>
                    <div class="col-10">

                      <?php if ($honestidade > 94 && $honestidade < 100) { ?>
                        <div class="progress col-10" style="height: 30px">
                          <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $honestidade ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
                        </div>
                    </div>

                  <?php } ?>


                  <?php if ($honestidade > 50 && $honestidade < 95) { ?>
                    <div class="progress col-10" style="height: 30px">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $honestidade ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
                    </div>
                  </div>

                <?php } ?>

                <?php if ($honestidade > 25 && $honestidade < 50) { ?>
                  <div class="progress col-10" style="height: 30px">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $honestidade ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
                  </div>
                </div>

              <?php } ?>

              <?php if ($honestidade > 0 && $honestidade < 25) { ?>
                <div class="progress col-10" style="height: 30px">
                  <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $honestidade ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $honestidade ?>%</div>
                </div>
              </div>

            <?php } ?>

            </div>

            <img src="https://chart.googleapis.com/chart?cht=qr&chl=https://mercadinho.top/indice_honestidade/index.php?unidade=<?php echo $_GET['unidade'] ?>&chs=260x260&chld=L|0" class="qr-code img-thumbnail img-responsive" style="width: 130px; height: 130px" />


          </div>



        </div>



      </div>

    </div>

  </div>

</div>

</div>







<?php include 'modais.php'; ?>





<!-- Login 4 end -->

<script>
  function formatInput(campoTexto) {

    if (campoTexto.value.length <= 11) {

      campoTexto.value = cpfMask(campoTexto.value);

    } else {

      campoTexto.value = cnpjMask(campoTexto.value);

    }

  }



  function retirarFormatacao(campoTexto) {

    campoTexto.value = campoTexto.value.replace(/(\.|\/|\-)/g, "");

  }



  function cpfMask(valor) {

    return valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3\-\$4");

  }



  function cnpjMask(valor) {

    return valor.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3\/\$4\-\$5");

  }



  function validate(evt) {

    var theEvent = evt || window.event;



    // Handle paste

    if (theEvent.type === 'paste') {

      key = event.clipboardData.getData('text/plain');

    } else {

      // Handle key press

      var key = theEvent.keyCode || theEvent.which;

      key = String.fromCharCode(key);

    }

    var regex = /[0-9]|\./;

    if (!regex.test(key)) {

      theEvent.returnValue = false;

      if (theEvent.preventDefault) theEvent.preventDefault();

    }

  }
</script>

<script>
  function changeValues() {

    var userFormat = document.getElementById("usuario");

    userFormat.value = userFormat.value.replace(/[&\/\\#,+()$~%.'":*?<>{}-]/g, "");

    console.log(userFormat);

  }
</script>

<script language="JavaScript" type="text/javascript">
  function mascaraData(campoData) {

    var data = campoData.value;

    if (data.length == 2) {

      data = data + '/';

      document.forms[0].data.value = data;

      return true;

    }

    if (data.length == 5) {

      data = data + '/';

      document.forms[0].data.value = data;

      return true;

    }

  }
</script>





<!-- External JS libraries -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Custom JS Script -->



<!-- <script src="assets/js/teclado-number.js"></script> -->

<script>
  $(function() {

    $('.carousel').carousel({

      interval: 3000,

      pause: "false",



    });

  });

  // window.onload = function () {



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