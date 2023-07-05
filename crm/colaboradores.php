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


<div id="results"></div>
					
					<div id="dvConteudo" >

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Gerenciável &gt; Colaboradores</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           
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
					                 <div class="card-body" align="center">
                                        <h4 class="card-title">Adicionar novo Colaborador</h4>
										 
									</div> <div align="center">
									<button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".adm"><i class="fa fa-window-restore" aria-hidden="true"></i> Administrativo</button>
									
									<button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".repositor"><i class="fa fa-share-square" aria-hidden="true"></i> Repositor</button>
									
									 
									<br><br>
									</div>
								
								</div></div></div></div>
					
					
					
                <div class="container-fluid">
					<div class="row">
                            <div class="col-12">
                                <div class="card">
					                 <div class="card-body">
                                        <h4 class="card-title">Colaboradores Cadastrados</h4>
                                        
										 
										 
										 
										 
										 
										    <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                <table id="tech-companies-1" class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th data-priority="1">Login</th>
                                                        <th data-priority="3">Status</th>
                                                       <th data-priority="3">Função</th>
														 <th data-priority="3">Último acesso</th>
                                                        <th data-priority="3">Ação</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
														
														<?php // LISTANDO OS EM ABERTO
														
$sql = "SELECT * FROM adm order by nome desc  ";
$resultado = mysqli_query($conn, $sql);
$totalos = mysqli_num_rows($resultado);	
while($colaborador = mysqli_fetch_array($resultado)){
	
	
	?>
														
														
                                                        <th><?php echo $colaborador['nome'] ?>  <span class="co-name"> </span></th>
                                                        <td><?php echo $colaborador['login'] ?> </td>
                                                        <td><?php if($colaborador['situacao'] =='on') { ?><span class="btn btn-success btn-sm"> <i class="fa fa-check" aria-hidden="true"></i> Ativo </span><?php } ?>
															<?php if($colaborador['situacao'] =='off') { ?><span class="btn btn-danger btn-sm"> <i class="fa fa-ban" aria-hidden="true"></i> Inativo </span><?php } ?>
</td>
                                                        <td><?php if($colaborador['gerenciavel'] =='2') { ?>Administrativo <?php } ?><?php if($colaborador['repositor'] =='2') { ?>Repositor <?php } ?></td>
														<td></td>
                                                        <td>
															
															
															
															 <form id="#" action="#" method="post">
															<input type="hidden" value="<?php echo $linhaos['id_os_reposicao'] ?>" name="os">	 
															<button class="btn btn-outline-secondary btn-sm edit">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
														
															</form>
														
														</td>
														
														
														
														
														
														
													
                                                      </tr>
														 
														
														
														
			<script>
															
															 $(document).ready(function() {
 
	 $("#formos<?php echo $linhaos['id_os_reposicao'] ?>").submit(function(){
		 
		 
		 
		 var dados = jQuery( this ).serialize();
		 
		$.ajax({
			url: 'ver_os_reposicao.php',
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
										 
	<!-- Modal ADM -->
                                                <div class="modal fade adm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Novo Colaborador Administrativo</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
															<form action="inserir_gerenciavel" method="post">
																<label> Informe o nome</label>
																<input type="text" class="form-control" name="nome" required>
																<label> Informe o login acesso</label>
																	<input type="text" class="form-control" name="login" required>
																<label> Informe o e-mail</label>
																	<input type="text" class="form-control" name="email" required>
																<label> Informe uma senha</label>																	<input type="text" class="form-control" name="senha" required>
<input type="hidden" class="form-control" name="repositor" value="1" required>
<input type="hidden" class="form-control" name="gerenciavel" value="2" required>
																	<div align="center" style="padding: 10px"> <input type="submit" class="btn btn-info" value="Cadastrar"> </div>
																</form>
																
																
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
                                            <!-- end col -->									 
									
									
									<!-- Modal Repositor -->
                                                <div class="modal fade repositor" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Novo Colaborador Repositor</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
																<form action="inserir_gerenciavel" method="post">
																<label> Informe o nome</label>
																<input type="text" class="form-control" name="nome" required>
																<label> Informe o login acesso</label>
																	<input type="text" class="form-control" name="login" required>
																<label> Informe o e-mail</label>
																	<input type="text" class="form-control" name="email" required>
																<label> Informe uma senha</label>																	<input type="text" class="form-control" name="senha" required>
<input type="hidden" class="form-control" name="repositor" value="2" required>
<input type="hidden" class="form-control" name="gerenciavel" value="1" required>
																	<div align="center" style="padding: 10px"> <input type="submit" class="btn btn-info" value="Cadastrar"> </div>
																</form>
																
																
                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->
                                            </div>
                                            <!-- end col -->				
									
									
									

                                  </div> </div> </div> </div>
        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
        <script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script>