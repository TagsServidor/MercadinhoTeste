	<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

/// CONECTANDO AOS PEDIDOS

$sql = "SELECT SUM(qtd_carrinho) AS qtd_carrinho , SUM(qtd_carrinho*preco_pago) AS preco_pago2, SUM(qtd_carrinho*preco_custo) AS preco_custo2, preco_pago, preco_custo, produto_carrinho, data_carrinho FROM carrinho WHERE status_carrinho ='2' and preco_pago <> '0.00' group by produto_carrinho    ";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_num_rows($resultado);	


?>

<style>
	.esconderbarras {
		font-size: 0px;
	}

</style>
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

				






				

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Relatórios &gt; Produtos mais vendidos</h4> 

                                    <div class="page-title-right">
										
										
										
										
										
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                      
                        
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form action="produtos_vendidos_unidade_periodo2" method="post">
                                    <div class="row"> 

<div class="col-3">
<label><strong>Inicio:</strong></label>
<input type="datetime-local" class="form-control" required name="inicio"> 
</div>	

<div class="col-3">
<label><strong>Fim:</strong></label>
<input type="datetime-local" class="form-control" required name="fim">
</div>	

<div class="col-3">
<label><strong>Unidade:</strong></label>
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

?></div>	
<div class="col-3">
<label>&nbsp;&nbsp;<br></label><br>
&nbsp;<button class="btn btn-info"> Listar </button>
</div>	

                    </div>
</form>
                    </div>
                    </div>
					
					
			
	
	
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