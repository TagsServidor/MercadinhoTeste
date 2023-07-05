<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

$sql = "SELECT * FROM clientes WHERE id_cliente = '$id'";
$resultado = mysqli_query($conn, $sql);
$chamado = mysqli_fetch_assoc($resultado);

?><br><br><br><br><br><br><br>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar Cliente</h4>

                    <form id="formcentral" action="atualizar_cliente_senha/<?php echo($id) ?>" method="post">

                        <div class="row">


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nome do Chamado:</label>
                                    <input name="titulo" type="text" required class="form-control" id="titulo" disabled="" value="<?php echo($chamado['cliente_nome']) ?>">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cliente CPF:</label> 
                                    <input type="text" class="form-control phone_with_ddd2" id="data" disabled="" name="data"  value="<?php echo($chamado['cliente_cpf']) ?>">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cliente E-mail:</label>
<input type="text" class="form-control"   name="email"  value="<?php echo($chamado['cliente_email']) ?>">

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cliente Telefone:</label>
<input type="text" class="form-control"   name="telefone"  value="<?php echo($chamado['cliente_telefone']) ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cliente Senha:</label>
<input type="text" class="form-control"  placeholder="Deixe em branco para nao alterar" name="senha"  ">
                                </div>
                            </div>  
                            
                            
                            
                            
                            
                            

                            <div align="right"> <button class="btn btn-primary" id="enviar" type="submit">Atualizar</button> </div>
                    </form>