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

<?php include "head.php";?>
<!-- 	
<div class="page_loader"></div>

	 -->

<!-- Login 4 start -->

<div class="container-fluid">
           
    <div class="row">
           
        <div class="col-xl-12 col-lg-12 col-md-12 bg-color-9">
                    
                <div class="text-center mb-5">
                    <img src="assets/img/logo.png" alt="logo" class="">
                </div>
                
                <div class="text-center mb-5">
                <h1 class="text-white">Pagamento Confirmado</h1>
                
                        
                <div class="text-center mt-5 mb-5">
                    <h3 class="text-white">Muito obrigado <?php 
$primeiroNome = explode(" ", $cliente_nome);
echo ', '. current($primeiroNome); ?>!</h3> 
                </div>

                <div class="text-center mt-5 mb-5"><i class="fa fa-check-circle-o ok"></i></div>
                
                
            </div>
        </div>
    </div>
</div>
	
<?php include 'modais.php';?>	
<script type="text/javascript">   
    function Redirect() 
    {  
        window.location="index.php?unidade=<?php echo $unidade ?>"; 
    } 
   
    setTimeout('Redirect()', 5000);   

    // };
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