
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

@$conn->query("update terminais set t_maquina =  '$_POST[maquina]',
                                   	id_anydesk =  '$_POST[anydesk]'
                                 
                               


where id_terminal = '$_POST[id]' ");




?>

<script>
      alert("Alterado com sucesso!");
 
    window.location.href = "terminais";


</script>