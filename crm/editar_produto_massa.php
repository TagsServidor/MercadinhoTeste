<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
?>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_estoqueentrada.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
 <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     


 <!-- Select com Busca-->
 <link href="assets/js/select2.min.css" rel="stylesheet" />
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/select2.min.js"></script>

  <!-- Responsive Table css -->
        <link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' deve ser preenchido.\n'; }
    } if (errors) alert('Atenção !!!\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script> 

<div id="results"></div>
					
					<div id="dvConteudo" >

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Produtos &gt; Edição em Massa</h4>

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
					                 <div class="card-body">
                                      
                                        
										 
										 
										 
										 
										 
										    <div class="table-rep-plugin">
                                            
                                                 <table id="" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">	
                                                    <thead>
                                                    <tr>
                                                       
														  <th>Nome</th>
														 <th>Preço venda</th>
                                                         <th>Preço custo</th>
                                                        <th >Código de barras</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
														
														<?php 				
														
$sqlos = "SELECT * FROM produtos where produto_lixeira = '1' ";	
$resultadoos = mysqli_query($conn, $sqlos);
$totalose = mysqli_num_rows($resultadoos);	
while($linhaos = mysqli_fetch_array($resultadoos)){
  extract($linhaos);
$sqlose = "SELECT * FROM entrada_produtos where entrada_produto = $linhaos[id_produto] order by id_entrada DESC  ";	
$resultadoose = mysqli_query($conn, $sqlose);
$totalose = mysqli_num_rows($resultadoose);	
$linhaose = mysqli_fetch_array($resultadoose);
	?>
														<?php if($linhaos['produto_status'] =='2') { ?>
														 <th style="background:red; color: #fff">
                             <?php } ?>
                             <?php if($linhaos['produto_status'] =='1') { ?>
														 <th>
                             <?php } ?>
                             <form action="alterar_produtos_massa" method="POST">

<input type="hidden" value="<?php echo $linhaos['id_produto'] ?>" name="produto[<?php echo $linhaos['id_produto'] ?>]">

                             
                            
                             
                             
                             
<?php echo $linhaos['produto_nome'] ?><span class="co-name"> </span><br>

<strong> Ativo: </strong> 
<?php if($linhaos['produto_status'] == '1' ) { ?>
<input type="radio" checked name="desativar[<?php echo $linhaos['id_produto'] ?>]" value="1"> Sim
<input type="radio"  name="desativar[<?php echo $linhaos['id_produto'] ?>]" value="2"> Não
<?php } ?>

<?php if($linhaos['produto_status'] == '2' ) { ?>
  <input type="radio"  name="desativar[<?php echo $linhaos['id_produto'] ?>]" value="1"> Sim
<input type="radio" checked name="desativar[<?php echo $linhaos['id_produto'] ?>]" value="2"> Não
<?php } ?>


<span class="badge bg-danger">                    
  <input class="form-check-input" type="checkbox" name="excluir[<?php echo $linhaos['id_produto'] ?>]" value="2" id="flexRadioDefault2<?php echo $linhaos['id_produto'] ?>">
  <label class="form-check-label" for="flexRadioDefault2<?php echo $linhaos['id_produto'] ?>">
   Excluir 
  </label> 
</span>
                            </th>
														
                                                        <th>
															
															<div id="r1<?php echo $linhaos['id_produto'] ?>">
															
															
															<div id="dvpreco<?php echo $linhaos['id_produto'] ?>" style="display: block" >

															
																
																
																
															<div class="row"> 
																<div class="col-12"> 
																<input type="text"  class="form-control money" name="valor[<?php echo $linhaos['id_produto'] ?>]" id="textfield" value="<?php echo $linhaose['entrada_venda'] ?>">
															  </div>

																	
																	
															  </div>
																
																</div>
																
																
													
														</div>
														
														</th>
														
														 

                                                        <th>
															
															<div id="r1<?php echo $linhaos['id_produto'] ?>">
															
															
															<div id="dvpreco<?php echo $linhaos['id_produto'] ?>" style="display: block" >

															
																
																
																
															<div class="row"> 
																<div class="col-12"> 
																<input type="text"  class="form-control money" name="valorcusto[<?php echo $linhaos['id_produto'] ?>]" id="textfield" value="<?php echo $linhaose['entrada_unitario'] ?>">
															  </div>

																	
																	
															  </div>
																
																</div>
																
																
														
														</div>
														
														</th>


														
                                                        <td>
															
																
																

																
															<div class="row"> 
																<div class="col-12"> 
																<input type="text" class="form-control" name="barras[<?php echo $linhaos['id_produto'] ?>]" id="barras" value="<?php echo $linhaos['produto_codigobarras'] ?>" >
																	</div>

																	
																	
																	</div>
																
																</div>
																
																
															
															
                                                      </tr>
														 
														
														
														
<script>
															
$(document).ready(function() {
$("#atpreco<?php echo $linhaos['id_produto'] ?>").submit(function(){
var dados = jQuery( this ).serialize();
$.ajax({
url: 'salvar_preco_massa.php',
cache: false,
data: dados,
type: "POST",  
success: function(msg){
alert("Alterado com sucesso!");

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
                                            </div><input class="btn btn-info" type="submit" value="Salvar">
        
                                 
										 </div>
										 
										 
									

                                  </div> </div> </div> </div>
					
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

        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
        <script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script><script src="assets/js/pages/table-responsive.init.js"></script>