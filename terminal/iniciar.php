<?php
include "bd/conexao.php";

function formata_cpf_cnpj($cpf_cnpj){
   

    ## Retirando tudo que não for número.
    $cpf_cnpj = preg_replace("/[^0-9]/", "", $cpf_cnpj);
    $tipo_dado = NULL;
    if(strlen($cpf_cnpj)==11){
        $tipo_dado = "cpf";
    }
    if(strlen($cpf_cnpj)==14){
        $tipo_dado = "cnpj";
    }
    switch($tipo_dado){
        default:
            $cpf_cnpj_formatado = "Não foi possível definir tipo de dado";
        break;

        case "cpf":
            $bloco_1 = substr($cpf_cnpj,0,3);
            $bloco_2 = substr($cpf_cnpj,3,3);
            $bloco_3 = substr($cpf_cnpj,6,3);
            $dig_verificador = substr($cpf_cnpj,-2);
            $cpf_cnpj_formatado = $bloco_1.".".$bloco_2.".".$bloco_3."-".$dig_verificador;
        break;

        
    }
    return $cpf_cnpj_formatado;
}

$cpf = "$_POST[cpf]";

$cpfv = formata_cpf_cnpj($cpf);



/// validar cpf

$valor1 = $cpfv;
$valor = preg_replace('/[^0-9]/', '', $valor1);

function validaCPF($cpf)
{	// Verifiva se o nÃºmero digitado contÃ©m todos os digitos
    $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	
	// Verifica se nenhuma das sequÃªncias abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
	{
	return false;
    }
	else
	{   // Calcula os nÃºmeros para verificar se o CPF Ã© verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
           $d += $cpf[$c] * (($t + 1) - $c);

            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$c] != $d) {

                return false;
            }
        }

        return true;
    }
}
// Verifica se o botÃ£o de validaÃ§Ã£o foi acionado
	$cpf_enviado = validaCPF($valor);
	// Verifica a resposta da funÃ§Ã£o e exibe na tela
	if($cpf_enviado == true) {
	


/// CONECTANDO AO CLIENTE

$sqlcl = "SELECT * FROM clientes  where cliente_cpf = '$cpfv' and cliente_status ='1' ";
$resultadocl = mysqli_query($conn, $sqlcl);
$totalcl = mysqli_num_rows($resultadocl);	
$linhacl = mysqli_fetch_array($resultadocl);
		
		
if ($totalcl =='0')	{
	
$conn->query($insert = "INSERT INTO clientes (cliente_cpf, cliente_unidade,clientes_date,terminal) VALUES ('$_POST[cpf]','$_POST[unidade]','$data1','sim')");
$ultimo_id = $conn->insert_id;

$sqlcl = "SELECT * FROM clientes  where id_cliente = $ultimo_id ";
$resultadocl = mysqli_query($conn, $sqlcl);
$totalcl = mysqli_num_rows($resultadocl);	
$linhacl = mysqli_fetch_array($resultadocl);
			
	
}

	
		
@session_start();
// criar um indice pai pra essa sessão:
$_SESSION['cadastro'] = null;
$_SESSION['registro'] = rtrim($_POST['registro']);
$_SESSION['unidade'] = $_POST['unidade'];
$_SESSION['condominio'] = $_POST['condominio'];
$_SESSION['cpf'] = $linhacl['cliente_cpf'];
$_SESSION['id_cliente'] = $linhacl['id_cliente'];
$_SESSION['cliente_nome'] = $linhacl['cliente_nome'];

		
header("Location:inicio.php?id=$totalcl");
die();
	} elseif($cpf_enviado == false)
		
?>
<script>
    

     window.history.go(-1);

</script> 
