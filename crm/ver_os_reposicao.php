<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/form_estoqueentrada.js"></script>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>


<!-- Select com Busca-->
<link href="assets/js/select2.min.css" rel="stylesheet" />
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/select2.min.js"></script>

<!-- Responsive Table css -->
<link href="assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">OS &gt; <?php echo $_POST['os'] ?></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                            </ol>
                        </div>

                    </div>
                </div>
            </div>


        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Relação de produtos</h4>


                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table">
                                        <thead>
                                            <tr>
												  <th>Item</th>
                                                <th>Produto</th>
                                                <th data-priority="1" class="text-center">Reposição</th>
                                                <th data-priority="1" class="text-center">QTD Minima</th>
                                                <th data-priority="1" class="text-center">QTD Maxima</th>
                                                <th data-priority="3">Lote</th>

                                                <th data-priority="3">Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <?php // LISTANDO OS EM ABERTO

                                                $sqlosp = "SELECT * FROM os_produtos o2 inner join produtos p on o2.os_produtos_produto = p.id_produto inner join produtos_departamentos pd on   p.produto_departamento = pd.id_departamentos  where o2.os_produtos_os  = '$_POST[os]' and o2.os_produtos_status ='1' order by pd.departamento_os_posicao , o2.os_produtos_qtd  ";
                                                $resultadoosp  = mysqli_query($conn, $sqlosp);
                                                $totalosp  = mysqli_num_rows($resultadoosp);

$x=0;
                                                while ($linhaos  = mysqli_fetch_array($resultadoosp)) {
$x++;
                                                ?>


                                                    <!-- Center Modal example -->
                                                    <div class="modal fade modaleditar<?php echo $linhaos['os_produtos_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">



                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Editar OS</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <a href="remover_entrada_os/<?php echo $linhaos['os_produtos_id'] ?>" link class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar essa entrada?')"> REMOVER ENTRADA </a>
                                                                </div>
                                                                </form>
                                                            </div>



                                                        </div>
                                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->


                            <script>
                                var i = setInterval(function() {
                                    clearInterval(i);


                                    document.getElementById("loading<?php echo $linhaos['os_produtos_id'] ?>").style.display = "none";
                                    document.getElementById("content<?php echo $linhaos['os_produtos_id'] ?>").style.display = "block";

                                }, 2000);
                            </script>
 <th><?php echo $x ?></th>
                            <th><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['os_produtos_id'] ?>"><?php echo $linhaos['produto_nome'] ?> <span class="co-name"></a> </span></th>
                            <td class="bg-info text-center "><a class="text-white font-weight-bold" href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['os_produtos_id'] ?>"><?php echo $linhaos['os_produtos_qtd'] ?> </a></td>
                            <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['os_produtos_id'] ?>"><?php echo $linhaos['os_produtos_minima'] ?> </a></td>
                            <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['os_produtos_id'] ?>"><?php echo $linhaos['os_produtos_maxima'] ?> </a></td>



                            <td><a href="#" data-bs-toggle="modal" data-bs-target=".modaleditar<?php echo $linhaos['os_produtos_id'] ?>"><?php echo $linhaos['os_produtos_lote'] ?></a></td>

                            <td>

                                <div id="dvConteudo2<?php echo $linhaos['os_produtos_id'] ?>">

                                    <form id="formos2<?php echo $linhaos['os_produtos_id'] ?>" action="#" method="post">

                                        <button class="btn btn-outline-warning btn-sm edit">
                                            <i class="fas fa-check"></i>
                                        </button>


                                        <input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="id">
                                        <input type="hidden" value="<?php echo $linhaos['os_produtos_os'] ?>" name="os">
                                        <input type="hidden" value="<?php echo $linhaos['os_produtos_produto'] ?>" name="produto">
                                        <input type="hidden" value="<?php echo $linhaos['os_produtos_id'] ?>" name="idosproduto">
                                        <input type="hidden" value="<?php echo $linhaos['os_produtos_unidade'] ?>" name="unidade">


                                    </form>
                                </div>


                                <div id="dvConteudo3<?php echo $linhaos['os_produtos_id'] ?>" class="spinner" style="display: none">


                                    <!-- <div id="results2<?php echo $linhaos['os_produtos_id'] ?>"> </div> -->



                                    <img src="assets/images/checkp.gif" />

                                </div>
                            </td>



                            </tr>




                            <script>
                                $(document).ready(function() {

                                    $("#formos2<?php echo $linhaos['os_produtos_id'] ?>").submit(function() {

                                        var dados = jQuery(this).serialize();

                                        $.ajax({
                                            url: 'atualizar_os_produtos.php',
                                            cache: false,
                                            data: dados,
                                            type: "POST",

                                            success: function(msg) {

                                                $("#results2<?php echo $linhaos['os_produtos_id'] ?>").empty();
                                                $("#results2<?php echo $linhaos['os_produtos_id'] ?>").append(msg);
                                                document.getElementById("dvConteudo2<?php echo $linhaos['os_produtos_id'] ?>").style.display = "none";
                                                document.getElementById("dvConteudo3<?php echo $linhaos['os_produtos_id'] ?>").style.display = "block";


                                            }

                                        });

                                        return false;
                                    });

                                });
                            </script>




                        <?php } ?>

                        <!-- Fim lista os aberto  -->

                        </tbody>
                        </table>
                        </div>


                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="text-center"> <a href="os_abertas" class="btn btn-success"> Voltar para OS </a> </div>
    
    <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
    <script src="assets/js/pages/table-responsive.init.js"></script>