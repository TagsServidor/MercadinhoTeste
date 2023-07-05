
<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
?>

<script src="assets/js/jquery.js"></script>
 <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>



 <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<!-- Deixando Botão Transparente -->
<style>

.button {     
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;        
}

</style>


<?php 

 $upass = strip_tags($_POST['senha']);
$hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version

/// INSERINDO DADOS NO BANCO DE DADOS

	 @$conn->query($insert = "INSERT INTO adm (nome, senha, email, login, repositor, gerenciavel, situacao) VALUES ('$_POST[nome]','$hashed_password','$_POST[email]','$_POST[login]','$_POST[repositor]','$_POST[gerenciavel]','on')");


?>

<button type="button" class="button"   id="sa-gerenciavel"></button>

  <!-- Sweet Alerts js -->
  <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

   <!-- Sweet alert init js-->
   <script src="assets/js/pages/sweet-alerts.init.js"></script>


   <!-- Executando Botao Automatico -->
<script>

function click(id)
{
    var element = document.getElementById(id);
    if(element.click)
        element.click();
    else if(document.createEvent)
    {
        var eventObj = document.createEvent('MouseEvents');
        eventObj.initEvent('click',true,true);
        element.dispatchEvent(eventObj);
    }
}

click('sa-gerenciavel');

</script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
					
					
	
	<script src="assets/js/jquery.mask.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/examples.js"></script>					

	<script src="assets/js/pages/form-validation.init.js"></script>