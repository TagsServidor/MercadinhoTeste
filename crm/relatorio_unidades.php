<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
  $_SESSION['msg'] = "Área restrita";
  header("Location: logar.php");
}
include "bd/conexao.php";
/// CONECTANDO OS PRODUTOS

$sql = "SELECT * FROM unidades u INNER JOIN condominios c on u.unidade_condominio = c.id_condominio where unidade_lixeira = 1";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);

?>

<style>
  .esconderbarras {
    font-size: 0px;
  }
</style>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/form_estoqueentrada.js"></script>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


<!-- Select com Busca-->
<link href="assets/js/select2.min.css" rel="stylesheet" />
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/select2.min.js"></script>

<!-- Responsive Table css -->
<link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

<!-- DataTables -->
<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->



<div id="dvConteudo">

  <div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
              <h4 class="mb-0">Relatórios &gt; Unidades</h4>

              <div class="page-title-right">
                <ol class="breadcrumb m-0">

                </ol>
              </div>

            </div>
          </div>
        </div>


      </div>


      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Temos um total de (<?php echo $total ?>) unidades cadastradas </h4><br>

            <table class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                <tr>
                  <th>Unidade</th>
                  <th>Condominio</th>
                  <!-- <th>Saúde</th> -->
                  <th>Status</th>
                  <th>Ações</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>


                  <?php // LISTANDO OS EM ABERTO

                  $data_hoje = date("Y-m-d");
                  $data_ontem = date("Y-m-d", strtotime("-1 day"));
                  $hora_atual = date('H:i:s');
                  while ($linha = mysqli_fetch_array($resultado)) {
                    //ANALISANDO SE HÁ VENDAS NO TOTAL
                    $sql_vendas_totais = "SELECT * FROM pedidos WHERE pedido_unidade = '" . $linha['id_unidade'] . "'";
                    $resultado_vendas_totais = mysqli_query($conn, $sql_vendas_totais);
                    $total_vendas_totais = mysqli_num_rows($resultado_vendas_totais);

                    //ANALISANDO SE HÁ VENDAS DENTRO DE 24 HORAS

                    $sql_pedidos = "SELECT * FROM pedidos WHERE pedido_unidade = '" . $linha['id_unidade'] . "' AND ((pedido_data = '$data_ontem' AND pedido_hora >= '$hora_atual') OR pedido_data = '$data_hoje') AND pedido_local = 1";
                    $resultado_pedidos = mysqli_query($conn, $sql_pedidos);
                    $total_pedidos = mysqli_num_rows($resultado_pedidos);

                    ///SOMANDO TOTAL DE VENDAS CONCLUIDAS
                    $sqlvc = "SELECT SUM(pedido_valor) AS totalvalor FROM pedidos where pedido_unidade = $linha[id_unidade] and pedido_status = '2'  ";
                    $resultadovc = mysqli_query($conn, $sqlvc);
                    $totalrv2 = mysqli_num_rows($resultadovc);
                    $linhavc = mysqli_fetch_array($resultadovc);

                    ///SOMANDO TOTAL SAIDAS EM CONTAS PAGAS
                    $sqlsp = "SELECT SUM(valor_apagar) AS totalpagas FROM apagar where unidade_apagar = $linha[id_unidade] and status_apagar = '2'  ";
                    $resultadosp = mysqli_query($conn, $sqlsp);
                    $linhasp = mysqli_fetch_array($resultadosp);


                    ///SOMANDO TOTAL CUSTO PRODUTOS OS
                    $sqlcp = "SELECT SUM(os_custo_total) AS totalcustoos FROM os_produtos where os_produtos_unidade = $linha[id_unidade]  and os_produtos_status = '2'  ";
                    $resultadocp = mysqli_query($conn, $sqlcp);
                    $linhacp = mysqli_fetch_array($resultadocp);





                    /// CONECTANDO AO ESTOQUE DA UNIDADE PARA PEGAR TOTAL VALOR DE PRODUTOS

                    $sqlpu2 = "SELECT * FROM produtos_unidades pu where pu.produto_unidade_unidade = '$linha[id_unidade]'   ";
                    $resultadopu2 = mysqli_query($conn, $sqlpu2);
                    $linhapu2 = mysqli_fetch_array($resultadopu2);
                    $totalestoque = $linhapu2[qtd_estoque];
                    $totalvalor = $linhapu2[totalvalor];
                    $totalestoque3 = $linhapu2['produto_unidade_estoque'];


                    $sqlpu2a = "SELECT * FROM entrada_produtos  where entrada_produto = $linhapu2[produto_unidade_produto]  ";
                    $resultadopu2a = mysqli_query($conn, $sqlpu2a);
                    $linhapu2a = mysqli_fetch_array($resultadopu2a);

                    $valortotalestoque1 = $linhapu2a['entrada_unitario'] * $totalestoque3;
                    $valortotalestoque += $valortotalestoque1;



                    $totaldespesas = $linhasp['totalpagas'] + $linhacp['totalcustoos'];
                    $saldo = $linhavc['totalvalor'] + $valortotalestoque - $totaldespesas;

                    /// LOGICA DO SALDO
                    /// PEGA TOTAL DE VENDAS - TOTAL DE SAIDAS EM CONTAS PAGAS - TOTAL DE DESPESAS DOS PRODUTOS ENVIADOS (PEGA NA OS)
                  ?>




                    <?php



                    $entrada2 = number_format($linhavc['totalvalor'], 2, ",", ".");
                    $saida2 = number_format($totaldespesas, 2, ",", ".");


                    $saida2a = str_replace(".", "", $saida2);
                    $saida = str_replace(",", "", $saida2a);

                    $entrada2a = str_replace(".", "", $entrada2);
                    $entrada = str_replace(",", "", $entrada2a);


                    if ($entrada == '000') {
                      $px =   $saida / 1 * 100;
                    } else {

                      $px =   $saida / $entrada * 100;
                    }

                    $result = substr($px, 0, 3);


                    ?>
                    <td><?php echo $linha['unidade_id'] ?> - <?php echo $linha['unidade_nome'] ?>
                    </td>
                    <td><?php echo $linha['condominio_nome'] ?></td>

                    <!-- <td>
                
               
               
               
               <?php  //echo $saldo  ; 
                ?> <?php if ($result <= '50') { ?>	<button class="btn btn-outline-success btn-sm edit">Equilibrada </button> <?php } ?>
								 
								 <?php if (($result >= '51') && ($result <= '89')) { ?>
								 
								 
								 <button class="btn btn-outline-warning btn-sm edit">Precisa atenção </button> <?php } ?> <?php if ($result >= '90') { ?><button class="btn btn-outline-danger btn-sm edit">Ruim </button> <?php } ?>  </td> -->

                    <td><?php if ($linha['unidade_status'] == '1') { ?><span class="btn btn-success btn-sm">Ativo </span><?php } ?> <?php if ($linha['unidade_status'] == '2') { ?><span class="btn btn-danger btn-sm">Inativo </span><?php } ?></td>

                    <td>
                      <form id="" action="perfil_unidade/<?php echo $linha['id_unidade'] ?>" method="post">
                        <input name="id" type="hidden" id="id" value="<?php echo $linha['id_unidade'] ?>">
                        <button class="btn btn-outline-secondary btn-sm edit">
                          <i class="fas fa-eye"></i>
                        </button>

                      </form>
                    </td>



                    </td>
                    <td><?php
                        if ($total_pedidos == 0 and $linha['unidade_status'] == '1' and $total_vendas_totais > 0) {
                          echo ('<div class="alert alert-danger" role="alert">Nenhum pedido em mais de 24 horas!.</div>');
                        }
                        ?></td>

                </tr>

                <script>
                  $(document).ready(function() {

                    $("#formos<?php echo $linha['id_unidade'] ?>").submit(function() {



                      var dados = jQuery(this).serialize();

                      $.ajax({
                        url: 'perfil_unidade.php',
                        cache: false,
                        data: dados,
                        type: "POST",

                        success: function(msg) {

                          $("#results").empty();
                          $("#results").append(msg);
                          document.getElementById("dvConteudo").style.display = "none";





                        }

                      });

                      return false;
                    });

                  });
                </script>



              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="results"></div>


<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

<script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>
<script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
<script src="assets/js/pages/table-responsive.init.js"></script>
<script src="assets/js/pages/table-responsive.init.js"></script>
<script src="assets/js/pages/table-responsive.init.js"></script>