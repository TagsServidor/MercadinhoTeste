
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




if ($imagem =='') { 

@$conn->query("update produtos set produto_nome =  '$_POST[nome]',
                                  
                                   produto_codigobarras = '$_POST[codigobarras]',
                                   produto_unidade = '$_POST[unidade]',
                                   produto_informacoes = '$_POST[informacoes]',
								   produto_departamento = '$_POST[departamento]',
								   produto_origem = '$_POST[origem]',
								    produto_cfop_dentro = '$_POST[cfopdentro]',
									  produto_cfop_fora = '$_POST[cfopfora]',
									   produto_ncm = '$_POST[ncm]',
								    produto_cest = '$_POST[cest]',
								    produto_grupo = '$_POST[grupo]',
								     tags_produto = '$_POST[tags]',

								   
								   
								   produto_status = '$_POST[status]'
								


where id_produto = '$_POST[id]' ");

} else {
	
	@$conn->query("update produtos set produto_nome =  '$_POST[nome]',
                                  
                                   produto_codigobarras = '$_POST[codigobarras]',
                                   produto_unidade = '$_POST[unidade]',
                                   produto_informacoes = '$_POST[informacoes]',
								  produto_origem = '$_POST[origem]',
								  produto_cfop_dentro = '$_POST[cfopdentro]',
								  produto_cfop_fora = '$_POST[cfopfora]',
								   produto_ncm = '$_POST[ncm]',
								    produto_cest = '$_POST[cest]',
								  produto_grupo = '$_POST[grupo]',
								   produto_foto = '$nova_imagem'


where id_produto = '$_POST[id]' ");
	
}


?>

<button type="button" class="button"  id="sa-produtos"></button>

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

click('sa-produtos');

</script>