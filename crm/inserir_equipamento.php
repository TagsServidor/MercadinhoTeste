
<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>

<!-- Sweet Alert-->
<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<!-- Deixando Botão Transparente -->
<style>

.button {     
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;        
}

</style>




<?php 
/// INSERINDO NO BANCO DE DADOS

 @$conn->query($insert = "INSERT INTO controle_equipamentos (equipamentos_nome, equipamentos_valor, equipamentos_situacao, equipamentos_unidade ) VALUES ('$_POST[equipamento]','$_POST[valor]','$_POST[situacao]','$_POST[unidade]')"); 
 
  



?>

<?php
///LISTANDO EQUIPAMENTOS 
$sqleq = "SELECT * FROM controle_equipamentos where equipamentos_unidade = $_POST[unidade] order by equipamentos_id desc ";
$resultadoeq = mysqli_query($conn, $sqleq);

												
												?>
												
												
												 <div data-simplebar style="max-height: 336px;">
                                            <div class="table-responsive">
												
												<table class="table table-borderless table-centered table-nowrap">
												  <tbody>
												    <tr>                                                
												    <tr>
												      <th>Equipamento</th>
												      <th>Estado</th>
												      <th>Valor</th>
												      
											        </tr>
											      <tbody>
												      <tr>
												        <?php 
	while ($linhaeq = mysqli_fetch_array($resultadoeq)) {
															
			
															
															?>
												        <td ><span style="width: 15px;"> <?php echo $linhaeq['equipamentos_nome'] ?> </span></td>
												        <td><?php if ($linhaeq['equipamentos_situacao'] =='1') {  ?><span class="badge bg-soft-success">Ativo </span><?php } ?><?php if ($linhaeq['equipamentos_situacao'] =='2') { ?><span class="badge bg-soft-warning">Manuntenção </span> <?php } ?></td>
												        <td>R$<?php echo $linhaeq['equipamentos_valor'] ?> </td>
												      
											        </tr>
												      <?php } ?>
											      </tbody>
											    </table>
												</div></div>