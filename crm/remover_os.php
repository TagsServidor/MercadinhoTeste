
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

@$conn->query($insert = "INSERT INTO logs_acoes	 (quem, tipo, id_acao, acao, nome) VALUES ('$user[id]','Deletar','$id','Deletou uma OS','$linha[produto_nome]')");

/// SALVANDO DADOS NO BANCO DE DADOS

@$conn->query("DELETE from os_reposicao where id_os_reposicao  = '$id' ");




?>

<script>
	
      alert("Removido com sucesso!");
    window.location.href = "os_abertas";


</script>