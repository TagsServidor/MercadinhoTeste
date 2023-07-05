<?php 

include "bd/conexao.php";

@session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
$sqlu = "SELECT * FROM unidades where id_unidade = '$_GET[unidade]'  ";
$resultadou = mysqli_query($conn, $sqlu);
$linhau = mysqli_fetch_array($resultadou);
/// CONECTANDO OS PRODUTOS

$sql = "SELECT * FROM unidades where id_unidade = '$_GET[unidade]' ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);

$cat_prod_id = $_GET[unidade] ;



$query_produtos = "SELECT * 
                    FROM produtos_unidades pu inner join produtos p on pu.produto_unidade_produto = p.id_produto
                    inner join produtos_departamentos pd on   p.produto_departamento = pd.id_departamentos  WHERE pu.produto_unidade_unidade=:cat_prod_id and pu.produto_unidade_estoque > 0
                   order by pd.departamento_os_posicao , p.produto_nome";
$result_produtos = $conn2->prepare($query_produtos);
$result_produtos->bindParam(':cat_prod_id', $cat_prod_id);
$result_produtos->execute();

?>

<style>
	.esconderbarras {
		font-size: 0px;
	}

</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


 <!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>

  <!-- Responsive Table css -->
        <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

<!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />   

				


					<div id="dvConteudo" >

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Estoque &gt;  <a href="perfil_unidade/<?php echo $id ?>"> <?php echo $linhau['unidade_nome'] ?></a></h4> 

                                    <div class="page-title-right">
										 
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                    </div> 
               
					
					
					
					
					
					
                <div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">&nbsp;</h4><br>
                    <table class="table">
                      <tbody>
                        <tr>                        
                        <tr>
                          <th>Estoque</th>
                          <th>Produto</th>
                          <th>Seg</th>
                          <th>Ter.</th>
                          <th>Qua.</th>
							 <th>Qui</th>
							 <th>Sext.</th>
                          <th>Sab</th>
                          <th>Domingo</th>
                        </tr>
                      <tbody>
                        <tr>
                          <?php 
	 while($row_prod = $result_produtos->fetch(PDO::FETCH_ASSOC)){
                extract($row_prod);
				
				
				$sql = "SELECT * FROM produtos where id_produto = '$produto_unidade_produto' ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);    
															
															?>
							
			
							
							 <form action="alterar_estoque_unidade" method="POST">
							
							
                          <tr>
                            <td ><?php echo $produto_unidade_estoque ?>
								
								</td>
                          <td><h6 class="font-size-15 mb-1 fw-normal"> <?php echo $linha['produto_nome'] ?>
							  
							  
							  
							  </h6></td>
<td style="background: #a5a5a5" >&nbsp;</td>								
<td style="background: #x5x5x5" >&nbsp;</td>								
<td style="background: #d5d5d5" >&nbsp;</td>								
							  
<td style="background: #g5g5g5" >&nbsp;</td>								
							  
<td style="background: #e5e5e5" >&nbsp;</td>								
                          <td style="background: #D5D5D5" >&nbsp;</td>
                          <td style="background: #c6c6c6" >&nbsp;</td>
                         </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
                </div>   </div>   </div>   </div>   </div>
					<input type="hidden" name="unidade" value="<?php echo $id ?>">
						</form>
					
					


<?php
	$cat_prod_id = $_GET[unidade];



$query_produtos = "SELECT * 
                    FROM produtos_unidades 
                    WHERE produto_unidade_unidade=:cat_prod_id
                   order by produto_unidade_estoque ";
$result_produtos = $conn2->prepare($query_produtos);
$result_produtos->bindParam(':cat_prod_id', $cat_prod_id);
$result_produtos->execute();

while($row_prod = $result_produtos->fetch(PDO::FETCH_ASSOC)){
                extract($row_prod);
				
				
				$sql = "SELECT * FROM produtos where id_produto = '$produto_unidade_produto' ";
$resultado = mysqli_query($conn, $sql);
$linha = mysqli_fetch_array($resultado);  
	?>
					
		<!-- Center Modal example --><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->				




<?php } ?>






			   <!-- JAVASCRIPT -->
       
 <script src="assets/js/pages/modal.init.js"></script>
<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>	
        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>		
					
         <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>
        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
        <script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script>