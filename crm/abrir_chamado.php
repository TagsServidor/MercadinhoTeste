<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>

<BR>
    <BR><BR>
    <BR><BR><BR><BR><BR>
    
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Abrir Novo Chamado</h4>

                    <form id="formcentral" action="inserir_abrir_chamado" method="post">

                        <div class="row">


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Titulo do Chamado:</label>
                                    <input name="titulo" type="text" required class="form-control" id="titulo" placeholder="Informe o título do chamado">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Data do chamado:</label>
                                    <input type="date" class="form-control phone_with_ddd2" id="data" name="data" placeholder="Informe a data do chamado">

                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Informe o e-mail">
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
                                    <textarea name="texto" type="text" class="form-control cnpj" id="texto"></textarea>
                                </div>
                            </div>

                            <div align="right"> <button class="btn btn-primary" id="enviar" type="submit">Cadastrar</button> </div>
                    </form>