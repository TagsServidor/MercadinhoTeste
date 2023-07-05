<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}

include "bd/conexao.php";

$sqlos = "SELECT * FROM unidades WHERE id_unidade = '$_POST[id]' ";
$resultadoos = mysqli_query($conn, $sqlos);
$totalos = mysqli_num_rows($resultadoos);	
$unidade = mysqli_fetch_array($resultadoos);

?>
<script src="assets/js/jquery.js"></script>
 <script src="assets/js/form_unidades2.js"></script>
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
                                    <h4 class="mb-0">Unidades (Pontos de Vendas)</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                        <a href="listar_unidades"><button class="btn btn-info"> Voltar </button></a>   
											
											
											<form action="deletar_unidade" method="post"> 
												<input type="hidden" value="<?php echo $unidade['id_unidade'] ?>" name="id">
											<button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar essa unidade?')"> Remover Unidade </button>
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
                                        <h4 class="card-title">Editar Unidade</h4>
                                       
                                        <form id="formunidades" action="#" method="post">
											
											  <div class="row">
												  
												  
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nome da Unidade:</label>
                                                        <input name="nome" type="text" value="<?php echo $unidade['unidade_nome'] ?>"  required class="form-control" id="nome" placeholder="Informe o nome da Unidade">
                                                        
                                                    </div>
                                                </div>
												  
												   
										<div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Condomínio:</label>
                                                       	
<?php // listando em um box os instrutores

			  echo "<SELECT NAME='condominio' SIZE='1' class='form-control' required>

<OPTION VALUE='' SELECTED> Informe ";
// Selecionando os dados da tabela em ordem decrescente
$sql2 = "SELECT * FROM condominios where condominio_status ='1'  ORDER BY condominio_nome";
// Executando $sql e verificando se tudo ocorreu certo.
$resultado2 = mysqli_query($conn, $sql2);
//Realizando um loop para exibi&ccedil;&atilde;o de todos os dados 
while ($linha2=mysqli_fetch_array($resultado2)) {
echo "<OPTION VALUE='".$linha2['id_condominio']."' ";

if ($unidade['unidade_condominio'] == $linha2['id_condominio']) {

echo "SELECTED";

}

echo ">".$linha2['condominio_nome'];

}

?>
														</select>                                                
                                                    </div>
                                                </div>		   
												  
												  
												  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">CNPJ:</label>
            <input name="cnpj" type="text" value="<?php echo $unidade['unidade_cnpj'] ?>" class="form-control cnpj"  id="cnpj"/>

                                                        
                                                    </div>
                                                </div>
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Telefone fixo:</label>
                                                        <input type="text" value="<?php echo $unidade['unidade_telefone'] ?>" class="form-control phone_with_ddd2" id="telefone"  name="telefone" placeholder="Informe telefone fixo">
                                                        
                                                    </div>
                                                </div>
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Telefone celular:</label>
                                                        <input type="text" value="<?php echo $unidade['unidade_celular'] ?>" class="form-control phone_with_ddd" id="celular" name="celular"  placeholder="Informe telefone celular">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">E-mail:</label>
                                                        <input type="email" value="<?php echo $unidade['unidade_email'] ?>" class="form-control" id="email" name="email" placeholder="Informe o e-mail">
                                                        
                                                    </div>
                                                </div>  
												  
												  <hr>
												  <h5>Endereço:</h5>
												    <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Cep:</label>
                                                        <input name="cep" type="text" value="<?php echo $unidade['unidade_cep'] ?>" class="form-control cep" id="cep" placeholder="Informe o cep">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Rua:</label>
                                                        <input type="text" value="<?php echo $unidade['unidade_rua'] ?>" class="form-control" id="rua" name="rua" placeholder="Nome da rua">
                                                        
                                                    </div>
                                                </div>  
												   
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Nº:</label>
                                                        <input type="text" value="<?php echo $unidade['unidade_numero'] ?>"class="form-control" id="numero" name="numero" placeholder="Numero">
                                                        
                                                    </div>
                                                </div>  
												  
												    <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Complemento:</label>
                                                        <input type="text" value="<?php echo $unidade['unidade_complemento'] ?>" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
                                                        
                                                    </div>
                                                </div>  
												  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Bairro:</label>
                                                        <input type="text" value="<?php echo $unidade['unidade_bairro'] ?>" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                                                        
                                                    </div>
                                                </div>  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="validationCustom01">Cidade:</label>
                                                        <input type="text" value="<?php echo $unidade['unidade_cidade'] ?>" readonly=true class="form-control" id="cidade" name="cidade" placeholder="Cidade">
                                                        
                                                    </div>
                                                </div>  
												  
												   <div class="col-md-6">
                                                    <div class="mb-3">
                                                      <label class="form-label" for="validationCustom01">Estado:</label>
                                                        <input name="uf" type="text" value="<?php echo $unidade['unidade_uf'] ?>" readonly=true class="form-control" id="uf" placeholder="Estado" maxlength="2">
                                                        
                                                    </div>
                                                </div>  
												  
												  <hr>
												  <h5>Informações Adicionais</h5>
												  
												  
												  <div class="col-md-12">
                                                    <div class="mb-3">
                                                    <textarea  id="classic-editor"	 name="informacoes"> <?php echo $unidade['unidade_informacoes']?></textarea>
                                                        
                                                    </div>
                                                </div>  
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
					
					
