<?php //// INICIO CODIGO 


				
    if( !empty($_GET['url']) ){
        $url = explode( "/" , $_GET['url']);
        if( empty($url[count($url)-1]) ){
            unset($url[count($url)-1]);
        }

        switch( $url[0] ){

case 'home': include('os_abertas.php');break;

// INICIO CENTRAIS 				
case 'os_abertas':
include('os_abertas.php');break;
				
case 'os_concluidas':
include('os_concluidas.php');break;				
				
				

case 'inserir_alerta_reposicao':
include('inserir_alerta_reposicao.php');break;

case 'retiradas':
include('retiradas.php');break;
				
case 'ajuste_estoque':
include('ajuste_estoque.php');break;
				
case 'ajuste_estoque2':
$id = $url[1];
include('ajuste_estoque2.php');break;					
	
case 'ver_os_concluida':
$id = $url[1];
$id2 = $url[2];	
include('ver_os_concluida.php');break;				
	
				
				
case 'ver_os':
$id = $url[1];
$id2 = $url[2];				
include('ver_os.php');break;
				
case 'retirada2':
$id = $url[1];
include('retirada2.php');break;
		
				
case 'sair':
include('sair.php');break;
	
				 /// PAGINA 404
	   default: include('404.php');
        }
    }
	
	?>	


