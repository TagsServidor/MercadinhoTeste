<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$sqluu = "SELECT * FROM unidades where id_unidade = $_POST[unidade]  ORDER BY unidade_nome";
$resultadouu = mysqli_query($conn, $sqluu);
$linhauu=mysqli_fetch_array($resultadouu);
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
                                    <h4 class="mb-0">Relatórios &gt; Ajustes </h4> 

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
                    <h4 class="card-title"> Total de ajutes no periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?>  <?php if ($_POST['unidade'] =='') { ?> Geral <?php } else { ?> - Unidade: <?php echo $linhauu['unidade_nome'] ?> <?php } ?> 
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


$sql = "SELECT * FROM aletar_motivos WHERE id_alerta ='$num' ";
$resultado = mysqli_query($conn, $sql);
$linhacat = mysqli_fetch_array($resultado);

if ($_POST[unidade] == '') {
$sqlca = "SELECT SUM(alerta_valor) AS total  FROM alertas_reposicao  where alerta_motivo ='$num'  and alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_valor <> '0'  ";
} else {
$sqlca = "SELECT SUM(alerta_valor) AS total  FROM alertas_reposicao  where alerta_motivo ='$num'  and alerta_data BETWEEN '$_POST[inicio]' AND ' $_POST[fim]' and alerta_valor <> '0' and alerta_unidade = '$_POST[unidade]'  ";
}
$resultadoca = mysqli_query($conn, $sqlca); 
$linhaca = mysqli_num_rows($resultadoca);
$linhaca = mysqli_fetch_array($resultadoca);


    ?>



<div class="col-3">

<div class="toast fade show" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
<div class="toast-header"> 

<strong class="me-auto">
<?php echo $linhacat[alerta_nome]  ?>
</strong>

</div>


<?php /// ticket medio

$medio = $linhaca['totalvenda'] /  $linhaca[qtds] ;
?>


<div class="toast-body">
Total: <span class="text-info me-1"> <?php if($linhaca[total] == '') { ?>  0 <?php } else { ?> <?php echo $linhaca[total] ?> <?php } ?> produtos</small>  </span> <br><br>
<div align="center">  
<?php if($linhaca[total] == '') { ?> <button class="btn btn-warning btn-sm"  type="submit">Nada registrado</button> 
 <?php } else { ?>
<a href="relatorio_ajustes_resumido/<?php echo $num ?>/<?php echo $_POST[inicio] ?>/<?php echo $_POST[fim] ?>/<?php echo @$_POST[unidade] ?>"> <button class="btn btn-primary btn-sm" type="submit">Relatório Resumido</button> </a> 
<a href="relatorio_ajustes_detalhado/<?php echo $num ?>/<?php echo $_POST[inicio] ?>/<?php echo $_POST[fim] ?>/<?php echo @$_POST[unidade] ?>"><button class="btn btn-secondary btn-sm"  type="submit">Relatório Detalhado</button> </a> 
<?php } ?>
</div>

</div></div><br></div> 


    <?php } ?>
    </div>
    </div></div></div></div>
 


