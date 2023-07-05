
<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

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





/// TRATANDO UPLOAD ARQUIVO

   // $ext = strtolower(substr($_FILES['arquivo']['name'],-4)); //Pegando extensão do arquivo
   // $new_name1 = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
//$new_name = md5($new_name1). $ext; //Definindo md5 do novo nome
  //  $dir = '../produtos/'; //Diretório para uploads 
  //  move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo



	$imagem  = ($_FILES['arquivo']['name']);// Nome originai da imagem
	$dir = "../produtos"; // Diretório das imagens
	$salva = $dir."/".$imagem; // Caminho onde vai ficar a imagem no servidor
	move_uploaded_file($_FILES['arquivo']['tmp_name'],$salva ); // Este comando move o arquivo do diretório temporário para o caminho especificado acima
	$info_imagem = pathinfo($salva); // Resgatando extensão do arquivo recém-baixado
	$nova_imagem = time().rand(1000,5000).".".$info_imagem['extension']; // Nome da imagem redimensionada
	// *** Include the class
	require_once "resize2.php"; 
	// *** 1) Initialise / load image
	$resizeObj = new resize($salva);
	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj -> resizeImage(250, 250, 'crop');
	/* Especificando que a nova imagem terá 200 px de largura e altura. E utilizando a opção CROP, que é considerada a melhor
	pois, recorta a imagem na medida sem distorção
	Se quizer ver outras opções, visite o site do desenvolvedor de resize2.php (http://www.jarrodoberto.com/articles/2011/09/image-resizing-made-easy-with-php)
	
	*/
	// *** 3) Save image
	$resizeObj -> saveImage($dir."/".$nova_imagem, 80);
	// O arquivo-base é removido
	unlink($salva);


	/// INSERINDO NO BANCO DE DADOS
		
 @$conn->query($insert = "INSERT INTO produtos (produto_nome, produto_departamento, produto_categoria, produto_subcategoria, produto_codigobarras, produto_unidade, produto_informacoes, produto_foto, tags_produto, produto_origem, 	produto_ncm, produto_cest, produto_regras, produto_cfop_dentro, produto_cfop_fora, produto_quem) VALUES 
('$_POST[nome]','$_POST[departamento]','$_POST[categoria]','$_POST[subcategoria]','$_POST[codigobarras]','$_POST[unidade]','$_POST[informacoes]','$nova_imagem ','$_POST[tags]','$_POST[origem]','$_POST[ncm]','$_POST[cest]','$_POST[regras]','$_POST[cfopdentro]','$_POST[cfopfora]','$user[id]')");


?>

<button type="button" class="button"  id="sa-produto"></button>

  <!-- Sweet Alerts js -->
  <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

   <!-- Sweet alert init js-->
   <script src="assets/js/pages/sweet-alerts.init.js"></script>


   <!-- Executando Botao Automatico -->
<script>

function click(id)
{
    var element = document.getElementById(id);
    if(element.click)
        element.click();
    else if(document.createEvent)
    {
        var eventObj = document.createEvent('MouseEvents');
        eventObj.initEvent('click',true,true);
        element.dispatchEvent(eventObj);
    }
}

click('sa-produto');

</script>
			