<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$sqltv = "SELECT * FROM unidades WHERE id_unidade  = '$_POST[unidade]'      ";
$resultadotv = mysqli_query($conn, $sqltv);
$linhatv = mysqli_fetch_array($resultadotv);
?>


<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
 

<style type="text/css">
@media print {
    body * {
        visibility: hidden  !important;
        position:   static  !important;
    }
    .area_print, .area_print * {
        visibility: visible !important;
    }
    .area_print {
        position: absolute !important;
        left:     0        !important;
        top:      0        !important;
        width:    auto     !important;
        height:   auto     !important;
        margin:   0        !important;
        padding:  0        !important;
    }
}
</style>

   <!-- Bootstrap Css -->
   <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

	

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Relatórios &gt; Vendas </h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 

                    
             



                    <div class="area_print">

 
 <div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> Total de vendas no periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> - <?php if ($_POST['unidade'] =='') { ?> Geral <?php } else { ?> Unidade: <?php echo $linhatv['unidade_nome'] ?> <?php } ?>
 </h4><br>

<div class="row">
<?php 
 
 $locais = implode(",",$_POST['local']);

 $seq = "$locais";
 $explode_seq = explode(',', $seq);
 $n = array();
 foreach ($explode_seq as $num){
     ?>

<?php

if ($_POST[unidade] == '') { 
$sqlpe = "SELECT COUNT(*) as qtd, SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_pagamento = '$num'   and pedido_status ='2'     ";
} else {
 $sqlpe = "SELECT COUNT(*) as qtd, SUM(pedido_valor) AS pedido_valor FROM pedidos WHERE pedido_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and pedido_pagamento = '$num'   and pedido_status ='2'  and pedido_unidade = $_POST[unidade]    ";
}
$resultadope = mysqli_query($conn, $sqlpe);
$totalvendas2q = mysqli_num_rows($resultadope);
$linhape = mysqli_fetch_array($resultadope);
$total2 += $linhape[pedido_valor];
    ?>



<div class="col-3">

<div class="toast fade show" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
<div class="toast-header"> 

<strong class="me-auto"><?php if ($num == 'PIXAPP') { ?>
APP Pix
<?php } ?>

<?php if ($num == 'Cartão de Debito') { ?>
   Terminal Cartão de Débito
<?php } ?>

<?php if ($num == 'Cartão de Credito') { ?>
Terminal Cartão de Crédito
<?php } ?>

<?php if ($num == 'Pix') { ?>
Terminal Pix
<?php } ?>

<?php if ($num == 'CreditCard') { ?>
App Cartão de Crédito<?php } ?></strong>
<small class="text-muted"><?php echo $linhape[qtd] ?> vendas</small>
<button type="button" class="btn-close" data-bs-dismiss="toast"
                                                        aria-label="Close"></button>
</div>


<?php /// ticket medio

$medio = $linhape['pedido_valor'] /  $linhape[qtd] ;
?>


<div class="toast-body">
Total: <span class="text-info me-1">R$ <?php echo number_format($linhape['pedido_valor'],2,",",".");  ?>  </span>
Ticket médio: <span class="text-primary me-1">R$ <?php echo number_format($medio,2,",",".");  ?>  </span>

</div></div><br></div> 


    <?php } ?>
    </div>
    <strong> Total R$<?php 
    echo number_format($total2,2,",",".");  ?></strong>
    </div></div></div></div>
    <div align="center"> 
    <button class="btn btn-warning" onClick="window.print()" type="submit">Imprimir</button> 

    <a href="vendas"> <button class="btn btn-success" type="submit">Realizar Nova Consulta</button>  </a>
<?php 
if ($_POST[unidade] <>'') { 
?>
    <a href="perfil_unidade/<?php echo $linhatv['id_unidade'] ?>"> <button class="btn btn-info" type="submit">Relatórios Gerais Unidade:  <?php echo $linhatv['unidade_nome'] ?></button> </a>
<?php } ?>



