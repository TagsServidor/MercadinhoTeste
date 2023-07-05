<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";

$sqlos1= "SELECT * FROM os_reposicao os INNER JOIN unidades u ON os.os_unidade = u.id_unidade  where os.id_os_reposicao  = $id   ";
$resultadoos1 = mysqli_query($conn, $sqlos1);
$linhaos1  = mysqli_fetch_array($resultadoos1); 

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
                        <h4 class="mb-0">OS &gt; <?php echo $id ?> &gt;  <?php echo $linhaos1['unidade_nome'] ?> > <?php echo date('d/m/Y', strtotime($linhaos1['os_data'])); ?> </h4>

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
                                                <th data-priority="1" class="text-center">QTD A Repor</th>
                                               

                                                <th data-priority="3">Alerta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <?php // LISTANDO OS EM ABERTO

                                                $sqlosp = "SELECT * FROM os_produtos o2 inner join produtos p on o2.os_produtos_produto = p.id_produto inner join produtos_departamentos pd on   p.produto_departamento = pd.id_departamentos where o2.os_produtos_os  = '$id' and o2.os_produtos_status ='2' order by pd.departamento_os_posicao , o2.os_produtos_qtd   ";
                                                $resultadoosp  = mysqli_query($conn, $sqlosp);
                                                $totalosp  = mysqli_num_rows($resultadoosp);
                                                if ($totalosp == 0) {
                                                ?> <br>
                                                    OS sem produtos


                                                <?php

                                                } else {  ?>

                                                    <?php
$x=0;
                                                    while ($linhaos  = mysqli_fetch_array($resultadoosp)) {

$sqlal= "SELECT * FROM alertas_reposicao ar INNER JOIN adm ad ON ar.alerta_repositor = ad.id  where alerta_produto_unidade =  '$linhaos[os_produtos_id]'    ";
$resultadoal = mysqli_query($conn, $sqlal);
$alertas = mysqli_num_rows($resultadoal); 
$linhaal  = mysqli_fetch_array($resultadoal);


$x++;
                                                    ?>

                                </div>



<div class="modal fade bs-example-modal-lg<?php echo $linhaos['os_produtos_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myLargeModalLabel">Alerta Reposição</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                            
<strong> - Responsável  do alerta: </strong> <?php echo $linhaal['nome'] ?> <br> 
<strong> - Data Alerta: </strong> <?php echo date('d/m/Y', strtotime($linhaal['alerta_data'])); ?> às <?php echo $linhaal['alerta_hora'] ?> <br>

<hr>

<?php
$sqlal2= "SELECT * FROM alertas_reposicao ar INNER JOIN  aletar_motivos am ON  ar.alerta_motivo  = am.id_alerta INNER JOIN adm ad ON ar.alerta_repositor = ad.id where ar.alerta_produto_unidade =  '$linhaos[os_produtos_id]'    ";
$resultadoal2 = mysqli_query($conn, $sqlal2);
$alertas2 = mysqli_num_rows($resultadoal2); 
while ($linhaal2  = mysqli_fetch_array($resultadoal2)) {
?>

<strong> - Motivo do alerta: </strong> <?php echo $linhaal2['alerta_nome'] ?> <br>
<strong> - Registro: </strong>  <?php echo $linhaal2['alerta_valor'] ?> <br>
<hr>

<?php } ?>
<hr>
<strong> - Observações: </strong>  <?php echo $linhaal['alerta_observacoes'] ?> <br>


                                                            </div>
                                                        </div><!-- /.modal-content -->
                                                    </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->




                                
 <th><?php echo $x ?> </th>
                                <th><?php echo $linhaos['produto_nome'] ?> <span class="co-name"> </span></th>
                                <td class="bg-info text-center text-white font-weight-bold"><?php echo $linhaos['os_produtos_qtd'] ?> </td>
                              

                                <td>

                                    
<?php if ($alertas >= '1') { ?><button class="btn btn-warning btn-sm edit" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg<?php echo $linhaos['os_produtos_id'] ?>">
                                                                <i class="fas fa-eye"></i>
																 </button><?php } ?>
                                   
                                </td>

                                </tr>

                                

                        <?php }
                    } ?>

                        <!-- Fim lista os aberto  -->

                        </tbody>
                        </table>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="text-center"> <a href="os_concluidas" class="btn btn-success"> Voltar para OS </a> </div>
        
        <script src="assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script><!-- Init js -->
        <script src="assets/js/pages/table-responsive.init.js"></script>