<?php
require_once "template/common-header.php";
require_once "template/navbar.php";
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="container">
        <div class="col-xl-3 col-md-3 mb-4 float-left">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Temperatura</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $sql = "SELECT m.temperatura as temperatura
                            FROM measures m
                            JOIN stations s ON m.station_id = s.id
                            ORDER BY data, hora desc LIMIT 1
                            ";
                                $result = $link->query($sql);
                                $row = mysqli_fetch_array($result)[0];
                                echo $row . "º";
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Umidade (%)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $sql = "SELECT m.umidade as umidade
                            FROM measures m
                            JOIN stations s ON m.station_id = s.id
                            ORDER BY data, hora desc LIMIT 1
                            ";
                                $result = $link->query($sql);
                                $row = mysqli_fetch_array($result)[0];
                                echo $row . "";
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">CO (PPM)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                $sql = "SELECT m.co as co
                            FROM measures m
                            JOIN stations s ON m.station_id = s.id
                            ORDER BY data, hora desc LIMIT 1
                            ";
                                $result = $link->query($sql);
                                $row = mysqli_fetch_array($result)[0];
                                echo toFixed($row, 5) . "";
                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            Estação: <?php
                                $sql = "SELECT s.nome as station
                            FROM measures m
                            JOIN stations s ON m.station_id = s.id
                            ORDER BY data, hora desc LIMIT 1
                            ";
                                $result = $link->query($sql);
                                $row = mysqli_fetch_array($result)[0];
                                echo $row . "";
                                ?>
    </div>

    <div class="col-xl-9 col-md-9 mb-5 ">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Médias Recentes</h6>
                </div>

                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="mediaTemperaturas"></canvas>
                    </div>
                </div>
            </div>
    </div>

    <hr/>

    </div>
    <div class="clearfix"></div>
    <div class="row">
        <!-- Page Heading -->
        <div class="col-lg-6 col-md-6 mx-auto text-center">
            <h1 class="h3 mb-4 text-gray-800 ">Últimos 15 Registros</h1>

            <?php
            /*
            $sql = "SELECT COUNT(*) as totalPlanos from planos";
            $result = $link->query($sql);
            $row = mysqli_fetch_array($result)[0];
            echo "<p>Total de planos registrados: " . $row . ".</p>";
            $sql = "SELECT COUNT(*) as totalPagamentos from pagamentos where MONTH(data_pagamento) = MONTH(CURDATE()) AND YEAR(data_pagamento) = YEAR(CURDATE())";
            $result = $link->query($sql);
            $row = mysqli_fetch_array($result)[0];
            echo "<p>Total de pagamentos validados em " . date('m/Y') . ": " . $row . ".</p>";
            echo "$cur_month/$cur_year Paid Value: R$" . getPaidValue($cur_month, $cur_year) . " <br/>";
            echo "$cur_month/$cur_year Paid Speed: " . getPaidSpeed($cur_month, $cur_year) . "MB";            
            */
            ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Medidas:</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive col-lg-12">
                <table class="table table-bordered" id="dataTableIndex" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Local</th>
                            <th>CO</th>
                            <th>Temperatura</th>
                            <th>Umidade</th>
                            <th>Data</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Local</th>
                            <th>CO</th>
                            <th>Temperatura</th>
                            <th>Umidade</th>
                            <th>Data</th>
                            <th>Hora</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $result = $link->query("SELECT m.id as id, m.temperatura as temperatura, m.umidade as umidade, m.co as co, 
                        m.data as data, m.hora as hora, s.nome as station 
                        FROM measures m
                        JOIN stations s ON m.station_id = s.id
                        ORDER BY data, hora desc LIMIT 15");
                        foreach ($result as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['station'] . '</td>';
                            echo '<td>' . toFixed($row['co'], 5) . '</td>';
                            echo '<td>' . $row['temperatura'] . '</td>';
                            echo '<td>' . $row['umidade'] . '</td>';
                            echo '<td>' . $row['data'] . '</td>';
                            echo '<td>' . $row['hora'] . '</td>';
                            echo '<td>';
                            ?>
                            <a class="btn btn-danger" href="#" onclick="shouldDelete('measure', <?= $row['id'] ?>);">Remover</a>;
                            <?php
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/ms/graphs.js"></script>
<script src="js/ms/chart-lib.js"></script>
<script>
$(document).ready(function () {
	updateGraphs();
});
</script>
<?php

require_once "template/common-footer.php"

?>