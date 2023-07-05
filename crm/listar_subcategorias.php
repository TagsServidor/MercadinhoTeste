<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

include "bd/conexao.php";

$categoria = $_POST['categoria'];
?>
<label class="form-label" for="validationCustom01">Subcategoria:</label>
<?php
			  echo "<SELECT NAME='subcategoria' SIZE='1' class='form-control' >

<OPTION VALUE='' SELECTED> Informe a subcategoria ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos_subcategorias where subcategoria_categoria ='$categoria'  ORDER BY subcategoria_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_subcategoria']."'>".($linha['subcategoria_nome']);
}
echo "</SELECT>";

?>