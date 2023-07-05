<?php
@session_start();
$session = $_SESSION['registro'];
$unidade = $_SESSION['unidade'];
$condominio = $_SESSION['condominio'];
$cpf = $_SESSION['cpf'];
$id_cliente = $_SESSION['id_cliente'];
$cliente_nome = $_SESSION['cliente_nome'];

$registro_apagar = rtrim($session);

include "bd/conexao.php";




/// CONECTANDO A UNIDADE

$sqlu = "SELECT * FROM unidades  where id_unidade = '$unidade' and unidade_status ='1' ";
$resultadou = mysqli_query($conn, $sqlu);
$totalu = mysqli_num_rows($resultadou);
$linhau = mysqli_fetch_array($resultadou);



//// INSERINDO PEDIDO A PAGAR
$conn->query($insert = "INSERT INTO p_apagar_pix (registro_apagar, cliente_apagar, data_apagar, id_terminal, valor, metodo_pagamento ) VALUES ('$registro_apagar','$id_cliente','$data1','$_POST[terminal]','$_POST[valor]','p')");
$ultimo_id = $conn->insert_id;


$url =     "https://mercadinho.top/terminal/retornopix.php?pedido=$registro_apagar";

$url2 = substr($url, 0, -2);

$store_redirection = $url;
$store_redirection = json_encode($store_redirection);


?>

<form id="formcentral" name="a" action="#" method="post">



    <input type="submit" class="btn" name="tetete" id="clickButton" name="send">

    <input name="valor" type="hidden" value="<?php echo $_POST['valor'] ?><?php echo $linhae['valor'] ?>">
    <input name="registro" type="hidden" value="<?php echo $registro_apagar ?>">
    <input name="pagamento" type="hidden" value="Cartão de Debito">



    <input name="unidade" type="hidden" value="<?php echo $unidade ?>">



    <?php
    // MONTANDO BASE PARA BAIXA DE ESTOQUE

    $x = 0;
    $sqlos2 = "SELECT * FROM carrinho where  session_carrinho = '$registro_apagar'  group by produto_carrinho  ";
    $resultadoos2 = mysqli_query($conn, $sqlos2);
    $totalcar2 = mysqli_num_rows($resultadoos2);
    while ($produto = mysqli_fetch_array($resultadoos2)) {
        $x++;
    ?>

        <input name="produto[]" type="hidden" id="produto[<?php echo $x  ?>]" value="<?php echo $produto['produto_carrinho'] ?>" />
        <input name="qtd[]" type="hidden" id="qtd[<?php echo $x  ?>]" value="<?php echo $produto['qtd_carrinho'] ?>" />

    <?php } ?>



</form>
<?php include "head.php"; ?>
<div id="results"></div>

    <!-- Login 4 start -->
    <div class="container-fluid">

        <div class="row">


            <div class="col-xl-12 col-lg-12 col-md-12 bg-color-8">

                <div class="alert alert-danger text-center" id="myAlert" role="alert">
                    <p><i class="fa fa-exclamation-triangle "></i>Ops!<br /> O tempo para efetuar o pagamento acabou! <br /> A compra será cancelada.</p>
                </div>
                <div class="text-center mb-5">
                    <img src="assets/img/logo.png" alt="logo" class="">
                </div>

                <div class="text-center mb-5">
                    <div class="row justify-content-md-center">
                        <div class="col-md-4 mb-3">
                            <h4 class="text-white ">Pagamento por PIX </h4>
                        </div>

                        <?php


                        // ************************************** dados da transação
                        $id_venda                    = $registro_apagar;
                        $valor_da_compra             = $_POST['valor'];
                        $valor_da_compra_em_centavos = floatval($valor_da_compra * 100); // O valor da compra que deve entrar na aplicação e sempre em centavos

                        // ************************************** dados do cliente

                        if ($cliente_nome == '') {
                            $cliente_nome     = 'Não informado';
                        } else {
                            $cliente_nome     = $cliente_nome;
                        }

                        $cliente_email    = "vendas@mercadinho.top";
                        $cliente_cpf      = $cpf;
                        $cliente_cpf      = preg_replace('/[^0-9]/', '', $cliente_cpf); // apenas trata os dados do cpf e ajusta para o curl

                        $cliente_endereco = $linhau['unidade_rua'];
                        $cliente_numero   = $linhau['unidade_numero'];
                        $cliente_complem  = "sem";
                        $cliente_bairro   = $linhau['unidade_bairro'];
                        $cliente_cidade   = $linhau['unidade_cidade'];
                        $cliente_estado   = $linhau['unidade_uf'];
                        $cliente_cep      = $linhau['unidade_cep'];
                        $cliente_cep      = preg_replace('/[^0-9]/', '', $cliente_cep); // apenas trata os dados do cpf e ajusta para o curl

                        // ************************************************ dados sandbox
                        $token_sbox = "7A1F6D12542541BAAEDF9A2817D00305"; // Meu sandbox. Troque pelo seu.
                        $token_prod = "328a5bff-fcbe-4b59-8622-5c9830cf3ae096ace7ff485d915840ff8999e263ddfa1cd0-37d2-475c-8741-0089886b79e7";

                        // ************************************************ dados produção
                        $url_sbox   = "https://sandbox.api.pagseguro.com/orders";
                        $url_prod   = "https://api.pagseguro.com/orders";






                        $access_token = $token_prod; // troque para token_sbox ou token_prod (Sandbox ou Produção)
                        $api_url      = $url_prod;   // troque para url_sbox ou url_prod (Sandbox ou Produção)
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $api_url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{
    "reference_id": ' . $id_venda . ',
    "customer": {
        "name": ' . json_encode($cliente_nome) . ',
        "email": ' . json_encode($cliente_email) . ',
        "tax_id": ' . json_encode($cliente_cpf) . '
    },
    "items": [
        {
            "name": "nome do item",
            "quantity": 2,
            "unit_amount": 500
        }
    ],
    "qr_codes": [
        {
            "amount": {
                "value": ' . $valor_da_compra_em_centavos . '
            }
        }
    ],
    "shipping": {
        "address": {
            "street": ' . json_encode($cliente_endereco) . ',
            "number": ' . json_encode($cliente_numero) . ',
            "complement": ' . json_encode($cliente_complem) . ',
            "locality": ' . json_encode($cliente_bairro) . ',
            "city": ' . json_encode($cliente_cidade) . ',
            "region_code": ' . json_encode($cliente_estado) . ',
            "country": "BRA",
            "postal_code": ' . json_encode($cliente_cep) . '
        }
    },
    "notification_urls": [
        ' . $store_redirection . '
    ]
}',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/json',
                                'Authorization: Bearer ' . $access_token
                            ),
                        ));

                        $response = curl_exec($curl);

                        curl_close($curl);
                        $obj = json_decode($response, true);
                        //print_r($obj);

                        if (!isset($obj["qr_codes"][0]["id"])) {
                            $error_msg = "Serviço indisponível. Tente novamente em alguns minutos.";

                            if (isset($obj["error_messages"])) {
                                $error_param = $obj["error_messages"][0]["parameter_name"];
                            }

                            switch ($error_param) {
                                case "customer.name":
                                    $error_code = "Informe um nome válido";
                                    break;

                                case "customer.tax_id":
                                    $error_code = "Informe um CPF ou CNPJ válido";
                                    break;

                                case "shipping.address.region_code":
                                    $error_code = "Informe a sigla de seu Estado";
                                    break;

                                case "shipping.address.postal_code":
                                    $error_code = "Informe um cep válido";
                                    break;
                            }
                            echo $error_code;
                        } else {
                            $qr_codes_reference_id    = $obj["reference_id"];
                            $qr_codes_id              = $obj["qr_codes"][0]["id"];
                            $qr_codes_expiration_date = $obj["qr_codes"][0]["expiration_date"];
                            $qr_codes_text            = $obj["qr_codes"][0]["text"];
                            $qr_img_src               = $obj["qr_codes"][0]["links"][0]["href"];

                        ?>



                            <h5 class="text-white">Leia o QRCode pelo seu aplicativo PIX</h5>
                            <img src="<?php echo $qr_img_src; ?>" style="width: 300px" class="mb-3">



                        <?php } // end erro qr_codes 
                        ?>
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
                        <h3 class="text-white">


                            <!-- <a href="localizar_produto.php">
                    <button type="submit" class=" btn text-white btn-danger btn-lg btn-theme ">
                        <i class="fa fa-ban"></i> Cancelar Pedido
                    </button>
                </a> -->



                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'modais.php'; ?>

    <!-- Custom JS Script -->
    <script src="assets/js/jquery-1-1.min.js"></script>
  <script src="assets/js/jquery-2.2.4.js"></script>
    <script type="text/javascript">
        function copyData(containerid) {
            var range = document.createRange();
            range.selectNode(copiar); //changed here
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
            $(".copiado").show();
            setTimeout(function() {
                $(".copiado").hide();
            }, 2000);

        }
    </script>
    <script>
        $(document).ready(function() {
            $("#formcentral").submit(function() {
                var dados = jQuery(this).serialize();
                $.ajax({
                    url: 'confirm_pag_pix.php',
                    cache: false,
                    data: dados,
                    type: "POST",

                    success: function(msg) {

                        $("#results").empty();
                        $("#results").append(msg);

                    }

                });

                return false;
            });

        });

        window.onload = function() {
            var button = document.getElementById('clickButton');
            setInterval(function() {
                button.click();
            }, 4000); // this will make it click again every 1000 miliseconds
        };


        // jQuery(window).load(function() {
        //     $(".loader").delay(1500).fadeOut("slow"); //retire o delay quando for copiar!
        //     $("#tudo_page").toggle("fast");
        // });

        // Tempo em segundos
        var tempo = 120;
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
                setTimeout('countdown()', 1000);

                // diminui o tempo
                tempo--;

                // Quando o contador chegar a zero faz esta ação
            } else {
                $('#myAlert').show().fadeOut(9000);
                setTimeout('Redirect()', 9000);

            }

        }

        // Chama a função ao carregar a tela
        countdown();

        function Redirect() {
            window.location = "index.php?unidade=<?php echo $unidade ?>";
        }

        function OpenBootstrapPopup() {
            $("#modalOffline").modal({
                show: true,
                focus: true
            });
        }

        function CloseModal() {
            $("#modalOffline").modal('hide');
        }
    </script>

    </body>

    </html>