<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

?>

<?php 


/// INSERINDO DADOS NO BANCO DE DADOS

	 @$conn->query($insert = "INSERT INTO aletar_motivos (alerta_nome) VALUES ('$_POST[motivo]')");
    //var_dump($insert);
?>
<script>

alert("Adicionado com sucesso");
window.location.href = "<?php echo $_POST[retorno] ?>";

</script>