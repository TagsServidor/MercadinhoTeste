<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

include "bd/conexao.php";

$departamento = $_POST['departamento'];
?>

<div class="col-md-12">
<div class="mb-3">
																	
																
																	

<?php 
			  echo "<SELECT NAME='categoria' SIZE='1' class='form-control'  id='categoria' required>

<OPTION VALUE='' SELECTED> Informe a categoria ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM produtos_categorias where categoria_departamento = '$departamento'   ORDER BY categoria_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_categoria']."'>".($linha['categoria_nome']);
}
echo "</SELECT>";

?>
	</div>	</div>
<div class="col-md-12">
                                                    <div class="mb-3">
																	
																<input class="form-control" name="subcategoria" required placeholder="Informe o nome da subcategoria">
																		</div>	</div>	
																	

	  



