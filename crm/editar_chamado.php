<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

$sql = "SELECT * FROM chamados WHERE id_chamado = '$id'";
$resultado = mysqli_query($conn, $sql);
$chamado = mysqli_fetch_assoc($resultado);

?><br><br><br><br><br><br><br>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar Chamado</h4>

                    <form id="formcentral" action="atualizar_registro_chamado/<?php echo($id) ?>" method="post">

                        <div class="row">


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Titulo do Chamado:</label>
                                    <input name="titulo" type="text" required class="form-control" id="titulo" placeholder="Informe o título do chamado" value="<?php echo($chamado['titulo_chamado']) ?>">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Data do chamado:</label> 
                                    <input type="date" class="form-control phone_with_ddd2" id="data" name="data" placeholder="Informe a data do chamado" value="<?php echo($chamado['data_chamado']) ?>">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status do chamado:</label>
                                    <select class="form-control form-select" name="status">
                                        <option value="" disabled>Informe o status do chamado</option>
                                        <option value="Aberto">Aberto</option>
                                        <option value="Em análise">Em análise</option>
                                        <option value="Em execução">Em execução</option>
                                        <option value="Cancelado">Cancelado</option>
                                        <option value="Concluido">Concluido</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Texto do Chamado:</label>
                                    <textarea name="texto" type="text" class="form-control cnpj" id="texto"><?php echo($chamado['texto_chamado']) ?></textarea>
                                </div>
                            </div>

                            <div align="right"> <button class="btn btn-primary" id="enviar" type="submit">Atualizar</button> </div>
                    </form>