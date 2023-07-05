<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
?>
<div class="row">
<div class="col-4">
 Vencimento
	</div>
	<div class="col-4">
 Parcela
	</div>
	<div class="col-4">
Valor	</div>
</div>
<?php

	 $valor = 1;

	 $x = 0;
	 $y = 0;
$parcelas = $_POST['parcelas'] ;
 while($valor <= $parcelas){ 

 $x++;
 $y++;
 ?>

<div class="row">
	
<div class="col-4">
 <input type="date" class="form-control" name="vencimento[]" required id="vencimento[]">
  </div>
	<div class="col-4">
 <input name="parcela[]" type="text" required class="form-control" id="parcela[]" value="<?php echo  $x ?>" readonly="readonly">
	</div>
  <div class="col-4">
 <input type="text" class="form-control money" name="valor[]" required id="valor[]">
  </div>
	
</div>

<br>

<?php 

 $valor++;

  }
?> <div align="right"> <button class="btn btn-primary" id="enviar" type="submit">Cadastrar</button> </div>
