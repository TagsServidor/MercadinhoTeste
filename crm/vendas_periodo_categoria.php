<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}


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
                                    <h4 class="mb-0">Relatórios &gt; Vendas por categoria </h4> 

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
                    <h4 class="card-title"> Total de vendas por categoria no periodo de <?php echo date('d/m/Y', strtotime($_POST['inicio'])); ?> a <?php echo date('d/m/Y', strtotime($_POST['fim'])); ?> 
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


$sql = "SELECT * FROM produtos_departamentos WHERE id_departamentos ='$num' ";
$resultado = mysqli_query($conn, $sql);
$linhacat = mysqli_fetch_array($resultado);


$sqlca = "SELECT COUNT(*) as qtds, SUM(qtd_carrinho) AS qtd, SUM(qtd_carrinho * preco_pago) AS totalvenda  FROM carrinho c INNER JOIN produtos p ON c.produto_carrinho = p.id_produto where p.produto_departamento ='$num' and status_carrinho = '2' and data_carrinho BETWEEN '$_POST[inicio]' AND ' $_POST[fim]'   ";
$resultadoca = mysqli_query($conn, $sqlca); 
//$linhaca = mysqli_num_rows($resultadoca);
$linhaca = mysqli_fetch_array($resultadoca);


    ?>



<div class="col-3">

<div class="toast fade show" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
<div class="toast-header"> 

<strong class="me-auto">
<?php echo $linhacat[departamentos_nome]  ?>
</strong>
<small class="text-muted"><?php echo $linhaca[qtd] ?> produtos</small>

</div>


<?php /// ticket medio

$medio = $linhaca['totalvenda'] /  $linhaca[qtd] ;
?>


<div class="toast-body">
Total: <span class="text-info me-1">R$ <?php echo number_format($linhaca['totalvenda'],2,",",".");  ?>  </span>
Ticket médio: <span class="text-primary me-1">R$ <?php echo number_format($medio,2,",",".");  ?>  </span><br>
<!-- Lucro: <span class="text-info me-1">R$ <?php echo number_format($linhaca['totalvenda'],2,",",".");  ?>  </span>
Margem: <span class="text-primary me-1">R$ <?php echo number_format($medio,2,",",".");  ?>  </span> -->

</div></div><br></div> 


    <?php } ?>
    </div>
    </div></div></div></div>
    <div align="center"> 
    <button class="btn btn-warning" onClick="window.print()" type="submit">Imprimir</button> 

    <a href="vendas_categoria"> <button class="btn btn-success" type="submit">Realizar Nova Consulta</button>  </a>
<?php 
if ($_POST[unidade] <>'') { 
?>
    <a href="perfil_unidade/<?php echo $linhatv['id_unidade'] ?>"> <button class="btn btn-info" type="submit">Relatórios Gerais Unidade:  <?php echo $linhatv['unidade_nome'] ?></button> </a>
<?php } ?>



