<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
  
<div class="row">
<div class="col-3">Produto</div> 
<div class="col-1">Qtd</div> 
<div class="col-2">Unidade Atual</div> 
<div class="col-2">Total Atual</div> 
<div class="col-2">Unidade Real</div> 
<div class="col-2">Total Real</div> 

</div> <br>

<form action="salvar.php" method="POST">
<div class="row">


<?php
include "../bd/conexao.php";

$sqlsp = "SELECT *  FROM os_produtos osp INNER join produtos p ON osp.os_produtos_produto = p.id_produto where osp.os_produtos_status = '2' and osp.os_custo_total <> '0.00' and osp.os_produtos_cadatro BETWEEN '2022-10-04 00:00:57' and '2023-09-01 00:00:57'   ";
$resultadosp = mysqli_query($conn, $sqlsp);
while($linhasp = mysqli_fetch_array($resultadosp)) {

$sqlsp1 = "SELECT *  FROM entrada_produtos where entrada_produto = $linhasp[os_produtos_produto] limit 1  ";
$resultadosp1 = mysqli_query($conn, $sqlsp1);
$linhasp1 = mysqli_fetch_array($resultadosp1);

$totalreal = $linhasp['os_produtos_qtd'] * $linhasp1 ['entrada_unitario'];
$totalreal2 += $totalreal;
$totalreal3+= $linhasp['os_custo_total'];
    ?>

<div class="col-3"><?php echo $linhasp['produto_nome']; ?> <?php echo $linhasp['os_produtos_produto']; ?> </div> 
<div class="col-1"><?php echo $linhasp['os_produtos_qtd']; ?> </div> 
<div class="col-2"><?php echo $linhasp['os_produtos_valor']; ?></div> 
<div class="col-2"><?php echo $linhasp['os_custo_total']; ?></div> 

<div class="col-2"><?php echo $linhasp1['entrada_unitario'] ?></div> 
<div class="col-2"><input type="text" name="produto[<?php echo $linhasp['os_produtos_id'] ?>]" value="<?php echo $totalreal ?>">
<input type="hidden" name="id[<?php  echo $linhasp[os_produtos_id]?>]" value="<?php echo $linhasp[os_produtos_id] ?>">

</div> 

	


 <?php } ?>
 
 </div> 

<br> 
<?php echo $totalreal3 ?><br> 
<?php echo $totalreal2 ?>
 <button class="btn btn-info"> SALVAR </button> 

 </form>