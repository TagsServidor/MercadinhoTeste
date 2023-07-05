<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


 <!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>

  <!-- Responsive Table css -->
        <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />



<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Estoque &gt; Produtos vencendo &gt; Por unidades<br></h4>
									
									
</div>
                                    <div class="page-title-right"><div align="right"><form action="#" name="data" method="post"><input name="dias" type="number" placeholder="Filtrar por dias" max="120" min="1" class="form-control" onblur="teste()"> </form> <br>
                                        <ol class="breadcrumb m-0">
                                           <script>
											function teste(){
        document.data.submit();
}
											
											</script>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
               
					
                <div class="container-fluid">
					<div class="row">
                            <div class="col-12">
                                <div class="card">
					                 <div class="card-body">
                                        <h4 class="card-title">Controle de vencimento de produtos proximos: <?php if (@$_POST['dias'] =='') { ?> 30 <?php } else {  ?> <?php echo $_POST['dias'] ?> <?php } ?> dias</h4>
                                        
										 
										 
										 
										 
										 
										    <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Produto</th>
                                                        <th data-priority="1">Lote</th>
                                                        <th data-priority="3">Unidade</th>
														  <th data-priority="3">Estoque </th>
														
														  <th data-priority="3">Vencimento</th>
														
                                                        <th data-priority="1">Ação</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
														
														<?php // LISTANDO OS EM ABERTO
													
													
$sqlos = "SELECT * FROM os_produtos e INNER JOIN produtos p on e.os_produtos_produto = p.id_produto inner join unidades u on e.os_produtos_unidade = u.id_unidade inner join condominios c on u.unidade_condominio = c.id_condominio where e.os_produtos_produto = '$_POST[produto]' and os_produtos_vencimento BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY) order by os_produtos_vencimento asc ";

$resultadoos = mysqli_query($conn, $sqlos);
$totalos = mysqli_num_rows($resultadoos);	
while($linhaos = mysqli_fetch_array($resultadoos)){
	

$diferenca = strtotime($linhaos['os_produtos_vencimento']) - strtotime($data1);
$dias = floor($diferenca / (60 * 60 * 24));
	
	
	?>
														
														
                                                        <th> <?php echo $linhaos['produto_nome'] ?> <span class="co-name"> </span></th>
                                                        <td> <?php echo $linhaos['os_produtos_lote'] ?> </td>
                                                        <td><?php echo $linhaos['condominio_nome'] ?> - <?php echo $linhaos['unidade_nome'] ?> </td>
                                                        <td>xx	</td>
														<td><span class="badge rounded-pill bg-danger" ><?php echo date('d/m/Y', strtotime($linhaos['os_produtos_vencimento'])); ?>  </span> <br>  <span class="badge rounded-pill bg-soft-danger"><?php echo $dias ?> dias</span></td>
                                                        <td>
															
															
															
															 <form id="formos" action="#" method="post">
															<input type="hidden" value="" name="os">	 
															<button class="btn btn-outline-secondary btn-sm edit">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
														
															</form>
														
														</td>
														
														
														
														
														
														
													
                                                      </tr>
														 
														
														
														
			<script>
															
															 $(document).ready(function() {
 
	 $("#formos<?php echo $linhaos['id_entrada'] ?>").submit(function(){
		 
		 
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'ver_vencidos_unidades.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#results").empty();
				$("#results").append(msg);
				document.getElementById("dvConteudo").style.display = "none";
				

				
				
				
			}
			
		});
		 
		 return false;
	 });
 
 });
														</script>											
														
														
														
														<?php } ?>
														
														  <!-- Fim lista os aberto  -->
                                                                                           
                                                    </tbody>
                                                </table>
                                            </div>
        
                                 
										 </div>
										 
										 
									

                                  </div> </div> </div> </div>
        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
        <script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script>