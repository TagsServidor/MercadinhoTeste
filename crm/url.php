

<?php //// INICIO CODIGO 

if($user['gerenciavel'] =='2') {  
				
    if( !empty($_GET['url']) ){
        $url = explode( "/" , $_GET['url']);
        if( empty($url[count($url)-1]) ){
            unset($url[count($url)-1]);
        }

        switch( $url[0] ){

case 'home': include('home.php');break;

// INICIO CENTRAIS 				
case 'centrais':
include('centrais.php');break;			

case 'inserir_central':
include('inserir_central.php');break;
				
case 'relatorio_reposicao':
include('relatorio_reposicao.php');break;	
				
case 'gerar_lista_nova':
include('gerar_lista_nova.php');break;					
				
/// remover inicio
			
case 'perfil_unidade2':
$id = $url[1];
include('perfil_unidade2.php');break;	
				
/// remover fim

// EDITAR AJUSTES ESTOQUE
case 'editar_ajuste':
include('editar_ajuste.php');break;						
                        
case 'inserir_motivo':
include('inserir_motivo.php');break;

case 'valor_estoque_central_detalhado':
$id = $url[1];
include('valor_estoque_central_detalhado.php');break;



case 'excel_estoque_central':
    $id = $url[1];
include('excel_estoque_central.php');break;


case 'desativar_unidade_perfil':
$id = $url[1];
$id2 = $url[2];
include('desativar_unidade_perfil.php');break;



/// RELATORIOS NOVOS
				
case 'r_vendas_unidades':
include('r_vendas_unidades.php');break;	
				
case 'r_vendas_unidades_mes':
include('r_vendas_unidades_mes.php');break;					
				
case 'r_vendas_unidades_ano':
include('r_vendas_unidades_ano.php');break;					
		
case 'relatorio_alerta_reposicao':
include('relatorio_alerta_reposicao.php');break;	
				
case 'extravio_relatorio_produtos':
include('extravio_relatorio_produtos.php');break;				
				
case 'lista_relatorio_extravio_produto':
include('lista_relatorio_extravio_produto.php');break;	
				
case 'produtos_vendidos_unidade_periodo2':
include('produtos_vendidos_unidade_periodo2.php');break;	
				
case 'vendas_categoria':
include('vendas_categoria.php');break;					

case 'vendas_periodo_categoria':
include('vendas_periodo_categoria.php');break;					
    
case 'vendas_clientes':
include('vendas_clientes.php');break;	 

case 'vendas_clientes2':
include('vendas_clientes2.php');break;	
    
case 'relatorio_ajustes':
include('relatorio_ajustes.php');break;

case 'retirada_produtos':
include('retirada_produtos.php');break;

case 'relatorio_retiradas2':
include('relatorio_retiradas2.php');break;

case 'relatorio_ajustes2':
include('relatorio_ajustes2.php');break;	


case 'relatorio_ajustes_resumido':
$id = $url[1];
$id2 = $url[2];
$id3 = $url[3];
$id4 = $url[4];
include('relatorio_ajustes_resumido.php');break;



case 'editar_senha_cliente':
$id = $url[1];
include('editar_senha_cliente.php');break;


case 'atualizar_cliente_senha':
$id = $url[1];
include('atualizar_cliente_senha.php');break;





case 'relatorio_ajustes_detalhado':
$id = $url[1];
$id2 = $url[2];
$id3 = $url[3];
$id4 = $url[4];
include('relatorio_ajustes_detalhado.php');break;
				
case 'produtos_vendidos':
include('produtos_vendidos.php');break;			
				
case 'vendas_periodo':
$id = $url[1];
include('vendas_periodo.php');break;
				
case 'form_gerar_os':
$id = $url[1];
include('form_gerar_os.php');break;				
				
case 'excluir_produto_unidade':
$id = $url[1];
$id2 = $url[2];
include('excluir_produto_unidade.php');break;
				
				
case 'atualizar_minimo_maximo':
include('atualizar_minimo_maximo.php');break;
				
case 'distribuicao_direta':
$id = $url[1];
include('distribuicao_direta.php');break;				
				
/// PROMOCOES

case 'promocoes':
$id = $url[1];
include('promocoes.php');break;	

case 'cancelar_promocao':
$id = $url[1];
include('cancelar_promocao.php');break;	

case 'ver_os_reposicao_c':
$id = $url[1];
include('ver_os_reposicao_c.php');break;	


case 'vendas_promo':
    $id = $url[1];
    include('vendas_promo.php');break;



case 'alterar_produtos_massa':
include('alterar_produtos_massa.php');break;	

case 'produtos_vendidos_clientes':
include('produtos_vendidos_clientes.php');break;	

case 'produtos_vendidos_clientes_periodo':
include('produtos_vendidos_clientes_periodo.php');break;



case 'r_vendas_unidades_periodo':
include('r_vendas_unidades_periodo.php');break;	

case 'inserir_promocao':
$id = $url[1];
include('inserir_promocao.php');break;	

case 'inserir_credito_cliente':
include('inserir_credito_cliente.php');break;	
    
case 'listar_promocoes':
include('listar_promocoes.php');break;

				
case 'vendas_periodo_unidade':
$id = $url[1];
include('vendas_periodo_unidade.php');break;
				
case 'editar_terminal':
$id = $url[1];
include('editar_terminal2.php');break;			
	
case 'salvar_lista_os':
$id = $url[1];
include('salvar_lista_os.php');break;					
				
				
case 'perfil_cliente':
$id = $url[1];				
include('perfil_cliente.php');break;		
    
case 'compras_clientes':
$id = $url[1];
$id2 = $url[2];					
 include('compras_clientes.php');break;  
 
case 'compras_clientes_data':
$id = $url[1];				
include('compras_clientes_data.php');break;
 


					
case 'entrada_produtos_unidades_periodo':
$id = $url[1];
include('entrada_produtos_unidades_periodo.php');break;	
				
case 'produtos_vendidos_unidade_periodo':
$id = $url[1];
include('produtos_vendidos_unidade_periodo.php');break;					
				
case 'alterar_estoque_unidade':
include('alterar_estoque_unidade.php');break;				
				
				
case 'relatorio_entrada_central':
$id = $url[1];
include('relatorio_entrada_central.php');break;		

case 'relatorio_entrada_central2':
include('relatorio_entrada_central2.php');break;	
				
case 'deletar_venda_confirmar':
$id = $url[1];
include('deletar_venda_confirmar.php');break;				
				
case 'confirmar_venda_confirmar':
$id = $url[1];
include('confirmar_venda_confirmar.php');break;				
				
case 'confirmar_venda_confirmar2':
$id = $url[1];
include('confirmar_venda_confirmar2.php');break;					
				
case 'vendas_a_confirmar':
include('vendas_a_confirmar.php');break;				

case 'vendas_local':
include('vendas_local.php');break;
				
case 'vendas_periodo_local':
include('vendas_periodo_local.php');break;				
				
				
				
// LOGS E ERROS
				
				
case 'vendas_aberto':
include('vendas_aberto.php');break;						
				
case 'liberar_terminal':
$id = $url[1];
include('liberar_terminal.php');break;

case 'remover_produto_unidade':
$id = $url[1];
$id2 = $url[2];
include('remover_produto_unidade.php');break;

case 'remover_os':
$id = $url[1];
include('remover_os.php');break;				
				
// TERMINAIS				
	
case 'terminais':
 $id = $url[1];
include('terminais.php');break;

					
case 'inserir_terminal':
include('inserir_terminal.php');break;
				
				
				
case 'pay':
include('pay.php');break;					
				
case 'entradas_central':
    $id = $url[1];
include('entradas_central.php');break;					
				
case 'editar_estoque_unidade':
include('editar_estoque_unidade.php');break;					
	
case 'produtos_vendidos_unidade':
$id = $url[1];
include('produtos_vendidos_unidade.php');break;				
				
				
				
case 'consulta_estoquer':
include('consulta_estoquer.php');break;
				
				
case 'listar_centrais':
include('listar_centrais.php');break;

case 'editar_centrais':
$id = $url[1];
include('editar_centrais.php');break;
				
case 'remover_entrada_os':
$id = $url[1];
include('remover_entrada_os.php');break;
				
case 'deletar_categoria':
$id = $url[1];
include('deletar_categoria.php');break;				
				
case 'vendas_unidades':
$id = $url[1];
$id2 = $url[2];				
include('vendas_unidades.php');break;				

case 'entrada_produtos_unidades':
$id = $url[1];
include('entrada_produtos_unidades.php');break;				
				
case 'deletar_central':
include('deletar_central.php');break;
				
case 'deletar_condominio':
include('deletar_condominio.php');break;
				
case 'deletar_produto':
include('deletar_produto.php');break;				
				
				
				
case 'deletar_unidade':
include('deletar_unidade.php');break;
				
case 'deletar_fornecedor':
include('deletar_fornecedor.php');break;				
				
				
				
				
				
				

case 'remover_entrada':
$id = $url[1];
include('remover_entrada.php');break;	
				
case 'editar_estoque_central':
$id = $url[1];
include('editar_estoque_central.php');break;	
				
case 'editar_os':
include('editar_os.php');break;					
				
				
				
				
				
case 'editar_entrada':
include('editar_entrada.php');break;				
				
				
// FIM CENTRAIS 	
				
				
// INICIO CONDOMINIOS 				
case 'condominios':
include('condominios.php');break;			

case 'inserir_condominio':
include('inserir_condominio.php');break;

case 'listar_condominios':
include('listar_condominios2.php');break;

case 'alterar_condominio':
    $id = $url[1];
include('alterar_condominio.php');break;

case 'editar_condominios':
  $id = $url[1];  
include('editar_condominios.php');break;

		
// FIM CONDOMINIOS 	
				
				
				
// INICIO UNIDADES 				
case 'unidades':
include('unidades.php');break;			

case 'inserir_unidades':
include('inserir_unidades.php');break;

case 'listar_unidades':
include('listar_unidades2.php');break;

case 'alterar_unidade':
include('alterar_unidade.php');break;

// FIM UNIDADES 				
				
				

// INICIO PRODUTOS 				
case 'produtos':
include('produtos.php');break;			

case 'inserir_produtos':
include('inserir_produtos.php');break;

case 'listar_produtos':
include('listar_produtos2.php');break;
				
case 'editar_produto_massa':
include('editar_produto_massa.php');break;				
				

case 'alterar_produto':
include('alterar_produto.php');break;
				
case 'perfil_produto':
include('perfil_produto.php');break;	
				
case 'inserir_departamento':
include('inserir_departamento.php');break;					

case 'inserir_categoria':
include('inserir_categoria.php');break;	
				
case 'inserir_subcategoria':
include('inserir_subcategoria.php');break;	
				
case 'ver_entradas_produtos':
include('ver_entradas_produtos.php');break;						
				
case 'ver_entrada_produtos':
include('ver_entrada_produtos.php');break;
				
// FIM PRODUTOS 				
				
				
// INICIO FORNECEDORES 				
case 'fornecedores':
include('fornecedores.php');break;			

case 'inserir_fornecedores':
include('inserir_fornecedores.php');break;

case 'listar_fornecedores':
include('listar_fornecedores.php');break;

case 'alterar_fornecedor':
include('alterar_fornecedor.php');break;
			
// FIM FORNECEDORES 
				
				
// INICIO FORNECEDORES 				
case 'listar_clientes':
include('listar_clientes.php');break;
				
case 'listar_clientes_unidades':
$id = $url[1];				
include('listar_clientes_unidades.php');break;				
				
                
// FIM FORNECEDORES

				
// INICIO ESTOQUE 				
case 'estoque_entradas':
include('estoque_entradas.php');break;			

case 'estoque_entradas1':
include('estoque_entradas1.php');break;				
				
case 'inserir_estoque_entrada':
include('inserir_estoque_entrada.php');break;	
				
case 'distribuicao':
include('distribuicao.php');break;						
				
case 'salvar_reposicao':
include('salvar_reposicao.php');break;					
			
case 'estoque_vencendo':
include('estoque_vencendo.php');break;					
				
case 'gerar_lista':
include('gerar_lista.php');break;					
				
case 'listar_entradas':
			
include('listar_entradas.php');break;					
				
case 'ver_estoque_unidade':
				$id = $url[1];
include('ver_estoque_unidade.php');break;					
				
				
				
case '	editar_produto_massa':
include('editar_produto_massa.php');break;					
				
case 'ver_estoque_central':
    	$id = $url[1];
include('ver_estoque_central.php');break;					
				
// FIM ESTOQUE 	
								
				
				
				
// INICIO OS 				
case 'os_abertas':
include('os_abertas.php');break;			

case 'os_concluidas':
include('os_concluidas.php');break;				
				
case 'ver_os_reposicao':
include('ver_os_reposicao.php');break;			
				
case 'os_concluidas':
include('os_concluidas.php');break;	
				
case 'ver_os_reposicao_c':
include('ver_os_reposicao_c.php');break;					
				
			
// FIM OS 
				
				
// INICIO GERENCIAVEL				
case 'colaboradores':
include('colaboradores.php');break;			

case 'inserir_gerenciavel':
include('inserir_gerenciavel.php');break;				
				
			
// FIM GERENCIAVEL 	
				
				
// INICIO FINANCEIRO				
case 'contas_a_pagar':
include('contas_a_pagar.php');break;			

case 'add_conta_central':
include('add_conta_central.php');break;	
				
case 'informar_pagamento_conta':
include('informar_pagamento_conta.php');break;					
				
case 'add_conta_condominio':
include('add_conta_condominio.php');break;	
				
case 'add_conta_fornecedor':
include('add_conta_fornecedor.php');break;		
				
case 'contas_pagas':
include('contas_pagas.php');break;					
				
case 'vendas':
$id = $url[1];
include('vendas.php');break;						
			
// FIM FINANCEIRO 					
				
			
// INICIO CONFIGURAÇÕES				
case 'listar_departamentos':
include('listar_departamentos.php');break;

case 'listar_categorias2':
include('listar_categorias2.php');break;

case 'listar_subcategorias2':
include('listar_subcategorias2.php');break;

				
case 'grupo_impostos':
include('grupo_impostos.php');break;

                
                    
                
// FIM CONFIGURAÇÕES 
				
// INICIO RELATORIOS				
case 'relatorio_produtos':
include('relatorio_produtos.php');break;			

case 'relatorio_centrais':
include('relatorio_centrais.php');break;				
				
case 'relatorio_unidades':
$id = $url[1];
include('relatorio_unidades.php');break;
				
case 'lista_relatorio_extravio':
$id = $url[1];
include('lista_relatorio_extravio.php');break;		
				
				
				
case 'perfil_unidade':
$id = $url[1];
include('perfil_unidade.php');break;				
				
case 'relatorio_extravio':
include('relatorio_extravio.php');break;	
				
				
case 'relatorio_clientes':
include('relatorio_clientes.php');break;				
				
// FIM RELATORIOS


// INICIO NOTIFICACOES

case 'notificacoes_android':
include('notificacoes_android.php');break;

case 'disparar_notificacao_android':
include('disparar_notificacao_android.php');break;

case 'notificacoes_ios':
include('notificacoes_ios.php');break;

case 'disparar_notificacao_ios':
include('disparar_notificacao_ios.php');break;
    
    
// FIM NOTIFICACOES

//  INICIO SUPORTE

    case 'abrir_chamado':
    include('abrir_chamado.php');break;
    
    case 'inserir_abrir_chamado':
    include('inserir_abrir_chamado.php');break;
    
    case 'listar_chamado':
    include('listar_chamado.php');break;

    case 'editar_chamado':
    $id = $url[1];		
    include('editar_chamado.php');break;

    case 'atualizar_registro_chamado':
    $id = $url[1];	
    include('atualizar_registro_chamado.php');break;
    

//  FIM SUPORTE
                    
                
		
				
case 'sair':
include('sair.php');break;
	
				 /// PAGINA 404
	   default: include('404.php');
        }
    }
	}
	?>	


<?php //// INICIO CODIGO REPOSTOR

if($user['repositor'] =='2') {  
				
    if( !empty($_GET['url']) ){
        $url = explode( "/" , $_GET['url']);
        if( empty($url[count($url)-1]) ){
            unset($url[count($url)-1]);
        }

        switch( $url[0] ){

case 'home': include('os_abertas_r.php');break;
		
case 'ver_os_reposicao_r':
$id = $url[1];				
include('ver_os_reposicao_r.php');break;	
	
		
case 'inserir_alerta_reposicao':
$id = $url[1];				
include('inserir_alerta_reposicao.php');break;		





		
				
// INICIO OS 				
case 'os_abertas':
include('os_abertas_r.php');break;			

case 'os_concluidas':
include('os_concluidas_r.php');break;				
				
case 'ver_os_reposicao':
include('ver_os_reposicaor.php');break;			
				
case 'baixa_manual':
include('baixa_manual.php');break;						
	
case 'consulta_estoquer':
include('consulta_estoquer.php');break;				
			
case 'redistribuicao':
include('redistribuicao.php');break;						
	

// FIM OS 



		
				
case 'sair':
include('sair.php');break;
	
				 /// PAGINA 404
	   default: include('404.php');
        }
    }
	}
	?>	