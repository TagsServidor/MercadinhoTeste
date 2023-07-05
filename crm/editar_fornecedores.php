<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

include "bd/conexao.php";

$sqlos = "SELECT * FROM fornecedores WHERE id_fornecedor = '$_POST[id]' ";
$resultadoos = mysqli_query($conn, $sqlos);
$totalos = mysqli_num_rows($resultadoos);	
$fornecedor = mysqli_fetch_array($resultadoos);

?>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_fornecedor2.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>



 <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" >


$(document).ready(function () {
   $('input').keypress(function (e) {
        var code = null;
        code = (e.keyCode ? e.keyCode : e.which);                
        return (code == 13) ? false : true;
   });
});

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>

<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Fornecedores</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        <a href="listar_fornecedores"><button class="btn btn-info"> Voltar </button></a>    
											
											<form action="deletar_fornecedor" method="post"> 
												<input type="hidden" value="<?php echo $fornecedor['id_fornecedor'] ?>" name="id">
											<button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar esse fornecedor?')"> Remover Fornecedor </button> </form>
											
											
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
                                        <h4 class="card-title">Editar Fornecedor</h4>
                                       
                                        <form id="formfornecedor" action="#" method="post">
											
											  <div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nome do Fornecedor:</label>
                                                        <input name="nome" type="text" value="<?php echo $fornecedor['fornecedor_nome'] ?>" required class="form-control" id="nome" placeholder="Informe o nome do Fornecedor Ex: Ambev">
                                                        
                                                    </div>
                                                </div>
												  
												   
												    <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nome do Contato:</label>
                                                        <input name="contato" type="text" value="<?php echo $fornecedor['fornecedor_contato'] ?>" class="form-control" id="nome" placeholder="Informe o nome do contato com o fornecedor">
                                                        
                                                    </div>
                                                </div>
												  
												   
												  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">CNPJ:</label>
            <input name="cnpj" type="text" value="<?php echo $fornecedor['fornecedor_cnpj'] ?>" class="form-control cnpj" id="cnpj"/>

                                                        
                                                    </div>
                                                </div>
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Telefone fixo:</label>
                                                        <input type="text" value="<?php echo $fornecedor['fornecedor_telefone'] ?>" class="form-control phone_with_ddd2" id="telefone"  name="telefone" placeholder="Informe telefone fixo">
                                                        
                                                    </div>
                                                </div>
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Telefone celular:</label>
                                                        <input type="text" value="<?php echo $fornecedor['fornecedor_celular'] ?>" class="form-control phone_with_ddd" id="celular" name="celular"  placeholder="Informe telefone celular">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">E-mail:</label>
                                                        <input type="email" value="<?php echo $fornecedor['fornecedor_email'] ?>" class="form-control" id="email" name="email" placeholder="Informe o e-mail">
                                                        
                                                    </div>
                                                </div>  
												  
												  <hr>
												  <h5>Endereço:</h5>
												    <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Cep:</label>
                                                        <input name="cep" value="<?php echo $fornecedor['fornecedor_cep'] ?>" type="text" class="form-control cep" id="cep" placeholder="Informe o cep">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Rua:</label>
                                                        <input type="text" value="<?php echo $fornecedor['fornecedor_rua'] ?>" class="form-control" id="rua" name="rua" placeholder="Nome da rua">
                                                        
                                                    </div>
                                                </div>  
												   
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nº:</label>
                                                        <input type="text" value="<?php echo $fornecedor['fornecedor_numero'] ?>" class="form-control" id="numero" name="numero" placeholder="Numero">
                                                        
                                                    </div>
                                                </div>  
												  
												    <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Complemento:</label>
                                                        <input type="text" value="<?php echo $fornecedor['fornecedor_complemento'] ?>" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Bairro:</label>
                                                        <input type="text" value="<?php echo $fornecedor['fornecedor_bairro'] ?>" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                                                        
                                                    </div>
                                                </div>  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Cidade:</label>
                                                        <input type="text" value="<?php echo $fornecedor['fornecedor_cidade'] ?>" readonly=true class="form-control" id="cidade" name="cidade" placeholder="Cidade">
                                                        
                                                    </div>
                                                </div>  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Estado:</label>
                                                        <input name="uf" value="<?php echo $fornecedor['fornecedor_uf'] ?>" type="text" readonly=true class="form-control" id="uf" placeholder="Estado" maxlength="2">
                                                        
                                                    </div>
                                                </div>  
												  
												  <hr>
												  <h5>Informações Adicionais</h5>
												  
												  
												  <div class="col-md-12">
                                                    <div class="mb-3">
                                                    <textarea  id="classic-editor"	 name="informacoes"> <?php echo $fornecedor['fornecedor_informacoes']?></textarea>
                                                        
                                                    </div>
                                                </div>  
												  
												  
												<div class="card">
                                        <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-img-collapse">
                                            <div class="p-4">
                                                
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                       
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Logomarca do fornecedor</h5>
                                                        <p class="text-muted text-truncate mb-0">Adicionar logomarca do fornecedor</p>
                                                    </div>
                                                    <div class="flex-shrink-0">
														
														<i class="fa fa-upload font-size-24 " aria-hidden="true"></i>

														
                                                       
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </a>

                                        <div id="addproduct-img-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                              
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            
                                                        </div>
                                                        <div class="row">  
														<div class="col-md-9">
															 
                                                       <input type="file" onChange="readURL(this);"  class="form-control" name="arquivo"></div>
														
														<div class="col-md-3" align="center"> <img id="ImdID" src="" class="img" />	</div>
    <script type="text/javascript">
        function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#ImdID').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
    </script>
														
														</div>
														
														
                                                    </div>
                                               
                                        </div>
                                    </div></div>  
												  
												  
                                                 <input type="hidden" value="<?php echo $_POST['id'] ?>" name="id" id="textfield">
												     </div>
												 <div align="right"> <button class="btn btn-primary" id="enviar" type="submit">Alterar</button> </div>
										 </form>

										 
										    	<div id="results"></div>	
										 	<div id="results2"></div>	
	<div id="results3"></div>	  


                                  </div> </div> </div> </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
					
					
	
	<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>					

	<script src="assets/js/pages/form-validation.init.js"></script>
						
	
					
					
     <!-- JAVASCRIPT -->
        

        <!-- ckeditor -->
        <script src="assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

       

        <script>
        ClassicEditor
        .create( document.querySelector( '#classic-editor' ) )
        .catch( error => {
            console.error( error );
        } );
        </script>
					
					
