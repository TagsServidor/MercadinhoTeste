<!-- MOdais sacola -->

<!-- Modal -->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Escolha a forma de pagamento!</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
		  -->

      </div>

      <div class="text-center">


        <div class="modal-body">
          <div class="row">

            <div class="col-md-4 text-center">
              <form id="add_apagar" method="post" action="payment_pix.php">
                <button type="submit" class="btn btn-success btn-lg text-white"><i class="fa fa-qrcode" aria-hidden="true"></i>
                  </i>
                  PIX</button>

                <input type="hidden" name="terminal" value="<?php echo $linhat['id_terminal'] ?>">
                <input type="hidden" name="maquina" value="<?php echo $linhat['id_maquina'] ?>">
                <input type="hidden" name="registro" value="<?php echo $session ?>">
                <input type="hidden" name="valor" value="<?php echo $totalcar2 ?>">
              </form>
            </div>


            <div class="col-md-4">
              <form id="add_apagar" method="post" action="payment_cart_credit.php">
                <button type="submit" class="btn btn-info btn-lg text-white"><i class="fa fa-credit-card" aria-hidden="true"></i>
                  Crédito</button>

                <input type="hidden" name="terminal" value="<?php echo $linhat['id_terminal'] ?>">
                <input type="hidden" name="maquina" value="<?php echo $linhat['id_maquina'] ?>">
                <input type="hidden" name="registro" value="<?php echo ltrim($session) ?>">
                <input type="hidden" name="valor" value="<?php echo $totalcar2 ?>">
              </form>
            </div>

            <div class="col-md-4">

              <form id="add_apagar" method="post" action="payment_cart_debit.php">
                <button type="submit" class="btn btn-primary btn-lg float-right"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                  Débito</button>
            </div>
            <input type="hidden" name="terminal" value="<?php echo $linhat['id_maquina'] ?>">
            <input type="hidden" name="registro" value="<?php echo ltrim($session) ?>">
            <input type="hidden" name="valor" value="<?php echo $totalcar2 ?>">
            <input type="hidden" name="maquina" value="<?php echo $linhat['id_maquina'] ?>">

            </form>


          </div>
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
      <div class="text-center modal-body">
        <strong>
          <h2>OPERAÇÃO REALIZADA NA MAQUINA DE CARTÃO </h3>
        </strong> <BR><img src="loading.gif" width="150" height="150" alt="" />
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
      <div class="text-center modal-body">
        <strong>
          <h2>OPERAÇÃO REALIZADA NA MAQUINA DE CARTÃO </h3>
        </strong> <BR><img src="loading.gif" width="150" height="150" alt="" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar?</button>
        <input type="text" inputmode="none" name="terminal" value="<?php echo $linhat['id_terminal'] ?>">
        <input type="text" inputmode="none" name="terminal" value="<?php echo $linhat['id_maquina'] ?>">
      </div>
    </div>
  </div>
</div>

<!-- End Modais sacola -->
<!-- Modais index -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe src="consultar.php">...</iframe>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Offline-->
<div class="modal fade" id="modalOffline" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalOfflineLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h5 class="modal-title text-center text-white font-weight-bold" id="modalOfflineLabel"><strong> OPS! :/</strong></h5>
      </div>
      <div class="modal-body">
        <h3 class="text-white ">Terminal sem conexão.<br /> Baixe o nosso App e continue suas compras.</h3>
        <div class="col-md-12">
          <img src="assets/img/qrcode_baixar.png" alt="" class="img-fluid mx-auto d-block qrcode">
        </div>
      </div>

    </div>
  </div>
</div>
<!-- End Modais index -->

<!-- Modais Sacola -->
<div class="modal fade" tabindex="-1" id="myAlert" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <h5>Sacola vazia</h5>
    </div>
  </div>
</div>



<!--End Modais Sacola -->