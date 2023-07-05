
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

@$conn->query("update condominios set condominio_nome =  '$_POST[nome]',
                                   condominio_sindico = '$_POST[sindico]',
                                   condominio_cnpj =  '$_POST[cnpj]',
                                   condominio_telefone = '$_POST[telefone]',
                                   condominio_celular = '$_POST[celular]',
                                   condominio_email = '$_POST[email]',
                                   condominio_cep = '$_POST[cep]',
                                   condominio_rua = '$_POST[rua]',
                                   condominio_numero = '$_POST[numero]',
                                   condominio_complemento = '$_POST[complemento]',
                                   condominio_bairro = '$_POST[bairro]',
                                   condominio_cidade = '$_POST[cidade]',
                                   condominio_uf = '$_POST[uf]',
                                   condominio_informacoes = '$_POST[informacoes]',
								   condominio_apartamentos = '$_POST[apartamentos]'


where id_condominio = '$_POST[id]' ");




?>


<script>
window.location.href = "listar_condominios";
alert("Alterado!");


</script>