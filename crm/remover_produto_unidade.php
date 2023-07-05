
<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>




<?php 



/// SALVANDO DADOS NO BANCO DE DADOS

@$conn->query("DELETE from produtos_unidades where id_produto_unidades = '$id' ");




?>

<script>
	
      alert("Removido com sucesso!");
    window.location.href = "ver_estoque_unidade/<?php echo $id2 ?>";


</script>