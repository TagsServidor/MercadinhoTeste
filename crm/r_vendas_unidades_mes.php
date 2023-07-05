<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$mesatual = $_POST[mes];
$anoatual = $_POST[ano];

$inicio = $anoatual.'-'.$mesatual.'-01';
$fim = $anoatual.'-'.$mesatual.'-31';


    $numero_mes = $mesatual*1;
    $mes = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
						?>



<?php 
$sql = "SELECT u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data,  SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2'  and p.pedido_data BETWEEN '$inicio' and '$fim'  group by pedido_unidade order by total_valor desc";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);
$dados = "";
$id = "";
while($linha = mysqli_fetch_array($resultado)){
$unidades = $linha[unidade_nome] . ',' ;
$registro = $linha['total_valor'] . ',' ;	
  $dados .= $unidades." ";
  $id .= $registro." ";
}
$seq = "$dados";
$explode_seq = explode(',', $seq);
$n = array();
foreach ($explode_seq as $num){
     $n[] = "'" . $num . "'";
}
$result = implode(" , ", $n);
?>



<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="apexcharts.js"></script>

   <!-- Bootstrap Css -->
   <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

				
<style>
      
        #chart {
      max-width: 1650px;
      margin: 0px auto;
    }
      
    </style>

					


                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Relatórios &gt; Total Receitas </h4> 

                                    <div class="page-title-right">
									
                                        <ol class="breadcrumb m-0">
                                           
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
                <div class="container-fluid">
                 <form action="r_vendas_unidades_mes" method="post">
											   
											   <div class="row"> 
												   
												<div class="col-3">    <label><strong>Mês:</strong></label>
  
												   
<select name="mes" class="form-control" id="select" required>
  <option value="">Escolha o mës</option>
	<option value="01">Janeiro</option>
	<option value="02">Fevereiro</option>
	<option value="03">Março</option>
	<option value="04">Abril</option>
	<option value="05">Maio</option>
	<option value="06">Junho</option>
	<option value="07">Julho</option>
	<option value="08">Agosto</option>
	<option value="09">Setembro</option>
	<option value="10">Outubro</option>
	<option value="11">Novembro</option>
	<option value="12">Dezembro</option>
</select></div>
												   
														<div class="col-3">  
															 <label><strong>Ano:</strong></label>

<select name="ano" class="form-control" id="select" required>
  <option value="">Escolha o ano</option>
  <option value="2022">2022</option>
  <option value="2023">2023</option>
  <option value="2024">2024</option>
</select>
												 </div>
												   
												   
												   
												   <div class="col-3">  
															 <label>&nbsp;<br></label><br>
											<button class="btn btn-info"> Listar </button>
												   </div>
												   
												   </div>
											
											</form>
                  
 </div> <br><br>
					<div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Total Receitas por unidade: <span style="color:brown"> <?php echo $mes[$numero_mes] ?> / <?php echo $anoatual ?> </span><br><br><br>
					  
					  
					  
					  
					  <div class="row">
						  <div class="col-12">
					

						  <?php
$sql = "SELECT u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data,  SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2'  and p.pedido_data BETWEEN '$inicio' and '$fim' group by pedido_unidade order by total_valor  desc ";

$total = "";													
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);
						
$x=0;						
while($linha = mysqli_fetch_array($resultado)){
$x++;
	
$total += $linha['total_valor'];
	
$valor_base = $total;
$valor = $linha['total_valor'];
$resultadot = ($valor / $valor_base) * 100;

	
?>
							  
			<div class="row">
							
							  <div class="col-5"> <STRONG><?php echo $x ?>º - <?php echo $linha['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-3"> R$ <?php echo $linha['total_valor'] ?> </div>
				  <div class="col-4"> <div class="progress" style="height: 20px;">
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?php echo $resultadot ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
</div> </div>
								  
						  	 </div>				 
							  <hr>
							  <?php } ?>
							  
							  
						  </div>  
						  
						
						  
					  </div>
						  
				
					  
					  

                   
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