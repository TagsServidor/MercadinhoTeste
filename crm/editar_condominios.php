<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

include "bd/conexao.php";

$sqlos = "SELECT * FROM condominios WHERE id_condominio = '$id' ";
$resultadoos = mysqli_query($conn, $sqlos);
$totalos = mysqli_num_rows($resultadoos);	
$condominio = mysqli_fetch_array($resultadoos);

?>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_condominios_editar.js"></script>
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
                                    <h4 class="mb-0">Condomínios</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        <a href="listar_condominios"><button class="btn btn-info"> Voltar </button></a>   
											
										<form action="deletar_condominio" method="post"> 
												<input type="hidden" value="<?php echo $condominio['id_condominio'] ?>" name="id">
											<button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar esse condominio?')"> Remover Condomínio </button>	
											</form>
											
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
                                        <h4 class="card-title">Editar Condomínio </h4>
                                       
                                        <form  action="alterar_condominio" method="post">
											
											  <div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nome do Condomínio:</label>
                                                        <input name="nome" required type="text" value="<?php echo $condominio['condominio_nome'] ?>"  class="form-control" id="nome" placeholder="Informe o nome do Condomínio">
                                                        
                                                    </div>
                                                </div>
												  
												   
												    <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nome do Síndico:</label>
                                                        <input name="sindico" type="text" value="<?php echo $condominio['condominio_sindico'] ?>" class="form-control" id="nome" placeholder="Informe o nome do Síndico">
                                                        
                                                    </div>
                                                </div>
												  
												   <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Quantidade de apartamentos:</label>
                                                        <input name="apartamentos" type="number" value="<?php echo $condominio['condominio_apartamentos'] ?>" class="form-control" id="nome" placeholder="">
                                                        
                                                    </div>
                                                </div>
												  
												   <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Central de Distribuição:</label>
                                                    </div>
                                                </div>
												  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">CNPJ:</label>
            <input name="cnpj" type="text" value="<?php echo $condominio['condominio_cnpj'] ?>" class="form-control cnpj" id="cnpj"/>

                                                        
                                                    </div>
                                                </div>
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Telefone fixo:</label>
                                                        <input type="text" value="<?php echo $condominio['condominio_telefone'] ?>" class="form-control phone_with_ddd2" id="telefone"  name="telefone" placeholder="Informe telefone fixo">
                                                        
                                                    </div>
                                                </div>
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Telefone celular:</label>
                                                        <input type="text" value="<?php echo $condominio['condominio_celular'] ?>" class="form-control phone_with_ddd" id="celular" name="celular"  placeholder="Informe telefone celular">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">E-mail:</label>
                                                        <input type="email" value="<?php echo $condominio['condominio_email'] ?>" class="form-control" id="email" name="email" placeholder="Informe o e-mail">
                                                        
                                                    </div>
                                                </div>  
												  
												  <hr>
												  <h5>Endereço:</h5>
												    <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Cep:</label>
                                                        <input name="cep" type="text" value="<?php echo $condominio['condominio_cep'] ?>" class="form-control cep" id="cep" placeholder="Informe o cep">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Rua:</label>
                                                        <input type="text" value="<?php echo $condominio['condominio_rua'] ?>" class="form-control" id="rua" name="rua" placeholder="Nome da rua">
                                                        
                                                    </div>
                                                </div>  
												   
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nº:</label>
                                                        <input type="text" value="<?php echo $condominio['condominio_numero'] ?>" class="form-control" id="numero" name="numero" placeholder="Numero">
                                                        
                                                    </div>
                                                </div>  
												  
												    <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Complemento:</label>
                                                        <input type="text" value="<?php echo $condominio['condominio_complemento'] ?>" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Bairro:</label>
                                                        <input type="text" value="<?php echo $condominio['condominio_bairro'] ?>" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                                                        
                                                    </div>
                                                </div>  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Cidade:</label>
                                                        <input type="text" readonly=true value="<?php echo $condominio['condominio_cidade'] ?>" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
                                                        
                                                    </div>
                                                </div>  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Estado:</label>
                                                        <input name="uf" type="text" readonly=true value="<?php echo $condominio['condominio_uf'] ?>" class="form-control" id="uf" placeholder="Estado" maxlength="2">
                                                        
                                                    </div>
                                                </div>  
												  
												  <hr>
												  <h5>Informações Adicionais</h5>
												  
												  
												  <div class="col-md-12">
                                                    <div class="mb-3">
                                                      <textarea  id="classic-editor"	 name="informacoes"> <?php echo $condominio['condominio_informacoes']?></textarea>
                                                        
                                                    </div>
                                                </div>  
                                                <input type="hidden" value="<?php echo $id ?>" name="id" id="textfield">
												     </div>
												 <div align="right"> <button class="btn btn-primary" id="enviar" type="submit">Alterar</button> </div>
										 </form>

										 
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
					
					
