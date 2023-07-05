
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

@$conn->query($insert = "INSERT INTO logs_acoes	 (quem, tipo, id_acao, acao) VALUES ('$user[id]','Atualizar','$id','Atualizou minimo e maximo de produto de unidade')");
/// REMOVENDO


/// SALVANDO DADOS NO BANCO DE DADOS

@$conn->query("update produtos_unidades set produto_unidade_minimo =  '$_POST[minimo]', produto_unidade_maximo =  '$_POST[maximo]' where id_produto_unidades = '$_POST[id]' ");





?>

<script>
	
      alert("Alterado com sucesso!");
    window.location.href = "form_gerar_os/<?php echo $_POST[unidade] ?>/#<?php echo $_POST[id] ?>";


</script>