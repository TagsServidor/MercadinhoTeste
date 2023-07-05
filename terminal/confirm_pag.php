<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;

$registro_apagar = rtrim($session);


include "bd/conexao.php";

// Verificando se a venda foi paga
$sql = "SELECT * FROM p_apagar where registro_apagar = $registro_apagar and pago = 'sim'  ";
$resultado = mysqli_query($conn, $sql);
$linha=mysqli_fetch_array($resultado);
$total = mysqli_num_rows($resultado);

if ($total >='1') { 

?>
<script>
    window.location.href = "payment_ok.php";
</script>

<?php } ?> 

<?php
// Verificando se houve falha pagamento
$sqle1 = "SELECT * FROM p_apagar where registro_apagar = $registro_apagar and pago <> 'sim' and retorno = '-1004'   ";
$resultadoe1 = mysqli_query($conn, $sqle1);
$linhae1=mysqli_fetch_array($resultadoe1);
$totale1 = mysqli_num_rows($resultadoe1);

if ($totale1 >='1') { 

?>
<script>
window.location.replace("payment_erro.php?erro=<?php echo $linhae1['retorno'] ?>&id=<?php echo $linhae1['id_apagar'] ?>&tipo=<?php echo $linhae1['metodo_pagamento'] ?>");
</script>

<?php } ?> 


<?php
// Verificando se houve falha pagamento
$sqle1 = "SELECT * FROM p_apagar where registro_apagar = $registro_apagar and pago <> 'sim' and retorno = '-1019'   ";
$resultadoe1 = mysqli_query($conn, $sqle1);
$linhae1=mysqli_fetch_array($resultadoe1);
$totale1 = mysqli_num_rows($resultadoe1);

if ($totale1 >='1') { 

?>
<script>
window.location.replace("payment_erro.php?erro=<?php echo $linhae1['retorno'] ?>&id=<?php echo $linhae1['id_apagar'] ?>&tipo=<?php echo $linhae1['metodo_pagamento'] ?>");
</script>

<?php } ?> 



<?php
// Verificando se houve falha comunicacao com a maquina
$sqle2 = "SELECT * FROM p_apagar where registro_apagar = $registro_apagar and pago <> 'sim' and retorno = '-2001'  ";
$resultadoe2 = mysqli_query($conn, $sqle2);
$linhae2=mysqli_fetch_array($resultadoe2);
$totale2 = mysqli_num_rows($resultadoe2);

@$conn->query("update p_apagar set tentou_pagar	= '0',  tentativas = tentativas + 1   where registro_apagar ='$pedido' ");


if ($totale2 >='1') { 

?>
<script>
window.location.replace("payment_erro.php?&id=<?php echo $linhae2['id_apagar'] ?>&tipo=<?php echo $linhae2['metodo_pagamento'] ?>&erro=-2001");
</script>

<?php } ?> 


