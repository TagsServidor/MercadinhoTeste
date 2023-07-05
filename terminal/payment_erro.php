<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;

$registro_apagar = rtrim($session);

include "bd/conexao.php";


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
	
?>
<?php if (($_GET['erro'] =='-2001') and ($_GET['tipo'] =='1')) { ?>
<script>
window.location.href = "payment_cart_credit.php?id=<?php echo $_GET['id'] ?>&retentar=1";
</script>

<?php exit; } ?>
    
<?php if (($_GET['erro'] =='-2001') and ($_GET['tipo'] =='2')) { ?>
<script>
window.location.href = "payment_cart_debit.php?id=<?php echo $_GET['id'] ?>&retentar=1";
</script>

<?php exit; } ?>

<?php include "head.php";?>
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
					 <h1 class="text-white">Desculpe... </h1>
                    <h1 class="text-white">Houve uma falha em seu pagamento!</h1>
                </div>
                        
                <!-- <div class="text-center mt-5 mb-5">
                    <h3 class="text-white">Seu pagamento não foi confirmado. <br/>
                    <?//php// echo $cliente_nome ?><br/><br/>
                     Deseja tentar novamente? Ou cancelar? </h3> 
                </div> -->

                <div class="row justify-content-center">
               <div class="col-md-3 text-center">
				   
				   
                    <a href="sacola.php?session=<?php echo $registro_apagar ?>">
                            <button type="submit" class=" btn text-white btn-success btn-lg btn-theme ">
                                <i class="fa fa-retweet"></i> Tentar novamente
                            </button>
                        </a>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="index.php?unidade=<?php echo $unidade ?>">
                            <button type="submit" class=" btn text-white btn-danger btn-lg btn-theme ">
                                <i class="fa fa-ban"></i> Cancelar Pedido
                            </button>
                        </a>
                    </div>
                    
                </div>
                

                
                
                
            </div>
        </div>
    </div>
</div>
<?php include 'modais.php';?>	
<script src="assets/js/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="assets/js/popper.min.js" crossorigin="anonymous"></script>
  <script src="assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <
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