
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



/// SALVANDO DADOS NO BANCO DE DADOS

@$conn->query("update clientes set cliente_credito =  cliente_credito + '$_POST[valor]'
                                 


where id_cliente = '$_POST[cliente]' ");




?>
<script>

alert("Credito adicionado com sucesso");
window.location.href = "perfil_cliente/<?php echo $_POST[cliente] ?>";

</script>