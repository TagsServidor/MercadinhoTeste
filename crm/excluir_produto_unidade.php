
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


/// CRIANDO LOG

@$conn->query($insert = "INSERT INTO logs_acoes	 (quem, tipo, id_acao, acao) VALUES ('$user[id]','Desativar','$id','Desativo um produto de unidade')");
/// REMOVENDO


/// SALVANDO DADOS NO BANCO DE DADOS

@$conn->query("update produtos_unidades set produto_unidade_status =  '2' where id_produto_unidades = '$id' ");





?>

<script>
	
      alert("Removido com sucesso!");
    window.location.href = "form_gerar_os/<?php echo $id2 ?>";


</script>