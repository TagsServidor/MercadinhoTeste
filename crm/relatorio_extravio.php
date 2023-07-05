<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS

?>



<?php 
$pagina = (isset($id)? $id : 1);
echo $pagina;
//Selecionar todos os cursos da tabela
$sql_venda = "SELECT * FROM alertas_reposicao a LEFT JOIN unidades u on a.alerta_unidade = u.id_unidade   INNER JOIN adm ad on a.alerta_repositor = ad.id  order by a.alerta_data  desc ";
$resultado_venda = mysqli_query($conn, $sql_venda);

//Contar o total de cursos
$total_vendas = mysqli_num_rows($resultado_venda);

//Seta a quantidade de cursos por pagina
$quantidade_pg = 60;

//calcular o número de pagina necessárias para apresentar os cursos
$num_pagina = ceil($total_vendas/$quantidade_pg);

//Calcular o inicio da visualizacao
$incio = ($quantidade_pg*$pagina)-$quantidade_pg;

//Selecionar os cursos a serem apresentado na página

$result_vendas = "SELECT * FROM alertas_reposicao a LEFT JOIN unidades u on a.alerta_unidade = u.id_unidade   INNER JOIN adm ad on a.alerta_repositor = ad.id INNER JOIN aletar_motivos am ON a.alerta_motivo = am.id_alerta INNER JOIN produtos p ON a.alerta_produto = p.id_produto   order by a.alerta_data  desc limit $incio, $quantidade_pg";
$resultado_vendas = mysqli_query($conn, $result_vendas);
$total_vendas2 = mysqli_num_rows($resultado_vendas);
?>


<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
 
   <!-- Bootstrap Css -->
   <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

				


					


                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Relatorios &gt; Extravios</h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
                <div class="container-fluid">
                 <form action="lista_relatorio_extravio" method="post">
							<input type="hidden" value="sim" name="exportarextravio">
					 <input type="hidden" value="<?php echo $_POST['unidade'] ?>" name="unidade"> 	
											   <div class="row"> 
												   
												<div class="col-3">    <label><strong>Inicio:</strong></label>
											<input type="date" class="form-control" required name="inicio"> 
												   </div>
												   
														<div class="col-3">  
															 <label><strong>Fim:</strong></label>
											<input type="date" class="form-control" required name="fim">
												   </div>
												   
												   <div class="col-3">  
													 <label><strong>Unidade:</strong></label>
															 <span class="mb-3">
															 <?php // listando em um box os instrutores

			  echo "<SELECT NAME='unidade' SIZE='1' class='form-control' >

<OPTION VALUE='' SELECTED> Geral ";
// Selecionando os dados da tabela em ordem decrescente
$sql = "SELECT * FROM unidades where unidade_status ='1'  ORDER BY unidade_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado = mysqli_query($conn, $sql);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha=mysqli_fetch_array($resultado)) {
echo "<OPTION VALUE='".$linha['id_unidade']."'>".($linha['unidade_nome']);
}
echo "</SELECT>";

?>
															 </span></div>
												   
												   <div class="col-3">  
															 <label>&nbsp;<br></label><br>
											<button class="btn btn-info"> Listar </button>
												   </div>
												   
												   </div>
											
											</form>
                  
 </div> <br><br>
				

                   
		  <!-- JAVASCRIPT -->
		  <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>