<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
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


<div id="results"></div>

<div id="dvConteudo">

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">OS &gt; Abertas</h4>

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
                                <h4 class="card-title">Controle de OS em aberto</h4>


                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="tech-companies-1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Unidade</th>
                                                    <th data-priority="1">OS</th>
                                                    <th data-priority="3">Data</th>
                                                    <th data-priority="3">Ação</th>
													<th data-priority="3"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                    <?php // LISTANDO OS EM ABERTO

                                                    $sqlos = "SELECT * FROM os_reposicao o  inner join unidades u on o.os_unidade = u.id_unidade  inner join condominios c on u.unidade_condominio = c.id_condominio   where o.os_status  = '1' order by os_data desc  ";
                                                    $resultadoos = mysqli_query($conn, $sqlos);
                                                    $totalos = mysqli_num_rows($resultadoos);
                                                    while ($linhaos = mysqli_fetch_array($resultadoos)) {


                                                    ?>


                                                    <th><?php echo $linhaos['condominio_nome'] ?> - <?php echo $linhaos['unidade_nome'] ?> <span class="co-name"> </span></th>
                                                    <td><?php echo $linhaos['id_os_reposicao'] ?> </td>
                                                    <td><?php echo date('d/m/Y', strtotime($linhaos['os_data'])); ?></td>

                                                    <td>



                                                        <form id="formos<?php echo $linhaos['id_os_reposicao'] ?>" action="#" method="post">
                                                            <input type="hidden" value="<?php echo $linhaos['id_os_reposicao'] ?>" name="os">
                                                            <button class="btn btn-outline-secondary btn-sm edit">
                                                                <i class="fas fa-eye"></i>
                                                            </button>

                                                        </form>
														

                                                    </td>
 <td> <?php if (($user[id] == '1') or ($user[id] == '116')) { ?> <a href="remover_os/<?php echo $linhaos['id_os_reposicao'] ?>" onclick="return confirm('Deseja mesmo remover essa OS?');">
<button class="btn btn-outline-danger btn-sm edit">
                                                                <i class="fas fa-trash"></i>
	 </button></a> <?php } ?> </td>

                                                </tr>




                                                <script>
                                                    $(document).ready(function() {

                                                        $("#formos<?php echo $linhaos['id_os_reposicao'] ?>").submit(function() {

                                                            var dados = jQuery(this).serialize();

                                                            $.ajax({
                                                                url: 'ver_os_reposicao.php',
                                                                cache: false,
                                                                data: dados,
                                                                type: "POST",

                                                                success: function(msg) {

                                                                    $("#results").empty();
                                                                    $("#results").append(msg);
                                                                    document.getElementById("dvConteudo").style.display = "none";


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
          
                <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
                <script src="assets/js/pages/table-responsive.init.js"></script>
