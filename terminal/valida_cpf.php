<?php

$valor1 = $_POST['cpf'];

echo $valor = preg_replace('/[^0-9]/', '', $valor1);
  

	
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
	if($cpf_enviado == true)
		echo "CPF VERDADEIRO";
	elseif($cpf_enviado == false)
		echo "CPF FALSO";
	
?>