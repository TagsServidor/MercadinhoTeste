<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;

include "bd/conexao.php";

$registro_apagar = rtrim($_POST['registro']);


/// CONECTANDO AO CONDOMINIO

$sqlc = "SELECT * FROM condominios c where c.id_condominio = '$condominio' and c.condominio_status ='1' ";
$resultadoc = mysqli_query($conn, $sqlc);
$totalc = mysqli_num_rows($resultadoc);	
$linhac = mysqli_fetch_array($resultadoc);
 
/// CONECTANDO A UNIDADE

$sqlu = "SELECT * FROM unidades  where id_unidade = '$unidade' and unidade_status ='1' ";
$resultadou = mysqli_query($conn, $sqlu);
$totalu = mysqli_num_rows($resultadou);	
$linhau = mysqli_fetch_array($resultadou);


if ($_GET['retentar'] =='1') {
    
 @$conn->query("update p_apagar set tentou_pagar	= '0',  retorno	= '', tentativas = tentativas + 1    where id_apagar ='$_GET[id]' ");
 
 // Verificando se a venda foi cancelada
$sqlc = "SELECT * FROM p_apagar where registro_apagar = $session   ";
$resultadoc = mysqli_query($conn, $sqlc);
$linhae=mysqli_fetch_array($resultadoc);
 
	
} else {
//// INSERINDO PEDIDO A PAGAR


$sqlvr = "SELECT * FROM p_apagar where registro_apagar = $_POST[registro] and tentou_pagar	= '0'  ";
$resultadovr = mysqli_query($conn, $sqlvr);
$totalvr = mysqli_num_rows($resultadovr);

if ($totalvr =='0') { 


$conn->query($insert = "INSERT INTO p_apagar (registro_apagar, cliente_apagar, data_apagar, id_terminal, valor, metodo_pagamento, hora_apagar ) VALUES ('$registro_apagar','$id_cliente','$data1','$_POST[terminal]','$_POST[valor]','1','$hora2')");
$ultimo_id = $conn->insert_id;				
}}		
?>

	<?php if ($linhae['tentativas'] >'6') { 
	
	@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;


include "bd/conexao.php";
	
	?>        
          
        
          
          
          
        <?php /// cancelando a venda por falhas de comunicacao
        
 @$conn->query("update p_apagar set tentou_pagar	= '1',  retorno	= '' , tentativas = 7     where id_apagar ='$_GET[id]' ");
        
        include "head.php";?>
<!-- 	
<div class="page_loader"></div>

	 -->

<!-- Login 4 start -->

<div class="container-fluid">
           
    <div class="row">
           
        <div class="col-xl-12 col-lg-12 col-md-12 bg-color-10">
                    
                <div class="text-center mb-5">
                    <img src="assets/img/logo.png" alt="logo" class="">
                </div>
                <!-- <div class="text-center mt-5 mb-5"><i class="fa fa-ban erro"></i></div> -->
                <div class="text-center mb-5">
					 <h1 class="text-white">Desculpe.</h1>
                    <h1 class="text-white">Não foi possível realizar a conexão com a máquina de pagamento. <br> Iremos reiniciar o terminal para nova tentativa, é rapidinho!</h1>
                </div>
                        
                <!-- <div class="text-center mt-5 mb-5">
                    <h3 class="text-white">Seu pagamento n達o foi confirmado. <br/>
                    <?//php// echo $cliente_nome ?><br/><br/>
                     Deseja tentar novamente? Ou cancelar? </h3> 
                </div> -->

                <div class="row justify-content-center">
               <div class="col-md-3 text-center">
				   
				   
                    
                    </div>
                    <div class="col-md-3 text-center">
                        
                    </div>
                    
                </div>
                

                
                
                
            </div>
        </div>
    </div>
</div>
<?php include 'modais.php';?>	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  

<script type="text/javascript">   
    
   
    setTimeout('Redirect()', 9000);  
    
    function OpenBootstrapPopup() {
      $("#modalOffline").modal({
        show : true,
        focus : true
      });
  }

  function CloseModal() {
      $("#modalOffline").modal('hide');
  }
  function Redirect() 
    {  
        window.location="index.php?unidade=<?php echo $unidade ?>"; 
    } 
</script>

</body>
</html>
</body>
</html>  
          
          
          
          
          
          
           <?php exit; } ?>

 


<form id="formcentral" name="a" action="#" method="post">
    <input type="submit" class="btn" name="tetete" id="clickButton">
	<input name="valor" type="hidden" value="<?php echo $_POST['valor'] ?><?php echo $linhae['valor'] ?>">
	<input name="registro" type="hidden" value="<?php echo $session ?>">
	<input name="pagamento" type="hidden" value="Cartão de Credito">
	<input name="unidade" type="hidden" value="<?php echo $unidade ?>">


		  
	<?php
		// MONTANDO BASE PARA BAIXA DE ESTOQUE
	
$x=0;
$sqlos2 = "SELECT * FROM carrinho where  session_carrinho = '$session'  group by produto_carrinho  ";
$resultadoos2 = mysqli_query($conn, $sqlos2);
$totalcar2 = mysqli_num_rows($resultadoos2);	
while($produto = mysqli_fetch_array($resultadoos2)){
$x++;
?>
	
	<input name="produto[]" type="hidden" id="produto[<?php echo $x  ?>]" value="<?php echo $produto['produto_carrinho'] ?>" />
	<input name="qtd[]" type="hidden" id="qtd[<?php echo $x  ?>]" value="<?php echo $produto['qtd_carrinho'] ?>" />

	<?php } ?>
	
	
	
</form>
	<div id="results"></div>
		
  <?php include "head.php";?>



<!-- Login 4 start -->
   
    <div class="container-fluid">
           
        <div class="row">
        
            
            <div class="col-xl-12 col-lg-12 col-md-12 bg-color-8">
            <div class="alert alert-danger text-center" id="myAlert" role="alert">
                <p><i class="fa fa-exclamation-triangle "></i>Ops!<br/> O tempo para efetuar o pagamento acabou! <br/> A compra será cancelada.</p>
            </div>
					
					<div class="text-center mb-5">
                        <img src="assets/img/logo.png" alt="logo" class="">
                    </div>
					
                  <div class="text-center">
                    <div class="row justify-content-md-center">
                        <div class="col-md-4 mb-5">
                            <h4 class="text-white ">Pagamento Cartão de Crédito </h4>
                        </div>
                    </div>
                   
                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                                <h5 class="text-white">Aguardando o Pagamento</h5>
                                <!-- Cronometro -->
                                <h2 id="timer" class="text-center mb-0 bg-danger"></h2>
                                
                                <!-- Fim cronometro -->
                         </div>
                        
                    </div>
                  
                       
                    <div class="text-center mt-5 mb-5">
                        <h2 class="text-white"><?php echo $cliente_nome ?><br/><?php if ($_GET['retentar'] =='1') { ?>
                        
                        
                        <Style>
                            
                            .loading span {
  display: inline-block;
  vertical-align: middle;
  width: .6em;
  height: .6em;
  margin: .19em;
  background: #fff;
  border-radius: .6em;
  animation: loading 1s infinite alternate;
}

/*
 * Dots Colors
 * Smarter targeting vs nth-of-type?
 */
.loading span:nth-of-type(2) {
  background: #fff;
  animation-delay: 0.2s;
}
.loading span:nth-of-type(3) {
  background: #fff;
  animation-delay: 0.4s;
}
.loading span:nth-of-type(4) {
  background: #fff;
  animation-delay: 0.6s;
}
.loading span:nth-of-type(5) {
  background: #fff;
  animation-delay: 0.8s;
}
.loading span:nth-of-type(6) {
  background: #fff;
  animation-delay: 1.0s;
}
.loading span:nth-of-type(7) {
  background: #fff;
  animation-delay: 1.2s;
}

/*
 * Animation keyframes
 * Use transition opacity instead of keyframes?
 */
@keyframes loading {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
</Style>
                        
  Reconectando <br> Tentativa <?php echo $linhae['tentativas'] ?> / 6 <br><div class="loading">
  
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</div>

<?php } ?>Confira o valor da compra na máquina de cartão ao lado e realize o pagamento!</h2> 
                  </div>

                    <!-- <a href="localizar_produto.php">
                        <button type="submit" class=" btn text-white btn-danger btn-lg btn-theme ">
                            <i class="fa fa-ban"></i> Cancelar Pedido
                        </button>
                    </a>-->
                  
                </div>
            </div>
        </div>
    </div>
<?php //echo $_POST['terminal'] ?>
</div>
<?php include 'modais.php';?>		
<!-- Custom JS Script -->

<script src="assets/js/jquery-1-1.min.js"></script>
<script src="assets/js/jquery-2.2.4.js" ></script>
<script>
  $(document).ready(function() {
	 $("#formcentral").submit(function(){
		 var dados =jQuery( this ).serialize();
		$.ajax({
			url: 'confirm_pag.php',
			cache: false,
			data: dados,
			type: "POST",  

			success: function(msg){
				
				$("#results").empty();
				$("#results").append(msg);
				
			}
			
		});
		 
		 return false;
	 });
 
 });
	
	window.onload = function(){
    var button = document.getElementById('clickButton');
    setInterval(function(){
        button.click();
    },4000);  // this will make it click again every 1000 miliseconds
};
	

  jQuery(window).load(function() {
    $(".loader").delay(1500).fadeOut("slow"); //retire o delay quando for copiar!
    $("#tudo_page").toggle("fast");
  });

// Tempo em segundos
var tempo = 90;
  $('#myAlert').hide();

function countdown() {

    // Se o tempo não for zerado
    if ((tempo - 1) >= -1) {

        // Pega a parte inteira dos minutos
        var min = parseInt(tempo / 60);
        // Calcula os segundos restantes
        var seg = tempo % 60;

        // Formata o número menor que dez, ex: 08, 07, ...
        if (min < 10) {
            min = "0" + min;
            min = min.substr(0, 2);
        }
        if (seg <= 9) {
            seg = "0" + seg;
        }

        // Cria a variável para formatar no estilo hora/cronômetro
        horaImprimivel = '00:' + min + ':' + seg;
        //JQuery pra setar o valor
        $("#timer").html(horaImprimivel);

        // Define que a função será executada novamente em 1000ms = 1 segundo
        setTimeout('countdown()', 2000);

        // diminui o tempo
        tempo--;

        // Quando o contador chegar a zero faz esta ação
    } 
    else {
        $('#myAlert').show().fadeOut(9000);
        setTimeout('Redirect()', 9000);
        
    }

}

// Chama a função ao carregar a tela
countdown();  
    
function Redirect() 
    {  
      window.location="index.php?unidade=<?php echo $unidade ?>&id=<?php echo $ultimo_id ?>";     }   
    


    function OpenBootstrapPopup() {
      $("#modalOffline").modal({
        show : true,
        focus : true
      });
  }

  function CloseModal() {
      $("#modalOffline").modal('hide');
  }
</script>

</body>
</html>



