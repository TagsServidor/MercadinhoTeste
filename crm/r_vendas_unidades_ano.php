<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

$anoatual = date('Y');
error_reporting(E_ALL);
 
/* Habilita a exibição de erros */
ini_set("display_errors", 0);
						?>

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">


<link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.carousel.min.css">

        <link rel="stylesheet" href="assets/libs/owl.carousel/assets/owl.theme.default.min.css">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">


<div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Receitas mês a mês / 2022</h4>
                                        
                                        <div class="hori-timeline" dir="ltr">
                                            <div class="owl-carousel owl-theme  navs-carousel events" id="timeline-carousel">
                                                
												
												       

                                                       <div class="item event-list">
                                                    <div class="event-date bg-primary">
                                                        <div class="text-white">Maio</div>
                                                    </div>
                                                    
													
													
                                                    <div class="px-3">
														
														
                                                      <?php
														
														

$anoatual = date('Y');

$inicioa = $anoatual.'-05-01';
$fima = $anoatual.'-05-31';
														
$inicioaa = $anoatual.'-04-01';
$fimaa = $anoatual.'-04-31';														
														
														
$sqla = "SELECT  u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioa' and '$fima'  group by pedido_unidade order by total_valor  desc ";
												
$resultadoa = mysqli_query($conn, $sqla);
$totala = mysqli_num_rows($resultadoa);
						

												
																										
														
while($linhaa = mysqli_fetch_array($resultadoa)){

$sqlan = "SELECT p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioaa' and '$fimaa' and pedido_unidade = $linhaa[pedido_unidade]   order by total_valor  desc ";	
$resultadoan = mysqli_query($conn, $sqlan);	
$linhaam = mysqli_fetch_array($resultadoan);
$anterior = $linhaam[total_valor]; 
$atual = $linhaa[total_valor]; 
	
?>
							  
			<div class="row">
							
							  <div class="col-8" align="left"><?php if ($anterior < $atual ) {  ?> <i class="dripicons-arrow-up text-success"></i> <?php } else { ?> <i class="dripicons-arrow-down text-danger"></i> <?php } ?> <STRONG><?php echo($linhaa['Row'])  ?>º <?php echo $linhaa['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-4">R$<?php echo $linhaa['total_valor'] ?> </div>
				   
								  
						  	 </div>				 
							  <hr>
							  <?php }?>
														
														
														
														
                                                    </div>
                                                </div>
												

                                                 
												
												
												    <div class="item event-list">
                                                    <div class="event-date bg-primary">
                                                        <div class="text-white">Junho</div>
                                                    </div>
                                                    
													
													
                                                    <div class="px-3">
														
														
                                                      <?php
														
														

$anoatual = date('Y');

$inicioa = $anoatual.'-06-01';
$fima = $anoatual.'-06-31';
														
$inicioaa = $anoatual.'-05-01';
$fimaa = $anoatual.'-05-31';														
														
														
$sqla = "SELECT  u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioa' and '$fima'  group by pedido_unidade order by total_valor  desc ";
												
$resultadoa = mysqli_query($conn, $sqla);
$totala = mysqli_num_rows($resultadoa);
						

												
																										
														
while($linhaa = mysqli_fetch_array($resultadoa)){

$sqlan = "SELECT p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioaa' and '$fimaa' and pedido_unidade = $linhaa[pedido_unidade]   order by total_valor  desc ";	
$resultadoan = mysqli_query($conn, $sqlan);	
$linhaam = mysqli_fetch_array($resultadoan);
$anterior = $linhaam[total_valor]; 
$atual = $linhaa[total_valor]; 
	
?>
							  
			<div class="row">
							
							  <div class="col-8" align="left"><?php if ($anterior < $atual ) {  ?> <i class="dripicons-arrow-up text-success"></i> <?php } else { ?> <i class="dripicons-arrow-down text-danger"></i> <?php } ?> <STRONG><?php echo($linhaa['Row'])  ?>º <?php echo $linhaa['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-4">R$<?php echo $linhaa['total_valor'] ?> </div>
				   
								  
						  	 </div>				 
							  <hr>
							  <?php }?>
														
														
														
														
                                                    </div>
                                                </div>
												
												
												
												
												
												
												
												
												    <div class="item event-list">
                                                    <div class="event-date bg-primary">
                                                        <div class="text-white">Julho</div>
                                                    </div>
                                                    
													
													
                                                    <div class="px-3">
														
														
                                                      <?php
														
														

$anoatual = date('Y');

$inicioa = $anoatual.'-07-01';
$fima = $anoatual.'-07-31';
														
$inicioaa = $anoatual.'-06-01';
$fimaa = $anoatual.'-06-31';														
														
														
$sqla = "SELECT  u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioa' and '$fima'  group by pedido_unidade order by total_valor  desc ";
												
$resultadoa = mysqli_query($conn, $sqla);
$totala = mysqli_num_rows($resultadoa);
						

												
																										
														
while($linhaa = mysqli_fetch_array($resultadoa)){

$sqlan = "SELECT p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioaa' and '$fimaa' and pedido_unidade = $linhaa[pedido_unidade]   order by total_valor  desc ";	
$resultadoan = mysqli_query($conn, $sqlan);	
$linhaam = mysqli_fetch_array($resultadoan);
$anterior = $linhaam[total_valor]; 
$atual = $linhaa[total_valor]; 
	
?>
							  
			<div class="row">
							
							  <div class="col-8" align="left"><?php if ($anterior < $atual ) {  ?> <i class="dripicons-arrow-up text-success"></i> <?php } else { ?> <i class="dripicons-arrow-down text-danger"></i> <?php } ?> <STRONG><?php echo($linhaa['Row'])  ?>º <?php echo $linhaa['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-4">R$<?php echo $linhaa['total_valor'] ?> </div>
				   
								  
						  	 </div>				 
							  <hr>
							  <?php }?>
														
														
														
														
                                                    </div>
                                                </div>
												
												
												
												
												
												
												
												      <div class="item event-list">
                                                    <div class="event-date bg-primary">
                                                        <div class="text-white">Agosto</div>
                                                    </div>
                                                    
													
													
                                                    <div class="px-3">
														
														
                                                      <?php
														
														

$anoatual = date('Y');

$inicioa = $anoatual.'-08-01';
$fima = $anoatual.'-08-31';
														
$inicioaa = $anoatual.'-07-01';
$fimaa = $anoatual.'-07-31';														
														
														
$sqla = "SELECT  u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioa' and '$fima'  group by pedido_unidade order by total_valor  desc ";
												
$resultadoa = mysqli_query($conn, $sqla);
$totala = mysqli_num_rows($resultadoa);
						

												
																										
														
while($linhaa = mysqli_fetch_array($resultadoa)){

$sqlan = "SELECT p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioaa' and '$fimaa' and pedido_unidade = $linhaa[pedido_unidade]   order by total_valor  desc ";	
$resultadoan = mysqli_query($conn, $sqlan);	
$linhaam = mysqli_fetch_array($resultadoan);
$anterior = $linhaam[total_valor]; 
$atual = $linhaa[total_valor]; 
	
?>
							  
			<div class="row">
							
							  <div class="col-8" align="left"><?php if ($anterior < $atual ) {  ?> <i class="dripicons-arrow-up text-success"></i> <?php } else { ?> <i class="dripicons-arrow-down text-danger"></i> <?php } ?> <STRONG><?php echo($linhaa['Row'])  ?>º <?php echo $linhaa['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-4">R$<?php echo $linhaa['total_valor'] ?> </div>
				   
								  
						  	 </div>				 
							  <hr>
							  <?php }?>
														
														
														
														
                                                    </div>
                                                </div>
												
												
												
												
												
												
												
												    
												
												
												    <div class="item event-list">
                                                    <div class="event-date bg-primary">
                                                        <div class="text-white">Setembro</div>
                                                    </div>
                                                    
													
													
                                                    <div class="px-3">
														
														
                                                      <?php
														
														

$anoatual = date('Y');

$inicioa = $anoatual.'-09-01';
$fima = $anoatual.'-09-31';
														
$inicioaa = $anoatual.'-08-01';
$fimaa = $anoatual.'-08-31';														
														
														
$sqla = "SELECT  u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioa' and '$fima'  group by pedido_unidade order by total_valor  desc ";
												
$resultadoa = mysqli_query($conn, $sqla);
$totala = mysqli_num_rows($resultadoa);
						

												
																										
														
while($linhaa = mysqli_fetch_array($resultadoa)){

$sqlan = "SELECT p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioaa' and '$fimaa' and pedido_unidade = $linhaa[pedido_unidade]   order by total_valor  desc ";	
$resultadoan = mysqli_query($conn, $sqlan);	
$linhaam = mysqli_fetch_array($resultadoan);
$anterior = $linhaam[total_valor]; 
$atual = $linhaa[total_valor]; 
	
?>
							  
			<div class="row">
							
							  <div class="col-8" align="left"><?php if ($anterior < $atual ) {  ?> <i class="dripicons-arrow-up text-success"></i> <?php } else { ?> <i class="dripicons-arrow-down text-danger"></i> <?php } ?> <STRONG><?php echo($linhaa['Row'])  ?>º <?php echo $linhaa['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-4">R$<?php echo $linhaa['total_valor'] ?> </div>
				   
								  
						  	 </div>				 
							  <hr>
							  <?php }?>
														
														
														
														
                                                    </div>
                                                </div>
												
												
												
												
												
												    <div class="item event-list">
                                                    <div class="event-date bg-primary">
                                                        <div class="text-white">Outubro</div>
                                                    </div>
                                                    
													
													
                                                    <div class="px-3">
														
														
                                                      <?php
														
														

$anoatual = date('Y');

$inicioa = $anoatual.'-10-01';
$fima = $anoatual.'-10-31';
														
$inicioaa = $anoatual.'-09-01';
$fimaa = $anoatual.'-09-31';														
														
														
$sqla = "SELECT  u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioa' and '$fima'  group by pedido_unidade order by total_valor  desc ";
												
$resultadoa = mysqli_query($conn, $sqla);
$totala = mysqli_num_rows($resultadoa);
						

												
																										
														
while($linhaa = mysqli_fetch_array($resultadoa)){

$sqlan = "SELECT p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioaa' and '$fimaa' and pedido_unidade = $linhaa[pedido_unidade]   order by total_valor  desc ";	
$resultadoan = mysqli_query($conn, $sqlan);	
$linhaam = mysqli_fetch_array($resultadoan);
$anterior = $linhaam[total_valor]; 
$atual = $linhaa[total_valor]; 
	
?>
							  
			<div class="row">
							
							  <div class="col-8" align="left"><?php if ($anterior < $atual ) {  ?> <i class="dripicons-arrow-up text-success"></i> <?php } else { ?> <i class="dripicons-arrow-down text-danger"></i> <?php } ?> <STRONG><?php echo($linhaa['Row'])  ?>º <?php echo $linhaa['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-4">R$<?php echo $linhaa['total_valor'] ?> </div>
				   
								  
						  	 </div>				 
							  <hr>
							  <?php }?>
														
														
														
														
                                                    </div>
                                                </div>
												
												
												
												
														    <div class="item event-list">
                                                    <div class="event-date bg-primary">
                                                        <div class="text-white">Novembro</div>
                                                    </div>
                                                    
													
													
                                                    <div class="px-3">
														
														
                                                      <?php
														
														

$anoatual = date('Y');

$inicioa = $anoatual.'-11-01';
$fima = $anoatual.'-11-31';
														
$inicioaa = $anoatual.'-10-01';
$fimaa = $anoatual.'-10-31';														
														
														
$sqla = "SELECT  u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioa' and '$fima'  group by pedido_unidade order by total_valor  desc ";
												
$resultadoa = mysqli_query($conn, $sqla);
$total = mysqli_num_rows($resultadoa);
$totala = mysqli_num_rows($resultadoa);
						

												
																										
														
while($linhaa = mysqli_fetch_array($resultadoa)){

$sqlan = "SELECT p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioaa' and '$fimaa' and pedido_unidade = $linhaa[pedido_unidade]   order by total_valor  desc ";	
$resultadoan = mysqli_query($conn, $sqlan);	
$linhaam = mysqli_fetch_array($resultadoan);
$anterior = $linhaam[total_valor]; 
$atual = $linhaa[total_valor]; 
	
?>
							  
			<div class="row">
							
							  <div class="col-8" align="left"><?php if ($anterior < $atual ) {  ?> <i class="dripicons-arrow-up text-success"></i> <?php } else { ?> <i class="dripicons-arrow-down text-danger"></i> <?php } ?> <STRONG><?php echo($linhaa['Row'])  ?>º <?php echo $linhaa['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-4">R$<?php echo $linhaa['total_valor'] ?> </div>
				   
								  
						  	 </div>				 
							  <hr>
							  <?php }?>
														
														
																				<?php if ($total == '0') { ?> Sem dados para exibir	<?php } ?>													
			
														
                                                    </div>
                                                </div>
												
												
												
												
												
												    <div class="item event-list">
                                                    <div class="event-date bg-primary">
                                                        <div class="text-white">Dezembro</div>
                                                    </div>
                                                    
													
													
                                                    <div class="px-3">
														
														
                                                      <?php
														
														

$anoatual = date('Y');

$inicioa = $anoatual.'-12-01';
$fima = $anoatual.'-12-31';
														
$inicioaa = $anoatual.'-11-01';
$fimaa = $anoatual.'-11-31';														
														
														
$sqla = "SELECT  u.unidade_nome, p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioa' and '$fima'  group by pedido_unidade order by total_valor  desc ";
												
$resultadoa = mysqli_query($conn, $sqla);
$total = mysqli_num_rows($resultadoa);
$totala = mysqli_num_rows($resultadoa);
						

												
																										
														
while($linhaa = mysqli_fetch_array($resultadoa)){

$sqlan = "SELECT p.pedido_valor, u.id_unidade, p.pedido_status, p.pedido_data, p.pedido_unidade, SUM(p.pedido_valor) as total_valor  FROM pedidos p LEFT JOIN unidades u on p.pedido_unidade = u.id_unidade   where p.pedido_status ='2' and p.pedido_data BETWEEN '$inicioaa' and '$fimaa' and pedido_unidade = $linhaa[pedido_unidade]   order by total_valor  desc ";	
$resultadoan = mysqli_query($conn, $sqlan);	
$linhaam = mysqli_fetch_array($resultadoan);
$anterior = $linhaam[total_valor]; 
$atual = $linhaa[total_valor]; 
	
?>
							  
			<div class="row">
							
							  <div class="col-8" align="left"><?php if ($anterior < $atual ) {  ?> <i class="dripicons-arrow-up text-success"></i> <?php } else { ?> <i class="dripicons-arrow-down text-danger"></i> <?php } ?> <STRONG><?php echo($linhaa['Row'])  ?>º <?php echo $linhaa['unidade_nome'] ?> </STRONG></div>  
							  <div class="col-4">R$<?php echo $linhaa['total_valor'] ?> </div>
				   
								  
						  	 </div>				 
							  <hr>
							  <?php }?>
														
																						<?php if ($total == '0') { ?> Sem dados para exibir	<?php } ?>													
	
														
														
                                                    </div>
                                                </div>
												
												
												
													
												
												
												
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end row -->

</div></div></div>





 <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- owl.carousel js -->
        <script src="assets/libs/owl.carousel/owl.carousel.min.js"></script>

        <!-- timeline init js -->
        <script src="assets/js/pages/timeline.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>