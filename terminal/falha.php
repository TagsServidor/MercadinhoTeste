<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'] ;
$condominio = $_SESSION['condominio'] ;
$cpf = $_SESSION['cpf'] ;
$id_cliente = $_SESSION['id_cliente'] ;
$cliente_nome = $_SESSION['cliente_nome'] ;

include "bd/conexao.php";
include "head.php";
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


    
 @$conn->query("update p_apagar set tentou_pagar	= '0',  retorno	= '', tentativas = 7    where id_apagar ='$_GET[id]' ");
 
 // Verificando se a venda foi cancelada
$sqlc = "SELECT * FROM p_apagar where registro_apagar = $session   ";
$resultadoc = mysqli_query($conn, $sqlc);
$linhae=mysqli_fetch_array($resultadoc);

?>

<div class="container-fluid">
           
    <div class="row">
           
        <div class="col-xl-12 col-lg-12 col-md-12 bg-color-10">
                    
                <div class="text-center mb-5">
                    <img src="assets/img/logo.png" alt="logo" class="">
                </div>
                <!-- <div class="text-center mt-5 mb-5"><i class="fa fa-ban erro"></i></div> -->
                <div class="text-center mb-5">
					 <h1 class="text-white">Desculpe... </h1>
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