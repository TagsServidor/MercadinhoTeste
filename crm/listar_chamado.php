<?php @session_start();
if (!empty($_SESSION['id'])) {
} else {
    $_SESSION['msg'] = "Área restrita";
    header("Location: logar.php");
}
include "bd/conexao.php";
?>


<?php


$result_chamados = "SELECT * FROM chamados order by data_chamado desc";
$resultado_chamados = mysqli_query($conn, $result_chamados);
$total_chamados = mysqli_num_rows($resultado_chamados);
?>


<script src="assets/js/jquery.js"></script>
<script src="assets/js/form_estoqueentrada.js"></script>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Css -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />







<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Chamados &gt; Listando Chamados</h4>

                    <div class="page-title-right">

                        <ol class="breadcrumb m-0">


                        </ol>
                    </div>

                </div>
            </div><br><br>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Temos um total de (<?php echo $total_chamados ?>) chamados registrados</h4><br>

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                           

                            <th>Data</th>
                             <th>Título</th>
                            <th>Status</th>
                            <th>Texto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>



                            <?php while ($rows_chamados = mysqli_fetch_assoc($resultado_chamados)) {
                            ?>
                                <td><?php echo $rows_chamados['id_chamado'] ?> </td>
                                 <td><?php echo date('d/m/Y', strtotime($rows_chamados['data_chamado']));  ?> </td>
                                <td><?php echo $rows_chamados['titulo_chamado'] ?> </td>
                               
                                <td><?php echo $rows_chamados['status_chamado'] ?> </td>
                                <td><?php echo $rows_chamados['texto_chamado'] ?> </td>
                                <td><a href="editar_chamado/<?php echo $rows_chamados['id_chamado'] ?>"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
                                </tr>   
                            <?php
                            }
                            ?>
                            </tbody>
                            </table>
                            
